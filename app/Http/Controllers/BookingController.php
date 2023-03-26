<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booking;
use App\Jobs\BorrowCheck;
use App\Jobs\ReturnNotify;
use Illuminate\Http\Request;
use App\Mail\BookConfirmation;
use App\Mail\BorrowConfirmation;
use App\Mail\ExtensionConfirmation;
use App\Mail\ReturnConfirmation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Show booking
     * 
     * @return object
     */ 
    public function show($booking)
    {
        $booking = Booking::where('code', $booking)->first();

        if ($booking === null) {
            abort(404);
        }

        if (!$booking->borrowed) {
            $diff = date_diff(date_create($booking->from), date_create(date('Y-m-d')))->format('%R%a');
            if ($diff > 5) {
                $problem = "Rezervace byla zrušena";
            }
        }

        return view('bookings.show', [
            'booking' => $booking,
        ]);
    }

    /**
     * Store booking data
     * 
     * @return object
     */ 
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'book_id' => 'exists:books,id',
            'user_id' => ['nullable', 'exists:users,id']
        ]);

        $formFields['code'] = uniqid();

        if (!isset($formFields['user_id'])) {
            $formFields['user_id'] = auth()->user()->id;
        }

        // Get user and book data
        $user = User::where('id', $formFields['user_id'])->first();
        $book = Book::where('id', $formFields['book_id'])->first();

        // Check if booking can be created for this user
        if (!$user->canBook) {
            return back()->with('message', 'Tento uživatel již má rezervovaných pět knih!')->with('color', 'fail');
        }
        if ($user->bookings->contains(function ($val) use ($book) {
            return $val->book_id == $book->id && !$val->returned;
        })) {
            return back()->with('message', 'Tento uživatel již má tuto knihu rezervovanou!')->with('color', 'fail');
        }

        // == Find the nearest date and time during opening hours ==
        // Search for the nearest day
        $opening = "false";
        $i = 0;
        while ($opening == "false") {
            $day = strtoupper(date('D', strtotime(now('Europe/Prague')->addDays($i))));
            $opening = $_ENV['LIBRARY_' . $day];
            $i += 1;

            if ($i > 7) {
                return back()->with('message', 'V blízké době nebude knihovna otevřena!')->with('color', 'fail');
            }
        }
        $i -= 1;

        // Check if the library was already closed
        $now = now('Europe/Prague');
        $shifts = explode(',', $opening);
        foreach ($shifts as $shift) {
            $hours = explode('-', $shift);

            if (date_diff(date_create($now), date_create(date('Y-m-d', strtotime($now)) . ' ' . $hours[0]))->format('%R') == "+") {
                $from = strtotime(date('Y-m-d', strtotime($now)) . ' ' . $hours[0]);
                continue;
            } elseif (date_diff(date_create($now), date_create(date('Y-m-d', strtotime($now)) . ' ' . $hours[1]))->format('%R') == "+") {
                $from = strtotime($now);
                continue;
            } else {
                $from = false;
            }
        }

        // If the library is closed already, search for next open day
        if ($from === false) {
            $opening = "false";
            $i += 1;

            while ($opening == "false") {
                $day = strtoupper(date('D', strtotime(now('Europe/Prague')->addDays($i))));
                $opening = $_ENV['LIBRARY_' . $day];
                $i += 1;
            }
            $i -= 1;
            $shifts = explode(',', $opening);
            $from = strtotime(date('Y-m-d', strtotime(now('Europe/Prague')->addDays($i))) . ' ' . explode('-', $shifts[0])[0]);
        }

        $formFields['from'] = date('Y-m-d H:i:s', $from);
        $formFields['to'] = date('Y-m-d H:i:s', strtotime('+1 month', $from));
        $formFields['borrowed'] = 0;
        $formFields['returned'] = 0;

        if ($book === null || $book->date !== true) {
            return back()->with('message', 'Tuto knihu si nelze rezervovat!')->with('color', 'fail');
        }

        if (($formFields['user_id'] !== auth()->user()->id) && !auth()->user()->librarian) {
            return back()->with('message', 'Nemáte oprávnění vytvořit tuto rezervaci!')->with('color', 'fail');
        }

        // Create the booking
        $booking = Booking::create($formFields);
        // Dispatch a job to check in 6 days if the user has borrowed the book
        dispatch(new BorrowCheck($booking))->delay(strtotime('+6 days', $from) - strtotime(now('Europe/Prague')));
        // Email the user about the booking
        Mail::to($booking->user->email)->send(new BookConfirmation($booking));
        // Redirect the user
        if (auth()->user()->librarian) {
            return redirect('/rezervace/' . $booking->code)->with('message', 'Rezervace byla úspěšně vytvořena!')->with('color', 'success');
        }
        return back()->with('message', 'Rezervace byla úspěšně vytvořena!')->with('color', 'success');
    }

    /**
     * Update booking data
     * 
     * @return object
     */ 
    public function update(Request $request, Booking $booking)
    {
        if (!isset($request->type)) {
            return back()->with('message', 'Pro změnu rezervace použijte ovládací prvky webu!')->with('color', 'fail');
        } elseif (!auth()->user()->librarian) {
            return back()->with('message', 'Nemáte oprávnění změnit stav rezervace!')->with('color', 'fail');
        } elseif ($request->type == 'manage') {
            $formFields = $request->validate([
                'status' => 'required',
            ]);

            $updateFields = [];
            if ($formFields['status'] == 'booked') {
                $updateFields['borrowed'] = 0;
                $updateFields['returned'] = 0;
            } elseif ($formFields['status'] == 'borrowed') {
                $updateFields['borrowed'] = 1;
                $updateFields['returned'] = 0;
                Mail::to($booking->user->email)->send(new BorrowConfirmation($booking));
            } elseif ($formFields['status'] == 'returned') {
                $updateFields['returned'] = 1;
                Mail::to($booking->user->email)->send(new ReturnConfirmation($booking));
            }

            $booking->update($updateFields);
            return back()->with('message', 'Stav rezervace byl úspěšně změněn!')->with('color', 'success');
        } elseif ($request->type == 'extend') {
            if ($booking->extendable === false) {
                return back()->with('message', 'Tuto rezervaci nelze prodloužit!')->with('color', 'fail');
            } elseif (!auth()->user()->librarian && $booking->user->id !== auth()->user()->id) {
                return back()->with('message', 'Nemáte oprávnění prodloužit tuto rezervaci!')->with('color', 'fail');
            }

            $updateFields = [
                'to' => date('Y-m-d H:i:s', strtotime('+1 month', strtotime($booking->to))),
            ];

            $booking->update($updateFields);
            Mail::to($booking->user->email)->send(new ExtensionConfirmation($booking));
            dispatch(new ReturnNotify($booking))->delay(strtotime('-5 days', strtotime($updateFields['to'])) - strtotime(now('Europe/Prague')));
            return back()->with('message', 'Rezervace byla prodloužena o měsíc!')->with('color', 'success');
        }
    }
}

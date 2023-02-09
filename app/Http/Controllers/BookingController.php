<?php

namespace App\Http\Controllers;

use App\Jobs\BorrowCheck;
use App\Models\Book;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Get one booking
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

    // Store booking data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'book_id' => 'exists:books,id',
            'user_id' => ['nullable', 'exists:users,id']
        ]);

        $formFields['code'] = uniqid();
        $formFields['from'] = now();
        $formFields['to'] = Date('Y-m-d h:i:s', strtotime('+1 month', now()->getTimestamp()));
        $formFields['borrowed'] = 0;
        $formFields['returned'] = 0;

        $book = Book::where('id', $formFields['book_id'])->first();

        if ($book === null || $book->date !== true) {
            return back()->with('message', 'Tuto knihu si nelze rezervovat!')->with('color', 'fail');
        }

        if (!isset($formFields['user_id'])) {
            $formFields['user_id'] = auth()->user()->id;
        }

        if (($formFields['user_id'] !== auth()->user()->id) && !auth()->user()->librarian) {
            return back()->with('message', 'Nemáte oprávnění vytvořit tuto rezervaci!')->with('color', 'fail');
        }

        $booking = Booking::create($formFields);
        dispatch(new BorrowCheck($booking))->delay(now()->addDays(5));
        return back()->with('message', 'Rezervace byla úspěšně vytvořena!')->with('color', 'success');
    }

    // Update booking data
    public function update(Request $request, Booking $booking)
    {
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
        } elseif ($formFields['status'] == 'returned') {
            $updateFields['returned'] = 1;
        }

        $booking->update($updateFields);
        return back()->with('message', 'Stav rezervace byl úspěšně změněn!')->with('color', 'success');
    }
}

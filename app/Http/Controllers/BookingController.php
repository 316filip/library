<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
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

        if(!isset($formFields['user_id'])) {
            $formFields['user_id'] = auth()->user()->id;
        }

        if (($formFields['user_id'] !== auth()->user()->id) && !auth()->user()->admin) {
            return back()->with('message', 'Nemáte oprávnění vytvořit tuto rezervaci!')->with('color', 'fail');
        }

        Booking::create($formFields);
        return back()->with('message', 'Rezervace byla úspěšně vytvořena!')->with('color', 'success');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Work;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Get one book
    public function show($work, Book $book)
    {
        return view('books.show', [
            'book' => $book
        ]);
    }

    // Show create form
    public function create()
    {
        return view('books.create', [
            'works' => Work::orderBy('title')->get()
        ]);
    }

    // Store book data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'work_id' => 'required',
            'title' => 'required',
            'subtitle' => 'nullable',
            'length' => 'required',
            'language' => 'required',
            'translator' => 'nullable',
            'illustrator' => 'nullable',
            'description' => 'nullable',
            'house' => 'required',
            'year' => 'required',
            'publication' => 'nullable',
            'place' => 'nullable',
            'image' => 'nullable|image',
            'ISBN' => 'nullable',
            'amount' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('books', 'public');
        }

        $book = Book::create($formFields);

        return redirect('/')->with('message', 'Kniha byla úspěšně přidána do knihovny!')->with('color', 'success')->with('link', '/kniha/' . $book->work->slug . '/' . $book->id);
    }

    // Show edit form
    public function edit($work, Book $book)
    {
        return view('books.edit', [
            'book' => $book,
            'works' => Work::orderBy('title')->get()
        ]);
    }

    // Update book data
    public function update(Request $request, Book $book)
    {
        $formFields = $request->validate([
            'work_id' => 'required',
            'title' => 'required',
            'subtitle' => 'nullable',
            'length' => 'required',
            'language' => 'required',
            'translator' => 'nullable',
            'illustrator' => 'nullable',
            'description' => 'nullable',
            'house' => 'required',
            'year' => 'required',
            'publication' => 'nullable',
            'place' => 'nullable',
            'image' => 'nullable|image',
            'ISBN' => 'nullable',
            'amount' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('books', 'public');
        } elseif ($request->image_update == 1) {
            $formFields['image'] = null;
        }

        $book->update($formFields);

        return redirect('/kniha/' . $book->work->slug . '/' . $book->id)->with('message', 'Kniha byla úspěšně upravena!')->with('color', 'success');
    }

    // Delete book
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/')->with('message', 'Kniha byla úspěšně odstraněna!')->with('color', 'success');
    }
}

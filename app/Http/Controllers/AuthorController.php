<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Get all authors
    public function index()
    {
        return view('authors.index', [
            'authors' => Author::all()
        ]);
    }

    // Show create form
    public function create()
    {
        return view('authors.create');
    }

    // Get one author
    public function show(Author $author)
    {
        return view('authors.show', [
            'author' => $author
        ]);
    }

    // Store author data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name_prefix' => 'nullable',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'name_suffix' => 'nullable',
            'birth_date' => 'nullable',
            'death_date' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('authors', 'public');
        }

        $author = Author::create($formFields);

        return redirect('/')->with('message', 'Autor byl úspěšně přidán do knihovny!')->with('color', 'success')->with('link', '/autor/' . $author->id);
    }

    // Show edit form
    public function edit(Author $author)
    {
        return view('authors.edit', ['author' => $author]);
    }

    // Update author data
    public function update(Request $request, Author $author)
    {
        $formFields = $request->validate([
            'name_prefix' => 'nullable',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'name_suffix' => 'nullable',
            'birth_date' => 'nullable',
            'death_date' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('authors', 'public');
        } elseif ($request->image_update == 1) {
            $formFields['image'] = null;
        }

        $author->update($formFields);

        return redirect('/autor/' . $author->id)->with('message', 'Profil autora byl úspěšně změněn!')->with('color', 'success');
    }

    // Delete author
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect('/')->with('message', 'Profil autora byl úspěšně odstraněn!')->with('color', 'success');
    }
}

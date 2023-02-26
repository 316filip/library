<?php

namespace App\Http\Controllers;

use App\Helpers\AuthorHelper;
use App\Models\Author;
use Illuminate\Support\Str;
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

    // Get one author
    public function show($author)
    {
        $author = AuthorHelper::find($author);
        return view('authors.show', [
            'author' => $author
        ]);
    }

    // Show create form
    public function create()
    {
        return view('authors.create');
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

        $auto_slug = $formFields['first_name'] . '-' . (isset($formFields['middle_name']) ? $formFields['middle_name'] . '-' : '') . $formFields['last_name'];
        $slug = Str::of(preg_replace('/[^a-z0-9 -]+/', '', $auto_slug))->ascii()->lower();
        $i = 2;
        while (Author::where('slug', $slug)->get()->count() !== 0) {
            $slug = $auto_slug . '-' . $i;
            $i += 1;
        }
        $formFields['slug'] = Str::of($slug)->ascii()->lower();

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('authors', 'public');
        }

        $author = Author::create($formFields);

        return redirect('/')->with('message', 'Autor byl úspěšně přidán do knihovny!')->with('color', 'success')->with('link', '/autor/' . $author->slug);
    }

    // Show edit form
    public function edit($author)
    {
        $author = AuthorHelper::find($author);
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

        $auto_slug = $formFields['first_name'] . '-' . (isset($formFields['middle_name']) ? $formFields['middle_name'] . '-' : '') . $formFields['last_name'];
        $slug = $auto_slug;
        if (Str::of(preg_replace('/[^a-z0-9 -]+/', '', $slug))->ascii()->lower() != $author->slug) {
            $i = 1;
            while (Author::where('slug', $slug)->get()->count() !== 0) {
                $slug = $auto_slug . '-' . $i;
                $i += 1;
            }
        }
        $formFields['slug'] = Str::of($slug)->ascii()->lower();

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('authors', 'public');
        } elseif ($request->image_update == 1) {
            $formFields['image'] = null;
        }

        $author->update($formFields);

        return redirect('/autor/' . $author->slug)->with('message', 'Profil autora byl úspěšně změněn!')->with('color', 'success');
    }

    // Delete author
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect('/')->with('message', 'Profil autora byl úspěšně odstraněn!')->with('color', 'success');
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\AuthorHelper;
use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Show author
     * 
     * @return object
     */
    public function show($author)
    {
        $author = AuthorHelper::find($author);
        return view('authors.show', [
            'author' => $author
        ]);
    }

    /**
     * Show create form
     * 
     * @return object
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store author data
     * 
     * @return object
     */
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

        // Generate URL slug
        $slug = Str::of($formFields['first_name'] . '-' . (isset($formFields['middle_name']) ? $formFields['middle_name'] . '-' : '') . $formFields['last_name'])->slug('-');
        $end = '';
        $i = 2;
        while (Author::where('slug', $slug . $end)->get()->count() !== 0) {
            // While there are authors with this slug, increase number at the end
            $end = '-' . $i;
            $i += 1;
        }
        $formFields['slug'] = $slug . $end;

        // Store attached image
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('authors', 'public');
        }

        $author = Author::create($formFields);

        return redirect('/knihovna')->with('message', 'Autor byl úspěšně přidán do knihovny!')->with('color', 'success')->with('link', '/autor/' . $author->slug);
    }

    /**
     * Show edit form
     * 
     * @return object
     */
    public function edit($author)
    {
        $author = AuthorHelper::find($author);
        return view('authors.edit', ['author' => $author]);
    }

    /**
     * Update author data
     * 
     * @return object
     */
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

        // Generate URL slug
        $slug = Str::of($formFields['first_name'] . '-' . (isset($formFields['middle_name']) ? $formFields['middle_name'] . '-' : '') . $formFields['last_name'])->slug('-');
        if ($slug != $author->slug) {
            // If the new slug is different from the previous one, check it
            $end = '';
            $i = 2;
            while (Author::where('slug', $slug . $end)->get()->count() !== 0) {
                // While there are authors with this slug, increase number at the end
                $end = '-' . $i;
                $i += 1;
            }
        }
        $formFields['slug'] = $slug . $end;

        // Store attached image
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('authors', 'public');
        } elseif ($request->image_update == 1) {
            $formFields['image'] = null;
        }

        $author->update($formFields);

        return redirect('/autor/' . $author->slug)->with('message', 'Profil autora byl úspěšně změněn!')->with('color', 'success');
    }

    /**
     * Delete author
     * 
     * @return object
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect('/knihovna')->with('message', 'Profil autora byl úspěšně odstraněn!')->with('color', 'success');
    }
}

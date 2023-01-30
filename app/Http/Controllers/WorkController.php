<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    // Get all works
    public function index()
    {
        return view('works.index', [
            'works' => Work::all()
        ]);
    }

    // Get one work
    public function show(Work $work)
    {
        return view('works.show', [
            'work' => $work
        ]);
    }

    // Show create form
    public function create()
    {
        return view('works.create', [
            'authors' => Author::orderBy("last_name")->get()
        ]);
    }

    // Store work data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'author_id' => 'required',
            'title' => 'required',
            'original_title' => 'nullable',
            'year' => 'nullable',
            'description' => 'nullable',
            'subtitle' => 'nullable',
            'language' => 'required',
            'class' => 'required',
            'genre' => 'nullable',
            'number' => 'nullable'
        ]);

        $work = Work::create($formFields);

        return redirect('/')->with('message', 'Titul byl úspěšně přidán do knihovny!')->with('color', 'success')->with('link', '/titul/' . $work->id);
    }

    // Show edit form
    public function edit(Work $work)
    {
        return view('works.edit', [
            'work' => $work,
            'authors' => Author::orderBy("last_name")->get()
        ]);
    }

    // Update work data
    public function update(Request $request, Work $work)
    {
        $formFields = $request->validate([
            'author_id' => 'required',
            'title' => 'required',
            'original_title' => 'nullable',
            'year' => 'nullable',
            'description' => 'nullable',
            'subtitle' => 'nullable',
            'language' => 'required',
            'class' => 'required',
            'genre' => 'nullable',
            'number' => 'nullable'
        ]);

        $work->update($formFields);

        return redirect('/titul/' . $work->id)->with('message', 'Titul byl úspěšně změněn!')->with('color', 'success');
    }

    // Delete work
    public function destroy(Work $work)
    {
        $work->delete();
        return redirect('/')->with('message', 'Titul byl úspěšně odstraněn!')->with('color', 'success');
    }
}

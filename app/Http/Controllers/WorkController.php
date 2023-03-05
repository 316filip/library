<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Author;
use App\Helpers\WorkHelper;
use App\Models\Assignment;
use App\Models\Category;
use Illuminate\Support\Str;
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
    public function show($work)
    {
        $work = WorkHelper::find($work);
        return view('works.show', [
            'work' => $work
        ]);
    }

    // Show create form
    public function create()
    {
        return view('works.create', [
            'authors' => Author::orderBy("last_name")->get(),
            'categories' => Category::orderBy("name")->get(),
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

        if ($request->category_id != '') {
            foreach (explode(', ', $request->category_id) as $id) {
                if (Category::where('id', $id)->first() == null) {
                    return back()->withInput($request->input())->withErrors(['category_id' => 'Použili jste kategorii, která neexistuje.']);
                }
            }
        }

        $auto_slug = join('-', explode(' ', $formFields['title']));
        $slug = preg_replace('/[^a-z0-9 -]+/', '', Str::of($auto_slug)->ascii()->lower());
        $i = 2;
        while (Work::where('slug', $slug)->get()->count() !== 0) {
            $slug = $auto_slug . '-' . $i;
            $i += 1;
        }
        $formFields['slug'] = Str::of($slug)->ascii()->lower();

        $work = Work::create($formFields);

        if ($request->category_id != '') {
            foreach (explode(', ', $request->category_id) as $id) {
                Assignment::create([
                    'work_id' => $work->id,
                    'category_id' => $id,
                ]);
            }
        }

        return redirect('/knihovna')->with('message', 'Titul byl úspěšně přidán do knihovny!')->with('color', 'success')->with('link', '/titul/' . $work->slug);
    }

    // Show edit form
    public function edit($work)
    {
        $work = WorkHelper::find($work);

        $identifiers = [];
        $names = [];
        $assignments = Assignment::where('work_id', $work->id)->get();
        foreach ($assignments as $assignment) {
            array_push($identifiers, $assignment->category_id);
            array_push($names, $assignment->category->name);
        }

        return view('works.edit', [
            'work' => $work,
            'authors' => Author::orderBy('last_name')->get(),
            'categories' => Category::orderBy('name')->get(),
            'target' => [join(', ', $identifiers), join(', ', $names)],
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

        // Check for problems with categories
        if ($request->category_id != '') {
            foreach (explode(', ', $request->category_id) as $id) {
                if (Category::where('id', $id)->first() == null) {
                    return back()->withInput($request->input())->withErrors(['category_id' => 'Použili jste kategorii, která neexistuje.']);
                }
            }
        }

        $auto_slug = join('-', explode(' ', $formFields['title']));
        $slug = preg_replace('/[^a-z0-9 -]+/', '', Str::of($auto_slug)->ascii()->lower());
        if (Str::of($slug)->ascii()->lower() != $work->slug) {
            $i = 2;
            while (Work::where('slug', $slug)->get()->count() !== 0) {
                $slug = $auto_slug . '-' . $i;
                $i += 1;
            }
        }
        $formFields['slug'] = Str::of($slug)->ascii()->lower();

        $work->update($formFields);

        // Remove all connections to categories
        Assignment::where('work_id', $work->id)->delete();

        // Create new connections to categories
        if ($request->category_id != '') {
            foreach (explode(', ', $request->category_id) as $id) {
                Assignment::create([
                    'work_id' => $work->id,
                    'category_id' => $id,
                ]);
            }
        }

        return redirect('/titul/' . $work->slug)->with('message', 'Titul byl úspěšně změněn!')->with('color', 'success');
    }

    // Delete work
    public function destroy(Work $work)
    {
        $work->delete();
        return redirect('/knihovna')->with('message', 'Titul byl úspěšně odstraněn!')->with('color', 'success');
    }
}

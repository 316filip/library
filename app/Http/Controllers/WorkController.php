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
    /**
     * Show work
     * 
     * @return object
     */
    public function show($work)
    {
        $work = WorkHelper::find($work);
        return view('works.show', [
            'work' => $work
        ]);
    }

    /**
     * Show create form
     * 
     * @return object
     */
    public function create()
    {
        return view('works.create', [
            'authors' => Author::orderBy("last_name")->get(),
            'categories' => Category::orderBy("name")->get(),
        ]);
    }

    /**
     * Store work data
     * 
     * @return object
     */
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

        // Check for problems with categories
        if ($request->category_id != '') {
            foreach (explode(', ', $request->category_id) as $id) {
                if (Category::where('id', $id)->first() == null) {
                    return back()->withInput($request->input())->withErrors(['category_id' => 'Použili jste kategorii, která neexistuje.']);
                }
            }
        }

        // Generate URL slug
        $slug = Str::of($formFields['title'])->slug('-');
        $end = '';
        $i = 2;
        while (Work::where('slug', $slug . $end)->get()->count() !== 0) {
            // While there are works with this slug, increase number at the end
            $end = '-' . $i;
            $i += 1;
        }
        $formFields['slug'] = $slug . $end;

        $work = Work::create($formFields);

        // Assign categories
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

    /**
     * Show edit form
     * 
     * @return object
     */
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

    /**
     * Update work data
     * 
     * @return object
     */
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

        // Generate URL slug
        $slug = Str::of($formFields['title'])->slug('-');
        if ($slug != $work->slug) {
            // If the new slug is different from the previous one, check it
            $end = '';
            $i = 2;
            while (Work::where('slug', $slug)->get()->count() !== 0) {
                // While there are works with this slug, increase number at the end
                $end = '-' . $i;
                $i += 1;
            }
        }
        $formFields['slug'] = $slug . $end;

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

    /**
     * Delete work
     * 
     * @return object
     */
    public function destroy(Work $work)
    {
        $work->delete();
        return redirect('/knihovna')->with('message', 'Titul byl úspěšně odstraněn!')->with('color', 'success');
    }
}

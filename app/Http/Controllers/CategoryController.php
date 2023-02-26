<?php

namespace App\Http\Controllers;

use App\Helpers\CategoryHelper;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Get one category
    public function show($category)
    {
        $category = CategoryHelper::find($category);

        return redirect('/knihovna?filter=category&query=' . $category->slug);
    }

    // Show create form
    public function create()
    {
        return view('categories.create');
    }

    // Store category data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $auto_slug = join('-', preg_replace('/[^a-z0-9 -]+/', '', explode(' ', $formFields['name'])));
        $slug = Str::of($auto_slug)->ascii()->lower();
        if (Category::where('slug', $slug)->get()->count() !== 0) {
            return back()->with('message', 'Podobná kategorie už existuje!')->with('color', 'fail');
        }
        $formFields['slug'] = Str::of($slug)->ascii()->lower();

        $category = Category::create($formFields);

        return redirect('/')->with('message', 'Kategorie byla úspěšně vytvořena!')->with('color', 'success')->with('link', '/knihovna?filter=category&query=' . $category->slug);
    }

    // Show edit form
    public function edit($category)
    {
        $category = CategoryHelper::find($category);
        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    // Update category data
    public function update(Request $request, Category $category)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $auto_slug = join('-', preg_replace('/[^a-z0-9 -]+/', '', explode(' ', $formFields['name'])));
        $slug = Str::of($auto_slug)->ascii()->lower();
        if ($slug != $category->slug) {
            if (Category::where('slug', $slug)->get()->count() !== 0) {
                return back()->with('message', 'Podobná kategorie už existuje!')->with('color', 'fail');
            }
        }
        $formFields['slug'] = Str::of($slug)->ascii()->lower();

        $category->update($formFields);

        return redirect('/knihovna?filter=category&query=' . $category->slug)->with('message', 'Kategorie byla úspěšně změněna!')->with('color', 'success');
    }

    // Delete category
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/')->with('message', 'Kategorie byla úspěšně odstraněna!')->with('color', 'success');
    }
}

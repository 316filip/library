<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Author;
use App\Models\Category;
use App\Helpers\SearchHelper;

class BrowseController extends Controller
{
    // Browse works and authors
    public function browse()
    {
        if (request('filter') !== null) {
            if (request('filter') == 'category' && request('query') !== null) {
                $category = Category::where('slug', request('query'))->first();
                return view('categories.show', [
                    'category' => $category,
                    'assignments' => $category->assignments->paginate(12),
                ]);
            } elseif (request('filter') == 'search') {
                return view('search', [
                    'results' => SearchHelper::search()
                ]);
            }
        }

        return view('browse', [
            'works' => Work::orderByDesc('year')->get(),
            'authors' => Author::orderByDesc('birth_date')->get(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Work;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    // Browse works and authors
    public function browse()
    {
        return view('browse', [
            'works' => Work::orderByDesc('year')->get(),
            'authors' => Author::orderByDesc('birth_date')->get(),
        ]);
    }
}

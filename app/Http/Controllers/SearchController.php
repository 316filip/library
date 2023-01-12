<?php

namespace App\Http\Controllers;

use App\Helpers\SearchHelper;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class SearchController extends Controller
{
    public function search()
    {
        return view('search', [
            'results' => SearchHelper::search()
        ]);
    }
}

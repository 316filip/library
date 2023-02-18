<?php

namespace App\Http\Controllers;

use App\Helpers\SearchHelper;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Spatie\FlareClient\View;

class SearchController extends Controller
{
    public function quick()
    {
        return SearchHelper::search();
    }
}

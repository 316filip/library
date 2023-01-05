<?php

use App\Models\Book;
use App\Models\Work;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Return first five quick search results from each table ordered by similarity to the query
Route::get('/search', function () {
    $request = "%" . str_replace(" ", "%", request("query")) . "%";

    $author_query = Author::query();
    $author_query->where(DB::raw('concat(name_prefix, " ", first_name, " ", middle_name, " ", last_name, " ", name_suffix)'), 'like', $request);
    $author = $author_query->get();
    foreach ($author as $i => $item) {
        similar_text(strtolower($author[$i]['name']), strtolower(request('query')), $percent);
        $author[$i]['similarity'] = $percent;
    }

    $work_query = Work::query();
    $work_query->where(DB::raw('concat(title, " ", subtitle, " ", description)'), 'like', $request);
    $work = $work_query->get();
    foreach ($work as $i => $item) {
        similar_text(strtolower($work[$i]['title']), strtolower(request('query')), $percent);
        $work[$i]['similarity'] = $percent;
    }

    $book_query = Book::query();
    $book_query->where(DB::raw('concat(title, " ", subtitle, " ", description)'), 'like', $request);
    $book = $book_query->get();
    foreach ($book as $i => $item) {
        similar_text(strtolower($book[$i]['title']), strtolower(request('query')), $percent);
        $book[$i]['similarity'] = $percent;
    }

    return [
        'author' => $author->sortByDesc('similarity')->values()->take(5),
        'work' => $work->sortByDesc('similarity')->values()->take(5),
        'book' => $book->sortByDesc('similarity')->values()->take(5)
    ];
});

<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\Work;
use Illuminate\Http\Request;
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
    $author = Author::search(request("query"))->get();
    $work = Work::search(request("query"))->get();
    $book = Book::search(request("query"))->get();
    foreach ($author as $i => $item) {
        similar_text(strtolower($author[$i]['name']), strtolower(request('query')), $percent);
        $author[$i]['similarity'] = $percent;
    }
    foreach ($work as $i => $item) {
        similar_text(strtolower($work[$i]['title']), strtolower(request('query')), $percent);
        $work[$i]['similarity'] = $percent;
    }
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

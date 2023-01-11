<?php

namespace App\Helpers;

use App\Models\Book;
use App\Models\Work;
use App\Models\Author;
use Illuminate\Support\Facades\DB;

class SearchHelper
{
    public static function search()
    {
        $request = "%" . str_replace(" ", "%", request("query")) . "%";

        if (request('in') == 'all' || request('in') == 'author') {
            $author_query = Author::query();
            $author_query->where(DB::raw('concat(name_prefix, " ", first_name, " ", middle_name, " ", last_name, " ", name_suffix)'), 'like', $request);
            $author = $author_query->get();
            foreach ($author as $i => $item) {
                similar_text(strtolower($author[$i]['name']), strtolower(request('query')), $percent);
                $author[$i]['similarity'] = $percent;
            }
        }

        if (request('in') == 'all' || request('in') == 'work') {
            $work_query = Work::query();
            $work_query->where(DB::raw('concat(title, " ", subtitle, " ", description)'), 'like', $request);
            $work = $work_query->get();
            foreach ($work as $i => $item) {
                similar_text(strtolower($work[$i]['title']), strtolower(request('query')), $percent);
                $work[$i]['similarity'] = $percent;
            }
        }

        if (request('in') == 'all' || request('in') == 'book') {
            $book_query = Book::query();
            $book_query->where(DB::raw('concat(title, " ", subtitle, " ", description)'), 'like', $request);
            $book = $book_query->get();
            foreach ($book as $i => $item) {
                similar_text(strtolower($book[$i]['title']), strtolower(request('query')), $percent);
                $book[$i]['similarity'] = $percent;
            }
        }

        if (request('in') == 'all') {
            return [
                'author' => $author->sortByDesc('similarity')->values()->take(7),
                'work' => $work->sortByDesc('similarity')->values()->take(7),
                'book' => $book->sortByDesc('similarity')->values()->take(7)
            ];
        }
        if (request('in') == 'author') {
            return [
                'author' => $author->sortByDesc('similarity')->values()->paginate(6),
                'work' => [],
                'book' => []
            ];
        }
        if (request('in') == 'work') {
            return [
                'author' => [],
                'work' => $work->sortByDesc('similarity')->values()->paginate(6),
                'book' => []
            ];
        }
        if (request('in') == 'book') {
            return [
                'author' => [],
                'work' => [],
                'book' => $book->sortByDesc('similarity')->values()->paginate(6)
            ];
        }
    }
}

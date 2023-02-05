<?php

namespace App\Helpers;

use App\Models\Book;
use App\Models\Work;
use App\Models\Author;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SearchHelper
{
    public static function search()
    {
        $request = "%" . str_replace(" ", "%", request("query")) . "%";

        if (request('in') == 'quick' || request('in') == 'all' || request('in') == 'author') {
            $author_query = Author::query();
            $author_query->where(DB::raw('concat(coalesce(name_prefix, ""), " ", first_name, " ", coalesce(middle_name, ""), " ", last_name, " ", coalesce(name_suffix, ""))'), 'like', $request);
            $author = $author_query->get();
            foreach ($author as $i => $item) {
                similar_text(strtolower($author[$i]['name']), strtolower(request('query')), $percent);
                $author[$i]['similarity'] = $percent;
            }
        }

        if (request('in') == 'quick' || request('in') == 'all' || request('in') == 'work') {
            $work_query = Work::query();
            $work_query->where(DB::raw('concat(title, " ", coalesce(original_title, ""), " ", coalesce(subtitle, ""), " ", coalesce(description, ""))'), 'like', $request);
            $work = $work_query->get();
            foreach ($work as $i => $item) {
                similar_text(strtolower($work[$i]['title']), strtolower(request('query')), $percent);
                $work[$i]['similarity'] = $percent;
            }
        }

        if (request('in') == 'quick' || request('in') == 'all' || request('in') == 'book') {
            $book_query = Book::query();
            $book_query->where(DB::raw('concat(title, " ", coalesce(subtitle, ""), " ", coalesce(description, ""))'), 'like', $request);
            $book = $book_query->get();
            foreach ($book as $i => $item) {
                similar_text(strtolower($book[$i]['title']), strtolower(request('query')), $percent);
                $book[$i]['similarity'] = $percent;
            }
        }

        if (auth()->check()) {
            if (request('in') == 'quick' || request('in') == 'all' || request('in') == 'user') {
                $user_query = User::query();
                $user_query->where(DB::raw('concat(first_name, " ", last_name, " ", code)'), 'like', $request);
                $user = $user_query->get();
                foreach ($user as $i => $item) {
                    similar_text(strtolower($user[$i]['title']), strtolower(request('query')), $percent);
                    $user[$i]['similarity'] = $percent;
                }
            }
        } else {
            $user = collect([]);
        }

        if (request('in') == 'quick') {
            return [
                'author' => $author->sortByDesc('similarity')->values()->take(5),
                'work' => $work->sortByDesc('similarity')->values()->take(5),
                'book' => $book->sortByDesc('similarity')->values()->take(5),
                'user' => $user->sortByDesc('similarity')->values()->take(5),
            ];
        }
        if (request('in') == 'all') {
            return [
                'author' => $author->sortByDesc('similarity')->values()->take(8),
                'work' => $work->sortByDesc('similarity')->values()->take(8),
                'book' => $book->sortByDesc('similarity')->values()->take(8),
                'user' => $user->sortByDesc('similarity')->values()->take(8),
            ];
        }
        if (request('in') == 'author') {
            return [
                'author' => $author->sortByDesc('similarity')->values()->paginate(6),
                'work' => [],
                'book' => [],
                'user' => [],
            ];
        }
        if (request('in') == 'work') {
            return [
                'author' => [],
                'work' => $work->sortByDesc('similarity')->values()->paginate(6),
                'book' => [],
                'user' => [],
            ];
        }
        if (request('in') == 'book') {
            return [
                'author' => [],
                'work' => [],
                'book' => $book->sortByDesc('similarity')->values()->paginate(6),
                'user' => [],
            ];
        }
        if (request('in') == 'user') {
            return [
                'author' => [],
                'work' => [],
                'book' => [],
                'user' => $user->sortByDesc('similarity')->values()->paginate(6),
            ];
        }
    }
}

<?php

namespace App\Helpers;

use App\Models\Book;
use App\Models\Work;
use App\Models\Author;
use App\Models\Booking;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SearchHelper
{
    public static function search()
    {
        $request = "%" . str_replace(" ", "%", request("query")) . "%";

        if (request('in') == 'quick' || request('in') == 'all' || request('in') == 'author') {
            $author_query = Author::query();
            $author_query->where(DB::raw('concat(coalesce(name_prefix, ""), " ", first_name, " ", coalesce(middle_name, ""), " ", last_name, " ", coalesce(name_suffix, ""))'), 'like', $request)->where('id', '<>', 1);
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
                $book[$i]['work'] = $item->work;
            }
        }

        if (auth()->check() && auth()->user()->librarian) {
            if (request('in') == 'quick' || request('in') == 'all' || request('in') == 'user') {
                $user_query = User::query();
                $user_query->where(DB::raw('concat(first_name, " ", last_name, " ", code)'), 'like', $request);
                $user = $user_query->get();
                foreach ($user as $i => $item) {
                    similar_text(strtolower($user[$i]['name']), strtolower(request('query')), $percent);
                    $user[$i]['similarity'] = $percent;
                }
            }

            if (request('in') == 'quick' || request('in') == 'all' || request('in') == 'booking') {
                $booking_query = Booking::query();
                $booking_query->where('code', 'like', $request);
                $booking = $booking_query->get();
                foreach ($booking as $i => $item) {
                    similar_text(strtolower($booking[$i]['code']), strtolower(request('query')), $percent);
                    $booking[$i]['similarity'] = $percent;
                }
            }
        } else {
            $user = collect([]);
            $booking = collect([]);
        }

        if (request('in') == 'quick') {
            $category_query = Category::query();
            $category_query->where(DB::raw('concat(name, " ", coalesce(description, ""))'), 'like', $request);
            $category = $category_query->get();
            foreach ($category as $i => $item) {
                similar_text(strtolower($category[$i]['name']), strtolower(request('query')), $percent);
                $category[$i]['similarity'] = $percent;
            }
        }

        if (request('in') == 'quick') {
            return [
                'author' => $author->sortByDesc('similarity')->values()->take(5),
                'work' => $work->sortByDesc('similarity')->values()->take(5),
                'book' => $book->sortByDesc('similarity')->values()->take(5),
                'user' => $user->sortByDesc('similarity')->values()->take(5),
                'booking' => $booking->sortByDesc('similarity')->values()->take(5),
                'category' => $category->sortByDesc('similarity')->values(),
            ];
        }
        if (request('in') == 'all') {
            return [
                'author' => $author->sortByDesc('similarity')->values()->take(8),
                'work' => $work->sortByDesc('similarity')->values()->take(8),
                'book' => $book->sortByDesc('similarity')->values()->take(8),
                'user' => $user->sortByDesc('similarity')->values()->take(8),
                'booking' => $booking->sortByDesc('similarity')->values()->take(8),
            ];
        }
        if (request('in') == 'author') {
            return [
                'author' => $author->sortByDesc('similarity')->values()->paginate(12),
                'work' => [],
                'book' => [],
                'user' => [],
                'booking' => [],
            ];
        }
        if (request('in') == 'work') {
            return [
                'author' => [],
                'work' => $work->sortByDesc('similarity')->values()->paginate(12),
                'book' => [],
                'user' => [],
                'booking' => [],
            ];
        }
        if (request('in') == 'book') {
            return [
                'author' => [],
                'work' => [],
                'book' => $book->sortByDesc('similarity')->values()->paginate(12),
                'user' => [],
                'booking' => [],
            ];
        }
        if (request('in') == 'user') {
            return [
                'author' => [],
                'work' => [],
                'book' => [],
                'user' => $user->sortByDesc('similarity')->values()->paginate(12),
                'booking' => [],
            ];
        }
        if (request('in') == 'booking') {
            return [
                'author' => [],
                'work' => [],
                'book' => [],
                'user' => [],
                'booking' => $booking->sortByDesc('similarity')->values()->paginate(12),
            ];
        }
    }
}

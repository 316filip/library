<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Author;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Assignment;
use App\Helpers\SearchHelper;
use App\Helpers\WorkHelper;

class BrowseController extends Controller
{
    /**
     * Browse and search authors, works, books, categories and bookings
     * 
     * @return object
     */ 
    public function browse()
    {
        if (request('filter') !== null) {
            // If a filter is set
            if (request('filter') == 'category' && request('query') !== null) {
                // Results for specific category
                $category = Category::where('slug', request('query'))->first();
                return view('categories.show', [
                    'category' => $category,
                    'assignments' => $category->assignments->paginate(12),
                ]);
            } elseif (request('filter') == 'search') {
                // Search results
                return view('search', [
                    'results' => SearchHelper::search()
                ]);
            } elseif (request('filter') == 'new') {
                // Newest books
                return view('works.index', [
                    'works' => Work::orderBy('year', 'desc')->orderBy('created_at', 'desc')->paginate(12),
                ]);
            } elseif (request('filter') == 'young') {
                // Youngest authors
                return view('authors.index', [
                    'authors' => Author::where('id', '<>', 1)->orderBy('birth_date', 'desc')->paginate(12),
                ]);
            } elseif (request('filter') == 'read') {
                // Suggest works that have common categories with given book
                $work = WorkHelper::find(request('query'));
                $suggestions = collect([]);
                $added = [$work->id];
                $assignments = $work->assignments;
                $categories = [];
                // Get all assignments with common category IDs
                foreach ($assignments as $assignment) {
                    array_push($categories, $assignment->category->id);
                }
                $results = Assignment::whereIn('category_id', $categories)->get();
                foreach ($results as $result) {
                    if (!in_array($result->work->id, $added)) {
                        $id = [];
                        foreach ($result->work->assignments as $assignment) {
                            array_push($id, $assignment->category_id);
                        }
                        if (count(array_intersect($categories, $id)) > 2) {
                            if ($result->work->author->id == $work->author->id) {
                                // If the book has the same author, put it to the beginning
                                $suggestions->prepend($result->work);
                            } else {
                                // If the book has different author, put it to the end
                                $suggestions->push($result->work);
                            }
                            array_push($added, $result->work->id);
                        }
                    }
                }

                return view('suggest', [
                    'work' => $work,
                    'suggestions' => $suggestions->paginate(12),
                ]);
            } elseif (request('filter') == 'bookings' && auth()->check() && auth()->user()->librarian) {
                // Active bookings
                return view('bookings.index', [
                    'bookings' => Booking::where('borrowed', 1)->where('returned', 0)->orderBy('to')->paginate(12),
                ]);
            } else {
                // For other filters, show 404
                abort(404);
            }
        }

        // == No filter is set ==
        $bookings = collect([]);
        if (auth()->check() && auth()->user()->librarian) {
            $bookings = Booking::where('borrowed', 1)->where('returned', 0)->orderBy('to')->limit(8)->get();
        }

        // Suggest works that have common categories with recently borrowed books
        $suggestions = collect([]);
        if (auth()->check()) {
            // Get latest bookings
            $latest = Booking::where('user_id', auth()->user()->id)->where('borrowed', 1)->latest()->limit(2)->get();
            foreach ($latest as $booking) {
                $row = collect([]);
                $added = [$booking->book->work->id];
                $assignments = $booking->book->work->assignments;
                $categories = [];
                // Get all assignments with common category IDs
                foreach ($assignments as $assignment) {
                    array_push($categories, $assignment->category->id);
                }
                $results = Assignment::whereIn('category_id', $categories)->get();
                foreach ($results as $result) {
                    if (!in_array($result->work->id, $added)) {
                        $id = [];
                        foreach ($result->work->assignments as $assignment) {
                            array_push($id, $assignment->category_id);
                        }
                        if (count(array_intersect($categories, $id)) > 2) {
                            if ($result->work->author->id == $booking->book->work->author->id) {
                                // If the book has the same author, put it to the beginning
                                $row->prepend($result->work);
                            } else {
                                // If the book has different author, put it to the end
                                $row->push($result->work);
                            }
                            array_push($added, $result->work->id);
                            if (count($added) > 8) {
                                continue;
                            }
                        }
                    }
                }
                if (count($row) !== 0) {
                    $collection = collect([
                        'title' => $booking->book->work->title,
                        'slug' => $booking->book->work->slug,
                    ])->put('works', $row);
                    $suggestions->push($collection);
                }
            }
        }

        $identifiers = Assignment::select('category_id')->groupBy('category_id')->orderByRaw('COUNT(*) DESC')->limit(4)->get();
        $categories = collect([]);
        foreach ($identifiers as $identifier) {
            $categories->push(Category::find($identifier->category_id));
        }

        return view('browse', [
            'bookings' => $bookings,
            'works' => Work::orderByDesc('year')->limit(8)->get(),
            'suggestions' => $suggestions,
            'categories' => $categories,
            'authors' => Author::where('id', '<>', 1)->orderByDesc('birth_date')->limit(8)->get(),
        ]);
    }
}

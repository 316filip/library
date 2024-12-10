<?php

use App\Helpers\SearchHelper;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Common resource routes:
// index - show all
// show - show single
// create - show form to create new
// store - store new
// edit - show form to edit
// update - update
// destroy - delete

// HOMEPAGE ROUTE
Route::get('/', function () {
    return view('homepage');
});

// BROWSE ROUTE
Route::get('/knihovna', [BrowseController::class, 'browse']);

// CONTACT ROUTE
Route::get('/kontakt', function () {
    // Passes opening hours from .ENV file
    return view('contact', [
        'mon' => explode(',', $_ENV['LIBRARY_MON']),
        'tue' => explode(',', $_ENV['LIBRARY_TUE']),
        'wed' => explode(',', $_ENV['LIBRARY_WED']),
        'thu' => explode(',', $_ENV['LIBRARY_THU']),
        'fri' => explode(',', $_ENV['LIBRARY_FRI']),
        'sat' => explode(',', $_ENV['LIBRARY_SAT']),
        'sun' => explode(',', $_ENV['LIBRARY_SUN']),
    ]);
});

// AUTHOR ROUTES
Route::get('/autor', function () {
    abort(404);
});
Route::get('/autor/tvorba', [AuthorController::class, 'create'])->middleware('lib');
Route::post('/autor', [AuthorController::class, 'store'])->middleware('lib');
Route::get('/autor/{author}/upravit', [AuthorController::class, 'edit'])->middleware('lib');
Route::put('/autor/{author}', [AuthorController::class, 'update'])->middleware('lib');
Route::delete('/autor/{author}', [AuthorController::class, 'destroy'])->middleware('lib');
Route::get('/autor/{author}', [AuthorController::class, 'show']);

// WORK ROUTES
Route::get('/titul', function () {
    abort(404);
});
Route::get('/titul/tvorba', [WorkController::class, 'create'])->middleware('lib');
Route::post('/titul', [WorkController::class, 'store'])->middleware('lib');
Route::get('/titul/{work}/upravit', [WorkController::class, 'edit'])->middleware('lib');
Route::put('/titul/{work}', [WorkController::class, 'update'])->middleware('lib');
Route::delete('/titul/{work}', [WorkController::class, 'destroy'])->middleware('lib');
Route::get('/titul/{work}', [WorkController::class, 'show']);

// BOOK ROUTES
Route::get('/kniha', function () {
    abort(404);
});
Route::get('/kniha/tvorba', [BookController::class, 'create'])->middleware('lib');
Route::post('/kniha', [BookController::class, 'store'])->middleware('lib');
Route::get('/kniha/{work}/{book}/upravit', [BookController::class, 'edit'])->middleware('lib');
Route::put('/kniha/{book}', [BookController::class, 'update'])->middleware('lib');
Route::delete('/kniha/{book}', [BookController::class, 'destroy'])->middleware('lib');
Route::get('/kniha/{work}/{book}', [BookController::class, 'show']);
Route::get('/kniha/{book}', function () {
    abort(404);
});

// USER ROUTES
Route::get('/prihlaseni', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/authenticate', [UserController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/reset', [UserController::class, 'request_password'])->middleware('guest');
Route::post('/reset', [UserController::class, 'email_password'])->middleware('guest');
Route::get('/heslo', [UserController::class, 'reset_password'])->middleware('guest');
Route::post('/heslo', [UserController::class, 'update_password'])->middleware('guest');
Route::get('/registrace', [UserController::class, 'create'])->middleware('guest');
Route::post('/ucet', [UserController::class, 'store'])->middleware('guest');
Route::get('/ucet', [UserController::class, 'show'])->middleware('auth');
Route::get('/ucet/upravit', [UserController::class, 'edit'])->middleware('auth');
Route::get('/ucet/{user}/upravit', [UserController::class, 'edit'])->middleware('lib');
Route::get('/ucet/{user}', [UserController::class, 'show'])->middleware('lib');
Route::put('/ucet/{user}', [UserController::class, 'update'])->middleware('auth');
Route::delete('/ucet/{user}', [UserController::class, 'destroy'])->middleware('auth');

// BOOKING ROUTES
Route::get('/rezervace', function () {
    abort(404);
});
Route::post('/rezervace', [BookingController::class, 'store'])->middleware('auth');
Route::get('/rezervace/{booking}', [BookingController::class, 'show'])->middleware('lib');
Route::put('/rezervace/{booking}', [BookingController::class, 'update'])->middleware('auth');

// CATEGORY ROUTES
Route::get('/kategorie', function () {
    abort(404);
});
Route::get('/kategorie/tvorba', [CategoryController::class, 'create'])->middleware('lib');
Route::post('/kategorie', [CategoryController::class, 'store'])->middleware('lib');
Route::get('/kategorie/{category}/upravit', [CategoryController::class, 'edit'])->middleware('lib');
Route::get('/kategorie/{category}', [CategoryController::class, 'show']);
Route::put('/kategorie/{category}', [CategoryController::class, 'update'])->middleware('lib');
Route::delete('/kategorie/{category}', [CategoryController::class, 'destroy'])->middleware('lib');

// SEARCH ROUTE
Route::get('/search', function () {
    return SearchHelper::search();
});

// CRON route for some hosting services
Route::get('/work', function () {
    Artisan::call('queue:work', ['--stop-when-empty' => true, '--max-time' => 60*14]);
});

<?php

use App\Models\Book;
use App\Models\Author;
use App\Helpers\SearchHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\SearchController;

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

Route::get('/', function () {
    return view('homepage');
});

// BROWSE ROUTE
Route::get('/knihovna', [BrowseController::class, 'browse']);

// AUTHOR ROUTES
Route::get('/autor/tvorba', [AuthorController::class, 'create'])->middleware('admin');
Route::post('/autor', [AuthorController::class, 'store'])->middleware('admin');
Route::get('/autor/{author}/upravit', [AuthorController::class, 'edit'])->middleware('admin');
Route::put('/autor/{author}', [AuthorController::class, 'update'])->middleware('admin');
Route::delete('/autor/{author}', [AuthorController::class, 'destroy'])->middleware('admin');
Route::get('/autor/{author}', [AuthorController::class, 'show']);

// WORK ROUTES
Route::get('/titul/tvorba', [WorkController::class, 'create'])->middleware('admin');
Route::post('/titul', [WorkController::class, 'store'])->middleware('admin');
Route::get('/titul/{work}/upravit', [WorkController::class, 'edit'])->middleware('admin');
Route::put('/titul/{work}', [WorkController::class, 'update'])->middleware('admin');
Route::delete('/titul/{work}', [WorkController::class, 'destroy'])->middleware('admin');
Route::get('/titul/{work}', [WorkController::class, 'show']);

// BOOK ROUTES
Route::get('/kniha/tvorba', [BookController::class, 'create'])->middleware('admin');
Route::post('/kniha', [BookController::class, 'store'])->middleware('admin');
Route::get('/kniha/{book}/upravit', [BookController::class, 'edit'])->middleware('admin');
Route::put('/kniha/{book}', [BookController::class, 'update'])->middleware('admin');
Route::delete('/kniha/{book}', [BookController::class, 'destroy'])->middleware('admin');
Route::get('/kniha/{book}', [BookController::class, 'show']);

// USER ROUTES
Route::get('/prihlaseni', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/authenticate', [UserController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/registrace', [UserController::class, 'create'])->middleware('guest');
Route::post('/ucet', [UserController::class, 'store'])->middleware('guest');
Route::get('/ucet', [UserController::class, 'show'])->middleware('auth');
Route::get('/ucet/upravit', [UserController::class, 'edit'])->middleware('auth');
Route::get('/ucet/{user}/upravit', [UserController::class, 'edit'])->middleware('admin');
Route::get('/ucet/{user}', [UserController::class, 'show'])->middleware('admin');
Route::put('/ucet/{user}', [UserController::class, 'update'])->middleware('auth');
Route::delete('/ucet/{user}', [UserController::class, 'destroy'])->middleware('auth');

// BOOKING ROUTES
Route::post('/rezervace', [BookingController::class, 'store'])->middleware('auth');

// SEARCH ROUTES
Route::get('/hledat', [SearchController::class, 'search']);
Route::get('/search', [SearchController::class, 'quick']);

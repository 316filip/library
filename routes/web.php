<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\Route;

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

Route::get('/info', function () {
    return view('info');
});

// BROWSE ROUTE
Route::get('/knihovna', [BrowseController::class, 'browse']);

// AUTHOR ROUTES
Route::get('/autor/tvorba', [AuthorController::class, 'create'])->middleware('auth');
Route::post('/autor', [AuthorController::class, 'store'])->middleware('auth');
Route::get('/autor/{author}/upravit', [AuthorController::class, 'edit'])->middleware('auth');
Route::put('/autor/{author}', [AuthorController::class, 'update'])->middleware('auth');
Route::delete('/autor/{author}', [AuthorController::class, 'destroy'])->middleware('auth');
Route::get('/autor/{author}', [AuthorController::class, 'show']);

// WORK ROUTES
Route::get('/titul/tvorba', [WorkController::class, 'create'])->middleware('auth');
Route::post('/titul', [WorkController::class, 'store'])->middleware('auth');
Route::get('/titul/{work}/upravit', [WorkController::class, 'edit'])->middleware('auth');
Route::put('/titul/{work}', [WorkController::class, 'update'])->middleware('auth');
Route::delete('/titul/{work}', [WorkController::class, 'destroy'])->middleware('auth');
Route::get('/titul/{work}', [WorkController::class, 'show']);

// BOOK ROUTES
Route::get('/kniha/tvorba', [BookController::class, 'create'])->middleware('auth');
Route::post('/kniha', [BookController::class, 'store'])->middleware('auth');
Route::get('/kniha/{book}/upravit', [BookController::class, 'edit'])->middleware('auth');
Route::put('/kniha/{book}', [BookController::class, 'update'])->middleware('auth');
Route::delete('/kniha/{book}', [BookController::class, 'destroy'])->middleware('auth');
Route::get('/kniha/{book}', [BookController::class, 'show']);

// USER ROUTES
Route::get('/prihlaseni', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/authenticate', [UserController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/registrace', [UserController::class, 'create'])->middleware('guest');
Route::post('/ucet', [UserController::class, 'store'])->middleware('guest');
Route::get('/ucet', [UserController::class, 'show'])->middleware('auth');
Route::get('/ucet/{user}', [UserController::class, 'show'])->middleware('auth');

// SEARCH ROUTE
Route::get('/hledat', [SearchController::class, 'search']);

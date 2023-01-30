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
Route::get('/autor/tvorba', [AuthorController::class, 'create']);
Route::post('/autor', [AuthorController::class, 'store']);
Route::get('/autor/{author}/upravit', [AuthorController::class, 'edit']);
Route::put('/autor/{author}', [AuthorController::class, 'update']);
Route::delete('/autor/{author}', [AuthorController::class, 'destroy']);
Route::get('/autor/{author}', [AuthorController::class, 'show']);

// WORK ROUTES
Route::get('/titul/tvorba', [WorkController::class, 'create']);
Route::post('/titul', [WorkController::class, 'store']);
Route::get('/titul/{work}/upravit', [WorkController::class, 'edit']);
Route::put('/titul/{work}', [WorkController::class, 'update']);
Route::delete('/titul/{work}', [WorkController::class, 'destroy']);
Route::get('/titul/{work}', [WorkController::class, 'show']);

// BOOK ROUTES
Route::get('/kniha/tvorba', [BookController::class, 'create']);
Route::post('/kniha', [BookController::class, 'store']);
Route::get('/kniha/{book}/upravit', [BookController::class, 'edit']);
Route::put('/kniha/{book}', [BookController::class, 'update']);
Route::delete('/kniha/{book}', [BookController::class, 'destroy']);
Route::get('/kniha/{book}', [BookController::class, 'show']);

// USER ROUTES
Route::get('/ucet/{user}', [UserController::class, 'show']);

// SEARCH ROUTE
Route::get('/hledat', [SearchController::class, 'search']);

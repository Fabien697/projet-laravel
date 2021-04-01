<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthorController;
use App\Models\Author;
use App\Http\Controllers\BookController;
use App\Models\Book;
use App\Http\Controllers\GenreController;
use App\Models\Genre;

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

Route::resource('genres', GenreController::class);

Route::resource('books', BookController::class);

Route::resource('authors', AuthorController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

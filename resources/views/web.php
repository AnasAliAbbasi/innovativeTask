<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/' , [\App\Http\Controllers\filmController::class  , 'getFilmFromApi']);

Route::get('film/{id}' , [\App\Http\Controllers\filmController::class , 'getIndividualFilm']);

Route::post('film/comment/{id}' , [\App\Http\Controllers\filmController::class , 'saveComment']);

Route::get('film-create' ,  [\App\Http\Controllers\filmController::class , 'AddFilm']);
Route::get('insert/movie' , [\App\Http\Controllers\filmController::class , 'insertMovie'])->name('movies.store');
Auth::routes();


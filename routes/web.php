<?php

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/authors', [App\Http\Controllers\HomeController::class, 'authors'])->name('authors');
Route::get('/author/{id}', [App\Http\Controllers\HomeController::class, 'author'])->name('author');
Route::get('/text/{id}', [App\Http\Controllers\HomeController::class, 'text'])->name('text');
Route::post('/text/{id}/like', [App\Http\Controllers\HomeController::class, 'likeText'])->name('likeText');
Route::post('/text/{id}/dislike', [App\Http\Controllers\HomeController::class, 'dislikeText'])->name('dislikeText');


Route::get('/texts', [App\Http\Controllers\HomeController::class, 'texts'])->name('texts');
Route::post('/texts/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('/texts/popular', [App\Http\Controllers\HomeController::class, 'popular'])->name('popular');


Route::get('/my', [App\Http\Controllers\UserController::class, 'mypage'])->name('mypage');
Route::post('/my/dislike', [App\Http\Controllers\UserController::class, 'dislikeTextMy'])->name('dislikeTextMy');

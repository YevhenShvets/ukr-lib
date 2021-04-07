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



Route::prefix('admin')->middleware('guest:admin')->group(function () {                        
    Route::get('/login', [App\Http\Controllers\AdminController::class, 'login'])->name('adminLogin');
    Route::post('/login', [App\Http\Controllers\AdminController::class, 'loginSubmit'])->name('adminLoginSubmit');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'adminHome'])->name('adminHome');
    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'Logout'])->name('adminLogout');
    Route::get('/addAuthor', [App\Http\Controllers\AdminController::class, 'adminAddAuthor'])->name('adminAddAuthor');
    Route::post('/addAuthor', [App\Http\Controllers\AdminController::class, 'adminAddAuthorSubmit'])->name('adminAddAuthorSubmit');
    Route::get('/addText', [App\Http\Controllers\AdminController::class, 'adminAddText'])->name('adminAddText');
    Route::post('/addText', [App\Http\Controllers\AdminController::class, 'adminAddTextSubmit'])->name('adminAddTextSubmit');
    Route::get('/addTextType', [App\Http\Controllers\AdminController::class, 'adminAddTextType'])->name('adminAddTextType');
    Route::post('/addTextType', [App\Http\Controllers\AdminController::class, 'adminAddTextTypeSubmit'])->name('adminAddTextTypeSubmit');
    Route::get('/addContact', [App\Http\Controllers\AdminController::class, 'adminAddContact'])->name('adminAddContact');
    Route::post('/addContact', [App\Http\Controllers\AdminController::class, 'adminAddContactSubmit'])->name('adminAddContactSubmit');
    

    Route::get('/editText/{id}', [App\Http\Controllers\AdminController::class, 'adminEditText'])->name('adminEditText');
    Route::post('/editText/{id}', [App\Http\Controllers\AdminController::class, 'adminEditTextSubmit'])->name('adminEditTextSubmit');
    Route::post('/editText/{id}/addPage', [App\Http\Controllers\AdminController::class, 'adminEditTextAddPage'])->name('adminEditTextAddPage');
    Route::post('/editText/{id}/deletePage', [App\Http\Controllers\AdminController::class, 'adminEditTextDeletePage'])->name('adminEditTextDeletePage');
    
    Route::get('/editAuthor/{id}', [App\Http\Controllers\AdminController::class, 'adminEditAuthor'])->name('adminEditAuthor');
    Route::post('/editAuthor/{id}', [App\Http\Controllers\AdminController::class, 'adminEditAuthorSubmit'])->name('adminEditAuthorSubmit');
    Route::get('/editContact/{id}', [App\Http\Controllers\AdminController::class, 'adminEditContact'])->name('adminEditContact');
    Route::post('/editContact/{id}', [App\Http\Controllers\AdminController::class, 'adminEditContactSubmit'])->name('adminEditContactSubmit');
    

    Route::get('/deleteAuthor', [App\Http\Controllers\AdminController::class, 'adminDeleteAuthor'])->name('adminDeleteAuthor');
    Route::post('/deleteAuthor', [App\Http\Controllers\AdminController::class, 'adminDeleteAuthorSubmit'])->name('adminDeleteAuthorSubmit');
    Route::get('/deleteText', [App\Http\Controllers\AdminController::class, 'adminDeleteText'])->name('adminDeleteText');
    Route::post('/deleteText', [App\Http\Controllers\AdminController::class, 'adminDeleteTextSubmit'])->name('adminDeleteTextSubmit');
    Route::post('/deleteTextType', [App\Http\Controllers\AdminController::class, 'adminDeleteTextTypeSubmit'])->name('adminDeleteTextTypeSubmit');
    Route::post('/deleteContact', [App\Http\Controllers\AdminController::class, 'adminDeleteContactSubmit'])->name('adminDeleteContactSubmit');

});

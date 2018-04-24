<?php

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

Route::get('/', 'GuestController@index');
Route::get('/books/{book}/borrow', 'BooksController@borrow')->name('guest.books.borow');
Route::patch('/books/{book}/return', 'BooksController@return')->name('member.books.return');
Route::get('/refresh-captcha', 'Auth\RegisterController@refreshCaptcha');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function() {
    Route::resource('authors', 'AuthorsController');
    Route::resource('books', 'BooksController');
});

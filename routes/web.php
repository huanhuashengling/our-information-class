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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
Route::auth();
Route::get('/', 'HomeController@index');

Route::get('work/{id}', 'WorkController@show');

Route::post('comment', 'CommentController@store');

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('/', 'HomeController@index');
    Route::resource('work', 'WorkController');
    Route::resource('comment', 'CommentController');
});

// Route::get('/{locale}', function ($locale) {
//     App::setLocale($locale);
//     return view('welcome');
// });
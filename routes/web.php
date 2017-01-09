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

// Route::group(['prefix'=>'{guard}'],function(){ Route::auth();});


Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('/logout', function (){ Auth::logout(); return redirect('/'); });
Route::get('post/{id}', 'PostController@show');

Route::post('comment', 'CommentController@store');

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('/', 'HomeController@index');
    Route::resource('post', 'PostController');
    Route::resource('comment', 'CommentController');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Teacher', 'prefix' => 'teacher'], function() {
    Route::get('/', 'HomeController@index');
    Route::resource('class', 'SchoolClassController');
    Route::resource('lesson', 'LessonController');
});
// Route::get('/{locale}', function ($locale) {
//     App::setLocale($locale);
//     return view('welcome');
// });
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

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('/', 'HomeController@index');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Teacher', 'prefix' => 'teacher'], function() {
    Route::get('/', 'HomeController@index');
    Route::resource('class', 'SchoolClassController');
    Route::resource('lesson', 'LessonController');
    Route::resource('createComment', 'CommentController@store');
    Route::resource('updateComment', 'CommentController@update');
    Route::resource('getCommentByPostsId', 'CommentController@getByPostsId');

    Route::resource('updateRate', 'HomeController@updateRate');
    Route::resource('getPostRate', 'HomeController@getPostRate');


    Route::post('createLessonLog', 'LessonLogController@store');
    Route::post('updateLessonLog', 'LessonLogController@update');

    Route::get('takeclass', 'HomeController@takeClass');

});


Route::group(['middleware' => 'auth', 'namespace' => 'Student', 'prefix' => 'student'], function() {
    Route::get('/', 'HomeController@index');
    Route::post('upload', 'HomeController@upload');
    Route::get('posts', 'PostController@index');
});

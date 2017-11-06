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
// Route::auth();

// Route::group(['prefix'=>'{guard}'],function(){ Route::auth();});


// Route::get('/', 'HomeController@index');
// Route::get('/home', 'HomeController@index');

// Route::get('/logout', function (){ Auth::logout(); return redirect('/'); });

Route::get('reset', 'UserController@getReset');
Route::post('reset', 'UserController@postReset');

// Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    // Route::get('students', 'HomeController@studentsAccountManagement');
    // Route::post('importStudents', 'HomeController@importStudents');
    // Route::get('getStudentsData', 'HomeController@getStudentsData');
    // Route::post('resetStudentPassword', 'HomeController@resetStudentPassword');

// });

// Route::group(['middleware' => 'auth', 'namespace' => 'Teacher', 'prefix' => 'teacher'], function() {
//     Route::get('/', 'HomeController@index');
//     Route::resource('class', 'SchoolClassController');
//     Route::resource('lesson', 'LessonController');
//     Route::post('uploadMDImage', 'LessonController@uploadMDImage');
//     Route::get('ajaxSearchTopics', 'LessonController@ajaxSearchTopics');

//     Route::resource('createComment', 'CommentController@store');
//     Route::resource('updateComment', 'CommentController@update');
//     Route::resource('getCommentByPostsId', 'CommentController@getByPostsId');

//     Route::resource('updateRate', 'HomeController@updateRate');
//     Route::resource('getPostRate', 'HomeController@getPostRate');

//     Route::get('lessonLog', 'LessonLogController@listLessonLog');
//     Route::post('createLessonLog', 'LessonLogController@store');
//     Route::post('updateLessonLog', 'LessonLogController@update');

//     Route::get('takeclass', 'HomeController@takeClass');

//     Route::get('getLessonPostPerSchoolClass', 'HomeController@getLessonPostPerSchoolClass');

// });


// Route::group(['middleware' => 'auth', 'namespace' => 'Student', 'prefix' => 'student'], function() {
//     Route::get('/', 'HomeController@index');
//     Route::post('upload', 'HomeController@upload');
//     Route::get('posts', 'PostController@index');
// });


Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
    $router->get('login', 'LoginController@showLoginForm')->name('admin.login');
    $router->post('login', 'LoginController@login');
    $router->get('logout', 'LoginController@logout');

});

Route::group(['middleware' => 'auth.admin', 'prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
    $router->get('/', 'HomeController@index');

    $router->get('students', 'HomeController@studentsAccountManagement');

    $router->post('importStudents', 'HomeController@importStudents');
    $router->get('getStudentsData', 'HomeController@getStudentsData');
    $router->post('resetStudentPassword', 'HomeController@resetStudentPassword');
});

Route::group(['prefix' => 'teacher','namespace' => 'Teacher'],function ($router)
{
    $router->get('login', 'LoginController@showLoginForm')->name('teacher.login');
    $router->post('login', 'LoginController@login');
    $router->get('logout', 'LoginController@logout');
});

Route::group(['middleware' => 'auth.teacher', 'prefix' => 'teacher','namespace' => 'Teacher'],function ($router)
{
    $router->get('home', 'HomeController@index');
    $router->get('takeclass', 'HomeController@takeclass');
    $router->get('lesson', 'LessonController@index');
    $router->get('lessonLog', 'LessonLogController@listLessonLog');
    $router->get('getLessonPostPerSclass', 'HomeController@getLessonPostPerSclass');

});

Route::group(['prefix' => 'student','namespace' => 'Student'],function ($router)
{
    $router->get('login', 'LoginController@showLoginForm')->name('student.login');
    $router->post('login', 'LoginController@login');
    $router->get('logout', 'LoginController@logout');
});

Route::group(['middleware' => 'auth.student', 'prefix' => 'student','namespace' => 'Student'],function ($router)
{
    $router->get('/', 'HomeController@index');
    $router->get('/posts', 'PostController@index');
});


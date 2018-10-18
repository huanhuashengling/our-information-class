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
use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
// Route::auth();

// Route::group(['prefix'=>'{guard}'],function(){ Route::auth();});


// Route::get('/', 'HomeController@index');
// Route::get('/home', 'HomeController@index');

// Route::get('/logout', function (){ Auth::logout(); return redirect('/'); });

// Route::get('reset', 'UserController@getReset');
// Route::post('reset', 'UserController@postReset');

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

Route::group(['middleware' => 'auth.admin:admin, admin/login', 'prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
    $router->get('/dashboard', 'HomeController@index');

    $router->get('students', 'HomeController@studentsAccountManagement');

    $router->post('importStudents', 'HomeController@importStudents');
    $router->post('getStudentsData', 'HomeController@getStudentsData');
    $router->post('resetStudentPassword', 'HomeController@resetStudentPassword');
    $router->post('lockOneStudentAccount', 'HomeController@lockOneStudentAccount');
    $router->post('unlockOneStudentAccount', 'HomeController@unlockOneStudentAccount');
    $router->post('createOneStudent', 'HomeController@createOneStudent');


    $router->get('reset', 'HomeController@getReset');
    $router->post('reset', 'HomeController@postReset');


    $router->get('export-post', 'ExportPostController@index');
    $router->post('export-post-files', 'ExportPostController@exportPostFiles');
    $router->post('load-lesson-log-info', 'ExportPostController@loadLessonLogInfo');
    $router->post('load-post-list', 'ExportPostController@loadPostList');
    

    $router->get('lessonLog', 'LessonLogController@index');
    $router->post('get-lesson-log-list', 'LessonLogController@getLessonLogList');
    $router->post('delLessonLog', 'LessonLogController@delLessonLog');


    $router->get('get-post-count-per-class-same-grade-data-1', 'HomeController@getPostCountPerClassWithSameGradeData1');
    $router->get('get-post-count-per-class-same-grade-data-2', 'HomeController@getPostCountPerClassWithSameGradeData2');
    $router->get('get-mark-count-per-class-same-grade-data-1', 'HomeController@getMarkCountPerClassWithSameGradeData1');
    $router->get('get-mark-count-per-class-same-grade-data-2', 'HomeController@getMarkCountPerClassWithSameGradeData2');
});

Route::group(['prefix' => 'teacher','namespace' => 'Teacher'],function ($router)
{
    $router->get('login', 'LoginController@showLoginForm')->name('teacher.login');
    $router->post('login', 'LoginController@login');
    $router->get('logout', 'LoginController@logout');
});

Route::group(['middleware' => 'auth.teacher', 'prefix' => 'teacher','namespace' => 'Teacher'],function ($router)
{
    $router->get('/', 'HomeController@index');
    $router->get('takeclass', 'HomeController@takeclass');
    $router->resource('lesson', 'LessonController');
    $router->post('getLessonPostPerSclass', 'HomeController@getLessonPostPerSclass');

    Route::post('uploadMDImage', 'LessonController@uploadMDImage');
    Route::get('ajaxSearchTopics', 'LessonController@ajaxSearchTopics');
    Route::get('lessonLog', 'LessonLogController@listLessonLog');
    Route::post('loadLessonLogSelection', 'LessonLogController@loadLessonLogSelection');
    Route::post('getPostDataByTermAndSclass', 'LessonLogController@getPostDataByTermAndSclass');
    Route::post('createLessonLog', 'LessonLogController@store');
    Route::post('updateLessonLog', 'LessonLogController@update');
    Route::post('updateRethink', 'LessonLogController@updateRethink');
    
    Route::resource('createComment', 'CommentController@store');
    Route::resource('updateComment', 'CommentController@update');
    Route::post('getCommentByPostsId', 'CommentController@getByPostsId');
    Route::post('getPost', 'HomeController@getPost');

    Route::resource('updateRate', 'HomeController@updateRate');
    Route::post('getPostRate', 'HomeController@getPostRate');

    $router->post('getLessonLog', 'HomeController@getLessonLog');
    $router->get('reset', 'HomeController@getReset');
    $router->post('reset', 'HomeController@postReset');

    $router->get('scoreReport', 'ScoreReportController@index');
    $router->post('getScoreReport', 'ScoreReportController@report');
    $router->post('getSclassTermsList', 'ScoreReportController@getSclassTermsList');

    $router->get('get-lesson-list', 'LessonController@getLessonList');
    $router->post('deleteLesson', 'LessonController@deleteLesson');
    $router->post('getLesson', 'LessonController@getLesson');

    Route::resource('course', 'CourseController');
    Route::get('get-course-list', 'CourseController@getCourseList');

    Route::resource('unit', 'UnitController');
    Route::get('get-unit-list', 'UnitController@getUnitList');
    Route::post('get-unit-list-by-courses-id', 'UnitController@getUnitListByCoursesId');

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
    $router->post('getPostsByTerm', 'PostController@getPostsByTerm');
    
    $router->post('upload', 'HomeController@upload');
    $router->post('getentry', 'HomeController@get');
    $router->post('getCommentByPostsId', 'HomeController@getCommentByPostsId');
    $router->post('getPostRate', 'HomeController@getPostRate');
    $router->post('getOnePost', 'HomeController@getOnePost');
    $router->post('getMarkNumByPostsId', 'HomeController@getMarkNumByPostsId');
    $router->post('getIsMarkedByMyself', 'HomeController@getIsMarkedByMyself');
    $router->post('updateMarkState', 'HomeController@updateMarkState');

    
    
    $router->get('classmate', 'ClassmateController@classmatePost');
    
    $router->post('getPostsDataByType', 'ClassmateController@getPostsDataByType');
    

    $router->get('reset', 'HomeController@getReset');
    $router->post('reset', 'HomeController@postReset');

});

Route::get('imager', function ()
{
    $src = Input::get('src', 1);
    $cacheimage = Image::cache(function($image) use ($src) {
        return $image->make($src)->resize(200,140);
    }, 1, false); // one minute cache expiry

    return Response::make($cacheimage, 200, array('Content-Type' => 'image/jpeg'));
});


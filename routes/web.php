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

Route::get('/term-check/', 'TermCheckController@index');
Route::post('/term-check-load-lesson-log/', 'TermCheckController@loadLessonLogSelection');
Route::post('/term-check-get-post-data/', 'TermCheckController@getPostDataByTermAndSclass');
Route::post('/term-check-get-post-rate/', 'TermCheckController@getPostRate');
Route::post('/term-check-get-post/', 'TermCheckController@getPost');
Route::post('/term-check-get-comment/', 'TermCheckController@getCommentByPostsId');
Route::get('/load-class-selection', 'TermCheckController@loadSclassSelection');


Route::get('/space', 'SpaceController@index');
Route::get('/work', 'SpaceController@work');
Route::post('/add-work-comment', 'SpaceController@addWorkComment');
Route::post('/list-work-comment', 'SpaceController@listWorkComment');

Route::group(['prefix' => 'district','namespace' => 'District'],function ($router)
{
    $router->get('login', 'LoginController@showLoginForm')->name('district.login');
    $router->post('login', 'LoginController@login');
    $router->get('logout', 'LoginController@logout');

});

Route::group(['middleware' => 'auth.district:district, district/login', 'prefix' => 'district','namespace' => 'District'],function ($router)
{
    $router->get('/dashboard', 'HomeController@index');
    $router->get('/', 'HomeController@index');

    $router->get('schools', 'SchoolController@index');
    $router->post('getSchoolsAccountData', 'SchoolController@getSchoolsData');
    $router->post('createOneSchool', 'SchoolController@createOneSchool');

    $router->post('importStudents', 'HomeController@importStudents');
    $router->post('updateStudentEmail', 'HomeController@updateStudentEmail');
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


    $router->get('create-zip', 'ExportPostController@exportPostFiles');
    $router->get('clear-all-zip', 'ExportPostController@clearALlZip');

    $router->get('teachers', 'TeacherAccountController@index');

    $router->get('send-mail', 'SendMailController@index');
    $router->get('get-send-mail-list', 'SendMailController@listAllMails');
    $router->post('addSendMail', 'SendMailController@addSendMail');
    $router->post('updateSendMail', 'SendMailController@updateSendMail');

});


// Route::group(['middleware' => 'auth', 'namespace' => 'Student', 'prefix' => 'student'], function() {
//     Route::get('/', 'HomeController@index');
//     Route::post('upload', 'HomeController@upload');
//     Route::get('posts', 'PostController@index');
// });


Route::group(['prefix' => 'school','namespace' => 'School'],function ($router)
{
    $router->get('login', 'LoginController@showLoginForm')->name('school.login');
    $router->post('login', 'LoginController@login');
    $router->get('logout', 'LoginController@logout');

});

Route::group(['middleware' => 'auth.school:school, school/login', 'prefix' => 'school','namespace' => 'School'],function ($router)
{
    // dashboard
    $router->get('/dashboard', 'HomeController@index');
    $router->get('/', 'HomeController@index');
    $router->get('get-post-count-per-class-same-grade-data-1', 'HomeController@getPostCountPerClassWithSameGradeData1');
    $router->get('get-post-count-per-class-same-grade-data-2', 'HomeController@getPostCountPerClassWithSameGradeData2');
    $router->get('get-mark-count-per-class-same-grade-data-1', 'HomeController@getMarkCountPerClassWithSameGradeData1');
    $router->get('get-mark-count-per-class-same-grade-data-2', 'HomeController@getMarkCountPerClassWithSameGradeData2');

    // class
    $router->get('sclasses', 'SclassController@index');
    $router->post('getSclassesData', 'SclassController@getSclassesData');
    $router->post('getTermsData', 'SclassController@getTermsData');
    $router->post('createOneSclass', 'SclassController@createOneSclass');

    //student
    $router->get('students', 'StudentAccountController@index');
    $router->post('importStudents', 'StudentAccountController@importStudents');
    $router->post('updateStudentEmail', 'StudentAccountController@updateStudentEmail');
    $router->post('getStudentsData', 'StudentAccountController@getStudentsData');
    $router->post('resetStudentPassword', 'StudentAccountController@resetStudentPassword');
    $router->post('lockOneStudentAccount', 'StudentAccountController@lockOneStudentAccount');
    $router->post('unlockOneStudentAccount', 'StudentAccountController@unlockOneStudentAccount');
    $router->post('createOneStudent', 'StudentAccountController@createOneStudent');

    $router->post('lockOneStudentWorkComment', 'StudentAccountController@lockOneStudentWorkComment');
    $router->post('unlockOneStudentWorkComment', 'StudentAccountController@unlockOneStudentWorkComment');
    $router->post('addMaxWorkNum', 'StudentAccountController@addMaxWorkNum');

    //group
    $router->get('groups', 'GroupController@index');
    $router->post('getGroupsInSclass', 'GroupController@getGroupsInSclass');
    $router->post('createGroupInSclass', 'GroupController@createGroupInSclass');
    $router->post('getStudentsInGroup', 'GroupController@getStudentsInGroup');
    $router->post('getStudentsInSclassButNotInGroupsBtns', 'GroupController@getStudentsInSclassButNotInGroupsBtns');
    $router->post('addOneStudentIntoGroup', 'GroupController@addOneStudentIntoGroup');
    $router->post('removeOneStudentOutGroup', 'GroupController@removeOneStudentOutGroup');
    $router->post('removeOneGroup', 'GroupController@removeOneGroup');
    

    // teacher
    $router->get('teachers', 'TeacherAccountController@index');
    $router->post('getTeachersAccountData', 'TeacherAccountController@getTeachersAccountData');
    $router->post('createOneTeacherAccount', 'TeacherAccountController@createOneTeacherAccount');
    $router->post('resetTeacherPassword', 'TeacherAccountController@resetTeacherPassword');

    // export
    $router->get('export-post', 'ExportPostController@index');
    $router->post('export-post-files', 'ExportPostController@exportPostFiles');
    $router->post('load-lesson-log-info', 'ExportPostController@loadLessonLogInfo');
    $router->post('load-post-list', 'ExportPostController@loadPostList');
    $router->get('create-zip', 'ExportPostController@exportPostFiles');
    $router->get('clear-all-zip', 'ExportPostController@clearALlZip');
    
    $router->post('loadSclassSelection', 'ExportPostController@loadSclassSelection');
    // lesson log
    $router->get('lessonLog', 'LessonLogController@index');
    $router->post('get-lesson-log-list', 'LessonLogController@getLessonLogList');
    $router->post('delLessonLog', 'LessonLogController@delLessonLog');

    // email temp close this function
    $router->get('send-mail', 'SendMailController@index');
    $router->get('get-send-mail-list', 'SendMailController@listAllMails');
    $router->post('addSendMail', 'SendMailController@addSendMail');
    $router->post('updateSendMail', 'SendMailController@updateSendMail');



    // term-end-export
    $router->get('term-end-export', 'TermEndExportController@index');
    // $router->post('export-post-files', 'TermEndExportController@exportPostFiles');
    // $router->post('load-lesson-log-info', 'TermEndExportController@loadLessonLogInfo');
    $router->post('load-term-end-post-list', 'TermEndExportController@loadTermEndPostList');
    // $router->get('create-zip', 'TermEndExportController@exportPostFiles');
    // $router->get('clear-all-zip', 'TermEndExportController@clearALlZip');

    // reset password
    $router->get('reset', 'HomeController@getReset');
    $router->post('reset', 'HomeController@postReset');

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
    Route::post('loadSclassSelection', 'LessonLogController@loadSclassSelection');
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
    $router->post('email-out', 'ScoreReportController@emailOut');


    $router->get('get-lesson-list', 'LessonController@getLessonList');
    $router->post('deleteLesson', 'LessonController@deleteLesson');
    $router->post('getLesson', 'LessonController@getLesson');
    Route::post('closeLesson', 'LessonController@closeLesson');
    Route::post('openLesson', 'LessonController@openLesson');
    Route::post('chooseLesson', 'LessonController@chooseLesson');

    Route::resource('course', 'CourseController');
    Route::get('get-course-list', 'CourseController@getCourseList');
    Route::post('closeCourse', 'CourseController@closeCourse');
    Route::post('openCourse', 'CourseController@openCourse');

    Route::resource('unit', 'UnitController');
    Route::get('get-unit-list', 'UnitController@getUnitList');
    Route::post('get-unit-list-by-courses-id', 'UnitController@getUnitListByCoursesId');
    Route::post('closeUnit', 'UnitController@closeUnit');
    Route::post('openUnit', 'UnitController@openUnit');

});

Route::group(['prefix' => 'student','namespace' => 'Student'],function ($router)
{
    $router->get('login', 'LoginController@showLoginForm')->name('student.login');
    $router->post('login', 'LoginController@login');
    $router->get('logout', 'LoginController@logout');
});

Route::group(['middleware' => 'auth.student', 'prefix' => 'student','namespace' => 'Student'],function ($router)
{
    $router->get('/home', 'HomeController@index');
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

    Route::resource('work', 'WorkController');
    $router->post('upload-cover', 'WorkController@uploadCover');
    $router->post('upload-work', 'WorkController@uploadWork');

    $router->get('/get-work-list', 'WorkController@workList');
    
    $router->get('open-classroom', 'OpenClassroomController@index');
    $router->get('open-classroom/course/{id}', 'OpenClassroomController@course');
    $router->get('open-classroom/unit/{id}', 'OpenClassroomController@unit');
    $router->get('open-classroom/lesson/{id}', 'OpenClassroomController@lesson');



    $router->get('classmate', 'ClassmateController@classmatePost');
    
    $router->post('getPostsDataByType', 'ClassmateController@getPostsDataByType');
    

    $router->get('reset', 'HomeController@getReset');
    $router->get('info', 'HomeController@getStudentInfo');
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


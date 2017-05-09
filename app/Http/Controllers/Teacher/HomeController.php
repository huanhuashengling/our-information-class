<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Lesson;
use App\Models\Post;
use App\Models\LessonLog;

use App\Libaries\pinyinfirstchar;


class HomeController extends Controller
{
    public function index()
    {
        $userId = \Auth::user()->id;
        $lessonLog = LessonLog::where(['teachers_users_id' => $userId, 'status' => 'open'])->first();
        if ($lessonLog) {
            // dd($lessonLog);die();
            //If the teacher has one lesson log, only need redirect to route takeclass and load view
            return redirect('teacher/takeclass');
        }


        $schoolClasses = SchoolClass::where('grade_num', '>', 2)->pluck('title', 'id');
        $lessons = Lesson::get();
// dd($lessons);die();
        return view('teacher/home', compact('schoolClasses', 'lessons'));
    }

    public function takeClass()
    {
        $userId = \Auth::user()->id;
        $lessonLog = LessonLog::where(['teachers_users_id' => $userId, 'status' => 'open'])->first();
        // dd($lessonLog);die();

        $lesson = Lesson::where(['id' => $lessonLog['lessons_id']])->first();
        $schoolClass = SchoolClass::where(['id' => $lessonLog['school_classes_id']])->first();
        // dd($schoolClass);die();

        $students = Student::leftJoin('lesson_logs', function($join) {
            $join->on('students.school_classes_id', '=', 'lesson_logs.school_classes_id');
        })->leftJoin('users', function($join) {
            $join->on('students.users_id', '=', 'users.id');
        })->where(["lesson_logs.id" => $lessonLog['id']])->get();
        $postData = [];
        foreach ($students as $key => $student) {
            // echo($student['users_id']);
            $post = Post::where(['students_users_id' => $student['users_id'], 'lesson_logs_id' => $lessonLog['id']])->first();
            $postData[$student['users_id']] = $post;
        }
        // dd($postData);die();
        $py = new pinyinfirstchar();
        return view('teacher/takeclass', compact('schoolClass', 'lesson', 'students', 'lessonLog', 'postData', 'py'));
    }
}

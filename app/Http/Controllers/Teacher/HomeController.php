<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Lesson;
use App\Models\LessonLog;



class HomeController extends Controller
{
    public function index()
    {
        $userId = \Auth::user()->id;
        $lessonLog = LessonLog::where(['user_id' => $userId, 'status' => 'open'])->first();
        if ($lessonLog) {
            //If the teacher has one lesson log, only need redirect to route takeclass and load view
            return redirect('teacher/takeclass');
        }


        $schoolClasses = SchoolClass::where('grade_num', '>', 2)->pluck('title', 'id');
        $lessons = Lesson::pluck('title', 'id');

        return view('teacher/home', compact('schoolClasses', 'lessons'));
    }

    public function takeClass()
    {
        $userId = \Auth::user()->id;
        $lessonLog = LessonLog::where(['user_id' => $userId, 'status' => 'open'])->first();
        // dd($lessonLog);die();

        $lesson = Lesson::where(['id' => $lessonLog['lesson_id']])->first();
        $schoolClass = SchoolClass::where(['id' => $lessonLog['school_class_id']])->first();
        // dd($schoolClass);die();

        $students = Student::leftJoin('lesson_logs', function($join) {
            $join->on('students.school_class_id', '=', 'lesson_logs.school_class_id');
        })->leftJoin('users', function($join) {
            $join->on('students.user_id', '=', 'users.id');
        })->where("lesson_logs.status", "open")->get();
        // dd($students[0]);die();

        return view('teacher/takeclass', compact('schoolClass', 'lesson', 'students', 'lessonLog'));
    }
}

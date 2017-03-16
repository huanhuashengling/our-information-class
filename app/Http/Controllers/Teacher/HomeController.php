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
        $schoolClasses = SchoolClass::where('grade_num', '>', 2)->pluck('title', 'id');
        $lessons = Lesson::pluck('title', 'id');

        return view('teacher/home', compact('schoolClasses', 'lessons'));
    }

    public function takeClass()
    {
        // dd("takeClass");die();
        $userId = \Auth::user()->id;
        $lessonLog = LessonLog::where(['user_id' => $userId, 'status' => 'start'])->first();
        // dd($lessonLog['school_class_id']);die();

        // $students = Student::where('school_class_id', $lessonLog['school_class_id'])->get();
        $students = Student::leftJoin('lesson_logs', function($join) {
            $join->on('students.school_class_id', '=', 'lesson_logs.school_class_id');
        })->leftJoin('users', function($join) {
            $join->on('students.user_id', '=', 'users.id');
        })->where("lesson_logs.status", "start")->get();
        // var_dump($students[0]);die();

        $schoolClasses = [];
        $lessons = [];
        return view('teacher/takeclass', compact('schoolClasses', 'lessons', 'students'));
    }
}

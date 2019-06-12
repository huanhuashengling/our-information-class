<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Unit;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Sclass;
use App\Models\Term;
use EndaEditor;
use Route;

class OpenClassroomController extends Controller
{
    public function index()
    {
        $id = \Auth::guard("student")->id();

        $courses = Course::where("is_open", "=", 1)->get();
        $planetUrl = url("images/planet.png");
        return view('student/open-classroom/index', compact('courses', 'planetUrl'));
    }

    public function course(Request $request)
    {   
        $coursesId = Route::current()->getParameter('id');
        $id = \Auth::guard("student")->id();
        $course = Course::find($coursesId);
        $units = Unit::where("courses_id", "=", $coursesId)
        ->where("is_open", "=", 1)->get();
        $planetUrl = url("images/planet.png");
        return view('student/open-classroom/course', compact('units', 'planetUrl', 'course'));
    }

    public function unit(Request $request)
    {
        $unitsId = Route::current()->getParameter('id');

        $id = \Auth::guard("student")->id();
        $unit = Unit::find($unitsId);
        $unit->course = Course::find($unit->courses_id);
        $lessons = Lesson::where("units_id", "=", $unitsId)
        ->where("is_open", "=", 1)->get();
        $planetUrl = url("images/planet.png");
        return view('student/open-classroom/unit', compact('lessons', 'planetUrl', 'unit'));
    }

    public function lesson(Request $request)
    {
        $lessonsId = Route::current()->getParameter('id');

        $id = \Auth::guard("student")->id();
        $lesson = Lesson::find($lessonsId);
        $unit = Unit::find($lesson->units_id);
        $unit->course = Course::find($unit->courses_id);
        $lesson->unit = $unit;
        $lesson->help_md_doc = EndaEditor::MarkDecode($lesson->help_md_doc);
        return view('student/open-classroom/lesson', compact('lesson', 'planetUrl'));
    }
}

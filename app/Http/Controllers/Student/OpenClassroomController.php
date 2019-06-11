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
        $coursesId = $request->get("cId");
        $id = \Auth::guard("student")->id();

        $units = Unit::where("courses_id", "=", $coursesId)
        ->where("is_open", "=", 1)->get();
        $planetUrl = url("images/planet.png");
        return view('student/open-classroom/course', compact('units', 'planetUrl'));
    }

    public function unit(Request $request)
    {
        $unitsId = $request->get("uId");
        $id = \Auth::guard("student")->id();

        $lessons = Lesson::where("units_id", "=", $unitsId)
        ->where("is_open", "=", 1)->get();
        $planetUrl = url("images/planet.png");
        return view('student/open-classroom/unit', compact('lessons', 'planetUrl'));
    }

    public function lesson(Request $request)
    {
        $lessonsId = $request->get("lId");
        $id = \Auth::guard("student")->id();

        $lesson = Lesson::find($lessonsId);
        $lesson->help_md_doc = EndaEditor::MarkDecode($lesson->help_md_doc);

        return view('student/open-classroom/lesson', compact('lesson', 'planetUrl'));
    }
}

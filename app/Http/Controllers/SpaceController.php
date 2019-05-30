<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Sclass;
use App\Models\Term;
use App\Models\Work;
use \Auth;

class SpaceController extends Controller
{
    public function index(Request $request)
    {
        // echo($request->get("studentsId"));
        $student = Student::select("students.*", "terms.grade_key", "sclasses.class_title")
        ->join('sclasses', 'sclasses.id', '=', "students.sclasses_id")
        ->join('terms', 'sclasses.enter_school_year', '=', "terms.enter_school_year")
        ->where("students.id", "=", $request->get("sId"))
        ->where("terms.is_current", "=", 1)
        ->first();

        $coverPrefix = env('APP_URL') . "/works/" . $this->getSchoolCode() . "/cover/";
        
        $works = Work::where("students_id", "=", $student->id)
        ->where("is_open", "=", 1)
        ->orderBy("order_num", "asc")->get();
        return view('space/index', compact('student', "works", "coverPrefix"));
    }

    public function work(Request $request)
    {
        // echo Auth::guard("student")->id();
        $docTypes = ["ppt", "pptx", "doc", "docx", "xls", "xlsx"];
        $sbTypes = ["sb2"];
        $imgTypes = ["jpg", "jpeg", "png", "gif", "bmp"];
        $student = Student::select("students.*", "terms.grade_key", "sclasses.class_title")
        ->join('sclasses', 'sclasses.id', '=', "students.sclasses_id")
        ->join('terms', 'sclasses.enter_school_year', '=', "terms.enter_school_year")
        ->where("students.id", "=", $request->get("sId"))
        ->where("terms.is_current", "=", 1)
        ->first();

        $workPrefix = env('APP_URL') . "/works/" . $this->getSchoolCode() . "/";
        
        $work = Work::find($request->get("wId"));
        $fileType = "sb2";
        if (in_array($work->file_ext, $docTypes)) {
            $fileType = "doc";
        } elseif (in_array($work->file_ext, $imgTypes)) {
            $fileType = "img";
        }
        // $description = str_replace("\r\n", "<p>", $work->description);
        return view('space/work', compact('student', "work", "workPrefix", "fileType", "description"));
    }

    public function getSchoolCode()
    {
      return "ys";
    }
}

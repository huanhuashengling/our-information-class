<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Sclass;
use App\Models\Term;
use App\Models\Work;
use App\Models\WorkComment;
use App\Models\WorkViewLog;
use \Auth;

class SpaceController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->get("sId")) {
            $student = "";
            return view('space/index', compact("student"));
        }
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
        if (!$request->get("sId") || !$request->get("wId")) {
            $student = "";
            return view('space/work', compact("student"));
        }
        $studentsId = \Auth::guard("student")->id();
        $showComment = "false";
        $listHeight = "700px";
        if (isset($studentsId)) {
            $showComment = "true";
            $listHeight = "450px";

            $student = Student::find($studentsId);
            if (2 == $student->work_comment_enable) {
                $showComment = "false";
                $listHeight = "700px";
            } else if($studentsId == $request->get("sId")) {
                $showComment = "false";
                $listHeight = "700px";
            } else {
                $workViewLog = new WorkViewLog();
                $workViewLog->students_id = $request->get("sId");
                $workViewLog->guest_students_id = $studentsId;
                $workViewLog->works_id = $request->get("wId");
                $workViewLog->save();
            }
        }
        
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
        // echo $studentsId;
        // echo $showComment;
        // $description = str_replace("\r\n", "<p>", $work->description);
        return view('space/work', compact('student', "work", "workPrefix", "fileType", "description", "showComment", 'studentsId', 'listHeight'));
    }

    public function addWorkComment(Request $request)
    {
        $content = $request->get("content");
        $students_id = $request->get("students_id");
        $works_id = $request->get("works_id");
        $guest_students_id = $request->get("guest_students_id");

        $workComment = new WorkComment();
        $workComment->content = $request->get("content");
        $workComment->students_id = $request->get("students_id");
        $workComment->works_id = $request->get("works_id");
        $workComment->guest_students_id = $request->get("guest_students_id");
        if ($workComment->save()) {
            return "true";
        } else {
            return "false";
        }
    }

    public function deleteWorkComment(Request $request)
    {
        $content = $request->get("content");
        $students_id = $request->get("students_id");
        $works_id = $request->get("works_id");
        $guest_students_id = $request->get("guest_students_id");

        $workComment = new WorkComment();
    }

    public function listWorkComment(Request $request)
    {
        $resultHtml = "";

        
        $workComments = WorkComment::where("works_id", "=", $request->get("works_id"))->orderBy("created_at", "DESC")->get();
        // dd($workComments);
        foreach ($workComments as $key => $workComment) {

            $student = Student::select("students.username", "sclasses.class_title", "terms.grade_key")
            ->join("sclasses", 'sclasses.id', '=', "students.sclasses_id")
            ->join("terms", 'terms.enter_school_year', '=', "sclasses.enter_school_year")
            ->where("students.id", "=", $workComment->guest_students_id)
            ->where("terms.is_current", "=", 1)
            ->first();


            $resultHtml .= "<div class='text-left'>" . $student->grade_key . $student->class_title . "班" . $student->username . "：<span style='float: right;'>" . date("m-d H:i",strtotime($workComment->created_at)) . "</span></div>";
            $resultHtml .= "<div class='well well-sm well-info'>" . $workComment->content. "</div>";
        }
        return ("" == $resultHtml)?"<p>暂无留言...</p>":$resultHtml;
    }

    public function getSchoolCode()
    {
      return "ys";
    }
}

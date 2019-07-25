<?php

namespace App\Http\Controllers\School;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response as FacadeResponse;
use \DB;
use \Auth;
use \DateTime;
use App\Models\LessonLog;
use App\Models\Sclass;
use App\Models\School;
use App\Models\Student;
use App\Models\Post;
use App\Models\Term;

use ZipArchive;

class TermEndExportController extends Controller
{
    public function index($value='')
    {
        $schoolsId = \Auth::guard("school")->id();
        $terms = Term::orderBy("enter_school_year", "desc")->get();
        return view('school/term-end-export/index', compact("terms"));
    }

    public function loadSclassSelection(Request $request)
    {
        $term = Term::find($request->get('terms_id'));
        $schools_id = \Auth::guard("school")->id();
        $sclasses = Sclass::where(["enter_school_year" => $term->enter_school_year, 'schools_id' => $schools_id])
        ->orderBy("enter_school_year", "desc")->get();
        return $this->buildSclassSelctionHtml($sclasses);
    }

    public function loadTermEndPostList(Request $request) {
        $lessonTitleList = $request->get('lessonTitleList');
        $lessonTitleArr = explode("|", $lessonTitleList);
        $titleNum = array_pop($lessonTitleArr);
        $sclassesId = $request->get('sclassesId');
        $students = Student::select("username")
                ->where("sclasses_id", "=", $sclassesId)
                ->where("is_lock", "=", 0)
                ->get();
        $studentNum = count($students);
        $studentData = [];
        foreach ($students as $key => $student) {
            foreach ($lessonTitleArr as $key => $lessonTitle) {
                $student["title" . ($key + 1)] = $lessonTitle;
            }
            $student["titleNum"] = $titleNum;
            $studentData[] = $student;
        }
        $tStudent = new Student();
        $tStudent["username"] = "合计";
        $tStudent["title1"] = $studentNum;
        $tStudent["title2"] = $studentNum;
        $tStudent["title3"] = $studentNum;
        $tStudent["title4"] = $studentNum;
        $tStudent["titleNum"] = $studentNum*4;
        $studentData[] = $tStudent;
        return $studentData;
    } 

    public function buildSclassSelctionHtml($sclasses)
    {
        $returnHtml = "<option>选择班级</option>";
        foreach ($sclasses as $key => $sclass) {
            $returnHtml .= "<option value='" . $sclass['id'] . "'>" . $sclass['class_title'] . "班</option>";
        }

        return $returnHtml;
    }
}

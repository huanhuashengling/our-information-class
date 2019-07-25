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


    public function exportPostFiles(Request $request) {
        $sclassesId = $request->get('sclassesId');
        $lessonlogsId = $request->get('lessonlogsId');
        $school = School::where("id", "=", \Auth::guard("school")->id())->first();
        $middir = "/posts/" . $school->code ."/";

        $lessonLog = LessonLog::select('lesson_logs.id', 'lessons.title', 'lessons.subtitle', 'sclasses.enter_school_year', 'sclasses.class_title')
            ->join('lessons', function($join){
              $join->on('lessons.id', '=', 'lesson_logs.lessons_id');
            })
            ->join('sclasses', function($join){
              $join->on('sclasses.id', '=', 'lesson_logs.sclasses_id');
            })
            ->where(['lesson_logs.sclasses_id' => $sclassesId, 'lesson_logs.id' => $lessonlogsId])->first();


        $posts = Post::select('posts.id', 'students.username', 'posts.original_name', 'posts.storage_name', 'sclasses.enter_school_year', 'sclasses.class_title')
            ->leftJoin('students', function($join){
               $join->on('students.id', '=', 'posts.students_id');
            })
            ->leftJoin('sclasses', function($join){
               $join->on('sclasses.id', '=', 'students.sclasses_id');
            })
            ->where(['posts.lesson_logs_id' => $lessonlogsId])->get();

// echo($sclassesId . $lessonlogsId);
        if ($request->has('download') || true) {
            $zipFileName = $lessonLog->enter_school_year . "_" . $lessonLog->class_title . "_" . $lessonLog->title . '_' . count($posts) . '_' . date('YmdHis') . ".zip";
            $store_path = public_path() . '/downloads/' .$zipFileName;

            $zip = new ZipArchive;
            if ($zip->open($store_path, ZipArchive::CREATE) === TRUE) {
                foreach ($posts as $key => $post) {
                    if (!file_exists(public_path(). $middir .$post->storage_name)) { die($post->storage_name.' does not exist'); }
                    if (!is_readable(public_path(). $middir .$post->storage_name)) { die($post->storage_name.' not readable'); }
                    $zip->addFile(public_path(). $middir .$post->storage_name, $post->storage_name);
                }
                $zip->close();
            }
            if (!is_writable(public_path() . '/downloads/')) { die(public_path() . '/downloads/' . 'directory not writable'); }

            // $headers = array(
            //     'Cache-Control' => 'max-age=0',
            //     'Content-Description' => 'File Transfer',
            //     'Content-disposition' => 'attachment; filename=' . basename($store_path),
            //     'Content-Type' => 'application/zip',
            //     'Content-Transfer-Encoding' => 'binary',
            //     'Content-Length' => filesize($store_path),
            // );
            return env("APP_URL")."/downloads/".basename($store_path);

            // header("Cache-Control: max-age=0");
            // header("Content-Description: File Transfer");
            // header('Content-disposition: attachment; filename=' . basename($store_path)); // 文件名
            // header("Content-Type: application/zip"); // zip格式的
            // header("Content-Transfer-Encoding: binary"); // 告诉浏览器，这是二进制文件
            // header('Content-Length: ' . filesize($store_path)); // 告诉浏览器，文件大小
            // readfile($store_path);
        }
    }

    public function clearAllZip()
    {
        $zipfiles = scandir(public_path() . '/downloads/');
        foreach ($zipfiles as $key => $zipfile) {
            //排除目录中的.和..
            if($zipfile !="." && $zipfile !=".."){
                //如果是文件直接删除
                unlink(public_path() . '/downloads/'.$zipfile);
            }
        }
        return "true";
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

<?php

namespace App\Http\Controllers\School;

use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadeResponse;
use App\Http\Controllers\Controller;
use \DB;
use \Auth;
use \DateTime;
use App\Models\LessonLog;
use App\Models\Sclass;
use App\Models\School;
use App\Models\Post;
use App\Models\Term;

use ZipArchive;

class ExportPostController extends Controller
{
    public function index($value='')
    {
        $schoolsId = \Auth::guard("school")->id();
        $terms = Term::orderBy("enter_school_year", "desc")->get();
        return view('school/export/index', compact("terms"));
    }

    public function loadSclassSelection(Request $request)
    {
        $term = Term::find($request->get('terms_id'));
        $schools_id = \Auth::guard("school")->id();
        $sclasses = Sclass::where(["enter_school_year" => $term->enter_school_year, 'schools_id' => $schools_id])
        ->orderBy("enter_school_year", "desc")->get();
        return $this->buildSclassSelctionHhtml($sclasses);
    }

    public function loadLessonLogInfo(Request $request) {
        $sclassesId = $request->get('sclassesId');
        $lessonLogs = LessonLog::select('lesson_logs.id', 'lessons.title', 'lessons.subtitle', 'teachers.username', 'lesson_logs.updated_at', DB::raw("COUNT(`posts`.`id`) as post_num"))
            ->leftJoin('lessons', function($join){
              $join->on('lessons.id', '=', 'lesson_logs.lessons_id');
            })
            ->leftJoin('teachers', function($join){
              $join->on('teachers.id', '=', 'lesson_logs.teachers_id');
            })
            ->leftJoin('posts', function($join){
              $join->on('posts.lesson_logs_id', '=', 'lesson_logs.id');
            })
            ->groupBy('lesson_logs.id', 'lessons.title', 'lessons.subtitle', 'teachers.username', 'lesson_logs.updated_at')
            ->where(['sclasses_id' => $sclassesId])->get();

        return $this->buildLessonLogSelectionHtml($lessonLogs);
    }

    public function loadPostList(Request $request) {
        $lessonlogsId = $request->get('lessonlogsId');
        $posts = Post::select('posts.id', 'students.username', 'students.gender', 'posts.original_name', 'post_rates.rate', 'sclasses.enter_school_year', 'sclasses.class_title', 'comments.content', DB::raw("COUNT(`marks`.`id`) as mark_num"))
            ->leftJoin('students', function($join){
               $join->on('students.id', '=', 'posts.students_id');
            })
            ->leftJoin('post_rates', function($join){
               $join->on('post_rates.posts_id', '=', 'posts.id');
            })
            ->leftJoin('comments', function($join){
               $join->on('comments.posts_id', '=', 'posts.id');
            })
            ->leftJoin('sclasses', function($join){
               $join->on('sclasses.id', '=', 'students.sclasses_id');
            })
            ->leftJoin('marks', function($join){
               $join->on('marks.posts_id', '=', 'posts.id');
            })
            ->groupBy('posts.id', 'students.username', 'students.gender', 'posts.original_name', 'post_rates.rate', 'sclasses.enter_school_year', 'sclasses.class_title', 'comments.content')
            ->where(['posts.lesson_logs_id' => $lessonlogsId])->get();
        return json_encode($posts);
    }

    public function buildLessonLogSelectionHtml($lessonlogs) {
        $returnHtml = "<option>选择上课记录</option>";
        foreach ($lessonlogs as $key => $lessonLog) {
            $d= date("Y-m-d", strtotime($lessonLog['updated_at']));
            // $date = new DateTime($lessonLog['updated_at'])->format("Y-m-d");
            $returnHtml .= "<option value='" . $lessonLog['id'] . "'>" . ($key+1) . ". " . $lessonLog['title'] ."(". $lessonLog['subtitle'] .")－". $lessonLog['username'] . "－".$lessonLog['post_num'] . "份－" . $d . "</option>";
        }

        return $returnHtml;
    }

    public function exportPostFiles(Request $request) {
        $sclassesId = $request->get('sclassesId');
        $lessonlogsId = $request->get('lessonlogsId');
        $school = School::where("id", "=", \Auth::guard("school")->id());
        $middir = "/posts/" . $school->code ."/";

        $lessonLog = LessonLog::select('lesson_logs.id', 'lessons.title', 'lessons.subtitle', 'sclasses.enter_school_year', 'sclasses.class_title')
            ->leftJoin('lessons', function($join){
              $join->on('lessons.id', '=', 'lesson_logs.lessons_id');
            })
            ->leftJoin('sclasses', function($join){
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

    public function buildSclassSelctionHhtml($sclasses)
    {
        $returnHtml = "<option>选择班级</option>";
        foreach ($sclasses as $key => $sclass) {
            $returnHtml .= "<option value='" . $sclass['id'] . "'>" . $sclass['class_title'] . "班</option>";
        }

        return $returnHtml;
    }
}

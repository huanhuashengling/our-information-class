<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadeResponse;
use App\Http\Controllers\Controller;
use \DB;
use \DateTime;
use App\Models\LessonLog;
use App\Models\Post;

class ExportPostController extends Controller
{
    public function index($value='')
    {

        return view('admin/export/index');
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
        // $exportDir = $request->get('exportDir');
        $exportDir = "/Users/ywj/Downloads/post_download";
        $sclassesId = $request->get('sclassesId');
        $lessonlogsId = $request->get('lessonlogsId');
        // return "exportDir  " . $exportDir . "sclassesId  " . $sclassesId . "lessonlogsId   " . $lessonlogsId;
        $posts = Post::select('posts.id', 'students.username', 'posts.original_name', 'posts.storage_name', 'sclasses.enter_school_year', 'sclasses.class_title')
            ->leftJoin('students', function($join){
               $join->on('students.id', '=', 'posts.students_id');
            })
            ->leftJoin('sclasses', function($join){
               $join->on('sclasses.id', '=', 'students.sclasses_id');
            })
            ->where(['posts.lesson_logs_id' => $lessonlogsId])->get();
        // return var_dump(count($posts));
        // set_time_limit(0);
        foreach ($posts as $key => $post) {
            // file_put_contents("test.bmp", file_get_contents(env('APP_URL')."/posts/".$post->storage_name));
            // return response()->download(
            //     public_path()."/posts/".$post->storage_name,
            //     'Laravel学院.jpg'
            // );
                // $filename=public_path()."/posts/".$post->storage_name; //文件名  
                // $date=date("Ymd-H:i:m");  
                // Header( "Content-type:  application/octet-stream ");   
                // Header( "Accept-Ranges:  bytes ");   
                // Header( "Accept-Length: " .filesize($filename));  
                // header( "Content-Disposition:  attachment;  filename= {$date}.bmp");   
                // return file_get_contents($filename);  
                // readfile($filename);
            // return env('APP_URL')."/posts/".$post->storage_name;
            // file_put_contents($exportDir, $content);
            // return FacadeResponse::download(public_path()."/posts/".$post->storage_name, 200);
            // return Response::download(env('APP_URL')."/posts/".$post->storage_name);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, 0); 
            curl_setopt($ch,CURLOPT_URL, env('APP_URL')."/posts/".$post->storage_name); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            $file_content = curl_exec($ch);

            // file_put_contents($exportDir, $content);
            curl_close($ch);
            // $downloaded_file = fopen($exportDir, 'w');
            file_put_contents($filename, $img);
            fwrite($downloaded_file, $file_content);
            fclose($downloaded_file);
        }
    }
}

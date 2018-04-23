<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
            $returnHtml .= "<option value='" . $lessonLog['id'] . "'>" . ($key+1) . ". " . $lessonLog['title'] ."(". $lessonLog['subtitle'] .")－". $lessonLog['username'] . "老师－".$lessonLog['post_num'] . "份作业－" . $d . "</option>";
        }

        return $returnHtml;
    }
}

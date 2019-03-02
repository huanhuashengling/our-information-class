<?php

namespace App\Http\Controllers\School;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\LessonLog; 
use App\Models\Post; 
use App\Models\Mark; 
use App\Models\PostRate; 
use App\Models\Comment; 

use \DB;

class LessonLogController extends Controller
{
    public function index()
    {
        return view('school/lessonLog/index')->withLessonLogs(LessonLog::all());
    }

    public function getLessonLogList()
    {
        $schoolsId = \Auth::guard("school")->id();
        $lessonLogs = LessonLog::select('lesson_logs.id', 'lessons.title', 'lessons.subtitle', 'teachers.username', 'lesson_logs.updated_at', 'sclasses.enter_school_year', 'sclasses.class_title', DB::raw("COUNT(`posts`.`id`) as post_num"))
            ->leftJoin('lessons', function($join){
              $join->on('lessons.id', '=', 'lesson_logs.lessons_id');
            })
            ->leftJoin('teachers', function($join){
              $join->on('teachers.id', '=', 'lesson_logs.teachers_id');
            })
            ->leftJoin('sclasses', function($join){
              $join->on('sclasses.id', '=', 'lesson_logs.sclasses_id');
            })
            ->leftJoin('posts', function($join){
              $join->on('posts.lesson_logs_id', '=', 'lesson_logs.id');
            })
            ->groupBy('lesson_logs.id', 'lessons.title', 'lessons.subtitle', 'teachers.username', 'lesson_logs.updated_at', 'sclasses.enter_school_year', 'sclasses.class_title')
            ->where("sclasses.schools_id", "=", $schoolsId)->get();

        return $lessonLogs;
    }

    public function delLessonLog(Request $request)
    {
        $lessonLogsId = $request->get('lessonLogsId');
        $lessonLog = LessonLog::find($lessonLogsId);

        $posts = Post::where("posts.lesson_logs_id", "=", $lessonLogsId)->get();
        $returnValue = "";
        foreach ($posts as $key => $post) {
            $marks = Mark::where("marks.posts_id", "=", $post->id)->get();
            foreach ($marks as $key => $mark) {
                $result = DB::table('marks')->where('id', '=', $mark->id)->delete();
                if (!$result) {
                    $returnValue = "删除点赞数失败，请联系管理员！";
                    break;
                }
            }

            if ("" != $returnValue) {
                break;
            }

            $postRates = PostRate::where("post_rates.posts_id", "=", $post->id)->get();
            foreach ($postRates as $key => $postRate) {
                $result = DB::table('post_rates')->where('id', '=', $postRate->id)->delete();
                if (!$result) {
                    $returnValue = "删除等第数据失败，请联系管理员！";
                    break;
                }
            }

            if ("" != $returnValue) {
                break;
            }

            $coments = Comment::where("comments.posts_id", "=", $post->id)->get();
            foreach ($coments as $key => $coment) {
                $result = DB::table('coments')->where('id', '=', $coment->id)->delete();
                if (!$result) {
                    $returnValue = "删除评论数据失败，请联系管理员！";
                    break;
                }
            }

            if ("" != $returnValue) {
                break;
            }

            $result = DB::table('posts')->where('id', '=', $post->id)->delete();
            if (!$result) {
                $returnValue = "删除作品数据失败，请联系管理员！";
                break;
            }
        }
        $result = DB::table('lesson_logs')->where('id', '=', $lessonLog->id)->delete();
        if (!$result) {
            $returnValue = "删除上课记录数据失败，请联系管理员！";
        }
        return $returnValue;
    }
}

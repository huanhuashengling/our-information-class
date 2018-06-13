<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Sclass;
use App\Models\LessonLog;
use App\Models\Student;
use App\Models\Post;
use App\Models\PostRate;
use App\Models\Comment;
use App\Models\Mark;

use \DB;

class ScoreReportController extends Controller
{
    public function index() {

        $sclasses = Sclass::get();
        $classData = [];
        array_push($classData, "请选择班级");
        foreach ($sclasses as $key => $sclass) {
            // $dateDiff = date_diff($sclass['enter_school_year']."0801", date('y', time()).date('m',time())."01");
            // dd($dateDiff);
            $classData[$sclass['id']] = $sclass['enter_school_year'] . "级" . $sclass['class_title'] . "班";
        }
        return view('teacher/scoreReport/index', compact('classData'));
    }

    public function report(Request $request) {
        $sclassesId = $request->get('sclassesId');
        $lessonLogCount = LessonLog::where("lesson_logs.sclasses_id", '=', $sclassesId)->where(DB::raw('YEAR(lesson_logs.created_at)'), ">", 2017)->count();
        $students = Student::where("sclasses_id", "=", $sclassesId)->where("students.is_lock", "!=", "1")->get();
        // dd($students);
        // order username postednum unpostnum rate1num rate2num rate3num rate4num commentnum marknum scorecount
        $dataset = [];
        foreach ($students as $key => $student) {
            $tDate = [];
            $tDate['username'] = $student->username;
            $tDate['postedNum'] = Post::where("posts.students_id", '=', $student->id)
                                        ->where(DB::raw('YEAR(posts.created_at)'), ">", 2017)
                                        ->count();
            // $tDate['postedNum'] 
            $posts = Post::select('posts.id', DB::raw("SUM(`marks`.`state_code`) as mark_num"))
                            ->leftJoin("marks", 'marks.posts_id', '=', 'posts.id')
                            ->where("posts.students_id", '=', $student->id)
                            ->where("marks.state_code", "=", 1)
                            ->where(DB::raw('YEAR(posts.created_at)'), ">", 2017)
                            ->groupBy('posts.id')
                            ->get();
            $tDate['markNum'] = 0;
            $tDate['effectMarkNum'] = 0;
            foreach ($posts as $key => $post) {
                $tDate['markNum'] += $post->mark_num;
                $tDate['effectMarkNum'] += ($post->mark_num > 4)?4:$post->mark_num; 
            }
            // dd($posts);
            $tDate['unPostedNum'] = $lessonLogCount - $tDate['postedNum'];
            $tDate['commentNum'] = Comment::leftJoin("posts", 'posts.id', '=', 'comments.posts_id')
                                            ->leftJoin("students", 'students.id', '=', 'posts.students_id')
                                            ->where("posts.students_id", '=', $student->id)
                                            ->where(DB::raw('YEAR(posts.created_at)'), ">", 2017)
                                            ->count();
                    
            $rates = PostRate::leftJoin("posts", 'posts.id', '=', 'post_rates.posts_id')
                                            ->leftJoin("students", 'students.id', '=', 'posts.students_id')
                                            ->where("posts.students_id", '=', $student->id)
                                            ->where(DB::raw('YEAR(posts.created_at)'), ">", 2017)
                                            ->get();
            $tDate['rateYouNum'] = 0;
            $tDate['rateLiangNum'] = 0;
            $tDate['rateHeNum'] = 0;
            $tDate['rateChaNum'] = 0;
            foreach ($rates as $key => $rate) {
                if ("优" == $rate->rate) {
                    $tDate['rateYouNum'] ++;
                } elseif ("良" == $rate->rate) {
                    $tDate['rateLiangNum'] ++;
                } elseif ("合格" == $rate->rate) {
                    $tDate['rateHeNum'] ++;
                } elseif ("差" == $rate->rate) {
                    $tDate['rateChaNum'] ++;
                }
            }
            $tDate['scoreCount'] = $tDate['rateYouNum'] * 8 + $tDate['effectMarkNum'] * 0.5 + $tDate['commentNum'];
            $dataset[] = $tDate;

        }
        return $dataset;
    }
}

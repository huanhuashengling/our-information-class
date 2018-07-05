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
use App\Models\Term;

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

    public function getSclassTermsList(Request $request) {
        $sclassesId = $request->get('sclassesId');
        $sclass = Sclass::find($sclassesId);
        $terms = Term::where("terms.enter_school_year", '=', $sclass->enter_school_year)->get();
        return $this->buildTermsSelectionHtml($terms);
    }

    public function buildTermsSelectionHtml($terms) {
        $resultHtml = "";
        foreach ($terms as $key => $term) {
            $class = $term->is_current?"selected":"";
            $hint = $term->is_current?"（本学期）":"";
            $resultHtml .= "<option value='" . $term->id . "' " . $class . ">" . $term->grade_key . "年" . $term->term_segment . "期".$hint."</option>";
        }

        return $resultHtml;
    }

    public function report(Request $request) {
        $sclassesId = $request->get('sclassesId');
        $termsId = $request->get('termsId');
        // dd($sclassesId."-".$termsId);
        $term = Term::find($termsId);
        $from = date('Y-m-d', strtotime($term->from_date)); 
        $to = date('Y-m-d', strtotime($term->to_date));
        $lessonLogCount = LessonLog::where("lesson_logs.sclasses_id", '=', $sclassesId)->whereBetween('lesson_logs.created_at', array($from, $to))->count();
        $students = Student::where("sclasses_id", "=", $sclassesId)->where("students.is_lock", "!=", "1")->get();
        // dd($students);
        // order username postednum unpostnum rate1num rate2num rate3num rate4num commentnum marknum scorecount
        $dataset = [];
        foreach ($students as $key => $student) {
            $tDate = [];
            $tDate['username'] = $student->username;
            $tDate['postedNum'] = Post::leftJoin("lesson_logs", 'lesson_logs.id', '=', 'posts.lesson_logs_id')
                                        ->where("posts.students_id", '=', $student->id)
                                        ->whereBetween('lesson_logs.created_at', array($from, $to))
                                        ->count();
            // $tDate['postedNum'] 
            $posts = Post::select('posts.id', DB::raw("SUM(`marks`.`state_code`) as mark_num"))
                            ->leftJoin("marks", 'marks.posts_id', '=', 'posts.id')
                            ->leftJoin("lesson_logs", 'lesson_logs.id', '=', 'posts.lesson_logs_id')
                            ->where("posts.students_id", '=', $student->id)
                            ->where("marks.state_code", "=", 1)
                            ->whereBetween('lesson_logs.created_at', array($from, $to))
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
                                            ->leftJoin("lesson_logs", 'lesson_logs.id', '=', 'posts.lesson_logs_id')
                                            ->leftJoin("students", 'students.id', '=', 'posts.students_id')
                                            ->where("posts.students_id", '=', $student->id)
                                            ->whereBetween('lesson_logs.created_at', array($from, $to))
                                            ->count();
                    
            $rates = PostRate::leftJoin("posts", 'posts.id', '=', 'post_rates.posts_id')
                                ->leftJoin("lesson_logs", 'lesson_logs.id', '=', 'posts.lesson_logs_id')
                                ->leftJoin("students", 'students.id', '=', 'posts.students_id')
                                ->where("posts.students_id", '=', $student->id)
                                ->whereBetween('lesson_logs.created_at', array($from, $to))
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

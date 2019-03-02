<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Term;
use App\Models\Sclass;
use App\Models\LessonLog;
use \DB;
use App\Models\PostRate;
use App\Models\Comment;
use App\Models\Mark;
use App\Http\Requests\LessonLogRequest;
use App\Libaries\pinyinfirstchar;

class TermCheckController extends Controller
{
    public function index()
    {
        $terms = Term::orderBy("enter_school_year", "desc")->get();
        return view('termCheck/index', compact('terms'));
    }

    public function loadLessonLogSelection(Request $request)
    {
        $term = Term::find($request->get('terms_id'));
        $from = date('Y-m-d', strtotime($term->from_date)); 
        $to = date('Y-m-d', strtotime($term->to_date));

        $class_num = $request->get('class_num');
        $sclass = Sclass::where(["class_num" => $class_num, "enter_school_year" => $term->enter_school_year])->first();

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
            ->whereBetween('lesson_logs.created_at', array($from, $to))
            ->where(['sclasses_id' => $sclass->id])->get();

        return $this->buildLessonLogSelectionHtml($lessonLogs);
    }
    
    public function getPostRate(Request $request)
    {
        $postRate = PostRate::where(['posts_id' => $request->input('posts_id')])->first();

        if (isset($postRate)) {
            return $postRate['rate'];
        } else {
            return "false";
        }
    }


    public function getPostDataByTermAndSclass(Request $request)
    {
        $lessonLogsId = $request->get('lessonlogsId');
        $lessonLog = LessonLog::find($request->get('lessonlogsId'));
        // dd($lessonLog);die();

        $students = DB::table('students')->select('students.id', 'students.username', 'posts.file_ext', 'posts.storage_name', 'comments.content', 'post_rates.rate', 'posts.id as posts_id', DB::raw("COUNT(`marks`.`id`) as mark_num"))
        ->leftJoin('posts', 'posts.students_id', '=', 'students.id')
        ->leftJoin('post_rates', 'post_rates.posts_id', '=', 'posts.id')
        ->leftJoin('comments', 'comments.posts_id', '=', 'posts.id')
        ->leftJoin('marks', 'marks.posts_id', '=', 'posts.id')
        ->where(["students.sclasses_id" => $lessonLog['sclasses_id'], 'posts.lesson_logs_id' => $lessonLog['id']])
        ->where('students.is_lock', "!=", "1")
        ->groupBy('students.id', 'students.username', 'posts.storage_name', 'comments.content', 'post_rates.rate', 'posts.id')
        ->orderBy(DB::raw('convert(students.username using gbk)'), "ASC")->get();
        // dd($lessonLog);
        $unPostStudentNameStr = "未交名单:";
        
        $postedStudents = [];
        $allStudentsList = DB::table('students')->select('students.username')
        ->where(['students.sclasses_id' => $lessonLog['sclasses_id']])->where('students.is_lock', "!=", "1")->get();
        foreach ($students as $key => $student) {
            array_push($postedStudents, $student->username);
        }
        $unpostCount = 0;
        foreach ($allStudentsList as $key => $studentsName) {
            if (!in_array($studentsName->username, $postedStudents)) {
                $unPostStudentNameStr .= " " . ($unpostCount + 1). ". " . $studentsName->username;
                $unpostCount++;
            }
        }
        // dd($unPostStudentName);
        $allCount = count($allStudentsList);
        // return view('teacher/takeclass', compact('students', 'lessonLog', 'py', 'allCount', 'unPostStudentName'));
        // $unpostCount = 0;
        $postedCount = $allCount-$unpostCount;
        $panelHeadStr = "(全部".$allCount.")"." "."(已交".$postedCount.")"." "."(未交".$unpostCount.")";
        
        $returnHtml = "<div class='panel panel-default'><div class='panel-heading'><h4>".$panelHeadStr."</h4></div><div class='panel-body'>" . $this->buildStudentPostsList($students) . " </div><div class='panel-footer'><h4>".$unPostStudentNameStr."</h4></div></div>";
            
        $returnHtml .= "<input type='hidden' id='lesson-log-id' value='" . $lessonLog['id'] . "'>";
        $returnHtml .= "<div class='panel panel-default'><div class='panel-heading'><div class='panel-title'>本节课教学反思</div></div><div class='panel-body'><p>" . $lessonLog['rethink'] . "</p></div></div>";


        return $returnHtml;
    }

    public function buildStudentPostsList($students)
    {
        $returnHtml = "";
        $py = new pinyinfirstchar();
        foreach ($students as $student) {
            if (isset($student->rate)) {
                $ratestr = $student->rate;
                $hasCommentCss = "alert-info";
            } else {
                $ratestr = "";
                $hasCommentCss = "alert-default";
            }
            if (isset($student->content)) {
                $hasCommentCss = "alert-danger";
            }
            $marksNum = isset($student->mark_num)?($student->mark_num . "赞"):"";
            $returnHtml .= "<div class='col-md-2 col-sm-4 col-xs-6' style='padding-left: 5px; padding-right: 5px;'><div class='alert " . $hasCommentCss . "' style='padding: 5px;'><div><img class='img-responsive post-btn center-block' value='". $student->posts_id . "' src='" . getThumbnail($student->storage_name, 140, 100, 'fit', $student->file_ext) . "' alt='></div><div><h3 style='margin-top: 10px;'>" . $py->getFirstchar($student->username) . "<small>" . $student->username . "<small></small><span class='text-right'> " . $ratestr . "" . $marksNum . "</span></small></h3></div></div></div>";
        }
        return $returnHtml;
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

    public function getPost(Request $request)
    {
        $post = Post::where(['id' => $request->input('posts_id')])->orderBy('id', 'desc')->first();
        $imgTypes = ['jpg', 'jpeg', 'bmp', 'gif', 'png'];
        $docTypes = ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];
        if (isset($post)) {
            if (in_array($post->file_ext, $imgTypes)) {
                return ["filetype"=>"img", "url" => getThumbnail($post['storage_name'], 800, 600, 'fit', $post['file_ext'])];
            } elseif (in_array($post->file_ext, $docTypes)) {
                return ["filetype"=>"doc", "url" => env('APP_URL')."/posts/ys/".$post->storage_name];
            } elseif ("sb2" == $post->file_ext) {
                return ["filetype"=>"sb2", "url" => env('APP_URL')."/posts/ys/".$post->storage_name];
            }
            // $file = Storage::disk('uploads')->get($post->storage_name)->getPath();
                // $post->storage_name = env('APP_URL')."/posts/".$post->storage_name;
            // return getThumbnail($post['storage_name'], 800, 600, 'fit');
        
        } else {
            return "false";
        }
    }

    public function getCommentByPostsId(Request $request)
    {
        $comment = Comment::where(['posts_id' => $request->get('posts_id')])->first();

        if (isset($comment)) {
            return json_encode($comment);
        } else {
            return "false";
        }
    }

}

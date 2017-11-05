<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use App\Models\Student;
use App\Models\Sclass;
use App\Models\Lesson;
use App\Models\Post;
use App\Models\PostRate;
use App\Models\Comment;
use App\Models\LessonLog;
use Illuminate\Support\Facades\View;

use App\Libaries\pinyinfirstchar;


class HomeController extends Controller
{
    public function index()
    {
        // dd(auth()->guard('teacher')->user());

        $userId = auth()->guard('teacher')->id();
        // dd($userId);
        $lessonLog = LessonLog::where(['teachers_id' => $userId, 'status' => 'open'])->first();
        if ($lessonLog) {
            // dd($lessonLog);die();
            //If the teacher has one lesson log, only need redirect to route takeclass and load view
            return redirect('teacher/takeclass');
        }


        $sclasses = Sclass::get();
        $classData = [];
        foreach ($sclasses as $key => $sclass) {
            $dateDiff = date_diff($sclass['enter_school_year']."0801", date('y', time()).date('m',time())."01");
            dd($dateDiff);
            $classData[$sclass['id']] = (2017-$sclass['enter_school_year']) ."级". $sclass['class_title'] . "班";
        }
        $lessons = Lesson::get();
// dd($classData);
        return view('teacher/home', compact('classData', 'lessons'));
    }

    public function takeClass()
    {
        $userId = auth()->guard('teacher')->id();
        $lessonLog = LessonLog::where(['teachers_id' => $userId, 'status' => 'open'])->first();
        // dd($lessonLog);die();

        $lesson = Lesson::where(['id' => $lessonLog['lessons_id']])->first();
        $schoolClass = Sclass::where(['id' => $lessonLog['sclasses_id']])->first();
        // dd($schoolClass);die();

        $students = Student::leftJoin('lesson_logs', function($join) {
            $join->on('students.sclasses_id', '=', 'lesson_logs.sclasses_id');
        })->where(["lesson_logs.id" => $lessonLog['id']])->get();
        $postData = [];
        foreach ($students as $key => $student) {
            // echo($student['id']);
            $post = Post::where(['students_id' => $student['id'], 'lesson_logs_id' => $lessonLog['id']])->first();
            // $postRate = PostRate::where(['posts_id' => $post['id']])->first();
            // $rate = isset($postRate)?$postRate['rate']:"";
            $rate = "";
            $comment = Comment::where(['posts_id' => $post['id']])->first();
            $hasComment = isset($comment)?"true":"false";

            $postData[$student['id']] = ['post' => $post, 'rate' => $rate, 'hasComment' => $hasComment];
        }
        // dd($postData);die();
        $py = new pinyinfirstchar();
        return view('teacher/takeclass', compact('schoolClass', 'lesson', 'students', 'lessonLog', 'postData', 'py'));
    }

    public function updateRate(Request $request)
    {
        $this->validate($request, [
            'posts_id' => 'required',
            'rate' => 'required',
        ]);

        $id = \Auth::user()->id;
        $posts_id = $request->get('posts_id');
        $rate = $request->get('rate');
        $postRate = PostRate::where(['teachers_id' => $id, "posts_id" => $posts_id])->first();
        if (isset($postRate)) {
            $postRate->rate = $rate;
            if ($postRate->update()) {
                return "true";
            } else {
                return "false";
            }
        } else {
            $postRate = new PostRate();
            $postRate->teachers_id = $id;
            $postRate->posts_id = $posts_id;
            $postRate->rate = $rate;
            if ($postRate->save()) {
                return "true";
            } else {
                return "false";
            }
        }
    }

    public function getPostRate(Request $request)
    {
        $postRate = PostRate::where(['posts_id' => $request->get('posts_id')])->first();
        if (isset($postRate)) {
            return $postRate['rate'];
        } else {
            return "false";
        }
    }

    public function getLessonPostPerSclass(Request $request)
    {
        $id = \Auth::user()->id;
        $lessons_id = $request->get('lessons_id');
        $lessonLogs = LessonLog::leftJoin('sclasses', function($join) {
            $join->on('sclasses.id', '=', 'lesson_logs.sclasses_id');
        })->where(['lessons_id' => $lessons_id, 'teachers_id' => $id])->orderBy('sclasses.id', 'asc')->selectRaw("lesson_logs.id as lesson_logs_id, sclasses.title as school_class_title")->get();

        $newLessonLogs = [];
        $students = [];
        foreach ($lessonLogs as $key => $lessonLog) {
            $students = Student::leftJoin('lesson_logs', function($join) {
                $join->on('students.sclasses_id', '=', 'lesson_logs.sclasses_id');
            })->leftJoin('users', function($join) {
                $join->on('students.id', '=', 'users.id');
            })->where(["lesson_logs.id" => $lessonLog['lesson_logs_id']])->get();
// echo count($students) . "   ----   ";
            $postData = [];
            foreach ($students as $key => $student) {
                // echo($student['id']);
                $post = Post::where(['students_id' => $student['id'], 'lesson_logs_id' => $lessonLog['lesson_logs_id']])->first();
                $postRate = PostRate::where(['posts_id' => $post['id']])->first();
                $rate = isset($postRate)?$postRate['rate']:"";
                $comment = Comment::where(['posts_id' => $post['id']])->first();
                $hasComment = isset($comment)?"true":"false";

                $postData[$student['id']] = ['post' => $post, 'rate' => $rate, 'hasComment' => $hasComment];
            }
            $newLessonLogs[] = ['students' => $students, 'postData' => $postData, 'school_class_title' => $lessonLog['school_class_title'], 'lesson_logs_id' => $lessonLog['lesson_logs_id']];

        }
// dd($newLessonLogs);die();
        return $this->lessonHistoryHtmlCreate($newLessonLogs);
        // $post = Post::where(['students_id' => $student['id'], 'lesson_logs_id' => $lessonLog['id']])->first();
        //有哪些班，第一个班的详细数据
    }

    public function lessonHistoryHtmlCreate($lessonLogs)
    {
        $py = new pinyinfirstchar();
        $returnHtml = "<ul class='nav nav-tabs'>";
            foreach ($lessonLogs as $key => $lessonLog) {
// dd($lessonLog);

                $returnHtml .= "<li><a href='#show-class" . $lessonLog["lesson_logs_id"] . "' data-toggle='tab'>" . $lessonLog["school_class_title"] . "</a></li>";
            }
        $returnHtml .= "</ul>";
        $returnHtml .= "<div class='tab-content'>";
            foreach ($lessonLogs as $key => $lessonLog) {
                $students = $lessonLog['students'];
                $postData = $lessonLog['postData'];
                $showLimit = "all";
                $active = (0 == $key)?"in active":"";
                $html = View::make('teacher.partials.studentlist', compact('students', 'postData', 'showLimit', 'py'))->render();
                $returnHtml .= "<div class='tab-pane fade " . $active . "' id='show-class" . $lessonLog["lesson_logs_id"] . "'>" . $html . "</div>";
            }
        $returnHtml .= "</div>";
        return $returnHtml;
    }
}

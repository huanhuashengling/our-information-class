<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\SchoolClass;
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
        $userId = \Auth::user()->id;
        $lessonLog = LessonLog::where(['teachers_users_id' => $userId, 'status' => 'open'])->first();
        if ($lessonLog) {
            // dd($lessonLog);die();
            //If the teacher has one lesson log, only need redirect to route takeclass and load view
            return redirect('teacher/takeclass');
        }


        $schoolClasses = SchoolClass::where('grade_num', '>', 2)->pluck('title', 'id');
        $lessons = Lesson::get();
// dd($lessons);die();
        return view('teacher/home', compact('schoolClasses', 'lessons'));
    }

    public function takeClass()
    {
        $userId = \Auth::user()->id;
        $lessonLog = LessonLog::where(['teachers_users_id' => $userId, 'status' => 'open'])->first();
        // dd($lessonLog);die();

        $lesson = Lesson::where(['id' => $lessonLog['lessons_id']])->first();
        $schoolClass = SchoolClass::where(['id' => $lessonLog['school_classes_id']])->first();
        // dd($schoolClass);die();

        $students = Student::leftJoin('lesson_logs', function($join) {
            $join->on('students.school_classes_id', '=', 'lesson_logs.school_classes_id');
        })->leftJoin('users', function($join) {
            $join->on('students.users_id', '=', 'users.id');
        })->where(["lesson_logs.id" => $lessonLog['id']])->get();
        $postData = [];
        foreach ($students as $key => $student) {
            // echo($student['users_id']);
            $post = Post::where(['students_users_id' => $student['users_id'], 'lesson_logs_id' => $lessonLog['id']])->first();
            $postRate = PostRate::where(['posts_id' => $post['id']])->first();
            $rate = isset($postRate)?$postRate['rate']:"";
            $comment = Comment::where(['posts_id' => $post['id']])->first();
            $hasComment = isset($comment)?"true":"false";

            $postData[$student['users_id']] = ['post' => $post, 'rate' => $rate, 'hasComment' => $hasComment];
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

        $users_id = \Auth::user()->id;
        $posts_id = $request->get('posts_id');
        $rate = $request->get('rate');
        $postRate = PostRate::where(['teachers_users_id' => $users_id, "posts_id" => $posts_id])->first();
        if (isset($postRate)) {
            $postRate->rate = $rate;
            if ($postRate->update()) {
                return "true";
            } else {
                return "false";
            }
        } else {
            $postRate = new PostRate();
            $postRate->teachers_users_id = $users_id;
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

    public function getLessonPostPerSchoolClass(Request $request)
    {
        $users_id = \Auth::user()->id;
        $lessons_id = $request->get('lessons_id');
        $lessonLogs = LessonLog::leftJoin('school_classes', function($join) {
            $join->on('school_classes.id', '=', 'lesson_logs.school_classes_id');
        })->where(['lessons_id' => $lessons_id, 'teachers_users_id' => $users_id])->orderBy('school_classes.id', 'asc')->selectRaw("lesson_logs.id as lesson_logs_id, school_classes.title as school_class_title")->get();

        $newLessonLogs = [];
        $students = [];
        foreach ($lessonLogs as $key => $lessonLog) {
            $students = Student::leftJoin('lesson_logs', function($join) {
                $join->on('students.school_classes_id', '=', 'lesson_logs.school_classes_id');
            })->leftJoin('users', function($join) {
                $join->on('students.users_id', '=', 'users.id');
            })->where(["lesson_logs.id" => $lessonLog['lesson_logs_id']])->get();
// echo count($students) . "   ----   ";
            $postData = [];
            foreach ($students as $key => $student) {
                // echo($student['users_id']);
                $post = Post::where(['students_users_id' => $student['users_id'], 'lesson_logs_id' => $lessonLog['lesson_logs_id']])->first();
                $postRate = PostRate::where(['posts_id' => $post['id']])->first();
                $rate = isset($postRate)?$postRate['rate']:"";
                $comment = Comment::where(['posts_id' => $post['id']])->first();
                $hasComment = isset($comment)?"true":"false";

                $postData[$student['users_id']] = ['post' => $post, 'rate' => $rate, 'hasComment' => $hasComment];
            }
            $newLessonLogs[] = ['students' => $students, 'postData' => $postData, 'school_class_title' => $lessonLog['school_class_title'], 'lesson_logs_id' => $lessonLog['lesson_logs_id']];

        }
// dd($newLessonLogs);die();
        return $this->lessonHistoryHtmlCreate($newLessonLogs);
        // $post = Post::where(['students_users_id' => $student['users_id'], 'lesson_logs_id' => $lessonLog['id']])->first();
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

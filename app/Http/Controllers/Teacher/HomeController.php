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
use Illuminate\Support\Facades\Validator;
use \Auth;
use \DB;
use \Storage;
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

        $sclass = Sclass::where(['id' => $lessonLog['sclasses_id']])->first();
        // dd($sclass);die();
        $students = DB::table('students')->select('students.id as students_id', 'lesson_logs.id as lesson_logs_id', 'students.*', 'lesson_logs.*')->leftJoin('lesson_logs', 'students.sclasses_id', '=', 'lesson_logs.sclasses_id')->where(["lesson_logs.id" => $lessonLog['id']])->get();
        // dd($students);
        // $students = Student::->select('name', 'email as user_email')
        //     ->leftJoin('lesson_logs', function($join) {
        //     $join->on('students.sclasses_id', '=', 'lesson_logs.sclasses_id');
        // })->where(["lesson_logs.id" => $lessonLog['id']])->get();
        $postData = [];
        foreach ($students as $key => $student) {
            // var_dump($student->students_id);
            $post = Post::where(['students_id' => $student->students_id, 'lesson_logs_id' => $lessonLog['id']])->orderBy('id', 'desc')->first();
            // dd($post);
            $postRate = PostRate::where(['posts_id' => $post['id']])->first();
            $rate = isset($postRate)?$postRate['rate']:"";
            // $rate = "";
            $comment = Comment::where(['posts_id' => $post['id']])->first();
            $hasComment = isset($comment)?"true":"false";

            $postData[$student->students_id] = ['post' => $post, 'rate' => $rate, 'hasComment' => $hasComment];
        }
        // dd($postData);die();
        $py = new pinyinfirstchar();
        return view('teacher/takeclass', compact('sclass', 'lesson', 'students', 'lessonLog', 'postData', 'py'));
    }

    public function updateRate(Request $request)
    {
        $this->validate($request, [
            'posts_id' => 'required',
            'rate' => 'required',
        ]);

        $id = Auth::guard('teacher')->id();
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
        $postRate = PostRate::where(['posts_id' => $request->input('posts_id')])->first();

        if (isset($postRate)) {
            return $postRate['rate'];
        } else {
            return "false";
        }
    }

    public function getPost(Request $request)
    {
        $post = Post::where(['id' => $request->input('posts_id')])->orderBy('id', 'desc')->first();

        if (isset($post)) {
            // $file = Storage::disk('uploads')->get($post->file_path)->getPath();
                // $post->file_path = env('APP_URL')."/posts/".$post->file_path;
        
            return env('APP_URL')."/posts/".$post->file_path;
        } else {
            return "false";
        }
    }

    public function getLessonPostPerSclass(Request $request)
    {
        $id = \Auth::guard("teacher")->id();
        $lessons_id = $request->get('lessons_id');
        $lessonLogs = LessonLog::leftJoin('sclasses', function($join) {
            $join->on('sclasses.id', '=', 'lesson_logs.sclasses_id');
        })->where(['lessons_id' => $lessons_id, 'teachers_id' => $id])->orderBy('sclasses.id', 'asc')->selectRaw("lesson_logs.id as lesson_logs_id, sclasses.class_title as class_title, sclasses.enter_school_year as enter_school_year")->get();
        $newLessonLogs = [];
        $students = [];
        foreach ($lessonLogs as $key => $lessonLog) {
            $students = Student::leftJoin('lesson_logs', function($join) {
                $join->on('students.sclasses_id', '=', 'lesson_logs.sclasses_id');
            })->where(["lesson_logs.id" => $lessonLog['lesson_logs_id']])->selectRaw("*, students.id as students_id")->get();
// dd($students);
            $postData = [];
            foreach ($students as $key => $student) {
                // echo($student->students_id."/");
                $post = Post::where(['students_id' => $student->students_id, 'lesson_logs_id' => $lessonLog['lesson_logs_id']])->first();
                // $postRate = PostRate::where(['posts_id' => $post['id']])->first();
                // $rate = isset($postRate)?$postRate['rate']:"";
                $rate = "";
                $comment = Comment::where(['posts_id' => $post['id']])->first();
                $hasComment = isset($comment)?"true":"false";
                $postData[$student->students_id] = ['post' => $post, 'rate' => $rate, 'hasComment' => $hasComment];
            }
            $newLessonLogs[] = ['students' => $students, 'postData' => $postData, 'class_title' => $lessonLog['class_title'], 'enter_school_year' => $lessonLog['enter_school_year'], 'lesson_logs_id' => $lessonLog['lesson_logs_id']];
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
                $returnHtml .= "<li><a href='#show-class" . $lessonLog["lesson_logs_id"] . "' data-toggle='tab'>" . $lessonLog["enter_school_year"]."级".$lessonLog["class_title"] . "班</a></li>";
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
        // dd($returnHtml);
        return $returnHtml;
    }

    public function getReset()
    {
        return view('teacher.login.reset');
    }

    public function postReset(Request $request)
    {
        $oldpassword = $request->input('oldpassword');
        $password = $request->input('password');
        $data = $request->all();
        $rules = [
            'oldpassword'=>'required|between:6,20',
            'password'=>'required|between:6,20|confirmed',
        ];
        $messages = [
            'required' => '密码不能为空',
            'between' => '密码必须是6~20位之间',
            'confirmed' => '新密码和确认密码不匹配'
        ];
        $validator = Validator::make($data, $rules, $messages);
        $user = Auth::guard('teacher')->user();
        $validator->after(function($validator) use ($oldpassword, $user) {
            if (!\Hash::check($oldpassword, $user->password)) {
                $validator->errors()->add('oldpassword', '原密码错误');
            }
        });
        if ($validator->fails()) {
            return back()->withErrors($validator);  //返回一次性错误
        }
        $user->password = bcrypt($password);
        $user->save();
        Auth::guard('teacher')->logout();
        return redirect('/teacher/login');
    }
}

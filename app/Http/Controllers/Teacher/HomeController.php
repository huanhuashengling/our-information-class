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
use App\Models\Mark;
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
        array_push($classData, "请选择班级");
        foreach ($sclasses as $key => $sclass) {
            // $dateDiff = date_diff($sclass['enter_school_year']."0801", date('y', time()).date('m',time())."01");
            // dd($dateDiff);
            $classData[$sclass['id']] = $sclass['enter_school_year'] . "级" . $sclass['class_title'] . "班";
        }
        $lessons = Lesson::orderBy("lessons.created_at", "DESC")->get();
        $lessonsData = [];
        array_push($lessonsData, "请选择课程");
        $order = 1;
        foreach ($lessons as $key => $lesson) {
            $lessonsData[$lesson['id']] = $order . ". " . $lesson['title'] . "(". $lesson['subtitle'] .")";
            $order++;
        }
        return view('teacher/home', compact('classData', 'lessonsData'));
    }

    public function takeClass()
    {
        $userId = auth()->guard('teacher')->id();
        $lessonLog = LessonLog::select('lesson_logs.id', 'lesson_logs.sclasses_id', 'lessons.title', 'lessons.subtitle', 'sclasses.enter_school_year', 'sclasses.class_title')
        ->leftJoin("lessons", 'lessons.id', '=', 'lesson_logs.lessons_id')
        ->leftJoin("sclasses", 'sclasses.id', '=', 'lesson_logs.sclasses_id')
        ->where(['lesson_logs.teachers_id' => $userId, 'lesson_logs.status' => 'open'])->first();
        // dd($lessonLog);die();

        $students = DB::table('students')->select('students.id', 'students.username', 'posts.storage_name', 'comments.content', 'post_rates.rate', 'posts.id as posts_id', DB::raw("COUNT(`marks`.`id`) as mark_num"))
        ->leftJoin('posts', 'posts.students_id', '=', 'students.id')
        ->leftJoin('post_rates', 'post_rates.posts_id', '=', 'posts.id')
        ->leftJoin('comments', 'comments.posts_id', '=', 'posts.id')
        ->leftJoin('marks', 'marks.posts_id', '=', 'posts.id')
        ->where(["students.sclasses_id" => $lessonLog['sclasses_id'], 'posts.lesson_logs_id' => $lessonLog['id']])
        ->where('students.is_lock', "!=", "1")
        ->groupBy('students.id', 'students.username', 'posts.storage_name', 'comments.content', 'post_rates.rate', 'posts.id')
        ->orderBy(DB::raw('convert(students.username using gbk)'), "ASC")->get();
        // dd($students);
        $unPostStudentName = [];
        
        $postedStudents = [];
        $allStudentsList = DB::table('students')->select('students.username')
        ->where(['students.sclasses_id' => $lessonLog['sclasses_id']])->where('students.is_lock', "!=", "1")->get();
        foreach ($students as $key => $student) {
            array_push($postedStudents, $student->username);
        }
        foreach ($allStudentsList as $key => $studentsName) {
            if (!in_array($studentsName->username, $postedStudents)) {
                array_push($unPostStudentName, $studentsName->username);
            }
        }
        // dd($unPostStudentName);
        $allCount = count($allStudentsList);
        $py = new pinyinfirstchar();
        return view('teacher/takeclass', compact('students', 'lessonLog', 'py', 'allCount', 'unPostStudentName'));
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

    public function getLessonLog(Request $request)
    {   
        $teachersId = Auth::guard('teacher')->id();
        $lessonLog = LessonLog::where(['lessons_id' => $request->input('lessonsId'), 
                                    'sclasses_id' => $request->input('sclassesId'), 
                                    'teachers_id' => $teachersId])->first();

        if (isset($lessonLog)) {
            $postNum = Post::where(['lesson_logs_id' => $lessonLog->id])->count();

            return $postNum;
        } else {
            return "false";
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
        $imgTypes = ['jpg', 'jpeg', 'bmp', 'gif', 'png'];
        $docTypes = ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];
        if (isset($post)) {
            if (in_array($post->file_ext, $imgTypes)) {
                return ["filetype"=>"img", "url" => getThumbnail($post['storage_name'], 800, 600, 'fit')];
            } elseif (in_array($post->file_ext, $docTypes)) {
                return ["filetype"=>"doc", "url" => env('APP_URL')."/posts/".$post->storage_name];
            }
            // $file = Storage::disk('uploads')->get($post->storage_name)->getPath();
                // $post->storage_name = env('APP_URL')."/posts/".$post->storage_name;
            // return getThumbnail($post['storage_name'], 800, 600, 'fit');
        
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
        })->where(['lessons_id' => $lessons_id, 'teachers_id' => $id])->orderBy('sclasses.id', 'asc')->selectRaw("lesson_logs.id as lesson_logs_id, sclasses.class_title, sclasses.enter_school_year")->get();
        $newLessonLogs = [];
        $students = [];
        foreach ($lessonLogs as $key => $lessonLog) {
            $students = Student::leftJoin('lesson_logs', function($join) {
                $join->on('students.sclasses_id', '=', 'lesson_logs.sclasses_id');
            })->where(["lesson_logs.id" => $lessonLog['lesson_logs_id']])->selectRaw("*, students.id as students_id")->get();

            $postData = [];
            foreach ($students as $key => $student) {
                $post = Post::where(['students_id' => $student->students_id, 'lesson_logs_id' => $lessonLog['lesson_logs_id']])->first();
                $postRate = PostRate::where(['posts_id' => $post['id']])->first();
                $rate = isset($postRate)?$postRate['rate']:"";

                $comment = Comment::where(['posts_id' => $post['id']])->first();
                $hasComment = isset($comment)?"true":"false";
                $marksNum = Mark::where(['posts_id' => $post['id']])->count();

                $postData[$student->students_id] = ['post' => $post, 'rate' => $rate, 'hasComment' => $hasComment, 'marksNum' => $marksNum];
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
                $active = (0 == $key)?"in active":"";
                $html = View::make('teacher.partials.studentlist', compact('students', 'py'))->render();
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

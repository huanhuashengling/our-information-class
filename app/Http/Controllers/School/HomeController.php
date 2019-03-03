<?php

namespace App\Http\Controllers\School;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Sclass;
use App\Models\Lesson;
use App\Models\LessonLog;
use App\Models\Post;
use App\Models\Mark;
use App\Models\Term;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use \Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('school/home');
    }

    public function getPostCountPerClassWithSameGradeData1()
    {
        $schools_id = \Auth::guard("school")->id();
        $term = Term::where(['enter_school_year' => 2015, 'is_current' => 1])->first();
        $lessonsData = Lesson::select('lessons.title', 'lessons.id', 'lessons.created_at')
                    ->leftJoin('lesson_logs', function($join) {
                        $join->on('lesson_logs.lessons_id', '=', 'lessons.id');
                    })
                    ->leftJoin('sclasses', function($join) {
                        $join->on('lesson_logs.sclasses_id', '=', 'sclasses.id');
                    }) 
                    ->where('sclasses.enter_school_year', '=', 2015)
                    ->where('sclasses.schools_id', '=', $schools_id)
                    ->whereBetween('lesson_logs.created_at', array($term->from_date, $term->to_date))
                    ->groupBy('lessons.title', 'lessons.id', 'lessons.created_at')
                    ->orderBy('lessons.created_at')
                    ->get();
                    // return json_encode($lessonsData);
        $sclassData = Sclass::select('sclasses.id', 'sclasses.class_title', 'sclasses.enter_school_year')
                    ->where('sclasses.schools_id', '=', $schools_id)
                    ->where('sclasses.enter_school_year', '=', 2015)
                    ->get();

        $postsData = [];
        foreach ($sclassData as $key => $sclass) {
            $tPostData=[];
            foreach ($lessonsData as $key => $lesson) {
                $tPostData[] = Post::select(DB::raw('count(posts.id) as count'))
                    ->leftJoin('lesson_logs', function($join) {
                        $join->on('posts.lesson_logs_id', '=', 'lesson_logs.id');
                    })
                    ->leftJoin('students', function($join) {
                        $join->on('posts.students_id', '=', 'students.id');
                    })
                    ->leftJoin('sclasses', function($join) {
                        $join->on('students.sclasses_id', '=', 'sclasses.id');
                    })
                    ->where('sclasses.schools_id', '=', $schools_id)
                    ->where('lesson_logs.lessons_id', '=', $lesson->id)
                    ->where('students.sclasses_id', '=', $sclass->id)
                    ->where('students.is_lock', "!=", "1")
                    ->get();
            }
            $postsData[] = ['label' => $sclass->enter_school_year . "级" .$sclass->class_title . "班", 'data' => $tPostData];
        }

        $dataset = ["lessonsData" => $lessonsData, 'postsData' => $postsData];
        return json_encode($dataset);
    }

    public function getPostCountPerClassWithSameGradeData2()
    {
        $schools_id = \Auth::guard("school")->id();
        $term = Term::where(['enter_school_year' => 2014, 'is_current' => 1])->first();

        $lessonsData = Lesson::select('lessons.title', 'lessons.id', 'lessons.created_at')
                    ->leftJoin('lesson_logs', function($join) {
                        $join->on('lesson_logs.lessons_id', '=', 'lessons.id');
                    })
                    ->leftJoin('sclasses', function($join) {
                        $join->on('lesson_logs.sclasses_id', '=', 'sclasses.id');
                    })
                    ->where('sclasses.enter_school_year', '=', 2014)
                    ->whereBetween('lesson_logs.created_at', array($term->from_date, $term->to_date))
                    ->where('sclasses.schools_id', '=', $schools_id)
                    // ->whereDate('lessons.created_at', '>', '2018-2-30')
                    ->groupBy('lessons.title', 'lessons.id', 'lessons.created_at')
                    ->orderBy('lessons.created_at')
                    ->get();

        $sclassData = Sclass::select('sclasses.id', 'sclasses.class_title', 'sclasses.enter_school_year')
                    ->where('sclasses.enter_school_year', '=', 2014)
                    ->where('sclasses.schools_id', '=', $schools_id)
                    ->get();

        $postsData = [];
        foreach ($sclassData as $key => $sclass) {
            $tPostData=[];
            foreach ($lessonsData as $key => $lesson) {
                $tPostData[] = Post::select(DB::raw('count(posts.id) as count'))
                    ->leftJoin('lesson_logs', function($join) {
                        $join->on('posts.lesson_logs_id', '=', 'lesson_logs.id');
                    })
                    ->leftJoin('students', function($join) {
                        $join->on('posts.students_id', '=', 'students.id');
                    })
                    ->leftJoin('sclasses', function($join) {
                        $join->on('students.sclasses_id', '=', 'sclasses.id');
                    })
                    ->where('sclasses.schools_id', '=', $schools_id)
                    ->where('lesson_logs.lessons_id', '=', $lesson->id)
                    ->where('students.sclasses_id', '=', $sclass->id)
                    ->where('students.is_lock', "!=", "1")
                    ->get();
            }
            $postsData[] = ['label' => $sclass->enter_school_year . "级" .$sclass->class_title . "班", 'data' => $tPostData];
        }

        $dataset = ["lessonsData" => $lessonsData, 'postsData' => $postsData];
        return json_encode($dataset);
    }

    public function getMarkCountPerClassWithSameGradeData1()
    {
        $schools_id = \Auth::guard("school")->id();
        $term = Term::where(['enter_school_year' => 2015, 'is_current' => 1])->first();
        $lessonsData = Lesson::select('lessons.title', 'lessons.id', 'lessons.created_at')
                    ->leftJoin('lesson_logs', function($join) {
                        $join->on('lesson_logs.lessons_id', '=', 'lessons.id');
                    })
                    ->leftJoin('sclasses', function($join) {
                        $join->on('lesson_logs.sclasses_id', '=', 'sclasses.id');
                    }) 
                    ->where('sclasses.schools_id', '=', $schools_id)
                    ->where('sclasses.enter_school_year', '=', 2015)
                    ->whereBetween('lesson_logs.created_at', array($term->from_date, $term->to_date))
                    // ->whereDate('lessons.created_at', '>', '2018-2-30')
                    ->groupBy('lessons.title', 'lessons.id', 'lessons.created_at')
                    ->orderBy('lessons.created_at')
                    ->get();

        $sclassData = Sclass::select('sclasses.id', 'sclasses.class_title', 'sclasses.enter_school_year')
                    ->where('sclasses.enter_school_year', '=', 2015)
                    ->where('sclasses.schools_id', '=', $schools_id)
                    ->get();

        $marksData = [];
        foreach ($sclassData as $key => $sclass) {
            $tMarkData=[];
            foreach ($lessonsData as $key => $lesson) {
                $tMarkData[] = Mark::select(DB::raw('count(marks.id) as count'))
                    ->leftJoin('posts', function($join) {
                        $join->on('marks.posts_id', '=', 'posts.id');
                    })
                    ->leftJoin('lesson_logs', function($join) {
                        $join->on('posts.lesson_logs_id', '=', 'lesson_logs.id');
                    })
                    ->leftJoin('students', function($join) {
                        $join->on('posts.students_id', '=', 'students.id');
                    })
                    ->leftJoin('sclasses', function($join) {
                        $join->on('students.sclasses_id', '=', 'sclasses.id');
                    })
                    ->where('sclasses.schools_id', '=', $schools_id)
                    ->where('lesson_logs.lessons_id', '=', $lesson->id)
                    ->where('marks.state_code', '=', 1)
                    ->where('students.sclasses_id', '=', $sclass->id)
                    ->where('students.is_lock', "!=", "1")
                    ->get();
            }
            $marksData[] = ['label' => $sclass->enter_school_year . "级" .$sclass->class_title . "班", 'data' => $tMarkData];
        }

        $dataset = ["lessonsData" => $lessonsData, 'marksData' => $marksData];
        return json_encode($dataset);
    }

    public function getMarkCountPerClassWithSameGradeData2()
    {
        $schools_id = \Auth::guard("school")->id();
        $term = Term::where(['enter_school_year' => 2014, 'is_current' => 1])->first();
        $lessonsData = Lesson::select('lessons.title', 'lessons.id')
                    ->leftJoin('lesson_logs', function($join) {
                        $join->on('lesson_logs.lessons_id', '=', 'lessons.id');
                    })
                    ->leftJoin('sclasses', function($join) {
                        $join->on('lesson_logs.sclasses_id', '=', 'sclasses.id');
                    })
                    ->where('sclasses.schools_id', '=', $schools_id)
                    ->where('sclasses.enter_school_year', '=', 2014)
                    ->whereBetween('lessons.created_at', array($term->from_date, $term->to_date))
                    // ->whereDate('lessons.created_at', '>', '2018-2-30')
                    ->groupBy('lessons.title', 'lessons.id')
                    ->orderBy('lessons.created_at')
                    ->get();

        $sclassData = Sclass::select('sclasses.id', 'sclasses.class_title', 'sclasses.enter_school_year')
                    ->where('sclasses.enter_school_year', '=', 2014)
                    ->where('sclasses.schools_id', '=', $schools_id)
                    ->get();

        $marksData = [];
        foreach ($sclassData as $key => $sclass) {
            $tMarkData=[];
            foreach ($lessonsData as $key => $lesson) {
                $tMarkData[] = Mark::select(DB::raw('count(marks.id) as count'))
                    ->leftJoin('posts', function($join) {
                        $join->on('marks.posts_id', '=', 'posts.id');
                    })
                    ->leftJoin('lesson_logs', function($join) {
                        $join->on('posts.lesson_logs_id', '=', 'lesson_logs.id');
                    })
                    ->leftJoin('students', function($join) {
                        $join->on('posts.students_id', '=', 'students.id');
                    })
                    ->leftJoin('sclasses', function($join) {
                        $join->on('students.sclasses_id', '=', 'sclasses.id');
                    })
                    ->where('sclasses.schools_id', '=', $schools_id)
                    ->where('lesson_logs.lessons_id', '=', $lesson->id)
                    ->where('marks.state_code', '=', 1)
                    ->where('students.sclasses_id', '=', $sclass->id)
                    ->where('students.is_lock', "!=", "1")
                    ->get();
            }
            $marksData[] = ['label' => $sclass->enter_school_year . "级" .$sclass->class_title . "班", 'data' => $tMarkData];
        }

        $dataset = ["lessonsData" => $lessonsData, 'marksData' => $marksData];
        return json_encode($dataset);
    }

    public function getReset()
    {
        return view('school.login.reset');
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
        $user = Auth::guard("school")->user();
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
        Auth::guard("school")->logout();  //更改完这次密码后，退出这个用户
        return redirect('/school/login');
    }
}

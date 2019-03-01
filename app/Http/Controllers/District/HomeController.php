<?php

namespace App\Http\Controllers\District;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Sclass;
use App\Models\Lesson;
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
        return view('district/school/index');
    }

    public function getPostCountPerClassWithSameGradeData1()
    {
        $term = Term::where(['enter_school_year' => 2015, 'is_current' => 1])->first();
        $lessonsData = Lesson::select('lessons.title', 'lessons.id')
                    ->leftJoin('lesson_logs', function($join) {
                        $join->on('lesson_logs.lessons_id', '=', 'lessons.id');
                    })
                    ->leftJoin('posts', function($join) {
                        $join->on('posts.lesson_logs_id', '=', 'lesson_logs.id');
                    })
                    ->leftJoin('students', function($join) {
                        $join->on('posts.students_id', '=', 'students.id');
                    })
                    ->leftJoin('sclasses', function($join) {
                        $join->on('students.sclasses_id', '=', 'sclasses.id');
                    }) 
                    ->where('sclasses.enter_school_year', '=', 2015)
                    ->whereBetween('lessons.created_at', array($term->from_date, $term->to_date))
                    // ->whereDate('lessons.created_at', '>', '2018-2-30')
                    ->groupBy('lessons.title', 'lessons.id')
                    ->orderBy('lessons.created_at')
                    ->get();

        $sclassData = Sclass::select('sclasses.id', 'sclasses.class_title', 'sclasses.enter_school_year')
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
        $term = Term::where(['enter_school_year' => 2014, 'is_current' => 1])->first();

        $lessonsData = Lesson::select('lessons.title', 'lessons.id')
                    ->leftJoin('lesson_logs', function($join) {
                        $join->on('lesson_logs.lessons_id', '=', 'lessons.id');
                    })
                    ->leftJoin('posts', function($join) {
                        $join->on('posts.lesson_logs_id', '=', 'lesson_logs.id');
                    })
                    ->leftJoin('students', function($join) {
                        $join->on('posts.students_id', '=', 'students.id');
                    })
                    ->leftJoin('sclasses', function($join) {
                        $join->on('students.sclasses_id', '=', 'sclasses.id');
                    })
                    ->where('sclasses.enter_school_year', '=', 2014)
                    ->whereBetween('lessons.created_at', array($term->from_date, $term->to_date))

                    // ->whereDate('lessons.created_at', '>', '2018-2-30')
                    ->groupBy('lessons.title', 'lessons.id')
                    ->orderBy('lessons.created_at')
                    ->get();

        $sclassData = Sclass::select('sclasses.id', 'sclasses.class_title', 'sclasses.enter_school_year')
                    ->where('sclasses.enter_school_year', '=', 2014)
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
        $term = Term::where(['enter_school_year' => 2015, 'is_current' => 1])->first();
        $lessonsData = Lesson::select('lessons.title', 'lessons.id')
                    ->leftJoin('lesson_logs', function($join) {
                        $join->on('lesson_logs.lessons_id', '=', 'lessons.id');
                    })
                    ->leftJoin('posts', function($join) {
                        $join->on('posts.lesson_logs_id', '=', 'lesson_logs.id');
                    })
                    ->leftJoin('students', function($join) {
                        $join->on('posts.students_id', '=', 'students.id');
                    })
                    ->leftJoin('sclasses', function($join) {
                        $join->on('students.sclasses_id', '=', 'sclasses.id');
                    }) 
                    ->where('sclasses.enter_school_year', '=', 2015)
                    ->where('students.is_lock', "!=", "1")
                    ->whereBetween('lessons.created_at', array($term->from_date, $term->to_date))
                    // ->whereDate('lessons.created_at', '>', '2018-2-30')
                    ->groupBy('lessons.title', 'lessons.id')
                    ->orderBy('lessons.created_at')
                    ->get();

        $sclassData = Sclass::select('sclasses.id', 'sclasses.class_title', 'sclasses.enter_school_year')
                    ->where('sclasses.enter_school_year', '=', 2015)
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
        $term = Term::where(['enter_school_year' => 2014, 'is_current' => 1])->first();
        $lessonsData = Lesson::select('lessons.title', 'lessons.id')
                    ->leftJoin('lesson_logs', function($join) {
                        $join->on('lesson_logs.lessons_id', '=', 'lessons.id');
                    })
                    ->leftJoin('posts', function($join) {
                        $join->on('posts.lesson_logs_id', '=', 'lesson_logs.id');
                    })
                    ->leftJoin('students', function($join) {
                        $join->on('posts.students_id', '=', 'students.id');
                    })
                    ->leftJoin('sclasses', function($join) {
                        $join->on('students.sclasses_id', '=', 'sclasses.id');
                    })
                    ->where('sclasses.enter_school_year', '=', 2014)
                    ->whereBetween('lessons.created_at', array($term->from_date, $term->to_date))
                    // ->whereDate('lessons.created_at', '>', '2018-2-30')
                    ->groupBy('lessons.title', 'lessons.id')
                    ->orderBy('lessons.created_at')
                    ->get();

        $sclassData = Sclass::select('sclasses.id', 'sclasses.class_title', 'sclasses.enter_school_year')
                    ->where('sclasses.enter_school_year', '=', 2014)
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

    public function studentsAccountManagement()
    {
        $sclassesData = Sclass::select('sclasses.class_title', 'sclasses.enter_school_year', 'sclasses.id', DB::raw('count(students.id) as count'))
                              ->leftJoin('students', function($join) {
                                  $join->on('students.sclasses_id', '=', 'sclasses.id');
                              })
                              ->where('sclasses.is_graduated', '=', 0)
                              ->groupBy('sclasses.class_title', 'sclasses.enter_school_year', 'sclasses.id')
                              ->orderBy('sclasses.id')
                              ->get();
        foreach ($sclassesData as $key => $item) {
            $sclassesData[$key]["title"] = $item['enter_school_year'] . "级" . $item["class_title"] . "班";
        }
        // dd($sclassesData);

        return view('admin/studentsAccountManagement', compact('sclassesData'));
    }

    public function importStudents(Request $request)
    {
        if($request->hasFile('xls')){
            $path = $request->file('xls')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            if(!empty($data) && $data->count()){

                foreach ($data->toArray() as $value) {
                    // dd($value);

                    if(!empty($value)){
                        $this->createStudentAccount($value);
                        // die();
                    }
                }
            }
        }
    }

    public function updateStudentEmail(Request $request)
    {
        if($request->hasFile('xls')){
            $path = $request->file('xls')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            if(!empty($data) && $data->count()){

                foreach ($data->toArray() as $value) {
                    // dd($value);

                    if(!empty($value)){
                        $this->updateOneStudentEmail($value);
                        // die();
                    }
                }
            }
        }
    }

    public function getStudentsData(Request $request) {
        $sclass = Sclass::find($request->get('sclasses_id'));
        if (isset($sclass)) {
            $students = Student::select('students.id as studentsId', 'students.*', 'sclasses.*')
            ->leftJoin('sclasses', function($join){
              $join->on('sclasses.id', '=', 'students.sclasses_id');
            })
            ->where(['sclasses_id' => $sclass->id])->get();
            return json_encode($students);
        } else {
            return "false";
        }
    }

    public function resetStudentPassword(Request $request) {
        $student = Student::find($request->get('users_id'));
        if ($student) {
            $student->password = bcrypt("123456");
            $student->save();
            return "true";
        } else {
            return "false";
        }
    }

    public function lockOneStudentAccount(Request $request) {
        $student = Student::find($request->get('users_id'));
        if ($student) {
            $student->is_lock = 1;
            $student->save();
            return "true";
        } else {
            return "false";
        }
    }

    public function unlockOneStudentAccount(Request $request) {
        $student = Student::find($request->get('users_id'));
        if ($student) {
            $student->is_lock = 0;
            $student->save();
            return "true";
        } else {
            return "false";
        }
    }

    public function createOneStudent(Request $request)
    {
        $data = [];
        $data["username"] = $request->get('username');
        $data["gender"] = $request->get('gender');
        $data["password"] = $request->get('password');
        $data["groups_id"] = $request->get('groups_id');
        $data["sclasses_id"] = $request->get('sclasses_id');
        return $this->createStudentAccount($data);
    }

    public function createStudentAccount($data) {
        try {
            $student = Student::create([
                'username' => $data['username'],
                'email' => "",
                'password' => bcrypt($data['password']),
                'gender' => $data['gender'],
                'level' => 0,
                'score' => 0,
                'groups_id' => $data['groups_id'],
                'sclasses_id' => $data['sclasses_id'],
                'is_lock' => 0,
                'remember_token' => str_random(10),
            ]);
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function updateOneStudentEmail($data) {
        try {
            $student = Student::find($data["id"]);
            $student->email = $data["email"];
            $student->save();
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function getReset()
    {
        return view('admin.login.reset');
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
        $user = Auth::guard("admin")->user();
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
        Auth::guard("admin")->logout();  //更改完这次密码后，退出这个用户
        return redirect('/admin/login');
    }
}

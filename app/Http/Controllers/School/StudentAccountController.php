<?php

namespace App\Http\Controllers\School;

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

class StudentAccountController extends Controller
{
    public function index()
    {
        $schoolsId = \Auth::guard("school")->id();
        $sclassesData = Sclass::select('sclasses.class_title', 'sclasses.enter_school_year', 'sclasses.id', DB::raw('count(students.id) as count'))
                              ->leftJoin('students', function($join) {
                                  $join->on('students.sclasses_id', '=', 'sclasses.id');
                              })
                              ->leftJoin('schools', function($join) {
                                  $join->on('schools.id', '=', 'sclasses.schools_id');
                              })
                              ->where('sclasses.is_graduated', '=', 0)
                              ->where('schools.id', '=', $schoolsId)
                              ->groupBy('sclasses.class_title', 'sclasses.enter_school_year', 'sclasses.id')
                              ->orderBy('sclasses.id')
                              ->get();
        foreach ($sclassesData as $key => $item) {
            $sclassesData[$key]["title"] = $item['enter_school_year'] . "级" . $item["class_title"] . "班";
        }
        // dd($sclassesData);

        return view('school/student-account/index', compact('sclassesData'));
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
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\SchoolClass;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin/home');
    }

    public function studentsAccountManagement()
    {
        $schoolClassesData = SchoolClass::select('school_classes.title', DB::raw('count(students.users_id) as count'))
                              ->leftJoin('students', function($join) {
                                  $join->on('students.school_classes_id', '=', 'school_classes.id');
                              })
                              ->where('school_classes.grade_num', '>', 2)
                              ->groupBy('school_classes.title')
                              ->get();
                              // dd($schoolClassesData);
                              // die();
        return view('admin/studentsAccountManagement', compact('schoolClassesData'));
    }

    public function importStudents(Request $request)
    {
        if($request->hasFile('xls')){
            $path = $request->file('xls')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            if(!empty($data) && $data->count()){

                foreach ($data->toArray() as $value) {
                    // var_dump($value);

                    if(!empty($value)){
                        $this->createStudentAccount($value);
                        // die();
                    }
                }
            }
        }
    }

    public function getStudentsData(Request $request) {
        $schoolClass = SchoolClass::where(['title' => $request->get('school_classes_title')])->first();
        if (isset($schoolClass)) {
            $students = Student::leftJoin('users', function($join){
              $join->on('students.users_id', '=', 'users.id');
            })
            ->leftJoin('school_classes', function($join){
              $join->on('school_classes.id', '=', 'students.school_classes_id');
            })
            ->where(['school_classes_id' => $schoolClass->id])->get();
            return json_encode($students);
        } else {
            return "false";
        }
    }

    public function createStudentAccount($data) {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'roles_id' => $data['roles_id'],
        ]);
        if ($user) {
            $student = Student::create([
                'users_id' => $user->id,
                'gender' => $data['gender'],
                'school_classes_id' => $data['school_classes_id'],
                'level' => $data['level'],
                'score' => $data['score'],
            ]);
        }
    }
}

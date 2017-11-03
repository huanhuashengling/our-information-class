<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Sclass;
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
        $sclassesData = Sclass::select('sclasses.class_title', DB::raw('count(students.id) as count'))
                              ->leftJoin('students', function($join) {
                                  $join->on('students.sclasses_id', '=', 'sclasses.id');
                              })
                              ->where('sclasses.enter_school_year', '>', 2015)
                              ->groupBy('sclasses.class_title')
                              ->get();
                              // dd($sclassesData);
                              // die();
        return view('admin/studentsAccountManagement', compact('sclassesData'));
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
        $sclass = Sclass::where(['title' => $request->get('class_title')])->first();
        if (isset($sclass)) {
            $students = Student::leftJoin('sclasses', function($join){
              $join->on('sclasses.id', '=', 'students.sclasses_id');
            })
            ->where(['sclasses_id' => $sclass->id])->get();
            return json_encode($students);
        } else {
            return "false";
        }
    }

    public function resetStudentPassword(Request $request) {
        $student = Student::find($request->get('id'));
        if ($student) {
            $student->password = bcrypt("123456");
            $student->save();
            return "true";
        } else {
            return "false";
        }
    }

    public function createStudentAccount($data) {
        $student = Student::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        if ($student) {
            $student = Student::create([
                'is' => $student->id,
                'gender' => $data['gender'],
                'sclasses_id' => $data['sclasses_id'],
                'level' => $data['level'],
                'score' => $data['score'],
            ]);
        }
    }
}

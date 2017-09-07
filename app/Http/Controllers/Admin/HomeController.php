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

class HomeController extends Controller
{
    public function index()
    {
        return view('admin/home');
    }

    public function studentsAccountManagement()
    {
        $schoolClasses = SchoolClass::where('grade_num', '>', 2)->pluck('title', 'id');
        return view('admin/studentsAccountManagement', compact('schoolClasses'));
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

      //   $file = $request->file('xls');
   
      // //Display File Name
      // echo 'File Name: '.$file->getClientOriginalName();
      // echo '<br>';
   
      // //Display File Extension
      // echo 'File Extension: '.$file->getClientOriginalExtension();
      // echo '<br>';
   
      // //Display File Real Path
      // echo 'File Real Path: '.$file->getRealPath();
      // echo '<br>';
   
      // //Display File Size
      // echo 'File Size: '.$file->getSize();
      // echo '<br>';
   
      // //Display File Mime Type
      // echo 'File Mime Type: '.$file->getMimeType();
    }

    function createStudentAccount($data) {
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

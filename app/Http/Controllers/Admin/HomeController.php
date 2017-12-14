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
use \Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin/home');
    }

    public function studentsAccountManagement()
    {
        $sclassesData = Sclass::select('sclasses.class_title', 'sclasses.enter_school_year', 'sclasses.id', DB::raw('count(students.id) as count'))
                              ->leftJoin('students', function($join) {
                                  $join->on('students.sclasses_id', '=', 'sclasses.id');
                              })
                              ->where('sclasses.enter_school_year', '<', 2016)
                              ->groupBy('sclasses.class_title', 'sclasses.enter_school_year', 'sclasses.id')
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
                    dd($value);

                    if(!empty($value)){
                        $this->createStudentAccount($value);
                        // die();
                    }
                }
            }
        }
    }

    public function getStudentsData(Request $request) {
        $sclass = Sclass::find($request->get('sclasses_id'));
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
            'gender' => $data['gender'],
            'level' => $data['level'],
            'score' => $data['score'],
            'groups_id' => $data['groups_id'],
            'sclasses_id' => $data['sclasses_id'],
        ]);
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

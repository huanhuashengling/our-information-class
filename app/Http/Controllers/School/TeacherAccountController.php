<?php

namespace App\Http\Controllers\School;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Teacher;


class TeacherAccountController extends Controller
{
    public function index()
    {
        $schoolsData = School::get();
        return view('school/teacher-account/index', compact('schoolsData'));
    }

    public function getTeachersAccountData(Request $request)
    {
        $school = School::find($request->get('schools_id'));
        if (isset($school)) {
            $teachers = Teacher::select('schools.*', 'teachers.*')
                        ->leftJoin('schools', function($join){
                          $join->on('schools.id', '=', 'teachers.schools_id');
                        })
                        ->where(['schools_id' => $school->id])->get();
            return json_encode($teachers);
        } else {
            return "false";
        }
    }

    public function createOneTeacherAccount(Request $request)
    {
        try {
            $teacher = Teacher::create([
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'schools_id' => $request->get('schools_id'),
                'remember_token' => str_random(10),
            ]);
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
    }
}

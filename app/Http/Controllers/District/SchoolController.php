<?php

namespace App\Http\Controllers\District;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Teacher;
use App\Models\District;


class SchoolController extends Controller
{
    public function index()
    {
        $schoolsData = School::get();
        return view('district/school/index', compact('schoolsData'));
    }

    public function getSchoolsData()
    {
        $userId = auth()->guard('district')->id();
        $district = District::find($userId);
        if (isset($district)) {
            $schools = School::select('schools.*', 'districts.title as district_title')
                        ->leftJoin('districts', function($join){
                          $join->on('districts.id', '=', 'schools.districts_id');
                        })
                        ->where(['districts.id' => $district->id])->get();
            return json_encode($schools);
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

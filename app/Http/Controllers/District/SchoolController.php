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

    public function createOneSchool(Request $request)
    {
        $districtsId = \Auth::guard("district")->id();
        try {
            $school = School::create([
                'username' => $request->get('username'),
                'title' => $request->get('title'),
                'display_name' => $request->get('display_name'),
                'code' => $request->get('school_code'),
                'description' => "",
                'password' => bcrypt("123456"),
                'districts_id' => $districtsId,
                'remember_token' => str_random(10),
            ]);
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
    }
}

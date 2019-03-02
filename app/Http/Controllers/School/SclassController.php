<?php

namespace App\Http\Controllers\School;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sclass;
use App\Models\Term;

class SclassController extends Controller
{
    public function index()
    {
        $schoolsId = \Auth::guard("school")->id();
        return view('school/sclass/index', compact("schoolsId"));
    }

    public function getSclassesData()
    {
        $schoolsId = \Auth::guard("school")->id();
        $sclasses = Sclass::where(['sclasses.schools_id' => $schoolsId])->get();
        return json_encode($sclasses);
    }

    public function getTermsData()
    {
        $schoolsId = \Auth::guard("school")->id();
        $terms = Term::get();
        return json_encode($terms);
    }

    public function createOneSclass(Request $request)
    {
        try {
            $sclass = Sclass::create([
                'enter_school_year' => $request->get('enter_school_year'),
                'class_num' => $request->get('class_num'),
                'class_title' => $request->get('class_title'),
                'is_graduated' => $request->get('is_graduated'),
                'schools_id' => $request->get('schools_id'),
            ]);
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
    }
}

<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Unit;
use App\Models\Course;

use \Auth;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $cId = $request->get('cId');
        // $cId = Route::current()->getParameter('id');
        $course = Course::find($cId);
        return view('teacher/unit/index', compact("cId", 'course'));
    }

    public function show(Request $request)
    {
        $cId = $request->get('cId');
        // $cId = Route::current()->getParameter('id');
        $course = Course::find($cId);
        return view('teacher/unit/index', compact("cId", 'course'));
    }

    public function getUnitList(Request $request)
    {
        $coursesId = $request->get('coursesId');
        // $coursesId = Route::current()->getParameter('id');

        $units = Unit::select("units.*", "teachers.username", "courses.title as course_title")
        ->join("teachers", "teachers.id", "=", "units.teachers_id")
        ->join("courses", "courses.id", "=", "units.courses_id")
        ->where("units.courses_id", "=", $coursesId)
        ->get();
        return $units;
    }

    public function create()
    {
        return view('teacher/unit/create')->withCourses(Course::get()->pluck('title', 'id'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:units|max:255',
            'description' => 'required',
            'courses_id' => 'required',
        ]);

        $unit = new Unit;
        $unit->title = $request->get('title');
        $unit->description = $request->get('description');
        $unit->courses_id = $request->get('courses_id');
        $unit->teachers_id = Auth::guard('teacher')->id();

        if ($unit->save()) {
            return redirect('teacher/unit?cId=' . $request->get('courses_id'));
        } else {
            return redirect()->back()->withInput()->withErrors('新建失败！');
        }
    }

    public function edit(Request $request, $id)
    {
        // dd(Unit::with("courses")->find($id)->withCourses(Course::get()->pluck('title', 'id')));
        $unit = Unit::with("courses")->find($id);
        $courses = Course::get()->pluck('title', 'id');
        return view('teacher/unit/edit', compact('unit', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:units,title,'.$id.'|max:255',
            'description' => 'required',
            'courses_id' => 'required',
        ]);
        $unit = Unit::find($id);
        $unit->title = $request->get('title');
        $unit->description = $request->get('description');
        $unit->courses_id = $request->get('courses_id');
        $unit->teachers_id = Auth::guard('teacher')->id();

        if ($unit->save()) {
            return redirect('teacher/unit?cId=' . $request->get('courses_id'));
        } else {
            return redirect()->back()->withInput()->withErrors('修改失败！');
        }
    }

    public function openUnit(Request $request)
    {
        $unit = Unit::find($request->get('units_id'));
        $unit->is_open = 1;

        if ($unit->save()) {
            return "true";
        } else {
            return "false";
        }
    }

    public function closeUnit(Request $request)
    {
        $unit = Unit::find($request->get('units_id'));
        $unit->is_open = 2;

        if ($unit->save()) {
            return "true";
        } else {
            return "false";
        }
    }

    public function destroy($id)
    {
        Unit::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function getUnitListByCoursesId(Request $request)
    {
        $coursesId = $request->get('coursesId');
        $units = Unit::where(['courses_id' => $coursesId])->get();
        if(0 == count($units))
        {
            return "<option>请现在当前课程下创建相应单元</option>";
        }
        return $this->buildUnitListHtml($units);
    }

    public function buildUnitListHtml($units)
    {
        $returnHtml = "";
        foreach ($units as $key => $unit) {
            $returnHtml .= "<option value = '" . $unit->id . "'>" . $unit->title . "</option>";
        }
        return $returnHtml;
    }
}

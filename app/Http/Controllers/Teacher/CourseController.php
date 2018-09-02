<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Course;

use \Auth;

class CourseController extends Controller
{
    public function index()
    {
        // dd(Course::find(1)->teacher());
        return view('teacher/course/index')->withCourses(Course::all());
    }

    public function getCourseList()
    {
        $courses = Course::get();
        return $courses;
    }

    public function create()
    {
        return view('teacher/course/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:courses|max:255',
            'description' => 'required',
        ]);

        $course = new Course;
        $course->title = $request->get('title');
        $course->description = $request->get('description');
        $course->teachers_id = Auth::guard('teacher')->id();;

        if ($course->save()) {
            return redirect('teacher/course');
        } else {
            return redirect()->back()->withInput()->withErrors('新建失败！');
        }
    }

    public function edit(Request $request, $id)
    {
        return view('teacher/course/edit')->withCourse(Course::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:courses,title,'.$id.'|max:255',
            'description' => 'required',
        ]);
        $course = Course::find($id);
        $course->title = $request->get('title');
        $course->description = $request->get('description');

        if ($course->save()) {
            return redirect('teacher/course');
        } else {
            return redirect()->back()->withInput()->withErrors('修改失败！');
        }
    }

    public function destroy($id)
    {
        Course::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }
}

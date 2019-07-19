<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Lesson;
use App\Models\Course;
use App\Models\Unit;
use \Auth;
use \DB;
use EndaEditor;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $uId = $request->get('uId');
        // $uId = Route::current()->getParameter('id');
        $unit = Unit::find($uId);
        $unit->course = Course::find($unit->courses_id);
        // dd($unit);
        return view('teacher/lesson/index', compact("uId", "unit"));
    }

    public function create()
    {
        return view('teacher/lesson/create')->withCourses(Course::get()->pluck('title', 'id'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:lessons|max:255',
            'subtitle' => 'required',
            'courses_id' => 'required',
            'units_id' => 'required',
        ]);

        $lesson = new Lesson;
        $lesson->units_id = $request->get('units_id');
        $lesson->courses_id = $request->get('courses_id');
        $lesson->title = $request->get('title');
        $lesson->subtitle = $request->get('subtitle');
        $lesson->help_md_doc = $request->get('content');
        $lesson->teachers_id = Auth::guard('teacher')->id();;

        if ($lesson->save()) {
            return redirect('teacher/lesson');
        } else {
            return redirect()->back()->withInput()->withErrors('新建失败！');
        }
    }

    public function edit(Request $request, $id)
    {
        $lesson = Lesson::with("units")->find($id);
        $courses = Course::get()->pluck('title', 'id');
        $units = Unit::where(['courses_id' => $lesson->courses_id])->get()->pluck('title', 'id');
        // dd($lesson);
        return view('teacher/lesson/edit', compact("lesson", "courses", "units"));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:lessons,title,'.$id.'|max:255',
            'subtitle' => 'required',
            'courses_id' => 'required',
            'units_id' => 'required',
        ]);
        $lesson = Lesson::find($id);
        $lesson->units_id = $request->get('units_id');
        $lesson->courses_id = $request->get('courses_id');
        $lesson->title = $request->get('title');
        $lesson->subtitle = $request->get('subtitle');
        $lesson->help_md_doc = $request->get('content');

        if ($lesson->save()) {
            return redirect('teacher/lesson');
        } else {
            return redirect()->back()->withInput()->withErrors('修改失败！');
        }
    }

    public function destroy($id)
    {
        Lesson::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function deleteLesson(Request $request)
    {
        if (Lesson::find($request->get('lessonsId'))->delete()) {
            return "true";
        } else {
            return "false";
        }
    }

    public function uploadMDImage()
    {
        $data = EndaEditor::uploadImgFile('uploads/md');

        return json_encode($data);
    }

    public function ajaxSearchTopics()
    {
        $lessons = Lesson::all();
        $helpMDDoc = [];
        foreach ($lessons as $key => $lesson) {
            $helpMDDoc[$lesson->subtitle] = $lesson->help_md_doc;
        }
        return $helpMDDoc;
    }

    public function getLesson(Request $request)
    {
        $lessonsId = $request->get('lessonsId');
        $lesson = Lesson::find($lessonsId);
        $lesson->help_md_doc = EndaEditor::MarkDecode($lesson->help_md_doc);
        return $lesson;
    }

    public function getLessonList(Request $request)
    {
        $unitsId = $request->get('unitsId');

        $lessons = Lesson::select('lessons.id', 'lessons.title', 'lessons.is_open', 'lessons.subtitle', 'lessons.updated_at', 'teachers.username', 'units.title as unit_title', 'courses.title as course_title', DB::raw("COUNT(`lesson_logs`.`id`) as lesson_log_num"))
            ->join("teachers", "teachers.id", "=", "lessons.teachers_id")
            ->leftJoin("lesson_logs", "lesson_logs.lessons_id", "=", "lessons.id")
            ->join("units", "units.id", "=", "lessons.units_id")
            ->join("courses", "courses.id", "=", "units.courses_id")
            ->groupBy('lessons.id', 'lessons.title', 'lessons.subtitle', 'lessons.updated_at', 'teachers.username', 'unit_title', 'course_title')
            ->where("lessons.units_id", "=", $unitsId)
            ->orderBy('lessons.updated_at', 'DESC')
            ->get();
        return $lessons;
    }

    public function openLesson(Request $request)
    {
        $lesson = Lesson::find($request->get('lessons_id'));
        $lesson->is_open = 1;

        if ($lesson->save()) {
            return "true";
        } else {
            return "false";
        }
    }

    public function closeLesson(Request $request)
    {
        $lesson = Lesson::find($request->get('lessons_id'));
        $lesson->is_open = 2;

        if ($lesson->save()) {
            return "true";
        } else {
            return "false";
        }
    }
}

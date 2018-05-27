<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Lesson;
use \Auth;
use \DB;
use EndaEditor;

class LessonController extends Controller
{
    public function index()
    {
        // dd(Lesson::find(1)->teacher());
        return view('teacher/lesson/index')->withLessons(Lesson::all());
    }

    public function create()
    {
        return view('teacher/lesson/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:lessons|max:255',
            'subtitle' => 'required',
        ]);

        $lesson = new Lesson;
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
        return view('teacher/lesson/edit')->withLesson(Lesson::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:lessons,title,'.$id.'|max:255',
            'subtitle' => 'required',
        ]);
        $lesson = Lesson::find($id);
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

    public function getLessonList()
    {
        $lessons = Lesson::select('lessons.id', 'lessons.title', 'lessons.subtitle', 'lessons.updated_at', 'teachers.username', DB::raw("COUNT(`lesson_logs`.`id`) as lesson_log_num"))
            ->leftJoin("teachers", "teachers.id", "=", "lessons.teachers_id")
            ->leftJoin("lesson_logs", "lesson_logs.lessons_id", "=", "lessons.id")
            ->groupBy('lessons.id', 'lessons.title', 'lessons.subtitle', 'lessons.updated_at', 'teachers.username')
            ->orderBy('lessons.updated_at', 'DESC')
            ->get();
        return $lessons;
    }
}

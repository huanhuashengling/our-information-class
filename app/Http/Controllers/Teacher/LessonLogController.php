<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\LessonLog;
use App\Http\Requests\LessonLogRequest;

class LessonLogController extends Controller
{
    public function store(Request $request)
    {
        //TODO DO not readd the same lessonlog with the sanme teacher classe and lesson
        $teachersId = \Auth::guard("teacher")->id();
        $sclassesId = $request->get('sclasses_id');
        $lessonsId = $request->get('lessons_id');
        if (0 == $sclassesId) {
            return redirect()->back()->withInput()->withErrors('请选择班级！');
        }
        if (0 == $lessonsId) {
            return redirect()->back()->withInput()->withErrors('请选择课程！');
        }
        $oldlLessonLog = LessonLog::where(['teachers_id' => $teachersId, "sclasses_id" => $sclassesId, "lessons_id" => $lessonsId])->first();
            


        if($oldlLessonLog) {
            $oldlLessonLog->status = 'open';
            $oldlLessonLog->update();
            return redirect('teacher/takeclass');
        }

        
        $lessonLog = new LessonLog();

        $lessonLog->teachers_id = \Auth::guard("teacher")->id();
        $lessonLog->sclasses_id = $request->get('sclasses_id');
        $lessonLog->lessons_id = $request->get('lessons_id');
        $lessonLog->status = 'open';
        // dd($lessonLog);die();
        if ($lessonLog->save()) {
            return redirect('teacher/takeclass');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function update(Request $request)
    {
        $lessonLogId = $request->get('lessonLogId');
        $action = $request->get('action');
        if ("close-lesson-log" == $action) {
            $lessonLog = LessonLog::where(['id' => $lessonLogId])->first();
            $lessonLog->status = 'close';
        }
        if ($lessonLog->update()) {
            return "true";
        } else {
            return "false";
        }
    }

    public function listLessonLog()
    {
        $teachers_id = \Auth::guard("teacher")->id();
        // $lessonLogData = LessonLog::where(['teachers_id' => $teachers_id])->get();
        $lessonLogs = LessonLog::leftJoin('lessons', function($join) {
            $join->on('lessons.id', '=', 'lesson_logs.lessons_id');
        })->selectRaw('lesson_logs.lessons_id as lessons_id, lessons.title, lessons.subtitle')->where(["lesson_logs.teachers_id" => $teachers_id])->groupBy('lessons_id')->get();
        // dd($lessonLogs);die();
        // $lessons = [];
        // foreach ($lessonLogs as $key => $lessonLog) {
            // $lessonLog
        // }

        return view('teacher/lesson/lesson-log', compact('lessonLogs'));
    }
}

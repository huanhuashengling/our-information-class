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
        $lessonLog = new LessonLog();
        // if (\Auth::user()->lessonLogs->save($lessonLog)) {
            // return redirect('teacher/takeClass');
        // } else {
        //     return redirect()->back()->withInput()->withErrors('保存失败！');
        // }
        // $user = \Auth::user();
        // dd(\Auth::user());die();
        $lessonLog->teachers_users_id = \Auth::user()->id;
        $lessonLog->school_classes_id = $request->get('school_classes_id');
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
        $teachers_users_id = \Auth::user()->id;
        // $lessonLogData = LessonLog::where(['teachers_users_id' => $teachers_users_id])->get();
        $lessonLogs = LessonLog::leftJoin('lessons', function($join) {
            $join->on('lessons.id', '=', 'lesson_logs.lessons_id');
        })->selectRaw('lesson_logs.lessons_id as lessons_id, lessons.title, lessons.subtitle')->where(["lesson_logs.teachers_users_id" => $teachers_users_id])->groupBy('lessons_id')->get();
        // dd($lessonLogs);die();
        // $lessons = [];
        // foreach ($lessonLogs as $key => $lessonLog) {
            // $lessonLog
        // }

        return view('teacher/lesson/lesson-log', compact('lessonLogs'));
    }
}

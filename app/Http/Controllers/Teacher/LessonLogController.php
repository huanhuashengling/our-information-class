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
        // dd($user->id);die();
        $lessonLog->user_id = \Auth::user()->id;
        $lessonLog->school_class_id = $request->get('school_class_id');
        $lessonLog->lesson_id = $request->get('lesson_id');
        $lessonLog->status = 'start';
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
}

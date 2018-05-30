<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Post;
use App\Models\Mark;
use App\Models\Comment;
use App\Models\PostRate;
use App\Models\Lesson;
use App\Models\LessonLog;

use EndaEditor;

class PostController extends Controller
{
    public function index()
    {
        $id = \Auth::guard("student")->id();
        $student = Student::find($id);
        $lessonLogs = LessonLog::where(['sclasses_id' => $student['sclasses_id']])->get();

        $allMarkNum = 0;
        $allEffectMarkNum = 0;
        $allRateNum = 0;
        $allCommentNum = 0;
        $postData = [];
        foreach ($lessonLogs as $key => $lessonLog) {
            $lesson = Lesson::where(['id' => $lessonLog['lessons_id']])->first();
            $lesson->help_md_doc = EndaEditor::MarkDecode($lesson->help_md_doc);
            $post = Post::where(['lesson_logs_id' => $lessonLog['id'], "students_id" => $id])->orderBy('id', 'desc')->first();
            // $post->storage_name = env('APP_URL')."/posts/".$post->storage_name;
            $rate = "";
            $hasComment = "false";
            $markNum = 0;
            $markNames = [];
            if (isset($post)) {
                $post->storage_name = env('APP_URL')."/posts/".$post->storage_name;

                $postRate = PostRate::where(['posts_id' => $post['id']])->first();
                // $rate = isset($postRate)?$postRate['rate']:"";
                if (isset($postRate)) {
                    $rate = $postRate['rate'];
                    if ("优" == $rate) {
                        $allRateNum ++;
                    }
                }
                $comment = Comment::where(['posts_id' => $post['id']])->first();
                // $hasComment = isset($comment)?"true":"false";
                if (isset($comment)) {
                    $hasComment = "true";
                    $allCommentNum ++;
                }
                $markNames = Mark::select('students.username')
                ->leftJoin("students", 'students.id', '=', 'marks.students_id')
                ->where(['posts_id' => $post['id'], 'state_code' => 1])->get();
                $markNum = count($markNames);
                $allMarkNum += $markNum;
                $allEffectMarkNum += ($markNum>4)?4:$markNum;
                // dd($marks);
            }

            $postData[] = ["lesson" => $lesson, 'post' => $post, 'rate' => $rate, 'lessonLog' => $lessonLog, 'hasComment' => $hasComment, 'markNum' => $markNum, 'markNames' => $markNames];
        }
        $allScore = $allEffectMarkNum * 0.5 + $allRateNum * 8 + $allCommentNum * 1;
        if ($allScore < 60) {
            $levelStr = "不合格";
        } else if ($allScore < 80) {
            $levelStr = "合格";
        } else if ($allScore < 95) {
            $levelStr = "优秀";
        } else {
            $levelStr = "非常优秀";
        } 
        return view('student/posts', compact('postData', 'allMarkNum', 'allEffectMarkNum', 'allRateNum', 'allCommentNum', 'allScore', 'levelStr'));
    }
}

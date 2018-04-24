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

        $postData = [];
        foreach ($lessonLogs as $key => $lessonLog) {
            $lesson = Lesson::where(['id' => $lessonLog['lessons_id']])->first();
            $lesson->help_md_doc = EndaEditor::MarkDecode($lesson->help_md_doc);
            $post = Post::where(['lesson_logs_id' => $lessonLog['id'], "students_id" => $id])->orderBy('id', 'desc')->first();
            // $post->storage_name = env('APP_URL')."/posts/".$post->storage_name;
            $rate = "";
            $hasComment = "";
            $markNum = 0;
            if (isset($post)) {
                $post->storage_name = env('APP_URL')."/posts/".$post->storage_name;

                $postRate = PostRate::where(['posts_id' => $post['id']])->first();
                $rate = isset($postRate)?$postRate['rate']:"";
                $comment = Comment::where(['posts_id' => $post['id']])->first();
                $hasComment = isset($comment)?"true":"false";
                $marks = Mark::where(['posts_id' => $post['id']])->get();
                $markNum = count($marks);
            }

            $postData[] = ["lesson" => $lesson, 'post' => $post, 'rate' => $rate, 'lessonLog' => $lessonLog, 'hasComment' => $hasComment, 'markNum' => $markNum];
        }

        return view('student/posts', compact('postData'));
    }
}

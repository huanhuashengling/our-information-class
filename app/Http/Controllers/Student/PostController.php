<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostRate;
use App\Models\Lesson;
use App\Models\LessonLog;

use EndaEditor;

class PostController extends Controller
{
    public function index()
    {
        $userId = \Auth::user()->id;
        $student = Student::where(['users_id' => $userId])->first();
        $lessonLogs = LessonLog::where(['school_classes_id' => $student['school_classes_id']])->get();

        $postData = [];
        foreach ($lessonLogs as $key => $lessonLog) {
            $lesson = Lesson::where(['id' => $lessonLog['lessons_id']])->first();
            $lesson->help_md_doc = EndaEditor::MarkDecode($lesson->help_md_doc);
            $post = Post::where(['lesson_logs_id' => $lessonLog['id'], "students_users_id" => $userId])->orderBy('id', 'desc')->first();

            $rate = "";
            $hasComment = "";
            if (isset($post)) {
                $postRate = PostRate::where(['posts_id' => $post['id']])->first();
                $rate = isset($postRate)?$postRate['rate']:"";
                $comment = Comment::where(['posts_id' => $post['id']])->first();
                $hasComment = isset($comment)?"true":"false";
            }

            $postData[] = ["lesson" => $lesson, 'post' => $post, 'rate' => $rate, 'hasComment' => $hasComment];
        }

        return view('student/posts', compact('postData'));
    }
}

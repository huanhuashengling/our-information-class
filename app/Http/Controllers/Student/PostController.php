<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Post;
use App\Models\Lesson;
use App\Models\LessonLog;

class PostController extends Controller
{
    public function index()
    {
        $userId = \Auth::user()->id;
        $student = Student::where(['users_id' => $userId])->first();
        $lessonLogs = LessonLog::where(['school_classes_id' => $student['school_classes_id']])->get();

        $posts = [];
        foreach ($lessonLogs as $key => $lessonLog) {
            $lesson = Lesson::where(['id' => $lessonLog['lessons_id']])->first();
            $post = Post::where(['lesson_logs_id' => $lessonLog['id'], "students_users_id" => $userId])->first();
            $posts[] = ["lesson" => $lesson, 'post' => $post];
        }

        return view('student/posts', compact('posts'));
    }
}

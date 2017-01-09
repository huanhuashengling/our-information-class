<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Lesson;

class LessonController extends Controller
{
    public function index()
    {
        return view('teacher/lesson/index')->withLessons(Lesson::all());
    }
}

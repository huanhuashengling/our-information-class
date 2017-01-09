<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SchoolClass;
use App\Models\Lesson;

class HomeController extends Controller
{
    public function index()
    {
        $schoolClasses = SchoolClass::where('grade_num', '>', 2)->pluck('title', 'id');
        $lessons = Lesson::pluck('title', 'id');
        // dd($schoolClasses);die();
        return view('teacher/home', compact('schoolClasses', 'lessons'));
    }
}

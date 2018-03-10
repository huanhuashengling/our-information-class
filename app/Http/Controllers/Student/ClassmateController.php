<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Post;

class ClassmateController extends Controller
{
    public function classmatePost()
    {
        $id = \Auth::guard("student")->id();
        $student = Student::find($id);
        $posts = Post::where('students_id', '<>', $id)->get();
// dd($posts);
        $postData = [];
        foreach ($posts as $key => $post) {
            if("doc" == $post->file_ext || "docx" == $post->file_ext) {
                $post->storage_name = env('APP_URL')."/images/defaultphoto.png";
            } else if("xls" == $post->file_ext || "xlsx" == $post->file_ext) {
                $post->storage_name = env('APP_URL')."/images/defaultphoto.png";
            } else if("ppt" == $post->file_ext || "pptx" == $post->file_ext) {
                $post->storage_name = env('APP_URL')."/images/defaultphoto.png";
            } else {
                $post->storage_name = env('APP_URL')."/posts/".$post->storage_name;
            }
            $postStudent = Student::find($post->students_id);
            $post->studentName = $postStudent->username;
            array_push($postData, $post);
        }

        return view('student/classmatePost', compact('postData'));
    }
}

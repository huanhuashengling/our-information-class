<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Sclass;
use App\Models\Post;
use App\Models\PostRate;

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
                $post->storage_name = env('APP_URL')."/images/doc.png";
            } else if("xls" == $post->file_ext || "xlsx" == $post->file_ext) {
                $post->storage_name = env('APP_URL')."/images/xls.png";
            } else if("ppt" == $post->file_ext || "pptx" == $post->file_ext) {
                $post->storage_name = env('APP_URL')."/images/ppt.png";
            } else {
                $post->storage_name = env('APP_URL')."/posts/".$post->storage_name;
            }
            $postStudent = Student::find($post->students_id);
            $sclass = Sclass::find($postStudent->sclasses_id);
            $postRate = PostRate::where('posts_id', $post->id)->first();
            if (isset($postRate)) {
                if("outstanding" == $postRate->rate) {
                    $post->rate = "优";
                } else if("lower" == $postRate->rate) {
                    $post->rate = "合格";
                }
                // $post->rate = $postRate->rate;
            } else {
                $post->rate = "";
            }


            $post->studentName = $postStudent->username;
            $post->studentClass = (2018-$sclass->enter_school_year) . $sclass->class_title . "班";
            array_push($postData, $post);
        }

        return view('student/classmatePost', compact('postData'));
    }
}

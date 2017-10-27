<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Lesson;
use App\Models\LessonLog;
use App\Models\Post;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use EndaEditor;

class HomeController extends Controller
{
    public function index()
    {
        $userId = \Auth::user()->id;
        $student = Student::where(['users_id' => $userId])->first();
        $lessonLog = LessonLog::where(['school_classes_id' => $student['school_classes_id'], 'status' => 'open'])->first();

        $lesson = "";
        $schoolClass = "";
        if ($lessonLog) {
            $lesson = Lesson::where(['id' => $lessonLog['lessons_id']])->first();
            $lesson->help_md_doc = EndaEditor::MarkDecode($lesson->help_md_doc);
            $schoolClass = SchoolClass::where(['id' => $lessonLog['school_classes_id']])->first();
        }
        // dd($lessonLog);die();
        return view('student/home', compact('schoolClass', 'lesson', 'lessonLog'));
    }

    public function upload(Request $request)
    {
      // getting all of the post data
      $file = array('image' => Input::file('image'));
      // setting up rules
      $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
      // doing the validation, passing post data, rules and the messages
      $validator = Validator::make($file, $rules);
      if ($validator->fails()) {
        // send back to the page with the input data and errors
        return Redirect::to('student')->withInput()->withErrors($validator);
      } else {
        // checking file is valid.
        if (Input::file('image')->isValid()) {
          $destinationPath = 'uploads'; // upload path
          $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
          $postCode = rand(11111,99999);
          $fileName = $postCode . '.' . $extension; // renameing image
          Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
          
          //create a post record
          $post = new Post();
          $post->students_users_id = \Auth::user()->id;
          $post->lesson_logs_id = $request->get('lesson_logs_id');
          $post->file_path = "/" .$destinationPath . "/" . $fileName;
          $post->post_code = $postCode;
          $post->content = "";
          // dd($post);die();
          if ($post->save()) {
            Session::flash('success', '作业提交成功'); 
            return Redirect::to('student');
          } else {
            Session::flash('error', '作业提交失败'); 
          }

          // sending back with message
          // Session::flash('success', '作业提交成功'); 
          // return Redirect::to('student');
        }
        else {
          // sending back with error message.
          Session::flash('error', '上传文件不符合要求');
          return Redirect::to('student');
        }
      }
    }
}

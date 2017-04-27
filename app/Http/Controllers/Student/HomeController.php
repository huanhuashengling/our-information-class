<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Lesson;
use App\Models\LessonLog;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class HomeController extends Controller
{
    public function index()
    {
        $userId = \Auth::user()->id;
        $student = Student::where(['users_id' => $userId])->first();
        $lessonLog = LessonLog::where(['school_classes_id' => $student['school_classes_id'], 'status' => 'open'])->first();

        if ($lessonLog) {
            $lesson = Lesson::where(['id' => $lessonLog['lessons_id']])->first();
            $schoolClass = SchoolClass::where(['id' => $lessonLog['school_classes_id']])->first();
        }
        // dd($lessonLog);die();
        return view('student/home', compact('schoolClass', 'lesson'));
    }

    public function upload()
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
          $fileName = rand(11111,99999).'.'.$extension; // renameing image
          Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
          // sending back with message
          Session::flash('success', '作业提交成功'); 
          return Redirect::to('student');
        }
        else {
          // sending back with error message.
          Session::flash('error', 'uploaded file is not valid');
          return Redirect::to('student');
        }
      }
    }
}

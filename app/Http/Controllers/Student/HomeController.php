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
        $id = auth()->guard("student")->id();
        $student = Student::find($id);
        $lessonLog = LessonLog::where(['sclasses_id' => $student['sclasses_id'], 'status' => 'open'])->first();

        $lesson = "";
        $sclass = "";
        $post = "";
        if ($lessonLog) {
            $lesson = Lesson::where(['id' => $lessonLog['lessons_id']])->first();
            $lesson->help_md_doc = EndaEditor::MarkDecode($lesson->help_md_doc);
            $sclass = SchoolClass::where(['id' => $lessonLog['sclasses_id']])->first();

            $post = Post::where(['lesson_logs_id' => $lessonLog['id'], "students_id" => $id])->orderBy('id', 'desc')->first();

            // $img_dir = dirname(__FILE__) . $post->file_path;
            $img_dir =  public_path() . $post->file_path;;
            $img_base64 = $this->imgToBase64($img_dir);
            $post->file_path = $img_base64;

        }
        // dd($lessonLog);die();
        return view('student/home', compact('sclass', 'lesson', 'lessonLog', 'post'));
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

  public function imgToBase64($img_file) {
     $img_base64 = '';
     if (file_exists($img_file)) {
         $app_img_file = $img_file; // 图片路径
         $img_info = getimagesize($app_img_file); // 取得图片的大小，类型等
 
         //echo '<pre>' . print_r($img_info, true) . '</pre><br>';
         $fp = fopen($app_img_file, "r"); // 图片是否可读权限
 
         if ($fp) {
             $filesize = filesize($app_img_file);
             $content = fread($fp, $filesize);
             $file_content = chunk_split(base64_encode($content)); // base64编码
             switch ($img_info[2]) {           //判读图片类型
                 case 1: $img_type = "gif";
                     break;
                 case 2: $img_type = "jpg";
                     break;
                 case 3: $img_type = "png";
                     break;
             }
 
             $img_base64 = 'data:image/' . $img_type . ';base64,' . $file_content;//合成图片的base64编码
 
         }
         fclose($fp);
     }
     return $img_base64; //返回图片的base64
 }
}

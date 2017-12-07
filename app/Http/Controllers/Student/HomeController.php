<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Sclass;
use App\Models\Lesson;
use App\Models\LessonLog;
use App\Models\Post;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use \Auth;
use \Storage;
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
            $sclass = Sclass::where(['id' => $lessonLog['sclasses_id']])->first();

            $post = Post::where(['lesson_logs_id' => $lessonLog['id'], "students_id" => $id])->orderBy('id', 'desc')->first();
            if ($post) {
              // $post->file_path = $this->get($post->file_path);
              // echo env('APP_URL');
              // echo env('APP_URL')."/posts/".$post->file_path;
              // dd($post->file_path);
              // $file_path = Storage::url($post->file_path);
              $post->file_path = env('APP_URL')."/posts/".$post->file_path;

              // $exists = Storage::disk('posts')->exists($post->file_path);
              // dd($file_path);

              // $file_path = Storage::disk('posts')->url($post->file_path);
              // dd($file_path);
              // route('getpostimg', $post->file_path)
              // $img_dir = storage_path(). $post->file_path;
              // dd($img_dir);
              // $img_dir =  public_path() . $post->file_path;
              // $img_base64 = $this->imgToBase64($file_path);
              // $post->file_path = $img_base64;
              // $post->file_path = $file_path;
            }
        }
        // dd($post);
        return view('student/home', compact('sclass', 'lesson', 'lessonLog', 'post'));
    }

    public function upload(Request $request)
    {

      $file = $request->file('source');

      if ($file->isValid()) {
        // 原文件名
        $originalName = $file->getClientOriginalName();
        // 扩展名
        $ext = $file->getClientOriginalExtension();
        // MimeType
        $type = $file->getClientMimeType();
        // 临时绝对路径
        $realPath = $file->getRealPath();

        $uniqid = uniqid();
        $filename = date('Ymd') . '-' . $uniqid . '.' . $ext;

        $bool = Storage::disk('posts')->put($filename, file_get_contents($realPath)); 
        
        $post = new Post();

        $post->students_id = Auth::guard("student")->id();
        $post->lesson_logs_id = $request->get('lesson_logs_id');
        $post->file_path = $filename;
        $post->post_code = $uniqid;
        $post->content = "";
        // dd($post);die();
        if ($post->save()) {
          // Session::flash('success', '作业提交成功'); 
          return Redirect::to('student')->with('success', '作业提交成功啦！');
        } else {
          return Redirect::to('student')->with('success', '作业提交失败，请重新操作！');

          // Session::flash('error', '作业提交失败'); 
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


    public function getReset()
    {
        return view('student.login.reset');
    }

    public function postReset(Request $request)
    {
        $oldpassword = $request->input('oldpassword');
        $password = $request->input('password');
        $data = $request->all();
        $rules = [
            'oldpassword'=>'required|between:6,20',
            'password'=>'required|between:6,20|confirmed',
        ];
        $messages = [
            'required' => '密码不能为空',
            'between' => '密码必须是6~20位之间',
            'confirmed' => '新密码和确认密码不匹配'
        ];
        $validator = Validator::make($data, $rules, $messages);
        $user = Auth::guard("student")->user();
        $validator->after(function($validator) use ($oldpassword, $user) {
            if (!\Hash::check($oldpassword, $user->password)) {
                $validator->errors()->add('oldpassword', '原密码错误');
            }
        });
        if ($validator->fails()) {
            return back()->withErrors($validator);  //返回一次性错误
        }
        $user->password = bcrypt($password);
        $user->save();
        Auth::guard("student")->logout();  //更改完这次密码后，退出这个用户
        return redirect('/student/login');
    }
}

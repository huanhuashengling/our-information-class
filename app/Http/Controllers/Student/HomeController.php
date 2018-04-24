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
use App\Models\PostRate;
use App\Models\Comment;
use App\Models\Mark;

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

        $allLessonLogs = LessonLog::select('lesson_logs.id as lesson_logs_id', 'lessons.title', 'lessons.subtitle')
        ->leftJoin('lessons', 'lessons.id', '=', "lesson_logs.lessons_id")
        ->where(['lesson_logs.sclasses_id' => $student['sclasses_id'], 'status' => 'close'])->get();
        $unPostedLessonLogs = array();
        // dd($allLessonLogs);
        foreach ($allLessonLogs as $key => $lessonLogData) {
          $post = Post::where(['students_id' => $id, 'lesson_logs_id' => $lessonLogData['lesson_logs_id']])->first();
          // dd($post);
          if (!isset($post)) {
            array_push($unPostedLessonLogs, $lessonLogData);
          }
          
        }
        // dd($unPostedLessonLogs);
        $unPostedLessonLogsNum = count($unPostedLessonLogs);
        $lesson = "";
        $sclass = "";
        $post = "";
        if ($lessonLog) {
            $lesson = Lesson::where(['id' => $lessonLog['lessons_id']])->first();
            $lesson->help_md_doc = EndaEditor::MarkDecode($lesson->help_md_doc);
            $sclass = Sclass::where(['id' => $lessonLog['sclasses_id']])->first();

            $post = Post::where(['lesson_logs_id' => $lessonLog['id'], "students_id" => $id])->orderBy('id', 'desc')->first();
            if ($post) {
              // echo env('APP_URL')."/posts/".$post->storage_name;
              $post->storage_name = env('APP_URL')."/posts/".$post->storage_name;
            }
        }
        // dd($post);
        return view('student/home', compact('sclass', 'lesson', 'lessonLog', 'post', 'unPostedLessonLogsNum'));
    }

    public function upload(Request $request)
    {
      $file = $request->file('source');
      if(!$file) {
        return Redirect::to('student')->with('danger', '请重新选择作业提交！');
      }

      $studentsId = Auth::guard("student")->id();
      $lessonLogsId = $request->get('lesson_logs_id');
      $oldPost = Post::where(['lesson_logs_id' => $lessonLogsId, "students_id" => $studentsId])->orderBy('id', 'desc')->first();

      if ($file->isValid()) {
        // 原文件名
        $originalName = $file->getClientOriginalName();
        // $bytes = File::size($filename);
        // 扩展名
        $ext = $file->getClientOriginalExtension();
        // $originalName = str_replace($originalName, ".".$ext);
        // MimeType
        $type = $file->getClientMimeType();
        // dd($originalName);
        // 临时绝对路径
        $realPath = $file->getRealPath();

        $uniqid = uniqid();
        $filename = $originalName . '-' . $uniqid . '.' . $ext;

        $bool = Storage::disk('posts')->put($filename, file_get_contents($realPath)); 
        //TDDO update these new or update code
        if($oldPost) {
          $oldFilename = $oldPost->storage_name;
          $oldPost->storage_name = $filename;
          $oldPost->original_name = $originalName;
          $oldPost->file_ext = $ext;
          $oldPost->mime_type = $type;
          $oldPost->post_code = $uniqid;
          $oldPost->content = "";
          if ($oldPost->update()) {
            $bool = Storage::disk('posts')->delete($oldFilename); 

            // Session::flash('success', '作业提交成功'); 
            return Redirect::to('student')->with('success', '作业提交成功啦！');
          } else {
            return Redirect::to('student')->with('danger', '作业提交失败，请重新操作！');
            // Session::flash('error', '作业提交失败'); 
          }
        } else {
          $post = new Post();
          $post->students_id = Auth::guard("student")->id();
          $post->lesson_logs_id = $request->get('lesson_logs_id');
          $post->storage_name = $filename;
          $post->original_name = $originalName;
          $post->file_ext = $ext;
          $post->mime_type = $type;
          $post->post_code = $uniqid;
          $post->content = "";
          if ($post->save()) {
            // Session::flash('success', '作业提交成功'); 
            return Redirect::to('student')->with('success', '作业提交成功啦！');
          } else {
            return Redirect::to('student')->with('danger', '作业提交失败，请重新操作！');
            // Session::flash('error', '作业提交失败'); 
          }
        }
      } else {
        return Redirect::to('student')->with('danger', '文件上传失败，请确认是否文件过大？');
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

    public function getCommentByPostsId(Request $request)
    {
        $comment = Comment::where(['posts_id' => $request->get('posts_id')])->first();

        if (isset($comment)) {
            return json_encode($comment);
        } else {
            return "false";
        }
    }

    public function getPostRate(Request $request)
    {
        $postRate = PostRate::where(['posts_id' => $request->input('posts_id')])->first();

        if (isset($postRate)) {
            return $postRate['rate'];
        } else {
            return "false";
        }
    }

    public function getOnePost(Request $request)
    {
        $post = Post::where("posts.id", "=", $request->input('posts_id'))
                ->leftjoin('students', 'students.id', '=', "posts.students_id")
                ->leftjoin('lesson_logs', 'lesson_logs.id', '=', "posts.lesson_logs_id")
                ->leftjoin('lessons', 'lessons.id', '=', "lesson_logs.lessons_id")->first();
                // return var_dump($post);
        if (isset($post)) {
          // $post['storage_name'] = env('APP_URL')."/posts/".$post['storage_name'];
            // return env('APP_URL')."/posts/".$post['storage_name'];
            // {{ getThumbnail($post->storage_name, 140, 100, 'fit') }}
            // return ["storage_name" => env('APP_URL')."/posts/".$post['storage_name'], 
            return ["storage_name" => getThumbnail($post['storage_name'], 800, 600, 'fit'), 
                    'username' => $post["username"], 
                    'lessontitle' => $post["title"], 
                    'lessonsubtitle' => $post["subtitle"]];
        } else {
            return "false";
        }
    }

    public function getMarkNumByPostsId(Request $request)
    {
        $marks = Mark::where(["posts_id" => $request->input('postsId'), "state_code" => 1])->get();

        if (isset($marks)) {
            return count($marks);
        } else {
            return 0;
        }
    }

    public function getIsMarkedByMyself(Request $request)
    {
      $studentsId = Auth::guard("student")->id();
      $postsId =  $request->input('postsId');
      $mark = Mark::where(["posts_id" => $postsId, "students_id" => $studentsId, "state_code" => 1])->first();

        if (isset($mark)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateMarkState(Request $request)
    {
        $studentsId = Auth::guard("student")->id();
        $postsId =  $request->input('postsId');
        $stateCode =  $request->input('stateCode');
        
        $mark = Mark::where(["posts_id" => $postsId, "students_id" => $studentsId])->first();
        // dd($mark);
        if (isset($mark)) {
          $mark->state_code = $stateCode;
          if ($mark->save()) {
            return "true";
          }
        } else {
          $mark = new Mark();
          $mark->posts_id = $postsId;
          $mark->students_id = $studentsId;
          $mark->state_code = $stateCode;
          if ($mark->save()) {
            return "true";
          }
        }
    }
}

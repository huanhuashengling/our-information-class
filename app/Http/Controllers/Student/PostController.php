<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Post;
use App\Models\Mark;
use App\Models\Comment;
use App\Models\PostRate;
use App\Models\Lesson;
use App\Models\LessonLog;
use App\Models\Term;
use App\Models\Sclass;
use App\Models\School;
use \Auth;

use EndaEditor;
use \DB;

class PostController extends Controller
{
    public function index()
    {
        $imgTypes = ['jpg', 'jpeg', 'bmp', 'gif', 'png'];
        $docTypes = ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

        $id = \Auth::guard("student")->id();
        $student = Student::find($id);
        $sclass = Sclass::find($student->sclasses_id);
        $terms = Term::where(['enter_school_year' => $sclass->enter_school_year])->get();
        return view('student/posts', compact('terms'));
    }

    public function getPostsByTerm(Request $request) {
        $termsId = $request->termsId;
        $term = Term::find($termsId);
        $middir = "/posts/" . $this->getSchoolCode() . "/";
        $imgTypes = ['jpg', 'jpeg', 'bmp', 'gif', 'png'];
        $docTypes = ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

        $id = \Auth::guard("student")->id();
        $student = Student::find($id);
        $sclass = Sclass::find($student->sclasses_id);
        // dd($term);
        $from = date('Y-m-d', strtotime($term->from_date)); 
        $to = date('Y-m-d', strtotime($term->to_date));
        $lessonLogs = LessonLog::where(['sclasses_id' => $student['sclasses_id']])
        ->whereBetween('lesson_logs.created_at', array($from, $to))->get();

        $allMarkNum = 0;
        $allEffectMarkNum = 0;
        $allYouNum = 0;
        $allYouJiaNum = 0;
        $postData = [];
        foreach ($lessonLogs as $key => $lessonLog) {
            $lesson = Lesson::where(['id' => $lessonLog['lessons_id']])->first();
            $lesson->help_md_doc = EndaEditor::MarkDecode($lesson->help_md_doc);
            $post = Post::where(['lesson_logs_id' => $lessonLog['id'], "students_id" => $id])->orderBy('id', 'desc')->first();
            // $post->storage_name = env('APP_URL').  $middir .$post->storage_name;
            $rate = "";
            $hasComment = "false";
            $markNum = 0;
            $markNames = [];
            if (isset($post)) {
                $post->storage_name = env('APP_URL'). $middir .$post->storage_name;

                if (in_array($post->file_ext, $imgTypes)) {
                    $post["filetype"] = "img";
                    $post["previewPath"] = getThumbnail($post['storage_name'], 800, 600, $this->getSchoolCode(), 'fit', $post['file_ext']);
                } elseif (in_array($post->file_ext, $docTypes)) {
                    $post["filetype"] = "doc";
                    $post["previewPath"] = $post->storage_name;
                }


                $postRate = PostRate::where(['posts_id' => $post['id']])->first();
                // $rate = isset($postRate)?$postRate['rate']:"";
                if (isset($postRate)) {
                    $rate = $postRate['rate'];
                    if ("优" == $rate) {
                        $allYouNum ++;
                    } else if("优+" == $rate) {
                        $allYouJiaNum ++;
                    }
                }
                $comment = Comment::where(['posts_id' => $post['id']])->first();
                // $hasComment = isset($comment)?"true":"false";
                // if (isset($comment)) {
                //     $hasComment = "true";
                //    ++;
                // }
                $markNames = Mark::select('students.username')
                ->leftJoin("students", 'students.id', '=', 'marks.students_id')
                ->where(['posts_id' => $post['id'], 'state_code' => 1])->get();
                $markNum = count($markNames);
                $allMarkNum += $markNum;
                $allEffectMarkNum += ($markNum>4)?4:$markNum;
                // dd($marks);
            }

            $postData[] = ["lesson" => $lesson, 'post' => $post, 'rate' => $rate, 'lessonLog' => $lessonLog, 'hasComment' => $hasComment, 'markNum' => $markNum, 'markNames' => $markNames];
        }
        $allScore = $allEffectMarkNum * 0.5 + $allYouNum * 8 + $allYouJiaNum * 9;
        if ($allScore < 60) {
            $levelStr = "不合格";
        } else if ($allScore < 80) {
            $levelStr = "合格";
        } else if ($allScore < 95) {
            $levelStr = "优秀";
        } else {
            $levelStr = "非常优秀";
        }
        return $this->buildPostListHtml($postData, $allMarkNum, $allEffectMarkNum, $allYouNum, $allYouJiaNum, $allScore, $levelStr);
    }

    public function buildPostListHtml($postData, $allMarkNum, $allEffectMarkNum, $allYouNum, $allYouJiaNum, $allScore, $levelStr) {
        $resultHtml = "<div class='alert alert-info col-md-10 col-md-offset-1'><h4>当前成绩：(有效赞" . $allEffectMarkNum ." * 0.5) (" . $allYouJiaNum . "个优+ * 9)(". $allYouNum . "个优 * 8) = " . $allScore . "分 （当前等第：" . $levelStr . "）</h4><h5>总赞数(共" . $allMarkNum . "个赞)，每份作业4次有效，以每个0.5分计入期末成绩，共2分</h5><h5>颜色注释：白色为未提交，黄色为未看或未达到作业要求，绿色为优等，红色为优+等第</h5></div>";

        $resultHtml .= "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>";
        foreach ($postData as $key => $item) {
            $orderNum = $key + 1;
            $hasComment = "";
            
            $hasPostCss = "default";
            $hasPostStr = "(未交)";
            $rateStr = "";
            $markStr = "";
            if (isset($item['post'])) {
                
                $markStr = $item['markNum']."个赞";
                $hasPostStr = $item['rate'];
                if ("优" == $item['rate']) {
                    $hasPostCss = "success";
                } elseif ("优+" == $item['rate']) {
                    $hasPostCss = "danger";
                } else {
                    $hasPostCss = "warning";
                }
            }

            // if ("true" == $item['hasComment']) {
            //     $hasComment = "有评语";
            //     $hasPostCss = "danger";
            // }
            // if ("优" != $item['rate']) {
                $resultHtml .= "<input type='hidden' name='' id='posted-path-" . $item['post']['id'] . "' value='" . $item['post']['storage_name'] . "' />";
            // }

            $resultHtml .= "<div class='col-md-12'><div class='panel panel-" . $hasPostCss . "'><div class='panel-heading' role='tab' id='heading" . $orderNum. "'><h4 class='panel-title' value='" . $item['post']['id'] . "," . $item['post']['storage_name'] . "," . $item['post']['filetype'] . "," . $item['post']['previewPath'] . "'><a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse" . $orderNum . "' aria-expanded='true' aria-controls='collapse".$orderNum."'>第" . $orderNum . "节： " . $item['lesson']['title'] . " <small>" . $item['lesson']['subtitle'] ." </small>  <label class='text-right'>" ." ". $hasPostStr ." " . $markStr . "</label></a></h4></div><div id='collapse" . $orderNum . "' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading" . $orderNum . "'><div class='panel-body'><div id='post-body-" . $item['post']['id'] . "'></div>";

                if (isset($item['post'])) {
                    if ('待完' != $item['rate']) {
                        $resultHtml .= "<div id='doc-preview-" .$item['post']['id'] . "'></div>";
                        $resultHtml .= "<img src='' id='post-show-" . $item['post']['id'] . "' class='img-responsive'>";
                        
                        $resultHtml .= "<a href='' id='post-download-" . $item['post']['id'] . "'>右键点击下载</a><p></p>";
                        $resultHtml .= "<div class='form-group'><label id='rate-label-" . $item['post']['id'] . "'></label></div>";
                        $resultHtml .= "<div class='form-group'><label id='post-comment-" . $item['post']['id'] . "' value=''></label></div>";
                        $resultHtml .= "<div class='form-group'>" . $item['markNum'] . "个人为你点赞：";
                            foreach ($item['markNames'] as $key => $name) {
                                $resultHtml .= $name->username . ", ";
                            }
                        $resultHtml .= "</div>";
                    } else {
                        $resultHtml .= "<a href='' id='post-download-" . $item['post']['id'] . "'>右键点击下载</a><p></p>";
                        $resultHtml .= $item['lesson']['help_md_doc'];
                        $resultHtml .= "<form action='/student/upload' method='POST' accept-charset='UTF-8' enctype='multipart/form-data'>" . csrf_field();
                        $resultHtml .= "<input type='hidden' name='lesson_logs_id' value='" . $item['lessonLog']['id'] . "'>";
                        $resultHtml .= "<input type='file' name='source' id='input-zh-".$item["post"]["id"]."' class='file input-zh'>";
                            
                        $resultHtml .= "</form>";
                    }
                } else {
                    $resultHtml .= $item['lesson']['help_md_doc'];
                    $resultHtml .= "<form action='/student/upload' method='POST' accept-charset='UTF-8' enctype='multipart/form-data'>" . csrf_field();
                    $resultHtml .= "<input type='hidden' name='lesson_logs_id' value='" . $item['lessonLog']['id'] . "'>";
                    $resultHtml .= "<input type='file' name='source' id='input-zh-".$item["post"]["id"]."' class='file input-zh'>";
                        
                    $resultHtml .= "</form>";
                }

            $resultHtml .= "</div></div></div></div>";     
        }
        $resultHtml .= "</div></div>";
        return $resultHtml;
    }

    public function getSchoolCode()
    {
      $student = Student::find(Auth::guard("student")->id());

      $school = School::leftJoin('sclasses', 'sclasses.schools_id', '=', "schools.id")
              ->where('sclasses.id', '=', $student->sclasses_id)->first();
      return $school->code;
    }

}

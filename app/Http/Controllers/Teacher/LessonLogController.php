<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\LessonLog;
use App\Models\Term;
use App\Models\Sclass;
use App\Models\School;
use App\Models\Teacher;
use \DB;
use \Auth;
use App\Http\Requests\LessonLogRequest;
use App\Libaries\pinyinfirstchar;


class LessonLogController extends Controller
{
    public function store(Request $request)
    {
        //TODO DO not readd the same lessonlog with the sanme teacher classe and lesson
        $teachersId = \Auth::guard("teacher")->id();
        $sclassesId = $request->get('sclasses_id');
        $lessonsId = $request->get('lessons_id');
        if (0 == $sclassesId) {
            return redirect()->back()->withInput()->withErrors('请选择班级！');
        }
        if (0 == $lessonsId) {
            return redirect()->back()->withInput()->withErrors('请选择课程！');
        }
        $oldlLessonLog = LessonLog::where(['teachers_id' => $teachersId, "sclasses_id" => $sclassesId, "lessons_id" => $lessonsId])->first();
            


        if($oldlLessonLog) {
            $oldlLessonLog->status = 'open';
            $oldlLessonLog->update();
            return redirect('teacher/takeclass');
        }

        
        $lessonLog = new LessonLog();

        $lessonLog->teachers_id = \Auth::guard("teacher")->id();
        $lessonLog->sclasses_id = $request->get('sclasses_id');
        $lessonLog->lessons_id = $request->get('lessons_id');
        $lessonLog->rethink = $request->get('rethink');
        $lessonLog->status = 'open';
        // dd($lessonLog);die();
        if ($lessonLog->save()) {
            return redirect('teacher/takeclass');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function update(Request $request)
    {
        $lessonLogId = $request->get('lessonLogId');
        $action = $request->get('action');
        if ("close-lesson-log" == $action) {
            $lessonLog = LessonLog::where(['id' => $lessonLogId])->first();
            $lessonLog->status = 'close';
        }
        if ($lessonLog->update()) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateRethink(Request $request)
    {
        $lessonLogId = $request->get('lessonLogId');
        $rethink = $request->get('rethink');
        $lessonLog = LessonLog::where(['id' => $lessonLogId])->first();
        $lessonLog->rethink = $rethink;
        if ($lessonLog->update()) {
            return "true";
        } else {
            return "false";
        }
    }

    public function listLessonLog()
    {
        $terms = Term::orderBy("enter_school_year", "desc")->get();
        return view('teacher/lesson/lesson-log', compact('terms'));
    }

    public function loadSclassSelection(Request $request)
    {
        $term = Term::find($request->get('terms_id'));
        $teachers_id = \Auth::guard("teacher")->id();
        $teacher = Teacher::find($teachers_id);
        $sclasses = Sclass::where(["enter_school_year" => $term->enter_school_year, 'schools_id' => $teacher->schools_id])
        ->orderBy("enter_school_year", "desc")->get();
        return $this->buildSclassSelctionHhtml($sclasses);
    }

    public function loadLessonLogSelection(Request $request)
    {
        $term = Term::find($request->get('terms_id'));
        $from = date('Y-m-d', strtotime($term->from_date)); 
        $to = date('Y-m-d', strtotime($term->to_date));

        $sclass = Sclass::find($request->get('sclassesId'));

        $lessonLogs = LessonLog::select('lesson_logs.id', 'lessons.title', 'lessons.subtitle', 'teachers.username', 'lesson_logs.updated_at', DB::raw("COUNT(`posts`.`id`) as post_num"))
            ->leftJoin('lessons', function($join){
              $join->on('lessons.id', '=', 'lesson_logs.lessons_id');
            })
            ->leftJoin('teachers', function($join){
              $join->on('teachers.id', '=', 'lesson_logs.teachers_id');
            })
            ->leftJoin('posts', function($join){
              $join->on('posts.lesson_logs_id', '=', 'lesson_logs.id');
            })
            ->groupBy('lesson_logs.id', 'lessons.title', 'lessons.subtitle', 'teachers.username', 'lesson_logs.updated_at')
            ->whereBetween('lesson_logs.created_at', array($from, $to))
            ->where(['lesson_logs.sclasses_id' => $sclass->id])->get();

        return $this->buildLessonLogSelectionHtml($lessonLogs);
        // return json_encode($term);
    }

    public function getPostDataByTermAndSclass(Request $request)
    {
        $lessonLogsId = $request->get('lessonlogsId');
        $lessonLog = LessonLog::find($request->get('lessonlogsId'));
        // dd($lessonLog);die();

        $students = DB::table('students')->select('students.id', 'students.username', 'posts.file_ext', 'posts.storage_name', 'comments.content', 'post_rates.rate', 'posts.id as posts_id', DB::raw("COUNT(`marks`.`id`) as mark_num"))
        ->leftJoin('posts', 'posts.students_id', '=', 'students.id')
        ->leftJoin('post_rates', 'post_rates.posts_id', '=', 'posts.id')
        ->leftJoin('comments', 'comments.posts_id', '=', 'posts.id')
        ->leftJoin('marks', 'marks.posts_id', '=', 'posts.id')
        ->where(["students.sclasses_id" => $lessonLog['sclasses_id'], 'posts.lesson_logs_id' => $lessonLog['id']])
        ->where('students.is_lock', "!=", "1")
        ->groupBy('students.id', 'students.username', 'posts.storage_name', 'comments.content', 'post_rates.rate', 'posts.id')
        ->orderBy(DB::raw('convert(students.username using gbk)'), "ASC")->get();
        // dd($lessonLog);
        $unPostStudentNameStr = "未交名单:";
        
        $postedStudents = [];
        $allStudentsList = DB::table('students')->select('students.username')
        ->where(['students.sclasses_id' => $lessonLog['sclasses_id']])->where('students.is_lock', "!=", "1")->get();
        foreach ($students as $key => $student) {
            array_push($postedStudents, $student->username);
        }
        $unpostCount = 0;
        foreach ($allStudentsList as $key => $studentsName) {
            if (!in_array($studentsName->username, $postedStudents)) {
                $unPostStudentNameStr .= " " . ($unpostCount + 1). ". " . $studentsName->username;
                $unpostCount++;
            }
        }
        // dd($unPostStudentName);
        $allCount = count($allStudentsList);
        // return view('teacher/takeclass', compact('students', 'lessonLog', 'py', 'allCount', 'unPostStudentName'));
        // $unpostCount = 0;
        $postedCount = $allCount-$unpostCount;
        $panelHeadStr = "(全部".$allCount.")"." "."(已交".$postedCount.")"." "."(未交".$unpostCount.")";
        
        $returnHtml = "<div class='panel panel-default'><div class='panel-heading'><h4>".$panelHeadStr."</h4></div><div class='panel-body'>" . $this->buildStudentPostsList($students) . " </div><div class='panel-footer'><h4>".$unPostStudentNameStr."</h4></div></div>";
            
        $returnHtml .= "<input type='hidden' id='lesson-log-id' value='" . $lessonLog['id'] . "'>";
        $returnHtml .= "<div class='panel panel-default'><div class='panel-heading'><div class='panel-title'><button class='btn btn-default' id='update-rethink'>点击记录教学反思</button></div></div><div class='panel-body'><textarea class='form-control' rows='5' id='rethink' name='rethink'>" . $lessonLog['rethink'] . "</textarea></div></div>";


        return $returnHtml;
    }

    public function buildStudentPostsList($students)
    {
        $returnHtml = "";
        $py = new pinyinfirstchar();
        foreach ($students as $student) {
            if (isset($student->rate)) {
                $ratestr = $student->rate . "/";
                if ("优+" == $student->rate) {
                    $postCss = "alert-danger";
                } else if("优" == $student->rate) {
                    $postCss = "alert-success";
                } else {
                    $postCss = "alert-info";
                }
            } else {
                $ratestr = "";
                $postCss = "alert-default";
            }
            $commentStr = "";
            if (isset($student->content) && "" != $student->content) {
                $commentStr = "/评";
            }
            $marksNum = isset($student->mark_num)?$student->mark_num:"";
            $returnHtml .= "<div class='col-md-2 col-sm-4 col-xs-6' style='padding-left: 5px; padding-right: 5px;'><div class='alert " . $postCss . "' style='padding: 5px;'><div><img class='img-responsive post-btn center-block' value='". $student->posts_id . "' src='" . getThumbnail($student->storage_name, 140, 100, $this->getSchoolCode(), 'fit', $student->file_ext) . "' alt='></div><div><h3 style='margin-top: 10px;'>" . $py->getFirstchar($student->username) . "<small>" . $student->username . "<small></small><span class='text-right'> " . $ratestr . "" . $marksNum . $commentStr . "</span></small></h3></div></div></div>";
        }
        return $returnHtml;
    }

    public function buildSclassSelctionHhtml($sclasses)
    {
        $returnHtml = "<option>选择班级</option>";
        foreach ($sclasses as $key => $sclass) {
            $returnHtml .= "<option value='" . $sclass['id'] . "'>" . $sclass['class_title'] . "班</option>";
        }

        return $returnHtml;
    }

    public function buildLessonLogSelectionHtml($lessonlogs) {
        $returnHtml = "<option>选择上课记录</option>";
        foreach ($lessonlogs as $key => $lessonLog) {
            $d= date("Y-m-d", strtotime($lessonLog['updated_at']));
            // $date = new DateTime($lessonLog['updated_at'])->format("Y-m-d");
            $returnHtml .= "<option value='" . $lessonLog['id'] . "'>" . ($key+1) . ". " . $lessonLog['title'] ."(". $lessonLog['subtitle'] .")－". $lessonLog['username'] . "－".$lessonLog['post_num'] . "份－" . $d . "</option>";
        }

        return $returnHtml;
    }

    public function getSchoolCode()
    {
      $teacher = Teacher::find(Auth::guard("teacher")->id());
      $school = School::where('schools.id', '=', $teacher->schools_id)->first();
      return $school->code;
    }
}

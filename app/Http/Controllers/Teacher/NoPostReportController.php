<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Sclass;
use App\Models\LessonLog;

use \DB;

class NoPostReportController extends Controller
{
    public function index() {

        $sclasses = Sclass::get();
        $classData = [];
        array_push($classData, "请选择班级");
        foreach ($sclasses as $key => $sclass) {
            // $dateDiff = date_diff($sclass['enter_school_year']."0801", date('y', time()).date('m',time())."01");
            // dd($dateDiff);
            $classData[$sclass['id']] = $sclass['enter_school_year'] . "级" . $sclass['class_title'] . "班";
        }
        return view('teacher/noPostReport/index', compact('classData'));
    }

    public function report(Request $request) {
        $sclassesId = $request->get('sclassesId');
        $lessonLogs = LessonLog::select('lesson_logs.id', 'lesson_logs.sclasses_id', 'lessons.title', 'lessons.subtitle', 'sclasses.enter_school_year', 'sclasses.class_title')
        ->leftJoin("lessons", 'lessons.id', '=', 'lesson_logs.lessons_id')
        ->leftJoin("sclasses", 'sclasses.id', '=', 'lesson_logs.sclasses_id')
        ->where(['lesson_logs.sclasses_id' => $sclassesId])->get();
        
        $unPostStudentsName = [];
        
        foreach ($lessonLogs as $key => $lessonLog) {
            $students = DB::table('students')->select('students.id', 'students.username', 'posts.storage_name', 'comments.content', 'post_rates.rate', 'posts.id as posts_id', DB::raw("COUNT(`marks`.`id`) as mark_num"))
            ->leftJoin('posts', 'posts.students_id', '=', 'students.id')
            ->leftJoin('post_rates', 'post_rates.posts_id', '=', 'posts.id')
            ->leftJoin('comments', 'comments.posts_id', '=', 'posts.id')
            ->leftJoin('marks', 'marks.posts_id', '=', 'posts.id')
            ->where(["students.sclasses_id" => $lessonLog['sclasses_id'], 'posts.lesson_logs_id' => $lessonLog['id']])
            ->where("post_rates.rate", "!=", "'优'")
            ->where('students.is_lock', "!=", "1")
            ->groupBy('students.id', 'students.username', 'posts.storage_name', 'comments.content', 'post_rates.rate', 'posts.id')
            ->orderBy(DB::raw('convert(students.username using gbk)'), "ASC")->get();
            // dd($students);
            
            
            $postedStudentsName = [];
            $allStudentsList = DB::table('students')->select('students.username')
            ->where(['students.sclasses_id' => $lessonLog['sclasses_id']])->where('students.is_lock', "!=", "1")->get();
            foreach ($students as $key => $student) {
                array_push($postedStudentsName, $student->username);
            }
            foreach ($allStudentsList as $key => $studentsName) {
                if (!in_array($studentsName->username, $postedStudentsName)) {
                    if (isset($unPostStudentsName[$studentsName->username])) {
                        $unPostStudentsName[$studentsName->username]++;
                    } else {
                        $unPostStudentsName[$studentsName->username] = 1;
                    }
                }
            }

        }
        arsort($unPostStudentsName);
        $returnHtml = "<p>合计" . count($unPostStudentsName) . "</p><ul class='list-group'>";
        $num = 1;
        foreach ($unPostStudentsName as $key => $unPostNum) {
            $returnHtml .= "<li class='list-group-item'>" . $num . ". " . $key . "<span class='badge'>" . $unPostNum . "</span></li>";
            $num++;
        }
        return ($returnHtml."</ul>");
    }
}

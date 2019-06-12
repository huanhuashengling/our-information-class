<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Sclass;
use App\Models\LessonLog;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Post;
use App\Models\PostRate;
use App\Models\Comment;
use App\Models\Group;
use App\Models\Mark;
use App\Models\Term;
use App\Models\SendMailList;

use App\Mail\PostReport;
use Carbon\Carbon;
use \DB;

class ScoreReportController extends Controller
{
    public function index() 
    {
        $userId = auth()->guard('teacher')->id();
        $teacher = Teacher::find($userId);
        $sclasses = Sclass::where(["is_graduated" => 0, "schools_id" => $teacher->schools_id])->get();
        $classData = [];
        array_push($classData, "请选择班级");
        foreach ($sclasses as $key => $sclass) {
            // $dateDiff = date_diff($sclass['enter_school_year']."0801", date('y', time()).date('m',time())."01");
            // dd($dateDiff);
            $classData[$sclass['id']] = $sclass['enter_school_year'] . "级" . $sclass['class_title'] . "班";
        }
        return view('teacher/scoreReport/index', compact('classData'));
    }

    public function getSclassTermsList(Request $request) {
        $sclassesId = $request->get('sclassesId');
        $sclass = Sclass::find($sclassesId);
        $terms = Term::where("terms.enter_school_year", '=', $sclass->enter_school_year)->get();
        return $this->buildTermsSelectionHtml($terms);
    }

    public function buildTermsSelectionHtml($terms) {
        $resultHtml = "";
        foreach ($terms as $key => $term) {
            $class = $term->is_current?"selected":"";
            $hint = $term->is_current?"（本学期）":"";
            $resultHtml .= "<option value='" . $term->id . "' " . $class . ">" . $term->grade_key . "年" . $term->term_segment . "期".$hint."</option>";
        }

        return $resultHtml;
    }

    public function report(Request $request) {
        $sclassesId = $request->get('sclassesId');
        $termsId = $request->get('termsId');
        // dd($sclassesId."-".$termsId);
        $term = Term::find($termsId);
        $from = date('Y-m-d', strtotime($term->from_date)); 
        $to = date('Y-m-d', strtotime($term->to_date));
        $lessonLogCount = LessonLog::where("lesson_logs.sclasses_id", '=', $sclassesId)->whereBetween('lesson_logs.created_at', array($from, $to))->count();
        $students = Student::where("sclasses_id", "=", $sclassesId)->where("students.is_lock", "!=", "1")->get();
        // dd($students);
        // order username postednum unpostnum rate1num rate2num rate3num rate4num commentnum marknum scorecount
        $dataset = [];
        foreach ($students as $key => $student) {
            $tData = [];
            $tData['users_id'] = $student->id;
            $tData['email'] = $student->email;
            $tData['username'] = $student->username;
            $tData['order_num'] = "-";
            if ($student->groups_id) {
                $tGroup = Group::where("id", "=", $student->groups_id)->first();
                $tData['order_num'] = $tGroup->order_num;
            }

            $tData['postedNum'] = Post::leftJoin("lesson_logs", 'lesson_logs.id', '=', 'posts.lesson_logs_id')
                                        ->where("posts.students_id", '=', $student->id)
                                        ->whereBetween('lesson_logs.created_at', array($from, $to))
                                        ->count();
            // $tData['postedNum'] 
            $posts = Post::select('posts.id', DB::raw("SUM(`marks`.`state_code`) as mark_num"))
                            ->leftJoin("marks", 'marks.posts_id', '=', 'posts.id')
                            ->leftJoin("lesson_logs", 'lesson_logs.id', '=', 'posts.lesson_logs_id')
                            ->where("posts.students_id", '=', $student->id)
                            ->where("marks.state_code", "=", 1)
                            ->whereBetween('lesson_logs.created_at', array($from, $to))
                            ->groupBy('posts.id')
                            ->get();
            $tData['markNum'] = 0;
            $tData['effectMarkNum'] = 0;
            foreach ($posts as $key => $post) {
                $tData['markNum'] += $post->mark_num;
                $tData['effectMarkNum'] += ($post->mark_num > 4)?4:$post->mark_num; 
            }
            // dd($posts);
            $tData['unPostedNum'] = $lessonLogCount - $tData['postedNum'];
            $tData['commentNum'] = Comment::leftJoin("posts", 'posts.id', '=', 'comments.posts_id')
                                            ->leftJoin("lesson_logs", 'lesson_logs.id', '=', 'posts.lesson_logs_id')
                                            ->leftJoin("students", 'students.id', '=', 'posts.students_id')
                                            ->where("posts.students_id", '=', $student->id)
                                            ->whereBetween('lesson_logs.created_at', array($from, $to))
                                            ->count();
                    
            $rates = PostRate::leftJoin("posts", 'posts.id', '=', 'post_rates.posts_id')
                                ->leftJoin("lesson_logs", 'lesson_logs.id', '=', 'posts.lesson_logs_id')
                                ->leftJoin("students", 'students.id', '=', 'posts.students_id')
                                ->where("posts.students_id", '=', $student->id)
                                ->whereBetween('lesson_logs.created_at', array($from, $to))
                                ->get();
            $tData['rateYouJiaNum'] = 0;
            $tData['rateYouNum'] = 0;
            $tData['rateDaiWanNum'] = 0;
            foreach ($rates as $key => $rate) {
                if ("优+" == $rate->rate) {
                    $tData['rateYouJiaNum'] ++;
                } elseif ("优" == $rate->rate) {
                    $tData['rateYouNum'] ++;
                } elseif ("待完" == $rate->rate) {
                    $tData['rateDaiWanNum'] ++;
                }
            }
            $tData['scoreCount'] = $tData['rateYouNum'] * 8 + $tData['effectMarkNum'] * 0.5 + $tData['rateYouJiaNum'] * 9;
            $tData['reportText'] = $tData['username'] . "同学本学期到目前为止信息课堂作业共获得：（" . $tData['rateYouJiaNum'] . "个'优＋'x9分） + （" . $tData['rateYouNum']. "个'优'x8分） ＋ （" . $tData['effectMarkNum'] . "个'有效赞'x0.5分） = 总分" . $tData['scoreCount'] . "分; 未交作业".$tData['unPostedNum'] . "个，" . $tData['rateDaiWanNum'] . "个不符合作业要求； 更详细email至：shengling_2005@163.com";
            $dataset[] = $tData;

        }
        return $dataset;
    }

    public function emailOut(Request $request)
    {
        $sclassesId = $request->get('sclassesId');
        $termsId = $request->get('termsId');
        $rowdata = $request->get('rowdata');
        $emailCount = $request->get('emailCount');

        $when = Carbon::now()->addSeconds(40);
        $sendMailList = SendMailList::where(["is_useable" => 1])->get();
        $mailDatas = [];
        foreach ($sendMailList as $key => $sendMail) {
            $mailDatas[] = ['address' => $sendMail->mail_address, 'username' => $sendMail->username, 'password' => $sendMail->auth_code];
        }
        // $mailDatas = [
        //     ['address' => "yanshanoic@126.com", 'username' => 'yanshanoic@126.com', 'password' => 'oic1234yanshan'],
        //     ['address' => "yanshanoic1@126.com", 'username' => 'yanshanoic1@126.com', 'password' => 'oic11234yanshan'],
        //     ['address' => "yanshanoic2@126.com", 'username' => 'yanshanoic2@126.com', 'password' => 'oic21234yanshan'],
        //     ['address' => "yanshanoic3@126.com", 'username' => 'yanshanoic3@126.com', 'password' => 'oic31234yanshan'],
        //     ['address' => "yanshanoic4@126.com", 'username' => 'yanshanoic4@126.com', 'password' => 'oic41234yanshan'],
        //     ['address' => "yanshanoic5@126.com", 'username' => 'yanshanoic5@126.com', 'password' => 'oic51234yanshan'],
        //     ['address' => "yanshanoic6@126.com", 'username' => 'yanshanoic6@126.com', 'password' => 'oic61234yanshan'],
        //     ['address' => "yanshanoic7@126.com", 'username' => 'yanshanoic7@126.com', 'password' => 'oic71234yanshan'],
        //     ['address' => "yanshanoic8@126.com", 'username' => 'yanshanoic8@126.com', 'password' => 'oic81234yanshan'],
        //     ];
        // $mailDatas = [
        //     ['address' => "3492490584@qq.com", 'username' => '3492490584@qq.com', 'password' => 'xmmlsfzlqzvodcaj'],
        //     ['address' => "1521419855@qq.com", 'username' => '1521419855@qq.com', 'password' => 'ccworqlfaxmejcac'],
        //     ['address' => "3411985763@qq.com", 'username' => '3411985763@qq.com', 'password' => 'oxamzmezdwrscjdi'],
        //     ['address' => "3286948136@qq.com", 'username' => '3286948136@qq.com', 'password' => 'amzfjrnbmvacchgb']
        //     ];
        
        $mailData = $mailDatas[$emailCount % count($mailDatas)];
        // var_dump($mailData);
        // $mailData = $mailDatas[0];
        config(['mail.from' => array('address' => $mailData['address'], 'name' => "燕山小学我们的信息课")]);
        config(['mail.username' => $mailData['username']]);
        config(['mail.password' => $mailData['password']]);
        // return floor($emailCount/10) . "_". $emailCount . " true";
        // var_dump($rowdata);
        // return count($mailDatas);
        // \Mail::to($rowdata["email"])->(new PostReport($termsId, $sclassesId, $rowdata));
        \Mail::to($rowdata["email"])->later($when, new PostReport($termsId, $sclassesId, $rowdata));

        if (!\Mail::failures()) {
            return $rowdata["username"] . $emailCount . " true";
        } else {
            return $rowdata["username"] . $emailCount . " false";
        }
        // try{
        //     \Mail::to($rowdata["email"])->queue(new PostReport($termsId, $sclassesId, $rowdata));
        //     return $rowdata["username"] . $emailCount . " success";
        // }catch(\Exception $e){
        //     return $rowdata["username"] . $emailCount . " failure";    
        // }
    }
}

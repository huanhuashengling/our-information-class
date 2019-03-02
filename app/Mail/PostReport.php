<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Sclass;
use App\Models\School;
use App\Models\LessonLog;
use App\Models\Student;
use App\Models\Post;
use App\Models\PostRate;
use App\Models\Comment;
use App\Models\Mark;
use App\Models\Term;

class PostReport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $termsId;
    public $sclassesId;
    public $rowdata;
    public $lessonLogs;
    public $sclass;
    public $term;

    public function __construct($termsId, $sclassesId, $rowdata)
    {
        $this->termsId = $termsId;
        $this->sclassesId = $sclassesId;
        $this->rowdata = $rowdata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $student = Student::find($this->rowdata["users_id"]);
        $this->sclass = Sclass::find($this->sclassesId);
        $school = School::find($this->sclass->schools_id);
        $middir = "/posts/" . $school->code . "/";
        $this->term = Term::find($this->termsId);
        $from = date('Y-m-d', strtotime($this->term->from_date)); 
        $to = date('Y-m-d', strtotime($this->term->to_date));
        $this->lessonLogs = LessonLog::select("lesson_logs.id", "lessons.title", "lessons.subtitle")
                    ->leftJoin("lessons", 'lessons.id', '=', 'lesson_logs.lessons_id')
                    ->where("lesson_logs.sclasses_id", '=', $this->sclassesId)
                    ->whereBetween('lesson_logs.created_at', array($from, $to))
                    ->get();
        // dd($this->term);
        // dd($this->rowdata["username"]);
        // dd($posts);

        $email = $this->view('emails.postReport')->subject($student->username . "同学" .  $this->term->grade_key."年级". $this->term->term_segment ."学期信息技术课堂作业");

        foreach ($this->lessonLogs as $key => $lessonLog) {
            $post = Post::where(["posts.lesson_logs_id" => $lessonLog->id, "posts.students_id" => $this->rowdata["users_id"]])->first();
            if (isset($post)) {
                $email->attach(public_path() . $middir . $post->storage_name, [
                        'as' => $student->username . "同学_" . $lessonLog->title. "_" . $lessonLog->subtitle . "_" . $post->original_name,
                    ]);
            } else {
                continue;
            }
        }
        // dd($email);
        return $email;
    }
}

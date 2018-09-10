<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \DB;
use App\Models\Student;
use App\Models\Sclass;
use App\Models\Post;
use App\Models\PostRate;

class ClassmateController extends Controller
{
    public function classmatePost(Request $request)
    {
        $getDataType = ($request->input('type'))?$request->input('type'):"all";
        $posts = [];

        switch ($getDataType) {
            case 'my':
                $posts = $this->getMyPostsData();
                break;
            case 'all':
                $posts = $this->getAllPostsData();
                break;
            case 'same-sclass':
                $posts = $this->getSameSclassPostsData();
                break;
            case 'same-grade':
                $posts = $this->getSameGradePostsData();
                break;
            case 'my-marked':
                $posts = $this->getMyMarkedPostsData();
                break;
            case 'most-marked':
                $posts = $this->getMostMarkedPostsData();
                break;
            case 'has-comment':
                $posts = $this->getHasCommentPostsData();
                break;
            default:
                if ("search-name" == explode("=",$getDataType)[0]) {
                    $posts = $this->getSearchNamePostsData(explode("=",$getDataType)[1]);
                }
                break;
        }
        return view('student/classmatePost', compact('posts'));
    }

    public function getMyPostsData() {
        $id = \Auth::guard("student")->id();
        $posts = Post::select('posts.id as pid', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username', DB::raw("SUM(`marks`.`state_code`) as mark_num"))
                // ->where('posts.students_id', '<>', $id)
                ->leftjoin('students', 'posts.students_id', '=', 'students.id')
                ->leftjoin('sclasses', 'students.sclasses_id', '=', 'sclasses.id')
                ->leftjoin('post_rates', 'posts.id', '=', 'post_rates.posts_id')
                ->leftjoin('marks', 'marks.posts_id', '=', 'posts.id')
                ->where('students.id', '=', $id)
                ->groupBy('posts.id', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username')
                ->orderby("posts.id", "DESC")->paginate(24);
        return $posts;
    }

    public function getAllPostsData() {
        $posts = Post::select('posts.id as pid', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username', DB::raw("SUM(`marks`.`state_code`) as mark_num"))
                // ->where('posts.students_id', '<>', $id)
                ->leftjoin('students', 'posts.students_id', '=', 'students.id')
                ->leftjoin('sclasses', 'students.sclasses_id', '=', 'sclasses.id')
                ->leftjoin('post_rates', 'posts.id', '=', 'post_rates.posts_id')
                ->leftjoin('marks', 'marks.posts_id', '=', 'posts.id')
                ->groupBy('posts.id', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username')
                ->orderby("posts.id", "DESC")->paginate(24);
        return $posts;
    }

    public function getSameSclassPostsData() {
        $id = \Auth::guard("student")->id();
        $student = Student::select('students.sclasses_id')->where('students.id', '=', $id)->first();
        $posts = Post::select('posts.id as pid', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username', DB::raw("SUM(`marks`.`state_code`) as mark_num"))
                // ->where('posts.students_id', '<>', $id)
                ->leftjoin('students', 'posts.students_id', '=', 'students.id')
                ->leftjoin('sclasses', 'students.sclasses_id', '=', 'sclasses.id')
                ->leftjoin('post_rates', 'posts.id', '=', 'post_rates.posts_id')
                ->leftjoin('marks', 'marks.posts_id', '=', 'posts.id')
                ->where('sclasses.id', '=', $student->sclasses_id)
                ->groupBy('posts.id', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username')
                ->orderby("posts.id", "DESC")->paginate(24);
        return $posts;
    }

    public function getSameGradePostsData() {
        $id = \Auth::guard("student")->id();
        $sclass = Sclass::leftjoin('students', 'students.sclasses_id', '=', 'sclasses.id')
                ->where('students.id', '=', $id)->first();
        $posts = Post::select('posts.id as pid', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username', DB::raw("SUM(`marks`.`state_code`) as mark_num"))
                // ->where('posts.students_id', '<>', $id)
                ->leftjoin('students', 'posts.students_id', '=', 'students.id')
                ->leftjoin('sclasses', 'students.sclasses_id', '=', 'sclasses.id')
                ->leftjoin('post_rates', 'posts.id', '=', 'post_rates.posts_id')
                ->leftjoin('marks', 'marks.posts_id', '=', 'posts.id')
                ->where('sclasses.enter_school_year', '=', $sclass->enter_school_year)
                ->groupBy('posts.id', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username')
                ->orderby("posts.id", "DESC")->paginate(24);
        return $posts;
    }

    public function getMyMarkedPostsData() {
        $id = \Auth::guard("student")->id();
        $posts = Post::select('posts.id as pid', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username', DB::raw("SUM(`marks`.`state_code`) as mark_num"))
                // ->where('posts.students_id', '<>', $id)
                ->leftjoin('students', 'posts.students_id', '=', 'students.id')
                ->leftjoin('sclasses', 'students.sclasses_id', '=', 'sclasses.id')
                ->leftjoin('post_rates', 'posts.id', '=', 'post_rates.posts_id')
                ->leftjoin('marks', 'marks.posts_id', '=', 'posts.id')
                ->where('marks.students_id', '=', $id)
                ->groupBy('posts.id', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username')
                ->orderby("posts.id", "DESC")->paginate(24);
        return $posts;
    }

    public function getMostMarkedPostsData() {
        $id = \Auth::guard("student")->id();
        $posts = Post::select('posts.id as pid', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username', DB::raw("SUM(`marks`.`state_code`) as mark_num"))
                // ->where('posts.students_id', '<>', $id)
                ->leftjoin('students', 'posts.students_id', '=', 'students.id')
                ->leftjoin('sclasses', 'students.sclasses_id', '=', 'sclasses.id')
                ->leftjoin('post_rates', 'posts.id', '=', 'post_rates.posts_id')
                ->leftjoin('marks', 'marks.posts_id', '=', 'posts.id')
                ->groupBy('posts.id', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username')
                ->orderby("mark_num", "DESC")->paginate(24);
        return $posts;
    }

    public function getHasCommentPostsData() {
        $id = \Auth::guard("student")->id();
        $posts = Post::select('posts.id as pid', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username', 'comments.id as cid', DB::raw("SUM(`marks`.`state_code`) as mark_num"))
                // ->where('posts.students_id', '<>', $id)
                ->leftjoin('students', 'posts.students_id', '=', 'students.id')
                ->leftjoin('sclasses', 'students.sclasses_id', '=', 'sclasses.id')
                ->leftjoin('post_rates', 'posts.id', '=', 'post_rates.posts_id')
                ->leftjoin('marks', 'marks.posts_id', '=', 'posts.id')
                ->leftjoin('comments', 'comments.posts_id', '=', 'posts.id')
                ->groupBy('posts.id', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username', 'comments.id')
                ->orderby("cid", "DESC")->paginate(24);
        return $posts;
    }

    public function getSearchNamePostsData($searchName) {
        $posts = Post::select('posts.id as pid', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username', 'comments.id as cid', DB::raw("SUM(`marks`.`state_code`) as mark_num"))
                ->leftjoin('students', 'posts.students_id', '=', 'students.id')
                ->leftjoin('sclasses', 'students.sclasses_id', '=', 'sclasses.id')
                ->leftjoin('post_rates', 'posts.id', '=', 'post_rates.posts_id')
                ->leftjoin('marks', 'marks.posts_id', '=', 'posts.id')
                ->leftjoin('comments', 'comments.posts_id', '=', 'posts.id')
                ->where('students.username', 'like', '%'.$searchName.'%')
                ->groupBy('posts.id', 'sclasses.class_title', 'sclasses.enter_school_year', 'post_rates.rate', 'posts.file_ext', 'posts.storage_name', 'students.username', 'comments.id')
                ->orderby("cid", "DESC")->paginate(24);
        return $posts;
    }
}

<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Work;
use App\Models\Student;
use App\Models\School;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use \Auth;
use \Storage;
use EndaEditor;

class WorkController extends Controller
{
    public function index()
    {
        $id = \Auth::guard("student")->id();
        $student = Student::find($id);
        $workNum = Work::where(["students_id" => $id])->count();
        $clickAble = ($student->work_max_num <= $workNum)?"disabled":"";
        // $sclass = Sclass::find($student->sclasses_id);
        // $terms = Term::where(['enter_school_year' => $sclass->enter_school_year])->get();
        return view('student/work/index', compact("id", "clickAble"));
    }

    public function workList()
    {
        $id = \Auth::guard("student")->id();
        $works = Work::where(["students_id" => $id])->get();
        // dd($works);
        return $works;
    }

    public function create()
    {
        return view('student/work/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:works|max:255',
            'description' => 'required',
            'work_idea' => 'required',
        ]);

        $studentsId = Auth::guard('student')->id();
        $tWorkNum = Work::where("students_id", '=', $studentsId)->count();
        
        $work = new Work;
        $work->title = $request->get('title');
        $work->description = $request->get('description');
        $work->work_idea = $request->get('work_idea');
        $work->students_id = $studentsId;
        $work->updated_num = 1;
        $work->is_open = 2;
        $work->order_num = $tWorkNum + 1;
        // dd($work);
        if ($work->save()) {
            return redirect('student/work');
        } else {
            return redirect()->back()->withInput()->withErrors('新建失败！');
        }
    }

    public function edit(Request $request, $id)
    {
        return view('student/work/edit')->withWork(Work::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:works,title,'.$id.'|max:25',
            'description' => 'required',
            'work_idea' => 'required',
            'order_num' => 'required|integer',
        ]);
        $studentsId = Auth::guard('student')->id();
        $tWorkNum = Work::where("students_id", '=', $studentsId)->count();

        $isOpen = ("on" == $request->get('is_open'))?1:2;
        $work = Work::find($id);
        $work->title = $request->get('title');
        $work->description = $request->get('description');
        $work->work_idea = $request->get('work_idea');
        $work->updated_num = $work->updated_num + 1;
        $work->is_open = $isOpen;
        $work->order_num = $request->get('order_num');

        if ($work->update()) {
            return redirect('student/work');
        } else {
            return redirect()->back()->withInput()->withErrors('修改失败！');
        }
    }

    public function uploadCover(Request $request)
    {
        $coverFile = $request->file('cover-source');
        if(!$coverFile) {
            return Redirect::to('student/work')->with('danger', '请重新选择作业提交！');
        }
        $work = Work::find($request->get('worksId'));
        $oldCoverFileName = $work->cover_name;
        if ($coverFile->isValid()) {
            // 原文件名
            $originalName = $coverFile->getClientOriginalName();
            // $bytes = File::size($filename);
            // 扩展名
            $ext = $coverFile->getClientOriginalExtension();
            // $originalName = str_replace($originalName, ".".$ext);
            // MimeType
            $type = $coverFile->getClientMimeType();
            // dd($originalName);
            // 临时绝对路径
            $realPath = $coverFile->getRealPath();

            $uniqid = uniqid();
            $filename = $originalName . '-' . $uniqid . '.' . $ext;
            
            $bool = Storage::disk($this->getSchoolCode() . 'cover')->put($filename, file_get_contents($realPath));

            $work->cover_name = $filename;
            $work->updated_num += 1;
            if ($work->update() && $bool) {
                $bool = Storage::disk($this->getSchoolCode() . 'cover')->delete($oldCoverFileName);
            }
        }
        
        return '{}';
    }

    public function uploadWork(Request $request)
    {
        $workFile = $request->file('work-source');
        if(!$workFile) {
            return Redirect::to('student/work')->with('danger', '请重新选择作业提交！');
        }
        $work = Work::find($request->get('worksId'));
        $oldWorkFileName = $work->work_name;
        if ($workFile->isValid()) {
            // 原文件名
            $originalName = $workFile->getClientOriginalName();
            // $bytes = File::size($filename);
            // 扩展名
            $ext = $workFile->getClientOriginalExtension();
            // $originalName = str_replace($originalName, ".".$ext);
            // MimeType
            $type = $workFile->getClientMimeType();
            // dd($originalName);
            // 临时绝对路径
            $realPath = $workFile->getRealPath();

            $uniqid = uniqid();
            $filename = $originalName . '-' . $uniqid . '.' . $ext;

            $bool = Storage::disk($this->getSchoolCode() . 'works')->put($filename, file_get_contents($realPath)); 

            $work->work_name = $filename;
            $work->updated_num += 1;
            $work->file_ext = $ext;
            $work->mime_type = $type;
            $work->work_code = $uniqid;

            if ($work->update() && $bool) {
                $bool = Storage::disk($this->getSchoolCode() . 'works')->delete($oldWorkFileName);
            }
        }
        return '{}';
    }

    public function getSchoolCode()
    {
      $student = Student::find(Auth::guard("student")->id());

      $school = School::leftJoin('sclasses', 'sclasses.schools_id', '=', "schools.id")
              ->where('sclasses.id', '=', $student->sclasses_id)->first();
      return $school->code;
    }
}

<?php

namespace App\Http\Controllers\School;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Sclass;
use App\Models\Lesson;
use App\Models\Post;
use App\Models\Group;
use App\Models\Mark;
use App\Models\Term;
use \DB;

class GroupController extends Controller
{
    public function index()
    {
        $schoolsId = \Auth::guard("school")->id();
        $sclassesData = Sclass::select('sclasses.class_title', 'sclasses.enter_school_year', 'sclasses.id', DB::raw('count(students.id) as count'))
                              ->leftJoin('students', function($join) {
                                  $join->on('students.sclasses_id', '=', 'sclasses.id');
                              })
                              ->leftJoin('schools', function($join) {
                                  $join->on('schools.id', '=', 'sclasses.schools_id');
                              })
                              ->where('sclasses.is_graduated', '=', 0)
                              ->where('schools.id', '=', $schoolsId)
                              ->groupBy('sclasses.class_title', 'sclasses.enter_school_year', 'sclasses.id')
                              ->orderBy('sclasses.id')
                              ->get();
        foreach ($sclassesData as $key => $item) {
            $sclassesData[$key]["title"] = $item['enter_school_year'] . "级" . $item["class_title"] . "班";
        }
        // dd($sclassesData);

        return view('school/group/index', compact('sclassesData'));
    }

    public function getGroupsInSclass(Request $request)
    {
        $sclasses_id = $request->get("sclasses_id");
        $groups = Group::select("groups.id", "groups.name", "groups.order_num", "sclasses.id as sclasses_id", "sclasses.class_title", "sclasses.enter_school_year", DB::raw("COUNT(`students`.`id`) as student_num"))
                        ->leftJoin('sclasses', function($join) {
                                  $join->on('groups.sclasses_id', '=', 'sclasses.id');
                              })
                        ->leftJoin('students', function($join) {
                                  $join->on('students.groups_id', '=', 'groups.id');
                              })
                        ->where("sclasses.id", "=", $sclasses_id)
                        ->groupBy("groups.id", "groups.name", "sclasses.id", "groups.order_num", "sclasses.class_title", "sclasses.enter_school_year")
                        ->get();
        return $groups;
    }

    public function createGroupInSclass(Request $request)
    {
        $sclasses_id = $request->get("sclasses_id");
        $group_desc = $request->get("group_desc");
        $group_name = $request->get("group_name");
        $order_num = $request->get("order_num");

        $group = new Group();
        $group->sclasses_id = $sclasses_id;
        $group->name = $group_name;
        $group->order_num = $order_num;
        $group->description = $group_desc;
        $group->save();
    }

    public function getStudentsInGroup(Request $request)
    {
        $groupsId = $request->get("groupsId");
        $students = Student::where("groups_id", "=", $groupsId)->orderBy("order_in_group", "ASC")->get();
        return $students;
    }

    public function getStudentsInSclassButNotInGroupsBtns(Request $request)
    {
        $sclassesId = $request->get("sclasses_id");
        $groups = Group::select("id")->where("sclasses_id", "=", $sclassesId)->get();
        $groupArr = [];
        foreach ($groups as $key => $group) {
            array_push($groupArr, $group->id);
        }
        // dd($groupArr);
        $students = Student::select("id", "username")
                    ->where("sclasses_id", "=", $sclassesId)
                    ->where(function($q) use ($groupArr) {
                          $q->where("groups_id", "=", NULL)
                            ->orWhereNotIn("groups_id", $groupArr);
                      })->get();
        $returnHtml = "";
        foreach ($students as $key => $student) {
            $returnHtml .= "<button class='btn btn-primary student-btn' value='" . $student->id . "'>" . $student->username . "</button>";
        }
        return $returnHtml;
    }

    public function addOneStudentIntoGroup(Request $request)
    {
        $groupsId = $request->get("groups_id");
        $studentsId = $request->get("students_id");
        $orderInGroup = $request->get("order_in_group");

        $student = Student::find($studentsId);
        $student->groups_id = $groupsId;
        $student->order_in_group = $orderInGroup;
        $student->update();
    }

    public function removeOneGroup(Request $request)
    {
        $groupsId = $request->get("groups_id");
        $students = Student::where("groups_id", "=", $groupsId)->get();
        foreach ($students as $key => $student) {
            $this->removeOneStudentOutGroupLocal($student->id);
        }
        $group = Group::find($groupsId);
        $group->delete();
    }

    public function removeOneStudentOutGroup(Request $request)
    {
        $studentsId = $request->get("students_id");
        $this->removeOneStudentOutGroupLocal($studentsId);
    }

    public function removeOneStudentOutGroupLocal($id)
    {
        $student = Student::find($id);
        $student->groups_id = null;
        $student->order_in_group = null;
        $student->update();
    }
}

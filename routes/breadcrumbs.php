<?php

Breadcrumbs::register('open-classroom', function ($breadcrumbs) {
    $breadcrumbs->push('开放课堂', url("/student/open-classroom"));
});

Breadcrumbs::register('course', function ($breadcrumbs, $course) {
    $breadcrumbs->parent('open-classroom');
    $breadcrumbs->push($course->title, url('/student/open-classroom/course', $course->id));
});

Breadcrumbs::register('unit', function ($breadcrumbs, $unit) {
    $breadcrumbs->parent('course', $unit->course);
    $breadcrumbs->push($unit->title, url('/student/open-classroom/unit', $unit->id));
});

Breadcrumbs::register('lesson', function ($breadcrumbs, $lesson) {
    $breadcrumbs->parent('unit', $lesson->unit);
    $breadcrumbs->push($lesson->title, url('open-classroom/lesson', $lesson->id));
});



Breadcrumbs::register('course-manage', function ($breadcrumbs) {
    $breadcrumbs->push('课程列表', url("/teacher/course"));
});

Breadcrumbs::register('tcourse', function ($breadcrumbs, $course) {
    $breadcrumbs->parent('course-manage');
    $breadcrumbs->push($course->title . ' 课程', url('/teacher/unit?cId='.$course->id, $course->id));
});

Breadcrumbs::register('tunit', function ($breadcrumbs, $unit) {
    $breadcrumbs->parent('tcourse', $unit->course);
    $breadcrumbs->push($unit->title . ' 单元', url('/teacher/lesson?uId='.$unit->id, $unit->id));
});
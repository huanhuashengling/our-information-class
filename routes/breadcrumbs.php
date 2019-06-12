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
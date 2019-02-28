@extends('layouts.admin')

@section('content')
<div class="container">
    <table id="lesson-log-list" class="table table-condensed table-responsive">
        <thead>
            <tr>
                <th data-field="" checkbox="true">

                </th>
                <th data-field="">
                    序号
                </th>
                <th data-field="class_title" data-sortable="true" data-formatter="classTitleCol">
                    上课的班级
                </th>
                <th data-field="username" data-sortable="true">
                    执教老师
                </th>
                <th data-field="title" data-sortable="true">
                    课题
                </th>
                <th data-field="subtitle" data-sortable="true">
                    副标题
                </th>
                <th data-field="updated_at" data-sortable="true">
                    上课时间
                </th>
                <th data-field="post_num" data-sortable="true">
                    提交作业数
                </th>
                <th data-field="studentsId" data-formatter="actionCol" data-events="actionEvents">
                  操作
                </th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('scripts')
    <script src="/js/school/lesson-log.js"></script>
@endsection

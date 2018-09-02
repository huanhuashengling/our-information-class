@extends('layouts.teacher')

@section('content')
<div class="container">
    <div id="toolbar">
        <button class="btn btn-success" id="add-unit-btn">新增单元</button>
    </div>
    <table id="unit-list" class="table table-condensed table-responsive">
        <thead>
            <tr>
                <th data-field="" checkbox="true">

                </th>
                <th data-field="">
                    序号
                </th>
                <th data-field="title" data-sortable="true" data-formatter="courseTitleCol">
                    所属课程
                </th>
                <th data-field="title" data-sortable="true">
                    标题
                </th>
                <th data-field="description" data-sortable="true">
                    描述
                </th>
                <th data-field="updated_at" data-sortable="true">
                    创建时间
                </th>
                <th data-field="coursesId" data-formatter="actionCol" data-events="actionEvents">
                  操作
                </th>
            </tr>
        </thead>
    </table>

</div>
@endsection

@section('scripts')
    <script src="/js/teacher/unit.js"></script>
@endsection
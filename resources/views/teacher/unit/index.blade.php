@extends('layouts.teacher')

@section('content')
<div class="container">
    {!! Breadcrumbs::render('tcourse', $course) !!}

    <div id="toolbar">
        <button class="btn btn-success" id="add-unit-btn">新增单元</button>
        <input type="hidden" name="" id="courses-id" value="{{$cId}}">
    </div>
    <table id="unit-list" class="table table-condensed table-responsive">
        <thead>
            <tr>
                <th data-field="" checkbox="true">

                </th>
                <th data-field="">
                    序号
                </th>
                <!-- <th data-field="course_title" data-sortable="true">
                    所属课程
                </th> -->
                <th data-field="title" data-sortable="true">
                    标题
                </th>
                <th data-field="description" data-sortable="true" data-formatter="descCol">
                    描述
                </th>
                <th data-field="is_open" data-sortable="true" data-formatter="isOpenCol">
                    开放
                </th>
                <th data-field="username" data-sortable="true">
                    创建人
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
    <script src="/js/teacher/unit.js?v={{rand()}}"></script>
@endsection
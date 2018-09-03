@extends('layouts.teacher')

@section('content')
<div class="container">
    <div id="toolbar">
        <button class="btn btn-success" id="add-lesson-btn">新增课</button>
    </div>
    <table id="lesson-list" class="table table-condensed table-responsive">
        <thead>
            <tr>
                <th data-field="" checkbox="true">

                </th>
                <th data-field="">
                    序号
                </th>
                <th data-field="course_title" data-sortable="true">
                    所属课程
                </th>
                <th data-field="unit_title" data-sortable="true">
                    所属单元
                </th>
                <th data-field="title" data-sortable="true">
                    标题
                </th>
                <th data-field="subtitle" data-sortable="true">
                    副标题
                </th>
                <th data-field="username" data-sortable="true">
                    创建者
                </th>
                <th data-field="lesson_log_num" data-sortable="true">
                    上课次数
                </th>
                <th data-field="updated_at" data-sortable="true">
                    创建时间
                </th>
                <th data-field="lessonsId" data-formatter="actionCol" data-events="actionEvents">
                  操作
                </th>
            </tr>
        </thead>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="lesson-detail-modal" tabindex="-2" role="dialog" aria-labelledby="lesson-detail-modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="lesson-detail-title">查看课程内容</h4>
          </div>
          <div class="modal-body" id="lesson-detail-help-md-doc">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="/js/teacher/lesson.js"></script>
@endsection
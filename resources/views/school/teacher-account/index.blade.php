@extends('layouts.admin')

@section('content')
<div class="container">

<div class="panel panel-success col-md-12">
  <div class="panel-heading">管理教师账户列表</div>
  <div class="panel-body">
    <div id="toolbar">
        <button id="lock-btn" class="btn btn-danger">锁定</button>
        <button id="active-btn" class="btn btn-danger">激活</button>
        <button id="reset-pass-btn" class="btn btn-success">重置密码</button>
        <button id="add-new-btn" class="btn btn-success" value="{{ $schoolsId }}">新增教师</button>
    </div>
    <table id="teacher-list" class="table table-condensed table-responsive">
        <thead>
            <tr>
              <th data-field="" checkbox="true">
                  
              </th>
              <th data-field="">
                  序号
              </th> 
              <th data-field="title">
                  学校
              </th>
              <th data-field="username">
                  姓名
              </th>
              <th data-field="email">
                  邮箱
              </th>
              <th data-field="users_id" data-formatter="resetCol" data-events="resetActionEvents">
                  重置密码
              </th>
              <th data-field="teachersId" data-formatter="teacherAccountActionCol" data-events="teacherAccountActionEvents">
                  操作
              </th> 
            </tr>
        </thead>
    </table>
  </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="add-new-teacher-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">增加教师</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>教师姓名</label>
                <input type="text" class="form-control" name="teacherName" id="teacher-name" required="">
              </div>
              <div class="form-group">
                <label>教师邮箱</label>
                <input type="text" class="form-control" name="email" id="email" required="">
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-success" id="confirm-add-new-btn">增加</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <link href="/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/fileinput.min.js"></script>
    <script src="/js/locales/zh.js"></script>
    <script src="/js/school/teacher-account.js?v={{rand()}}"></script>
@endsection

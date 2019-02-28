@extends('layouts.district')

@section('content')
<div class="container">
<div class="panel panel-success col-md-12">
  <div class="panel-heading">学校管理员账户列表</div>
  <div class="panel-body">
    <div id="toolbar">
        <button id="lock-btn" class="btn btn-danger">锁定</button>
        <button id="active-btn" class="btn btn-danger">激活</button>
        <button id="reset-pass-btn" class="btn btn-success">重置密码</button>
        <button id="add-new-btn" class="btn btn-success">新增学校管理账户</button>
    </div>
    <table id="school-list" class="table table-condensed table-responsive">
        <thead>
            <tr>
              <th data-field="" checkbox="true">
                  
              </th>
              <th data-field="">
                  序号
              </th> 
              <th data-field="district_title">
                  区名称
              </th>
              <th data-field="title">
                  学校名称
              </th>
              <th data-field="code">
                  学校代码
              </th>
              <th data-field="username">
                  用户名
              </th>
              <th data-field="display_name">
                  显示名字
              </th>
              <th data-field="users_id" data-formatter="resetCol" data-events="resetActionEvents">
                  重置密码
              </th>
              <th data-field="schoolsId" data-formatter="schoolAccountActionCol" data-events="schoolAccountActionEvents">
                  操作
              </th> 
            </tr>
        </thead>
    </table>
  </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="add-new-school-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">增加学校管理账户</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>登录名</label>
                <input type="text" class="form-control" name="username" id="school-name" required="">
              </div>
              <div class="form-group">
                <label>显示名称</label>
                <input type="text" class="form-control" name="displayName" id="display-name" required="">
              </div>
              <div class="form-group">
                <label>学校名称</label>
                <input type="text" class="form-control" name="schoolName" id="school-name" required="">
              </div>
              <div class="form-group">
                <label>学校代码(唯一标识)</label>
                <input type="text" class="form-control" name="schoolCode" id="school-code" required="">
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
    <script src="/js/district/school.js"></script>
@endsection

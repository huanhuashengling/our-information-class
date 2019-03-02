@extends('layouts.admin')

@section('content')
<div class="container">

<div class="panel panel-success col-md-6">
  <div class="panel-heading">导入学生账户</div>
  <div class="panel-body">
    {!! Form::open(array('url'=>'school/importStudents','method'=>'POST','files'=>'true')) !!}
    {!! Form::file('xls', ['id' => 'import-student-account', 'type'=>"file", 'class'=>"file-loading"]) !!}
    {!! Form::close() !!}
  </div>
</div>
<div class="panel panel-success col-md-6">
  <div class="panel-heading">导入学生邮箱</div>
  <div class="panel-body">
    {!! Form::open(array('url'=>'school/updateStudentEmail','method'=>'POST','files'=>'true')) !!}
    {!! Form::file('xls', ['id' => 'update-student-email', 'type'=>"file", 'class'=>"file-loading"]) !!}
    {!! Form::close() !!}
  </div>
</div>
<div class="panel panel-success col-md-12">
  <div class="panel-heading">管理学生账户</div>
  <div class="panel-body">

  @foreach ($sclassesData as $sclass)
      <button class="btn btn-info sclass-btn" value="{{ $sclass['id'] }}">{{ $sclass['title'] }} <span class="badge">{{ $sclass['count'] }}</span></button>
  @endforeach

  </div>
</div>

<div class="panel panel-success col-md-12">
  <div class="panel-heading">班级学生账户列表</div>
  <div class="panel-body">
    <div id="toolbar">
        <button id="lock-btn" class="btn btn-danger">锁定</button>
        <button id="active-btn" class="btn btn-danger">激活</button>
        <button id="reset-pass-btn" class="btn btn-success">重置密码</button>
        <button id="add-new-btn" class="btn btn-success hidden">新增学生</button>
    </div>
    <table id="student-list" class="table table-condensed table-responsive">
        <thead>
            <tr>
              <th data-field="" checkbox="true">
                  
              </th>
              <th data-field="">
                  序号
              </th> 
              <th data-field="class_title" data-formatter="classTitleCol">
                  班级
              </th>
              <th data-field="username">
                  姓名
              </th>
              <th data-field="gender" data-formatter="genderCol">
                  性别
              </th>
              <th data-field="score">
                  分数
              </th>
              <th data-field="level">
                  等级
              </th>
              <th data-field="email">
                  邮箱
              </th>
              <th data-field="users_id" data-formatter="resetCol" data-events="resetActionEvents">
                  重置密码
              </th>
              <th data-field="studentsId" data-formatter="studentAccountActionCol" data-events="studentAccountActionEvents">
                  操作
              </th> 
            </tr>
        </thead>
    </table>
  </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="add-new-student-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">增加学生</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>学生姓名</label>
                <input type="text" class="form-control" name="studentName" id="student-name" required="">
              </div>
              <div class="form-group">
                <label>学生性别（1为男生／0为女生）</label>
                <input type="text" class="form-control" name="gender" id="gender" required="">
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
    <script src="/js/school/student-account.js"></script>
@endsection

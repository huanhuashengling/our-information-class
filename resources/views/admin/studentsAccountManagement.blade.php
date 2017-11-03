@extends('layouts.admin')

@section('content')
<div class="container">

<div class="panel panel-success">
  <div class="panel-heading">导入学生账户</div>
  <div class="panel-body">
    {!! Form::open(array('url'=>'admin/importStudents','method'=>'POST','files'=>'true')) !!}
    {!! Form::file('xls', ['id' => 'import-student-account', 'type'=>"file", 'class'=>"file-loading"]) !!}
    {!! Form::close() !!}
  </div>
</div>

<div class="panel panel-success">
  <div class="panel-heading">管理学生账户</div>
  <div class="panel-body">

  @foreach ($sclassesData as $sclass)
      <button class="btn btn-info school-class-btn" value="{{ $sclass['title'] }}">{{ $sclass['title'] }} <span class="badge">{{ $sclass['count'] }}</span></button>
  @endforeach

  </div>
</div>

<div class="panel panel-success">
  <div class="panel-heading">班级学生账户列表</div>
  <div class="panel-body">
    <div id="toolbar">
        <button id="remove-btn" class="btn btn-danger">锁定</button>
        <button id="remove-btn" class="btn btn-danger">激活</button>
        <button id="remove-btn" class="btn btn-success">重置密码</button>
        <button id="remove-btn" class="btn btn-success">新增学生</button>
    </div>
    <table id="student-list" class="table table-condensed table-responsive">
        <thead>
            <tr>
              <th data-field="" checkbox="true">
                  
              </th>
              <th data-field="">
                  序号
              </th>
              <th data-field="title">
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
              <th data-field="users_id" data-formatter="resetCol" data-events="resetActionEvents">
                  重置密码
              </th>
              <th data-field="users_id" data-formatter="actionCol" data-events="actionEvents">
                  操作
              </th> 
            </tr>
        </thead>
    </table>
  </div>
</div>
</div>
@endsection

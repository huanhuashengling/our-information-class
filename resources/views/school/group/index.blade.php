@extends('layouts.admin')

@section('content')
<div class="container">
<div class="panel panel-success col-md-12">
  <div class="panel-heading">管理学生账户</div>
  <div class="panel-body">

  @foreach ($sclassesData as $sclass)
      <button class="btn btn-info sclass-btn" value="{{ $sclass['id'] }}">{{ $sclass['title'] }} <span class="badge">{{ $sclass['count'] }}</span></button>
  @endforeach

  </div>
</div>

    <div class="panel panel-success col-md-6">
      <div class="panel-heading" id="group-list-title">班级分组列表</div>
      <div class="panel-body">
        <div id="toolbar1">
            <button id="create-group-btn" class="btn btn-danger">新建小组</button>
        </div>
        <table id="group-list" class="table table-condensed table-responsive">
            <thead>
                <tr>
                  <th data-field="" checkbox="true">
                      
                  </th>
                  <th data-field="">
                      序号
                  </th> 
                  <th data-field="name">
                      组名
                  </th>
                  <th data-field="order_num">
                      组号
                  </th>
                  <th data-field="student_num">
                      组员数
                  </th>
                  <th data-field="studentsId" data-formatter="groupActionCol" data-events="groupActionEvents">
                      操作
                  </th> 
                </tr>
            </thead>
        </table>
      </div>
    </div>

    <div class="panel panel-success col-md-6">
      <div class="panel-heading">组内学生列表</div>
      <div class="panel-body">
        <div id="toolbar2">
            <button id="add-student-btn" class="btn btn-danger">添加学生</button>
        </div>
        <table id="student-list" class="table table-condensed table-responsive">
            <thead>
                <tr>
                  <th data-field="" checkbox="true">
                      
                  </th>
                  <th data-field="">
                      序号
                  </th> 
                  <th data-field="username">
                      姓名
                  </th>
                  <th data-field="gender" data-formatter="genderCol">
                      性别
                  </th>
                  <th data-field="order_in_group">
                      组内顺序
                  </th>
                  <th data-field="studentsId" data-formatter="studentActionCol" data-events="studentActionEvents">
                      操作
                  </th> 
                </tr>
            </thead>
        </table>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add-new-group-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">增加小组</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>小组名称</label>
                <input type="text" class="form-control" name="groupName" id="group-name" required="">
              </div>
              <div class="form-group">
                <label>小组描述</label>
                <input type="text" class="form-control" name="groupDesc" id="group-desc" required="">
              </div>
              <div class="form-group">
                <label>组序号</label>
                <input type="text" class="form-control" name="orderNum" id="order-num" required="">
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-success" id="confirm-add-new-btn">增加</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add-students-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">批量添加学生</h4>
            </div>
            <div class="modal-body">
              <div id="student-list-btn"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <link href="/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/fileinput.min.js"></script>
    <script src="/js/locales/zh.js"></script>
    <script src="/js/school/group.js?v={{rand()}}"></script>
@endsection

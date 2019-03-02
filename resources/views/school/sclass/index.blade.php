@extends('layouts.admin')

@section('content')
<div class="container">
<div class="panel panel-success col-md-12">
  <div class="panel-heading">学校班级列表</div>
  <div class="panel-body" style="padding-left: 0px; padding-right: 0px">
    <div id="sclass-toolbar">
        <button id="add-new-btn" class="btn btn-success">新增班级</button>
    </div>
    <table id="sclass-list" class="table table-condensed table-responsive">
        <thead>
            <tr>
              <th data-field="" checkbox="true">
                  
              </th>
              <th data-field="">
                  序号
              </th>
              <th data-field="id">
                  班级ID
              </th>
              <th data-field="enter_school_year">
                  入学年
              </th>
              <th data-field="class_num">
                  编号
              </th>
              <th data-field="class_title">
                  名称
              </th>
              <th data-field="is_graduated" data-formatter="graduatedCol">
                  毕业标志
              </th>
              <th data-field="id" data-formatter="sclassActionCol" data-events="classActionEvents">
                  操作
              </th> 
            </tr>
        </thead>
    </table>
  </div>
</div>

<div class="panel panel-success col-md-12">
  <div class="panel-heading">年级学期设置</div>
  <div class="panel-body" style="padding-left: 0px; padding-right: 0px">
    <div id="term-toolbar">
        <button id="add-new-term-btn" class="btn btn-success">新增学期</button>
    </div>
    <table id="term-list" class="table table-condensed table-responsive" >
        <thead>
            <tr>
              <th data-field="" checkbox="true">
                  
              </th>
              <th data-field="">
                  序号
              </th> 
              <th data-field="enter_school_year">
                  入学年
              </th>
              <th data-field="grade_key">
                  年级名称
              </th>
              <th data-field="term_segment">
                    学期名称
              </th>
              <th data-field="from_date">
                    开始时间
              </th>
              <th data-field="to_date">
                    结束时间
              </th>
              <th data-field="is_current" data-formatter="graduatedCol">
                    当前学期
              </th>
              <th data-field="id" data-formatter="sclassActionCol" data-events="classActionEvents">
                  操作
              </th> 
            </tr>
        </thead>
    </table>
  </div>
</div>


</div>

<!-- Modal -->
<div class="modal fade" id="add-new-sclass-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <input type="hidden" name="schoolsId" id="schools-id" value="{{ $schoolsId}}">
                <h4 class="modal-title" id="myModalLabel">增加班级</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>入学年</label>
                <input type="text" class="form-control" name="enterSchoolYear" id="enter-school-year" required="">
              </div>
              <div class="form-group">
                <label>编号</label>
                <input type="text" class="form-control" name="classNum" id="class-num" required="">
              </div>
              <div class="form-group">
                <label>名称</label>
                <input type="text" class="form-control" name="classTitle" id="class-title" required="">
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
    <script src="/js/school/sclass.js"></script>
@endsection

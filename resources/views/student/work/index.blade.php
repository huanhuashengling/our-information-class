@extends('layouts.student')

@section('content')
<div class="container">
    <div id="toolbar">
        <button class="btn btn-success" id="add-work-btn" {{$clickAble}}>添加新的作品</button>
        <a class="btn btn-info" href="/space?sId={{$id}}" target="_blank">预览个人主页</a>
        <input type="hidden" name="" id="works-id">
        <input type="hidden" name="" id="prefix" value="{{$prefix}}">
    </div>
    <table id="work-list" class="table table-condensed table-responsive" style="word-break:break-all; word-wrap:break-all;">
        <thead>
            <tr>
                <th data-field="" checkbox="true">

                </th>
                <th data-field="">
                    序号
                </th>
                <th data-field="title" data-sortable="true">
                    标题
                </th>
                <th data-field="work_idea" data-sortable="true" data-formatter="ideaCol">
                    创想
                </th>
                <th data-field="description" data-sortable="true" data-formatter="descCol">
                    描述
                </th>
                <th data-field="order_num" data-sortable="true">
                    显示序号
                </th>
                <th data-field="is_open" data-sortable="true" data-formatter="openCol">
                    是否显示
                </th>
                <th data-field="updated_num" data-sortable="true">
                    更新次数
                </th>
                <th data-field="click_num" data-sortable="true">
                    点击次数
                </th>
                <th data-field="works_id" data-formatter="actionCol" data-events="actionEvents">
                  操作
                </th>
            </tr>
        </thead>
    </table>
</div>

<div class="modal fade" id="cover-upload-modal" tabindex="-1" role="dialog" aria-labelledby="coverUploadModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="">上传作品封面</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('url'=>'student/upload-cover','method'=>'POST', 'files'=>true)) !!}
          <input type="hidden" name="works_id" value="">
          {!! Form::file('cover-source', ['id' => 'cover-upload']) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="work-upload-modal" tabindex="-1" role="dialog" aria-labelledby="workUploadModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="">上传作品文件</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('url'=>'student/upload-work','method'=>'POST', 'files'=>true)) !!}
          <input type="hidden" name="works_id" value="">
          {!! Form::file('work-source', ['id' => 'work-upload']) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
    <link href="/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/fileinput.min.js"></script>
    <script src="/js/locales/zh.js"></script>
    <script src="/js/student/works.js?v={{rand()}}"></script>
    <style type="text/css">
      .AutoNewline 
      { 
        Word-break: break-all;/*必须*/ 
      } 
    </style>
@endsection
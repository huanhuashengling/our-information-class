@extends('layouts.admin')

@section('content')
@php
@endphp
<div class="container">
  <div id="toolbar">
    <form class="form-inline">
      <div class="form-group">
        <select class="form-control" id="classes-selection">
          <option value="0">选择班级</option>
          <option value="1">四甲班</option>
          <option value="2">四乙班</option>
          <option value="3">四丙班</option>
          <option value="4">四丁班</option>
          <option value="5">五甲班</option>
          <option value="6">五乙班</option>
          <option value="7">五丙班</option>
          <option value="8">五丁班</option>
          <option value="9">六甲班</option>
          <option value="10">六乙班</option>
          <option value="11">六丙班</option>
          <option value="12">六丁班</option>
      </select>
  </div>
  <div class="form-group">
    <select class="form-control" id="lesson-log-selection">
      <option>选择上课记录</option>
  </select>
</div>
<a id="export-btn" class="btn btn-success">创建导出链接</a>
<a id="clear-btn" class="btn btn-danger">清除zip</a>
<div id="export-url"></div>
</form>
</div>
<table id="posts-list" class="table table-condensed table-responsive">
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
      <th data-field="original_name">
          文件名
      </th>
      <th data-field="rate">
          等第
      </th>
      <th data-field="content" data-formatter="commentCol">
          有无评论
      </th>
      <th data-field="mark_num">
          点赞数
      </th>
  </tr>
</thead>
</table>

</div>
@endsection

@section('scripts')
    <script src="/js/school/export-post.js"></script>
@endsection

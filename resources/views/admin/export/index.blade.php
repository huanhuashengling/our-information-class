@extends('layouts.admin')

@section('content')
<div class="container">
  <div id="toolbar">
    <form class="form-inline">
      <div class="form-group">
        <select class="form-control" id="classes-selection">
          <option value="0">选择班级</option>
          <option value="1">三甲班</option>
          <option value="2">三乙班</option>
          <option value="3">三丙班</option>
          <option value="4">三丁班</option>
          <option value="5">四甲班</option>
          <option value="6">四乙班</option>
          <option value="7">四丙班</option>
          <option value="8">四丁班</option>
      </select>
  </div>
  <div class="form-group">
    <select class="form-control" id="lesson-log-selection">
      <option>选择上课记录</option>
  </select>
</div>
<div class="form-group">
    <input type="" name="" id="output-dir" placeholder="文件导出目录" value="/Users/ywj/Downloads/post_download/" class="form-control">
</div>
<a id="export-btn" class="btn btn-success">Export</a>
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
    <script src="/js/admin/export-post.js"></script>
@endsection

@extends('layouts.admin')

@section('content')
@php
@endphp
<div class="container">
  <div id="toolbar">
    <form class="form-inline">
      <div class="form-group">
      <select class="form-control" id="term-selection">
          <option value="0">选择学期</option>
          @foreach ($terms as $term)
          @php
            $currentStr = "";
            if ($term->is_current) {
              $currentStr = "  (当前学期)";
            }
          @endphp
          <option value="{{$term->id}}">{{$term->enter_school_year}}级{{$term->grade_key}}年级{{$term->term_segment}}期{{$currentStr}}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group">
      <select class="form-control" id="sclasses-selection">
          <option value="0">选择班级</option>
      </select>
    </div>
    <div class="form-group">
      <div id="lesson-title-list">
        </div>
    </div>
<button id="build-btn" class="btn btn-success">形成表格</button>
<input type="hidden" name="" id="select-lesson-title-list">
</form>
</div>
<div id="toolbar">
</div>
<table id="posts-list" class="table table-condensed table-responsive">

    <thead>
      <tr>
        <th data-field="" checkbox="true">
          
        </th>
        <th data-field="">
          学号
      </th> 
      <th data-field="username">
          姓名
      </th>
      <th data-field="title1">
          教学内容1
      </th>
      <th data-field="title2">
          教学内容2
      </th>
      <th data-field="title3">
          教学内容3
      </th>
      <th data-field="title4">
          教学内容4
      </th>
      <th data-field="titleNum">
          作业总数
      </th>
  </tr>
</thead>
</table>

</div>
@endsection

@section('scripts')
    <script src="/js/school/term-end-export.js?v={{rand()}}"></script>
    <script src="/js/FileSaver.js"></script>
    <script src="/js/bootstrap-table-export.js"></script>
    <script src="/js/tableexport.js"></script>
@endsection

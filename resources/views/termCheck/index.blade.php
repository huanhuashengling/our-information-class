@extends('layouts.app')

@section('content')
<div class="container">
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
          <option value="{{$term->id}}">{{$term->enter_school_year}}级{{$term->grade_key}}年{{$term->term_segment}}期{{$currentStr}}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group">
      <select class="form-control" id="classes-selection">
          <option value="0">选择班级</option>
          <option value="1">甲班</option>
          <option value="2">乙班</option>
          <option value="3">丙班</option>
          <option value="4">丁班</option>
      </select>
    </div>
    <div class="form-group">
      <select class="form-control" id="lesson-log-selection">
        <option>选择上课记录</option>
      </select>
    </div>
  </form>

  <div id="posts_area">

  </div>
</div>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<input type="hidden" id="posts-id" value="">

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">批阅作业</h4>
      </div>
      <div class="modal-body">
        <div id="doc-preview"></div>
        <img src="" id='post-show' class="img-responsive img-thumbnail center-block">
        <div id='flashContent'>
            <!-- Get <a href="http://www.adobe.com/go/getflash">Adobe Flash Player</a>, otherwise this Scratch movie will not play. -->
            <!-- <object type="application/x-shockwave-flash" data="/scratch/Scratch.swf" width="850px" height="850px">
                <param name='movie' value="/scratch/Scratch.swf"/>
                <param name='bgcolor' value="#FFFFFF"/>
                <param name='FlashVars' value="project=/scratch/dts.sb2&autostart=false" />
                <param name='allowscriptaccess' value="always"/>
                <param name='allowFullScreen' value="true"/>
                <param name='wmode' value="direct"/>
                <param name='menu' value="false"/>
            </object> -->
        </div>
      </div>

    <div>
      <h5 id="rate">等第:</h5>
      <h5 id="post-comment">教师评语:</h5>
    </div>
  </div>
</div>
</div>
@endsection

@section('scripts')
    <script src="/js/term-check.js"></script>
@endsection

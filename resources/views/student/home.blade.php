@extends('layouts.student')

@section('content')

<?php //echo is_null($lessonLog);die(); ?>
<div class="container">
  @if (is_null($lessonLog))
    <div class="jumbotron">
      <h1>别着急，还未开始上课!</h1>
      <p>你可以耐心等待或者尝试<a href="/student">刷新</a>一下页面，你也可以去看看自己<a href="/student">以前交的作业</a>。</p>
    </div>
  @else
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              本堂课内容：{{ $lesson['title'] }}<small>({{ $lesson['subtitle'] }})</small></h4>
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
              <?php include("uploads/bridge.html"); ?>
          </div>
        </div>
        <div class="panel-footer">
        <input id="input-id" type="file" class="file">
        <!-- <div class="secure"><h4>作业提交</h4></div>
          {!! Form::open(array('url'=>'student/upload','method'=>'POST', 'files'=>true)) !!}
          <input type="hidden" name="lesson_logs_id" value="{{$lessonLog['id']}}">
           <div class="control-group">
            <div class="controls">
            {!! Form::file('image') !!}
            <p class="errors">{!!$errors->first('image')!!}</p>
              @if(Session::has('error'))
              <p class="errors">{!! Session::get('error') !!}</p>
              @endif
              </div>
          </div>
          <div id="success"> </div>
          {!! Form::submit('点击上传', array('class'=>'btn btn-primary send-btn')) !!}
          {!! Form::close() !!} -->
        </div>
      </div>
    </div>
  @endif
</div>
@endsection

<script type="text/javascript">
  $(document).ready(function() {
    $("#input-id").fileinput({language: "zh"});
  });
</script>



 
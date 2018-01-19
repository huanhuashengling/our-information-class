@extends('layouts.student')

@section('content')

<div class="container">
  @if (is_null($lessonLog))
    <div class="jumbotron">
      <h1>别着急，还未开始上课!</h1>
      <p>你可以耐心等待或者尝试<a href="/student">刷新</a>一下页面，你也可以去看看自己<a href="/student/posts">以前交的作业</a>。</p>
    </div>
  @else
    @if ($post)
      <input id="posted-path" value="{{ $post->storage_name }}" hidden />
    @endif
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title" value="">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <b>Click me! <span class="glyphicon glyphicon-hand-down"></span> </b> 课题：{{ $lesson['title'] }}<small>({{ $lesson['subtitle'] }})</small>
            </a>
          </h4>
          
        </div>

        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
              {!! $lesson['help_md_doc'] !!}
          </div>
        </div>
        <div class="panel-footer">
        <!-- <h4>上传作业</h4> -->
        @if(Session::has('success'))
          <div class="alert alert-success">
            <h4>{!! Session::get('success') !!}</h4>
          </div>
        @endif

        @if(Session::has('danger'))
          <div class="alert alert-danger">
            <h4>{!! Session::get('danger') !!}</h4>
          </div>
        @endif

        {!! Form::open(array('url'=>'student/upload','method'=>'POST', 'files'=>true)) !!}
          <input type="hidden" name="lesson_logs_id" value="{{$lessonLog['id']}}">
          {!! Form::file('source', ['id' => 'input-zh']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title" value="">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">本节课其他同学的作业
            </a>
          </h4>
        </div>

        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
              暂未开放
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection
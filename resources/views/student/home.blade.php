@extends('layouts.student')

@section('content')

<div class="container">
  @if (is_null($lessonLog))
    <div class="jumbotron">
      <h1>别着急，还未开始上课!</h1>
      <p>你可以耐心等待或者尝试<a href="/student">刷新</a>一下页面，你也可以去看看自己<a href="/student/posts">以前交的作业</a>。</p>
    </div>
  @else
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              本堂课内容：{{ $lesson['title'] }}<small>({{ $lesson['subtitle'] }})</small>
            </a>
          </h4>(已上交)
        </div>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
              {!! $lesson['help_md_doc'] !!}
          </div>
        </div>
        <div class="panel-footer">
        <h4>上传作业</h4>
        @if(Session::has('success'))
          <div class="alert-box success">
            <h2>{!! Session::get('success') !!}</h2>
          </div>
        @endif
        {!! Form::open(array('url'=>'student/upload','method'=>'POST', 'files'=>true)) !!}
        <input type="hidden" name="lesson_logs_id" value="{{$lessonLog['id']}}">
        {!! Form::file('image', ['id' => 'input-zh']) !!}
        <p class="errors">{!!$errors->first('image')!!}</p>
              @if(Session::has('error'))
              <p class="errors">{!! Session::get('error') !!}</p>
              @endif
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  @endif
</div>
@endsection
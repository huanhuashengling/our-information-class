@extends('layouts.student')

@section('content')

<div class="container">
  @if (0 < $unPostedLessonLogsNum)
      <div class="alert alert-danger">
        <h4><small>你之前还有</small><strong>{{$unPostedLessonLogsNum}}</strong><small>节课没有提交作业，请记得</small><a href="/student/posts">点击这里</a><small>补交作业！</small></h4>
      </div>
  @endif

  @if (0 < count($groupStudentsName))
    <div class="alert alert-success">
      <h5>你所在的 <strong>{{$groupName}}</strong> 还有
      <?php foreach ($groupStudentsName as $key => $name): ?>
        {{$name}},
      <?php endforeach ?>
      请互相交流合作，互相帮助，完成课堂任务！</h5>
    </div>
  @endif

  @if (is_null($lessonLog))
    <div class="jumbotron">
      <h1>别着急，还未开始上课!</h1>
      <p>你可以耐心等待或者尝试<a href="/student">刷新</a>一下页面，你也回顾<a href="/student/posts">以前交的作业</a>或者<a href="/student/classmate">其他同学的作业</a>。</p>
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
  @endif
</div>
@endsection

@section('scripts')
    <link href="/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/fileinput.min.js"></script>
    <script src="/js/locales/zh.js"></script>
    <script src="/js/student/student-upload.js"></script>
@endsection
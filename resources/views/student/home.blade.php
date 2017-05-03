@extends('layouts.student')

@section('content')

<div class="container">
  <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-5 col-sm-8"><h4>本堂课内容：{{ $lesson['title'] }}<small>({{ $lesson['subtitle'] }})</small></h4></div>
            </div>
        </div>
        <div class="row">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
            <div class="about-section">
               <div class="text-content">
                 <div class="span7 offset1">
                    @if(Session::has('success'))
                      <div class="alert-box success">
                      <h2>{!! Session::get('success') !!}</h2>
                      </div>
                    @endif
                    <div class="secure"><h4>作业提交</h4></div>
                    <!-- ['url'=>'teacher/articles'] -->
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
                  {!! Form::close() !!}
                  </div>
               </div>
            </div>
        </div>
      </div>
  </div>
</div>

@endsection
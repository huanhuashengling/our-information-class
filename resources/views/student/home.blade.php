@extends('layouts.app')

@section('content')

<div class="container">
    <h3>班级： {{ $schoolClass['title'] }}</h3>
    <h3>课题： {{ $lesson['title'] }}</h3><h3>副标题： {{ $lesson['subtitle'] }}</h3>
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
                <div class="secure"><h2>作业提交</h2></div>
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
              {!! Form::submit('Submit', array('class'=>'btn btn-primary send-btn')) !!}
              {!! Form::close() !!}
              </div>
           </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('content')
<!-- <iframe src="http://docs.google.com/gview?url=/users/ywj/downloads/two.ppt&embedded=true" style="width:550px; height:450px;" frameborder="0"></iframe> -->
<div class="container bs-example">
    <h3>班级： {{ $schoolClass['title'] }}</h3>
    <h3>课题： {{ $lesson['title'] }}</h3><h3>副标题： {{ $lesson['subtitle'] }}</h3>
    <input type="hidden" id="lesson-log-id" value="{{ $lessonLog['id'] }}">
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
        <div class="col-md-10 col-md-offset-1">
                @foreach ($students as $student)
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <table class="table table-bordered">
                            <tr><td>{{ $student['username'] }}</td><td>{{ $student['username'] }}</td></tr>
                            <tr><td colspan="2">
                            @if (isset($postData[$student['users_id']]))
                                <img src="{{$postData[$student['users_id']]['file_path']}}" height="200" width="200">
                            @else
                                <img src="/images/have_no_upload.png" height="200" width="200">
                            @endif
                            </td></tr>
                            <tr><td><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></td><td> 23 <span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span></td></tr>
                        </table>
                    </div>
                    <!-- <button class='btn btn-primary'>{{ $student['username'] }}</button> -->
                @endforeach
                <div class="form-group col-md-2 col-sm-3 col-xs-4 col-md-offset-10">
                    {!! Form::button('结束上课',['class'=>'btn btn-primary form-control', 'id' => 'close-lesson-log']) !!}
                </div> 
            </div>
        </div>
    </div>
</div>

@endsection
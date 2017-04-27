@extends('layouts.app')

@section('content')

<div class="container">
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
            {!! Form::open(['url'=>'teacher/articles']) !!}
                <div class="form-group">
                    {!! Form::label('schoolClasses','选择班级:') !!}
                    {!! Form::select('school_classes_id', $schoolClasses, null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('lessons','选择课程:') !!}
                    {!! Form::select('lessons_id', $lessons, null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('开始上课',['class'=>'btn btn-primary form-control']) !!}
                </div> 
                {!! Form::close()!!}
            </div>
        </div>
    </div>
</div>

@endsection
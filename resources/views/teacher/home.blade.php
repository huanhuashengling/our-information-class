@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            {!! Form::open(['url'=>'articles']) !!}
                <div class="form-group">
                    {!! Form::label('schoolClasses','选择班级:') !!}
                    {!! Form::select('schoolClasses', $schoolClasses, null, ['class'=>'form-control']) !!}

                    {!! Form::label('lessons','选择课程:') !!}
                    {!! Form::select('lessons', $lessons, null, ['class'=>'form-control']) !!}

                    {!! Form::submit('开始上课',['class'=>'btn btn-primary form-control']) !!}
                    </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>
</div>

@endsection
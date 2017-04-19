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

                @foreach ($students as $student)
                    <div class="col-md-3 col-sm-4 col-xs-6"><table class="table table-bordered"><tr><td>{{ $student['username'] }}</td><td>{{ $student['username'] }}</td></tr><tr><td colspan="2"><img src="/images/emptyStar_2x.png"></td></tr><tr><td><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></td><td> 23 <span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span></td></tr></table></div>
                    <!-- <button class='btn btn-primary'>{{ $student['username'] }}</button> -->
                @endforeach
                <div class="form-group col-md-2 col-md-offset-10">
                    {!! Form::submit('结束上课',['class'=>'btn btn-primary form-control']) !!}
                </div> 
                {!! Form::close()!!}
            </div>
        </div>
    </div>
</div>

@endsection
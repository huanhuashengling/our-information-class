@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">班级列表</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    @foreach ($school_classes as $school_class)
                        <a href="{{ url('teacher/lesson') }}" class="btn btn-success"><h4>{{ $school_class->title }}{{ $school_class->grade_num }}</h4></a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.teacher')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h4><p class="text-center">选课上课</h4></div>
                    <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-md-12">
                        {!! Form::open(['url'=>'teacher/createLessonLog']) !!}
                            <div class="form-group">
                                {!! Form::select('sclasses_id', $classData, null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                            {!! Form::select('lessons_id', $lessonsData, null, ['class'=>'form-control']) !!}
                                
                            </div>
                            <div class="form-group col-md-3 col-md-offset-4">
                                {!! Form::submit('开始上课',['class'=>'btn btn-primary  form-control']) !!}
                            </div> 
                        {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="/js/teacher/select-class-lesson.js"></script>
@endsection
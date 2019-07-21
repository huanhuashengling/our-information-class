@extends('layouts.teacher')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h4><p class="text-center">选课选班</h4></div>
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
                    <div class="col-md-12 text-center">
                        {!! Form::open(['url'=>'teacher/createLessonLog']) !!}
                            @if ($chooseLessonDesc == "")
                                <a class="btn btn-info btn-lg" href="/teacher/course">>>点我去选课>></a>
                            @else
                                <a class="btn btn-info btn-lg" href="/teacher/course">>>重新选课>></a>

                                <input type="hidden" name="" id="lessons-id" value="{{$chooseLessonsId}}">
                                <input type="hidden" name="sclassesId" id="sclasses-id">
                                <h4>{{$chooseLessonDesc}}</h4>
                            @endif
                            <p>------班级列表------</p>
                            @foreach ($classData as $key => $value)
                                <button class="btn btn-default btn-lg class-btn col-md-3" style="margin-left: 15px; margin-bottom: 15px; width: 100px" value="{{$key}}" style="margvaluein-left: 10px; margin-bottom: 10px">{{$value}}</button>
                            @endforeach
                            <div class="form-group col-md-3 col-md-offset-4">
                                {!! Form::submit('开始上课',['class'=>'btn btn-lg btn-primary']) !!}
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
    <script src="/js/teacher/select-class-lesson.js?v={{rand()}}"></script>
@endsection
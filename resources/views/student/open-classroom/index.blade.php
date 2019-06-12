@extends('layouts.student')

@section('content')
<div class="container">
    {!! Breadcrumbs::render('open-classroom') !!}
    @foreach($courses as $key => $course)
    <div class="panel panel-default col-md-4 text-center" style="margin-left:10px; width: 350px; height: 350px;">
      <div class="panel-body">
        <a href="/student/open-classroom/course/{{$course->id}}">
        <img src="{{$planetUrl}}" alt="..." class="img-circle"></a>
            <h4>{{$course->title}}</h4>
            <p class="text-left">{{$course->description}}</p>
      </div>
    </div>
    @endforeach
</div>
@endsection

@section('scripts')
    <script src="/js/student/open-classroom.js?v={{rand()}}"></script>
@endsection
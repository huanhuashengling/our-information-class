@extends('layouts.student')

@section('content')
<div class="container">
    {!! Breadcrumbs::render('unit', $unit) !!}
    @foreach($lessons as $key => $lesson)
    <div class="panel panel-default col-md-4 text-center" style="margin-left:10px; width: 350px; height: 350px;">
      <div class="panel-body">
        <a href="/student/open-classroom/lesson/{{$lesson->id}}">
        <img src="{{$planetUrl}}" alt="..." class="img-circle"></a>
            <h4>{{$lesson->title}}</h4>
            <p class="text-left">{{$lesson->subtitle}}</p>
      </div>
    </div>
    @endforeach
</div>
@endsection

@section('scripts')
    <script src="/js/student/open-classroom.js?v={{rand()}}"></script>
@endsection
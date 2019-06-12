@extends('layouts.student')

@section('content')
<div class="container">
    {!! Breadcrumbs::render('course', $course) !!}
    @foreach($units as $key => $unit)
    <div class="panel panel-default col-md-4 text-center" style="margin-left:10px; width: 350px; height: 350px;">
      <div class="panel-body">
        <a href="/student/open-classroom/unit/{{$unit->id}}">
        <img src="{{$planetUrl}}" alt="..." class="img-circle"></a>
            <h4>{{$unit->title}}</h4>
            <p class="text-left">{{$unit->description}}</p>
      </div>
    </div>
    @endforeach
</div>
@endsection

@section('scripts')
    <script src="/js/student/open-classroom.js?v={{rand()}}"></script>
@endsection
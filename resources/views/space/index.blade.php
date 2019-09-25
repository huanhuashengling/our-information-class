@extends('layouts.app')

@section('content')
<div class="container">
    @if ("" == $student)
            <h1>不合法的请求地址！</h1>
    @else
        <div class="jumbotron">

          <h1>{{$student->username}}<small>的个人空间</small></h1>
          <p>我来自{{$student->school_title}}{{$student->grade_key}}{{$student->class_title}}班，欢迎来我的个人空间参观，玩得开心！！</p>
        </div>
        @foreach ($works as $key => $work)
        <div class="alert alert-success col-md-4 text-center" role="alert" style="margin-right: 10px">
            <a href="/work?sId={{$student->id}}&wId={{$work->id}}#aa" target="_blank"><img src="{{$coverPrefix . $work->cover_name}}" class="img-thumbnail" width="200px"></a>
            <div class=""><p>{{$work->title}}</p></div>
        </div>
        @endforeach
    @endif
    
</div>

@endsection

@section('scripts')
    <script src="/js/space.js?v={{rand()}}"></script>
@endsection

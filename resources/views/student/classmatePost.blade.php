@extends('layouts.student')

@section('content')

<div class="container">
    @foreach($postData as $key=>$post)
        <!-- {{$post["students_id"]}} -->
        <div class="col-md-2 col-sm-4 col-xs-6" style="padding-left: 5px; padding-right: 5px;">
            <div class="panel panel-default">
                <div class="text-center"><img height="90px" value="{{ $post['id'] }}" src="{{$post['storage_name']}}"></div>
                <div class="text-center"><h3><small>{{ $post->studentName }}<span class="text-right"> (优|评|20赞)</span></small></h3>  </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
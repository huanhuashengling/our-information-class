@extends('layouts.student')

@section('content')

<div class="container">
    @foreach($postData as $key=>$post)
        <!-- {{$post["students_id"]}} -->
        <div class="col-md-3 col-sm-4 col-xs-6" style="padding-left: 5px; padding-right: 5px;">
            <div class="panel panel-default">
                <div class="text-center"></i><img height="140px" value="{{ $post['id'] }}" src="{{$post['storage_name']}}"></div>
                <div class="text-center"><h4><small>({{ $post->studentClass }})</small>{{ $post->studentName }}<small><{{ $post->rate }}><0赞></small></h4>  </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
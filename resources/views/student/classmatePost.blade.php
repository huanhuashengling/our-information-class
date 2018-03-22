@extends('layouts.student')

@section('content')

<div class="container">
    @foreach($posts as $key=>$post)
        <!-- {{$post["students_id"]}} -->
        @php
        if("doc" == $post->file_ext || "docx" == $post->file_ext) {
                $post->storage_name = env('APP_URL')."/images/doc.png";
            } else if("xls" == $post->file_ext || "xlsx" == $post->file_ext) {
                $post->storage_name = env('APP_URL')."/images/xls.png";
            } else if("ppt" == $post->file_ext || "pptx" == $post->file_ext) {
                $post->storage_name = env('APP_URL')."/images/ppt.png";
            } else {
                $post->storage_name = env('APP_URL')."/posts/".$post->storage_name;
            }
            $post->studentClass = (2018-$post->enter_school_year) . $post->class_title . "班";

            if (isset($post->rate)) {
                if("outstanding" == $post->rate) {
                    $post->rate = "优";
                } else if("lower" == $post->rate) {
                    $post->rate = "合格";
                }
                // $post->rate = $post->rate;
            } else {
                $post->rate = "";
            }
        @endphp
        <div class="col-md-3 col-sm-4 col-xs-6" style="padding-left: 5px; padding-right: 5px;">
            <div class="panel panel-default">
                <div class="text-center"></i><img height="140px" value="{{ $post['id'] }}" src="{{$post['storage_name']}}"></div>
                <div class="text-center"><h4><small>({{ $post->studentClass }})</small>{{ $post->username }}<small><{{ $post->rate }}><0赞></small></h4>  </div>
            </div>
        </div>
    @endforeach
    {{ $posts->links('pagination.limit_links') }}
    <!--{!! $posts->render() !!}-->
</div>
@endsection
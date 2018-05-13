@extends('layouts.student')

@section('content')

<div class="container" style="margin-top: 20px">
    @foreach($posts as $key=>$post)
        <!-- {{$post["students_id"]}} -->
        @php
        if("doc" == $post->file_ext || "docx" == $post->file_ext) {
                $post_storage_name = "images/doc.png";
            } else if("xls" == $post->file_ext || "xlsx" == $post->file_ext) {
                $post_storage_name = "images/xls.png";
            } else if("ppt" == $post->file_ext || "pptx" == $post->file_ext) {
                $post_storage_name = "images/ppt.png";
            } else {
                //$post_storage_name = public_path()."/posts/".$post->storage_name;
                //$post_storage_name = env('APP_URL')."/posts/".$post->storage_name;
                $post_storage_name = "posts/".$post->storage_name;
                //echo public_path()."/posts/".$post->storage_name;
            }
            $post->studentClass = (2018-$post->enter_school_year) . $post->class_title . "班";
            $gap = "";
            $ratestr = isset($post->rate)?$post->rate:"";

            if ($post->mark_num) {
                $markstr = $post->mark_num . "赞";
            } else {
                $gap = "";
                $markstr = "";
            }
        @endphp
        <div class="col-md-2 col-sm-3 col-xs-4" style="padding-left: 5px; padding-right: 5px;">
            <div class="alert alert-info" style="height: 147px">
                <!--<div class="text-center"><img height="140px" value="{{ $post['pid'] }}" src="/imager?src={{$post_storage_name}}"></div>-->
                <div><img class="img-responsive thumb-img" value="{{ $post['pid'] }}" src="{{ getThumbnail($post->storage_name, 140, 100, 'fit') }}" alt=""></div>
                <div><h4 style="margin-top: 10px; margin-bottom: 5px;"><small>({{ $post->studentClass }})</small>{{ $post->username }} <small>{{ $ratestr }}{{$gap}}{{ $markstr}}</small></h4>  </div>
                <input type="hidden" name="postInfo" value="{{ $post->studentClass }}班">
            </div>
        </div>
    @endforeach
    {{ $posts->links('pagination.limit_links') }}
    <!--{!! $posts->render() !!}-->
</div>

<!-- Modal -->
<div class="modal fade" id="classmate-post-modal" tabindex="-1" role="dialog" aria-labelledby="classmatePostModalLabel">
<input type="hidden" id="posts-id" value="">
<input type="hidden" id="mark-num" value="">
<input type="hidden" id="is-init" value="true">

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="classmate-post-modal-label"></h4>
      </div>
      <div class="modal-body">
        <img src="" id='classmate-post-show' class="img-responsive img-thumbnail center-block">
        <!-- <a href="" id="classmate-post-download-link">右键点击下载</a> -->
      </div>

    <div class="modal-footer">
        <div class="switch">
            <input type="checkbox" id="like-check-box" name="likeCheckBox"/>
        </div>
    </div>
  </div>
</div>
</div>

@endsection
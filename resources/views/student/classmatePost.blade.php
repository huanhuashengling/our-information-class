@extends('layouts.student')

@section('content')

<div class="container">
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
                <div class="text-center"></i><img height="140px" value="{{ $post['pid'] }}" src="/imager?src={{$post_storage_name}}"></div>
                <div class="text-center"><h4><small>({{ $post->studentClass }})</small>{{ $post->username }}<small><{{ $post->rate }}><0赞></small></h4>  </div>
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

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="classmate-post-modal-label">谁在什么课上提交的作品</h4>
      </div>
      <div class="modal-body">
        <img src="" id='classmate-post-show' class="img-responsive img-thumbnail">
        <a href="" id="classmate-post-download-link">右键点击下载</a>
      </div>

    <div class="modal-footer">
            <label class='btn btn-danger' value="rate"><input type='radio'>(20)喜欢</label>
    </div>
  </div>
</div>
</div>

@endsection
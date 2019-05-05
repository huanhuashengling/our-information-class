@extends('layouts.student')

@section('content')

<div class="container" style="padding-left: 0px; padding-right: 0px">
    <div class="col-md-1" >
        <button class="btn btn-info btn-sm form-control" id="my-posts-btn">我的</button>
        <button class="btn btn-info btn-sm form-control" id="same-sclass-posts-btn">同班级</button>
        <button class="btn btn-info btn-sm form-control" id="same-grade-posts-btn">同年级</button>
        
        <button class="btn btn-info btn-sm form-control" id="my-marked-posts-btn">我点赞</button>
        <button class="btn btn-info btn-sm form-control" id="most-marked-posts-btn">最多赞</button>
        <!-- <button class="btn btn-info btn-sm form-control" id="has-comment-posts-btn">有评语</button> -->
        <!--<button class="btn btn-info btn-sm form-control">最多分</button> -->
        <!-- <button class="btn btn-info btn-sm form-control">画图</button>
        <button class="btn btn-info btn-sm form-control">打字</button>
        <button class="btn btn-info btn-sm form-control">美图</button> -->
        <button class="btn btn-info btn-sm form-control" id="all-posts-btn">全部</button>
        <input type="text" name="" id="search-name" class="form-control input-sm" placeholder="姓名">
        <button class="btn btn-info btn-sm form-control" id="name-search-btn">搜索</button>
        <button class="btn btn-default btn-sm form-control">分{{ $posts->lastPage() }}页</button>
        <button class="btn btn-default btn-sm form-control">{{ $posts->total() }}份</button>
    </div>
    <div class="col-md-11" id="posts-list">
    @foreach($posts as $key=>$post)
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
                $post_storage_name = "posts/" . $schoolCode . "/" .$post->storage_name;
                //echo public_path()."/posts/".$post->storage_name;
            }
            $post->studentClass = $post->grade_key . $post->class_title;
            $gap = " ";
            $ratestr = isset($post->rate)?$post->rate:"";
            $alertCss = "alert alert-default";
            if (isset($post->rate)) {
                if ("优" == $post->rate) {
                    $alertCss = "alert alert-success";
                } elseif ("优+" == $post->rate) {
                    $alertCss = "alert alert-danger";
                } else {
                    $alertCss = "alert alert-warning";
                }
            }

            if ($post->mark_num) {
                $markstr = $post->mark_num . "赞";
            } else {
                $markstr = "";
            }
            $commentstr = "";
            if ($post->content && "" != $post->content) {
                $commentstr = "/评";
            }
        @endphp
        <div class="col-md-2 col-sm-3 col-xs-4" style="padding-left: 5px; padding-right: 5px;">
            <div class="{{ $alertCss }}" style="height: 147px; padding-left: 10px; padding-right: 10px">
                <!--<div class="text-center"><img height="140px" value="{{ $post['pid'] }}" src="/imager?src={{$post_storage_name}}"></div>-->

                <div><img class="img-responsive thumb-img" value="{{ $post['pid'] }}" src="{{ getThumbnail($post->storage_name, 140, 100, $schoolCode, 'fit', $post->file_ext) }}" alt=""></div>
                <div><h4 style="margin-top: 10px; margin-bottom: 5px;"><small>({{ $post->studentClass }})</small>{{ $post->username }} <small>{{ $ratestr }} {{ $markstr}} {{ $commentstr}}</small></h4>  </div>
                <input type="hidden" name="postInfo" value="{{ $post->studentClass }}班">
            </div>
        </div>
    @endforeach
    {{ $posts->appends(Illuminate\Support\Facades\Input::except('page'))->links('pagination.limit_links') }}
    </div>
    <!--{!! $posts->render() !!}-->
</div>

<!-- Modal -->
<div class="modal fade" id="classmate-post-modal" tabindex="-1" role="dialog" aria-labelledby="classmatePostModalLabel">
<input type="hidden" id="posts-id" value="">
<input type="hidden" id="mark-num" value="">
<input type="hidden" id="is-init" value="true">
<input type="hidden" id="image-360-src" value="">

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="classmate-post-modal-label"></h4>
      </div>
      <div class="modal-body">
        <div id='doc-preview'></div>
        <img src="" id='classmate-post-show' class="img-responsive img-thumbnail center-block">
        <div id='flashContent'>
            <!-- Get <a href="http://www.adobe.com/go/getflash">Adobe Flash Player</a>, otherwise this Scratch movie will not play. -->
        </div>
        <div id="vr-area">
            <a-scene embedded id="360-sence">
              <a-sky id="image-360"></a-sky>
            </a-scene>
        </div>
        <!-- <a href="" id="classmate-post-download-link">右键点击下载</a> -->
        <label id="post-comment"></label>
      </div>

    <div class="modal-footer">
        @if ("true" == $show3D)
        <div style="float: left;">
            <button class="btn btn-success" id="vr-btn">VR展示</button>
        </div>
        <div style="float: left;">
            <button class="btn btn-info" id="2d-btn">2D展示</button>
        </div>
        @endif
        <div class="switch" id="switch-box">
            <input type="checkbox" id="like-check-box" name="likeCheckBox"/>
        </div>
    </div>
  </div>
</div>
</div>

@endsection

@section('scripts')
    <!-- <script type="text/javascript" src="/scratch/swfobject.js"></script> -->
    <link href="/css/bootstrap-switch.css" rel="stylesheet">
    <script src="/js/bootstrap-switch.min.js"></script>
    <script src="/js/student/classmate-post.js?v={{rand()}}"></script>
    <style type="text/css">
      a-scene { width: 870px; height: 620px; }
   </style>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
  @if ("" == $student)
    <h1>不合法的请求地址！</h1>
  @else
  <div class="col-md-12">
    <div class="panel panel-default col-md-9" style="padding-right: 0px; padding-left: 0px;">
      <div class="panel-heading text-center" id="aa">
        <input type="hidden" name="" id="students-id" value="{{$student->id}}">
          <input type="hidden" name="" id="guest-students-id" value="{{$studentsId}}">
          <input type="hidden" name="" id="works-id" value="{{$work->id}}">
        <h4><small>燕山小学 {{$student->grade_key}}{{$student->class_title}}班 </small>{{$student->username}} 《{{$work->title}}》
          <small>共被访问{{$workViewLogNum}}次</small>
            <button type="button" style="float: right;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">作品介绍</button>

        </h4>
      </div>
      <div class="panel-body text-center" style="padding: 0px;">
        @if ("sb2" == $fileType)
            <object type='application/x-shockwave-flash' data='/scratch/Scratch.swf' width='820px' height='700px'>
                <param name='movie' value='/scratch/Scratch.swf'/>
                <param name='bgcolor' value='#FFFFFF'/>
                <param name='FlashVars' value='project={{$workPrefix . $work->work_name}}&autostart=false' />
                <param name='allowscriptaccess' value='always'/>
                <param name='allowFullScreen' value='true'/>
                <param name='wmode' value='direct'/>
                <param name='menu' value='false'/>
            </object>
        @elseif ("doc" == $fileType)
            <iframe src='http://10.63.7.189/op/embed.aspx?src={{$workPrefix . $work->work_name}}' width='820px' height='700px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Web Apps</a>.</iframe>
        @elseif ("img" == $fileType)
            <img src="{{$workPrefix . $work->work_name}}" class="img-thumbnail img-responsive">
        @endif
      </div>
        
      </div>
      @if ("true" == $showComment)
      <div class="panel panel-success col-md-3">
        <div class="panel-heading">你的建议会让他/她的作品更好</div>
        <div class="panel-body">
          
          <textarea id="comment-content" rows="5" placeholder="描述你的建议，不要废话，不要重复。如果被发现提交了不文明不礼貌的语言，你将被删除所有历史留言，以及被永久禁言！" class="form-control"></textarea>
        </div>
        <div class="panel-footer">
          <button class="btn btn-success btn-sm" id="submit-comment-btn">提交建议</button>
        </div>
      </div>
      @endif
    <div class="panel panel-success col-md-3" style="">
      <div class="panel-heading text-center">
      留言列表
        <button class="btn btn-sm btn-primary" id="refresh-comments-btn" style="float: right;">刷新</button>
      </div>
      <div class="panel-body" style="padding: 0px; max-height: {{$listHeight}};overflow-y: scroll;">
        <div id="comment-list">
        </div>
      </div>
    </div>
    </div>
    @endif
    </div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">《{{@$work->title}}》介绍</h4>
      </div>
      <div class="modal-body">
        <h4>作品创意</h4>
        <p>{{@$work->work_idea}}</p>
        <h4>作品说明</h4>
        {{@$work->description}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">了解了</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
    <script src="/js/work.js?v={{rand()}}"></script>
    <script type="text/javascript">
      $('img').bind("contextmenu", function(e){ return false; });
      $('img').bind("selectstart", function(e){ return false; });
      $('img').bind("dragstart", function(e){ return false; });
    </script>
@endsection

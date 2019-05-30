@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default">
      <div class="panel-heading text-center" id="aa">
        <h4><small>燕山小学 {{$student->grade_key}}{{$student->class_title}}班 </small>{{$student->username}} 《{{$work->title}}》
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">作品介绍</button>
        </h4>
      </div>
      <div class="panel-body text-center">
        @if ("sb2" == $fileType)
            <object type='application/x-shockwave-flash' data='/scratch/Scratch.swf' width='1000px' height='1000px'>
                <param name='movie' value='/scratch/Scratch.swf'/>
                <param name='bgcolor' value='#FFFFFF'/>
                <param name='FlashVars' value='project={{$workPrefix . $work->work_name}}&autostart=false' />
                <param name='allowscriptaccess' value='always'/>
                <param name='allowFullScreen' value='true'/>
                <param name='wmode' value='direct'/>
                <param name='menu' value='false'/>
            </object>
        @elseif ("doc" == $fileType)
            <iframe src='http://10.63.7.189/op/embed.aspx?src={{$workPrefix . $work->work_name}}' width='1000px' height='800px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Web Apps</a>.</iframe>
        @elseif ("img" == $fileType)
            <img src="{{$workPrefix . $work->work_name}}" class="img-thumbnail img-responsive">
        @endif

      </div>
    </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">《{{$work->title}}》介绍</h4>
      </div>
      <div class="modal-body">
        <h4>作品创意</h4>
        <p>{{$work->work_idea}}</p>
        <h4>作品说明</h4>
        {{$work->description}}
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
@endsection

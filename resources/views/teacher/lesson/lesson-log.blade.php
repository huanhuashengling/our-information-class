@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        @foreach ($lessonLogs as $key => $lesson)
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="heading{{$key}}">
                  <h4 class="panel-title"  value="{{$lesson['lessons_id']}}">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                      {{ $key+1 }}. {{ $lesson->title }} {{ $lesson->subtitle }}
                    </a>
                  </h4>
                </div>
                <div id="collapse{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$key}}">
                  <div class="panel-body">
                    <div id="lesson{{$lesson['lessons_id']}}">
                    </div>
                  </div>
                </div>
              </div>
        @endforeach

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<input type="hidden" id="posts-id" value="">

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">批阅作业</h4>
      </div>
      <div class="modal-body">
      <!-- <iframe src='https://docview.mingdao.com/op/embed.aspx?src=http://www.ccut.edu.tw/teachers/cskuan/downloads/ed01-ch01.ppt' width='800px' height='600px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Web Apps</a>.</iframe> -->
        <img src="" id='post-show' class="img-responsive">
        <a href="" id="post-download-link">右键点击下载</a>

        <!-- https://docview.mingdao.com/op/generate.aspx -->
        <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://www.ccut.edu.tw/teachers/cskuan/downloads/ed01-ch01.ppt' width='800px' height='600px' frameborder='0'> -->
        <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://www.lf1.cuni.cz/zfisar/psychiatry/Child%20Psychiatry.ppt' width='800px' height='600px' frameborder='0'> -->
        <!-- </iframe> -->
      </div>

    <div class="modal-footer">
        <div class="btn-group" name="rate-btn-group" data-toggle="buttons">
            <label class='btn btn-primary rate-btn' id="outstanding-rate" value="outstanding"><input type='radio'>优秀</label>
            <label class='btn btn-primary rate-btn' id="good-rate" value="good"><input type='radio'>良好</label>
            <label class='btn btn-primary rate-btn' id="lower-rate" value="lower"><input type='radio'>合格</label>
        </div>

        <hr>
        <div class="">
            <h4>填写评价内容</h4>
            <textarea class="form-control" rows='3' id="post-comment" value=''></textarea>
            <button type="button" class="btn btn-primary" id="add-post-comment-btn">提交评价</button>
            <button type="button" class="btn btn-primary" id="edit-post-comment-btn">编辑评价</button>
        </div>
    </div>
  </div>
</div>
</div>
@endsection

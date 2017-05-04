@extends('layouts.teacher')

@section('content')

<div class="container">
<!--<input type="hidden" id="lesson-log-id" value="{{ $lessonLog['id'] }}">
    <div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>-->
    <!-----start panel-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-1 col-sm-4"><h4>{{ $schoolClass['title'] }}班</h4></div>
                <div class="col-md-3 col-sm-4"><h4><small>(5738号)</small>{{ $lesson['title'] }}<small>({{ $lesson['subtitle'] }})</small></h4></div>
                
                <div class="col-md-1 col-sm-2 col-xs-6">{!! Form::button('姓名排序',['class'=>'btn btn-info', 'id' => 'close-lesson-log']) !!}</div>
                <!-- <div class="col-md-1 col-sm-2 col-xs-6">{!! Form::button('点赞排序',['class'=>'btn btn-info', 'id' => 'close-lesson-log']) !!}</div> -->
                <div class="col-md-1 col-sm-2 col-xs-6">{!! Form::button('结束上课',['class'=>'btn btn-danger', 'id' => 'close-lesson-log']) !!}</div>
            </div>
        </div>
        <div class="panel-body">

            <ul class="nav nav-tabs">
                <li class='active'><a href="#identifier" data-toggle="tab">全部</a></li>
                <li><a href="#identifier" data-toggle="tab">已交作业</a></li>
                <li><a href="#identifier" data-toggle="tab">未交作业</a></li>
                <!-- <li><a href="#identifier" data-toggle="tab">已评作业</a></li> -->
            </ul>
            <!-----start tab content-->
            <div class="tab-content">
                <!-----start tab-->
                <div class="tab-pane fade in active">
                        @foreach ($students as $student)
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <table class="table table-bordered">
                                    <tr><td><b>{{ $py->getFirstchar($student['username']) }}</b></td><td colspan="3">{{ $student['username'] }}</td></tr>
                                    <tr><td colspan="4">
                                    @if (isset($postData[$student['users_id']]))
                                        <button class='btn btn-success form-control' value="{{ $postData[$student['users_id']]['id'] }},{{ $postData[$student['users_id']]['file_path'] }}">已提交</button>
                                    @else
                                        <button class='btn btn-default form-control disabled'>未提交</button>
                                    @endif
                                    </td></tr>
                                    <tr>
                                    <td><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></td>
                                    <td  colspan="2"> 23 <span class="glyphicon glyphicon-heart" aria-hidden="true"></span></td>
                                    <td>优秀</td>
                                    </tr>
                                </table>
                            </div>
                        @endforeach
                </div>
                <!--end tab-->
                <!-----start tab-->
                <div class="tab-pane fade">
                        @foreach ($students as $student)
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <table class="table table-bordered">
                                    <tr><td>{{ $student['username'] }}</td><td>{{ $student['username'] }}</td></tr>
                                    <tr><td colspan="2">
                                    @if (isset($postData[$student['users_id']]))
                                        <button class='btn btn-success form-control'>未提交</button>
                                    @else
                                        <button class='btn btn-default form-control disabled'>提交</button>
                                    @endif
                                    </td></tr>
                                    <tr><td><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></td><td> 23 <span class="glyphicon glyphicon-heart" aria-hidden="true"></span></td></tr>
                                </table>
                            </div>
                        @endforeach
                </div>
                <!--end tab-->
            </div>
            <!--end tab content-->
        </div>
        <!--end panel body-->
    </div>
    <!-----end panel-->
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">批阅作业</h4>
      </div>
      <div class="modal-body">
      <!-- <iframe src='https://docview.mingdao.com/op/embed.aspx?src=http://www.ccut.edu.tw/teachers/cskuan/downloads/ed01-ch01.ppt' width='800px' height='600px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Web Apps</a>.</iframe> -->
        <img src="" id='post-show' width="800px" height="600px">
        <!-- https://docview.mingdao.com/op/generate.aspx -->
        <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://www.ccut.edu.tw/teachers/cskuan/downloads/ed01-ch01.ppt' width='800px' height='600px' frameborder='0'> -->
        <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://www.lf1.cuni.cz/zfisar/psychiatry/Child%20Psychiatry.ppt' width='800px' height='600px' frameborder='0'> -->
        <!-- </iframe> -->
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span></button>
        <button type="button" class="btn btn-primary">优秀</button>
        <button type="button" class="btn btn-primary">合格</button>
        <button type="button" class="btn btn-primary">不合格</button>

      </div>

      <hr>
        <h4>填写评价内容</h4>
        {!! Form::open(array('url'=>'student/upload','method'=>'POST', 'files'=>true)) !!}
            <textarea class="form-control" rows='3'></textarea>
          {!! Form::submit('提交评价', array('class'=>'btn btn-primary send-btn')) !!}
          {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection
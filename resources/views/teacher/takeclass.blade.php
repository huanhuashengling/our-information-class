@extends('layouts.teacher')

@section('content')

<div class="container">
<!--
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
    @if (is_null($lessonLog))
        <div class="jumbotron">
            <h1>哦, 您还未选班选课!</h1>
            <p>请点击<a href="/teacher">选课上课</a>链接开始你的新课课，你也可以去管理自己的<a href="/teacher/lesson">课程列表</a>。</p>
        </div>
    @else
        <input type="hidden" id="lesson-log-id" value="{{ $lessonLog['id'] }}">
        <!-----start panel-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-6"><h4>{{ $sclass['enter_school_year'] }}级{{ $sclass['class_title'] }}班</h4></div>
                    <div class="col-md-3 col-sm-4 col-xs-6"><h4><small></small>{{ $lesson['title'] }}<small>({{ $lesson['subtitle'] }})</small></h4></div>
                    
                    <!-- <div class="col-md-2 col-sm-2">{!! Form::button('姓名排序',['class'=>'btn btn-info', 'id' => 'sort-by-name']) !!}</div>
                    <div class="col-md-1 col-sm-2">{!! Form::button('点赞排序',['class'=>'btn btn-info', 'id' => 'close-lesson-log']) !!}</div> -->
                    <div class="col-md-2 col-sm-2 col-xs-6">{!! Form::button('结束上课',['class'=>'btn btn-danger', 'id' => 'close-lesson-log']) !!}</div>
                    <div class="col-md-2 col-sm-2 col-xs-6"><a href="/teacher/takeclass" class="btn btn-warning">刷新作业</a></div>
                </div>
            </div>
            <div class="panel-body">

                <ul class="nav nav-tabs">
                    <li class='active'><a href="#show-all" data-toggle="tab">全部</a></li>
                    <li><a href="#show-posted" data-toggle="tab">已交作业</a></li>
                    <li><a href="#show-no-posted" data-toggle="tab">未交作业</a></li>
                    <!-- <li><a href="#identifier" data-toggle="tab">已评作业</a></li> -->
                </ul>
                <!-----start tab content-->
                <div class="tab-content">
                    <!-----start tab-->
                    <div class="tab-pane fade in active" id='show-all'>
                        @include('teacher.partials.studentlist', array('students' => $students, 'postData' => $postData, 'showLimit' => "all"))
                    </div>
                    <!--end tab-->
                    <!-----start tab-->
                    <div class="tab-pane fade" id="show-posted">
                        @include('teacher.partials.studentlist', array('students' => $students, 'postData' => $postData, 'showLimit' => "posted"))
                    </div>
                    <div class="tab-pane fade" id="show-no-posted">
                        @include('teacher.partials.studentlist', array('students' => $students, 'postData' => $postData, 'showLimit' => "noPosted"))
                    </div>
                    <!--end tab-->
                </div>
                <!--end tab content-->
            </div>
            <!--end panel body-->
        </div>
        <!-----end panel-->
    @endif
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
            <label class='btn btn-danger rate-btn' id="outstanding-rate" value="outstanding"><input type='radio'>优秀</label>
            <label class='btn btn-success rate-btn' id="good-rate" value="good"><input type='radio'>良好</label>
            <label class='btn btn-info rate-btn' id="lower-rate" value="lower"><input type='radio'>合格</label>
            <label class='btn btn-warning rate-btn' id="unqualified-rate" value="unqualified"><input type='radio'>不合格</label>
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
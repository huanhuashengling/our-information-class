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
        @php
            $unpostCount = count($unPostStudentName);
            $postedCount = $allCount-$unpostCount;
        @endphp
        <input type="hidden" id="lesson-log-id" value="{{ $lessonLog['id'] }}">
        <!-----start panel-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-6"><h4>{{ $lessonLog['grade_key'] }}{{ $lessonLog['class_title'] }}班</h4></div>
                    <div class="col-md-3 col-sm-4 col-xs-6"><h4><small></small>{{ $lessonLog['title'] }}<small>({{ $lessonLog['subtitle'] }})</small></h4></div>
                    
                    <!-- <div class="col-md-2 col-sm-2">{!! Form::button('姓名排序',['class'=>'btn btn-info', 'id' => 'sort-by-name']) !!}</div>
                    <div class="col-md-1 col-sm-2">{!! Form::button('点赞排序',['class'=>'btn btn-info', 'id' => 'close-lesson-log']) !!}</div> -->
                    <div class="col-md-2 col-sm-2 col-xs-6">{!! Form::button('结束上课',['class'=>'btn btn-danger', 'id' => 'close-lesson-log']) !!}</div>
                    <div class="col-md-2 col-sm-2 col-xs-6"><a href="/teacher/takeclass" class="btn btn-warning">刷新作业</a></div>
                    <div class="col-md-3 col-sm-3 col-xs-6"><h4>(全部{{$allCount}}) (已交{{$postedCount}}) (未交{{$unpostCount}})</h4></div>
                </div>
            </div>
            <div class="panel-body">
                    @include('teacher.partials.studentlist', array('students' => $students))
            </div>
            <div class="panel-footer">
                    <h4>未交名单:
                    @php
                        foreach ($unPostStudentName as $key => $unPostedName) {
                            echo "  " . ($key+1) . ". " . $unPostedName . " ";
                        }
                    @endphp
                    </h4>
                </div>
            </div>
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
        <div id="doc-preview"></div>
        <img src="" id='post-show' class="img-responsive img-thumbnail center-block">
        <a href="" id="post-download-link">右键点击下载</a>

        <!--
        <div id='flashContent' width='482px' height='387px'>
            Get <a href="http://www.adobe.com/go/getflash">Adobe Flash Player</a>, otherwise this Scratch movie will not play.
        </div>-->
      </div>

    <div class="modal-footer">
        <div class='btn-group' name='level-btn-group' data-toggle='buttons'>
            <label class='btn btn-default'><input type='radio' value='优'>优秀</label>
            <label class='btn btn-default'><input type='radio' value='良'>良好</label>
            <label class='btn btn-default'><input type='radio' value='合格'>合格</label>
            <label class='btn btn-default'><input type='radio' value='差'>不合格</label>
        </div>

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

@section('scripts')
    <!--<script type="text/javascript" src="/scratch/swfobject.js"></script>
    <script type='text/javascript'>
    var flashvars = {
      project: '/scratch/dts.sb2',
      autostart: 'false'
    };

    var params = {
      bgcolor: '#FFFFFF',
      allowScriptAccess: 'always',
      allowFullScreen: 'true',
      wmode: "direct",
      menu: "false"
      
    };
    var attributes = {};

    swfobject.embedSWF('/scratch/Scratch.swf', 'flashContent', '100%', '600px', '10.2.0','/scratch/expressInstall.swf', flashvars, params, attributes);

    </script>-->
    <script src="/js/teacher/take-class.js"></script>
@endsection
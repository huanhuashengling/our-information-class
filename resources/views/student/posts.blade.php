@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>新增失败</strong> 输入不符合要求<br><br>
            {!! implode('<br>', $errors->all()) !!}
        </div>
    @endif
    <div class="alert alert-info col-md-8 col-md-offset-2">
        <h4>目前得分：有效赞{{$allEffectMarkNum}} * 0.5 + 共{{$allRateNum}}个优 * 8 + 共{{$allCommentNum}}条评语 * 1 = {{$allScore}}分</h4>
        <h5>总赞数(共{{$allMarkNum}}个赞)，有效赞为每次作业最多四次赞有效，以每个0.5分计入期末成绩，共2分</h5>

        @if(Session::has('success'))
          <div class="alert alert-success">
            <h4>{!! Session::get('success') !!}</h4>
          </div>
        @endif

        @if(Session::has('danger'))
          <div class="alert alert-danger">
            <h4>{!! Session::get('danger') !!}</h4>
          </div>
        @endif
    </div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    @foreach ($postData as $key => $item)
        @php
            $orderNum = $key + 1;
            $hasComment = ("true" == $item['hasComment'])?"有评语":"";
            $hasPostCss = "warning";
            $hasPostStr = "(未交)";
            $rateStr = "";
            $markStr = "";
            if (isset($item['post'])) {
                $hasPostCss = "success";
                $hasPostStr = "";
                $markStr = $item['markNum']."个赞";
            }
            
        @endphp
        <div class="col-md-12">
            <div class="panel panel-{{$hasPostCss}}">
                <div class="panel-heading" role="tab" id="heading{{$orderNum}}">
                  <h4 class="panel-title" value="{{ $item['post']['id'] }},{{ $item['post']['storage_name'] }}">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$orderNum}}" aria-expanded="true" aria-controls="collapse{{$orderNum}}">
                        第{{ $orderNum }}节： {{ $item['lesson']['title'] }} <small>{{ $item['lesson']['subtitle'] }} </small>  <label class="text-right">{{$item['rate']}} {{$hasComment}} {{$markStr}}{{$hasPostStr}}</label>
                    </a>
                  </h4>
                </div>
                <div id="collapse{{$orderNum}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$orderNum}}">
                <div class="panel-body">
                    <div class="col-md-12">
                    @if (isset($item['post']))
                        <img src="" id="post-show-{{$item['post']['id']}}" class="img-responsive">
                        <!-- <embed src="" width="1024" height="768" id="post-show-{{$item['post']['id']}}" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html"> -->
                        <a href="" id="post-download-{{$item['post']['id']}}">右键点击下载</a>
                        <p></p>
                        <div class="form-group">
                            <label id="rate-label-{{$item['post']['id']}}"></label>
                            <!--<h4>点赞：<small>刘奥，刘胜翔</small></h4>-->
                        </div>
                        <div class="form-group">
                            <label id="post-comment-{{$item['post']['id']}}" value=''></label>
                        </div>
                        <div class="form-group">
                            {{$item['markNum']}}个人为你点赞：
                            @foreach ($item['markNames'] as $key => $name)
                                {{$name->username}},
                            @endforeach
                        </div>
                    @else
                        <h4>请补交作业</h4>
                        {!! $item['lesson']['help_md_doc'] !!}

                        @if(Session::has('success'))
                          <div class="alert-box success">
                            <h2>{!! Session::get('success') !!}</h2>
                          </div>
                        @endif
                        {!! Form::open(array('url'=>'student/upload','method'=>'POST', 'files'=>true)) !!}
                            <input type="hidden" name="lesson_logs_id" value="{{$item['lessonLog']['id']}}">
                            {!! Form::file('source', ['class' => 'input-zh']) !!}
                            <p class="errors">{!!$errors->first('image')!!}</p>
                        {!! Form::close() !!}
                    @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <input type="hidden" id="posts-id" value="">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">查看作业</h4>
            </div>
            <div class="modal-body">
      <!-- <iframe src='https://docview.mingdao.com/op/embed.aspx?src=http://www.ccut.edu.tw/teachers/cskuan/downloads/ed01-ch01.ppt' width='800px' height='600px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Web Apps</a>.</iframe> -->
                <img src="" id='1post-show' width="800px" height="600px">
        <!-- https://docview.mingdao.com/op/generate.aspx -->
        <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://www.ccut.edu.tw/teachers/cskuan/downloads/ed01-ch01.ppt' width='800px' height='600px' frameborder='0'> -->
        <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://www.lf1.cuni.cz/zfisar/psychiatry/Child%20Psychiatry.ppt' width='800px' height='600px' frameborder='0'> -->
        <!-- </iframe> -->
                <hr>
                <div class="form-group">
                    <h4>该作业被评为:<b><label id="1rate-label"></label></b></h4>
                    <h4>点赞：<small>刘奥，刘胜翔</small></h4>
                </div>
                <div class="form-group">
                    <h4>老师评语：</h4>
                    <textarea rows='3' id="1post-comment" class="form-control" readonly="readonly"  value=''></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
@endsection
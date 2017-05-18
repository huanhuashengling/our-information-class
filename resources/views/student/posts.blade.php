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
        
    @foreach ($postData as $key => $item)
    @php
        $lesson = $item['lesson'];
        $post = $item['post'];
        $rate = $item['rate'];
        $hasComment = $item['hasComment'];
    @endphp
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="panel panel-success">
                <div class="panel-heading" role="tab">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                        #{{ $key }} 课题： {{ $lesson['title'] }} <small>{{ $lesson['subtitle'] }} </small>
                    </a>
                  </h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                    @if (isset($post))
                        
                        @if ("outstanding" == $rate)
                            <button class="btn btn-primary">优秀</button>
                        @elseif ("good" == $rate)
                            <button class="btn btn-primary">良好</button>
                        @elseif ("lower" == $rate)
                            <button class="btn btn-primary">合格</button>
                        @endif
                        
                        @if ("true" == $hasComment)
                            <button class="btn btn-info">已评</button>
                        @endif

                        @if ("true" == $hasComment)
                            <button class="btn btn-danger">123 赞</button>
                        @endif
                        <button class='btn btn-success' value="{{ $post['id'] }},{{ $post['file_path'] }}">查看作业</button>
                    @else
                        <h4>本节课作业未交</h4>
                    @endif
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
                <h4 class="modal-title" id="myModalLabel">查看作业</h4>
            </div>
            <div class="modal-body">
      <!-- <iframe src='https://docview.mingdao.com/op/embed.aspx?src=http://www.ccut.edu.tw/teachers/cskuan/downloads/ed01-ch01.ppt' width='800px' height='600px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Web Apps</a>.</iframe> -->
                <img src="" id='post-show' width="800px" height="600px">
        <!-- https://docview.mingdao.com/op/generate.aspx -->
        <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://www.ccut.edu.tw/teachers/cskuan/downloads/ed01-ch01.ppt' width='800px' height='600px' frameborder='0'> -->
        <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://www.lf1.cuni.cz/zfisar/psychiatry/Child%20Psychiatry.ppt' width='800px' height='600px' frameborder='0'> -->
        <!-- </iframe> -->
                <hr>
                <div class="form-group">
                    <h4>该作业被评为:<b><label id="rate-label"></label></b></h4>
                    <h4>点赞：<small>刘奥，刘胜翔</small></h4>
                </div>
                <div class="form-group">
                    <h4>老师评语：</h4>
                    <textarea rows='3' id="post-comment" class="form-control" readonly="readonly"  value=''></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
@endsection
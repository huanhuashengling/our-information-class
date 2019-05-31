
@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading"><h4>添加新的作品</h4></div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>添加失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif
                    
                    @if(Session::has('danger'))
                      <div class="alert alert-danger">
                        <h4>{!! Session::get('danger') !!}</h4>
                      </div>
                    @endif

                    <form action="{{ url('student/work') }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="text" name="title" class="form-control" required="required" placeholder="作品名称" value="">
                        <br>
                        <!-- <label>作品创意（为什么要创建一个这样的作品）</label> -->
                        <textarea name="work_idea" class="form-control" required="required" placeholder="作品创意（为什么要创建一个这样的作品）" rows="5"></textarea>
                        <br>
                        <!-- <label>请输入作品描述（包含操作说明或游戏玩法）</label> -->
                        <textarea name="description" class="form-control" required="required" placeholder="作品描述（包含操作说明或游戏玩法）" rows="5"></textarea>
                        <br>
                        <button class="btn btn-success btn-lg pull-right">添加</button> 
                         <a class="btn btn-info btn-lg pull-right" href="javascript:window.history.back()">返回</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <link href="/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/fileinput.min.js"></script>
    <script src="/js/locales/zh.js"></script>
    <script src="/js/student/work-create.js?v={{rand()}}"></script>
@endsection
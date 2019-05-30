@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>修改作品信息</h4></div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>新增失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    @if(Session::has('danger'))
                      <div class="alert alert-danger">
                        <h4>{!! Session::get('danger') !!}</h4>
                      </div>
                    @endif

                    <form action="{{ url('student/work/'.$work->id) }}" method="POST" class="form-horizontal">
                        {{ method_field('PATCH') }}
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">作品名称</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" required="required" placeholder="作品名称" value="{{$work->title}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">作品创意</label>
                            <div class="col-sm-10">
                                <textarea name="work_idea" class="form-control" required="required" placeholder="作品创意（为什么要创建一个这样的作品）" rows="5">{{$work->work_idea}}</textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">作品简介</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control" required="required" placeholder="作品描述（包含操作说明或游戏玩法）" rows="5">{{$work->description}}</textarea>
                            </div>
                        </div>

                        <div class="form-group" class="col-md-6 col-sm-6">
                            <label for="inputEmail3" class="col-sm-2 control-label">显示序号</label>
                            <div class="col-sm-4">
                                <input type="text" name="order_num" class="form-control" required="required" placeholder="显示序号" value="{{$work->order_num}}">
                            </div>
                        </div>

                        <div class="form-group" class="col-md-6 col-sm-6">
                            <label for="inputEmail3" class="col-sm-2 control-label">是否显示</label>
                            <div class="col-sm-4">
                                <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="is_open" {{(1==($work->is_open))?"checked":""}}>
                                </label>
                              </div>
                            </div>
                        </div>

                        <button class="btn btn-success btn-lg pull-right">修改</button> 
                         <a class="btn btn-info btn-lg pull-right" href="javascript:window.history.back()">返回</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>修单元信息</h4></div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>新增失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif
                    
                    <form action="{{ url('teacher/unit/'.$unit->id) }}" method="POST">
                        {{ method_field('PATCH') }}
                        {!! csrf_field() !!}
                        <div class="form-group">
                        {!! Form::select('courses_id', $courses, $unit["courses"]["id"], ['class' => 'form-control', 'placeholder' => '请选择课程']) !!}
                    </div>

                        单元标题： <input type="text" name="title" class="form-control" required="required" value="{{ $unit->title }}" placeholder="请输入标题">
                        <br>
                        单元介绍：<input name="description" rows="10" class="form-control" required="required" placeholder="请输入课程介绍" value="{{ $unit->description }}"</input>
                        <br>
                        <br>
                        <button class="btn btn-success btn-lg pull-right">保存</button>
                        <a class="btn btn-info btn-lg pull-right" href="javascript:window.history.back()">返回</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
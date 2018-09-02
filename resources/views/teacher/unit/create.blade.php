
@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>添加单元</h4></div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>添加失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif
                    
                    <form action="{{ url('teacher/unit') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="form-group">
                        {!! Form::select('courses_id', $courses, null, ['class' => 'form-control', 'placeholder' => '请选择课程']) !!}
                    </div>
                        <input type="text" name="title" class="form-control" required="required" placeholder="请输入单元标题">
                        <br>
                        <input type="text" name="description" class="form-control" required="required" placeholder="请输入单元描述" />
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
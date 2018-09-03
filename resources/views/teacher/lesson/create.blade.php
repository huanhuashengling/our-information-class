
@extends('layouts.teacher')

@section('content')
@include('editor::head')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>添加课时</h4></div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>添加失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <form action="{{ url('teacher/lesson') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            {!! Form::select('courses_id', $courses, null, ['class' => 'form-control', 'placeholder' => '请选择课程']) !!}
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="units_id" id="units-id">
                                <option>请先选择课程，再来选择单元</option>
                            </select>
                        </div>
                        <input type="text" name="title" class="form-control" required="required" placeholder="请输入课时标题">
                        <br>
                        <input type="text" name="subtitle" class="form-control" required="required" placeholder="请输入课时副标题" />
                        <br>
                        <p>编写课堂帮助文档</p>
                        <div class="editor"> 
                            {!! Form::textarea('content', '', ['class' => 'form-control','id'=>'myEditor']) !!}
                        </div>
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
    <script src="/js/teacher/lesson-edit.js"></script>
@endsection
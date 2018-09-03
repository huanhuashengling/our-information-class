@extends('layouts.teacher')

@section('content')
@include('editor::head')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>修改课时信息</h4></div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>新增失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <form action="{{ url('teacher/lesson/'.$lesson->id) }}" method="POST">
                        {{ method_field('PATCH') }}
                        {!! csrf_field() !!}
                        <div class="form-group">
                            {!! Form::select('courses_id', $courses, $lesson->courses_id, ['class' => 'form-control', 'placeholder' => '请选择课程']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::select('units_id', $units, $lesson->units_id, ['class' => 'form-control', 'id' => 'units-id', 'placeholder' => '请先选择单元']) !!}
                        </div>
                        课时标题： <input type="text" name="title" class="form-control" required="required" value="{{ $lesson->title }}" placeholder="请输入标题">
                        <br>
                        课时副标题：<input name="subtitle" rows="10" class="form-control" required="required" placeholder="请输入副标题" value="{{ $lesson->subtitle }}"</input>
                        <br>
                        <p>编写课堂帮助文档</p>
                        <div class="editor"> 
                            {!! Form::textarea('content', $lesson->help_md_doc, ['class' => 'form-control','id'=>'myEditor']) !!}
                        </div>
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

@section('scripts')
    <script src="/js/teacher/lesson-edit.js"></script>
@endsection
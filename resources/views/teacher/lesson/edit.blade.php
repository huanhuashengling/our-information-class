@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">修改课程信息</div>
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
                        课程标题： <input type="text" name="title" class="form-control" required="required" value="{{ $lesson->title }}" placeholder="请输入标题">
                        <br>
                        副标题：<input name="subtitle" rows="10" class="form-control" required="required" placeholder="请输入副标题" value="{{ $lesson->subtitle }}"</input>
                        <br>
                        <button class="btn btn-lg btn-info">编辑</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">编辑一篇文章</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>新增失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <form action="{{ url('admin/post/'.$post->id) }}" method="POST">
                        {{ method_field('PATCH') }}
                        {!! csrf_field() !!}
                        <input type="text" name="title" class="form-control" required="required" value="{{ $post->title }}" placeholder="请输入标题">
                        <br>
                        <textarea name="body" rows="10" class="form-control" required="required" placeholder="请输入内容">{{ $post->body }}</textarea>
                        <br>
                        <button class="btn btn-lg btn-info">编辑文章</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">编辑 <a href="{{ url('/post/'.$comment->post_id) }}">{{ $comment->hasOneWork->title }}</a> 评论</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>编辑失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <form action="{{ url('admin/comment/'.$comment->id) }}" method="POST">
                        {{ method_field('PATCH') }}
                        {!! csrf_field() !!}
                        <br>
                        <div class="form-group">
                            <label>Nickname</label>
                            <input type="text" name="nickname" value="{{ $comment->nickname }}" class="form-control" style="width: 300px;" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" value="{{ $comment->email }}" class="form-control" style="width: 300px;">
                        </div>
                        <div class="form-group">
                            <label>Home page</label>
                            <input type="text" name="website" value="{{ $comment->website }}" class="form-control" style="width: 300px;">
                        </div>

                        <textarea name="content" rows="10" class="form-control" required="required" placeholder="请输入内容">{{ $comment->content }}</textarea>
                        <br>
                        <button class="btn btn-lg btn-info">编辑评论</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
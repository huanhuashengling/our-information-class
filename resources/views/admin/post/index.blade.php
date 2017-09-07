@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">文章管理</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <a href="{{ url('admin/post/create') }}" class="btn btn-lg btn-primary">新增</a>

                    @foreach ($posts as $post)
                        <hr>
                        <div class="post">
                            <h4>{{ $post->title }}</h4>
                            <div class="content">
                                <p>
                                    {{ $post->body }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ url('admin/post/'.$post->id.'/edit') }}" class="btn btn-success">编辑</a>
                        <form action="{{ url('admin/post/'.$post->id) }}" method="POST" style="display: inline;">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">删除</button>
                        </form>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

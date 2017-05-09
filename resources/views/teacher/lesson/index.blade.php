@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4><p class="text-center">课程列表</p></h4></div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif
                    <h4>我是搜索框</h4>
                    <table class="table table-striped">
                    <thead><tr><th>课程编号</th><th>课程标题</th><th>课程副标题</th><th>操作</th></tr></thead>
                    <tbody>
                    @foreach ($lessons as $key => $lesson)
                        <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $lesson->title }}</td>
                        <td>{{ $lesson->subtitle }}</td>
                        <td>
                            <a href="{{ url('teacher/lesson/'.$lesson->id.'/edit') }}" class="btn btn-success">编辑</a>
                            <form action="{{ url('teacher/lesson/'.$lesson->id) }}" method="POST" style="display: inline;">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">删除</button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    <a href="{{ url('teacher/lesson/create') }}" class="btn  btn-primary">新增</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">课程列表</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif
                    <h4>我是搜索框</h4>
                    <table class="table table-striped">
                    @foreach ($lessons as $lesson)
                        <tr>
                        <td>
                            <div class="lesson">
                                <h4>{{ $lesson->title }}</h4>
                                <div class="content">
                                    <p>
                                        {{ $lesson->subtitle }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ url('teacher/lesson/'.$lesson->id.'/edit') }}" class="btn btn-success">编辑</a>
                            <form action="{{ url('teacher/lesson/'.$lesson->id) }}" method="POST" style="display: inline;">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">删除</button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ url('teacher/lesson/'.$lesson->id.'/edit') }}" class="btn btn-lg btn-success">选取上课</a>
                        </td>
                        </tr>
                    @endforeach
                    </table>
                    <a href="{{ url('teacher/lesson/create') }}" class="btn btn-lg btn-primary">新增</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

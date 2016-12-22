@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <a href="{{ url('admin/post') }}" class="btn btn-lg btn-success col-xs-12">管理文章</a>

                </div>
                <div class="panel-body">

                    <a href="{{ url('admin/comment') }}" class="btn btn-lg btn-success col-xs-12">管理评论</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
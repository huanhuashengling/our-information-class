
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>添加邮箱地址</h4></div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>添加失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif
                    
                    <form action="{{ url('teacher/unit') }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="text" name="server_provider" class="form-control" required="required" placeholder="邮箱服务">
                        <br>
                        <input type="text" name="num_limit_one_day" class="form-control" required="required" placeholder="每天次数限制" />
                        <br>
                        <input type="text" name="username" class="form-control" required="required" placeholder="用户名">
                        <br>
                        <input type="text" name="mail_address" class="form-control" required="required" placeholder="邮箱地址" />
                        <br>
                        <input type="text" name="password" class="form-control" required="required" placeholder="密码">
                        <br>
                        <input type="text" name="auth_code" class="form-control" required="required" placeholder="授权码" />
                        <input type="text" name="is_useable" class="form-control" required="required" placeholder="是否可用" />
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
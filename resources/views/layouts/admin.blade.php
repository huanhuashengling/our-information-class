<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ trans("layouts.title") }}</title>
    <link rel="icon" href="/img/oic.ico" type="image/x-icon" />
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-table.css" media="all" rel="stylesheet" type="text/css" />

    <link href="/css/jquery-ui.css" rel="stylesheet">
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/respond.min.js"></script>
    
    <script src="/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="/js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap-table.js"></script>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" /> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script> -->

    
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ trans("layouts.project_name") }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/school/dashboard') }}">数据报表</a></li>
                    <li><a href="{{ url('/school/sclasses') }}">学期班级</a></li>
                    <li><a href="{{ url('/school/students') }}">学生账户</a></li>
                    <li><a href="{{ url('/school/groups') }}">学生分组</a></li>
                    <li><a href="{{ url('/school/teachers') }}">教师账户</a></li>
                    <li><a href="{{ url('/school/export-post') }}">导出作业</a></li>
                    <li><a href="{{ url('/school/lessonLog') }}">课程记录</a></li>
                    <li><a href="{{ url('/school/send-mail') }}">邮件发送</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guard("school")->guest())
                        <li><a href="{{ url('/login') }}">{{ trans("layouts.login") }}</a></li>
                        <!-- <li><a href="{{ url('/register') }}">{{ trans("layouts.register") }}</a></li> -->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">你好， 
                                {{ Auth::guard("school")->user()->display_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/school/reset') }}"><i class="fa fa-btn fa-sign-out"></i>修改个人信息</a></li>
                                <li><a href="{{ url('/school/reset') }}"><i class="fa fa-btn fa-sign-out"></i>修改密码</a></li>
                                <li><a href="{{ url('/school/logout') }}"><i class="fa fa-btn fa-sign-out"></i>{{ trans("layouts.logout") }}</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    @yield('scripts')
</body>
</html>
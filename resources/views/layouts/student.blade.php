<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/img/oic.ico" type="image/x-icon" />
    <title>{{ trans("layouts.title") }}</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <link href="/css/jquery-ui.css" rel="stylesheet">
    <link href="/css/bootstrap-table.css" media="all" rel="stylesheet" type="text/css" />
    <!-- <link href="/css/all.css" rel="stylesheet"> -->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/respond.min.js"></script>

    <script src="/js/aframe.min.js"></script>
    <script src="/js/aframe-animation-component.min.js"></script>
    <!-- <script src="https://unpkg.com/aframe-particle-system-component@1.0.x/dist/aframe-particle-system-component.min.js"></script> -->
    <!-- <script src="https://unpkg.com/aframe-outline@%5E1.1.0/build/aframe-outline.min.js"></script> -->
    <!-- <script src="https://unpkg.com/aframe-template-component@3.x.x/dist/aframe-template-component.min.js"></script> -->
    <!-- <script src="https://unpkg.com/aframe-layout-component@3.x.x/dist/aframe-layout-component.min.js"></script> -->
    <!-- <script src="https://unpkg.com/aframe-event-set-component@3.x.x/dist/aframe-event-set-component.min.js"></script> -->

    <script src="/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="/js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="/js/plugins/purify.min.js" type="text/javascript"></script>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" /> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script> -->

    <script src="/js/bootstrap-table.js"></script>
    

    <!-- <script src="/js/locales/zh.js"></script> -->

    
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
                    <!-- Authentication Links -->
                    @if (Auth::guard("student")->guest())
                        <!-- <li><a href="{{ url('/login') }}">{{ trans("layouts.login") }}</a></li> -->
                        <form class="navbar-form navbar-right" role="form" method="POST" action="{{ route('student.login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <input id="username" type="text" class="form-control" name="username" value="" placeholder="用户名" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                        </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" value="" class="form-control" name="password"  placeholder="密码"  required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    登录
                                </button>
                                <a class="btn btn-link disabled" href="{{ url('/password/reset') }}">
                                    <small>忘记密码？请联系老师重置</small>
                                </a>
                        </div>

                          </form>
                    @else
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav" id="student-nav">
                            <!--<li><a href="{{ url('/student') }}">我的小组</a></li>-->
                            <li class="{{ Request::segment(2) === 'home' ? 'active' : null }}"><a href="{{ url('/student/home') }}">信息课</a></li>
                            <li class="{{ Request::segment(2) === 'posts' ? 'active' : null }}"><a href="{{ url('/student/posts') }}">作业记录</a></li>
                            <li class="{{ Request::segment(2) === 'classmate' ? 'active' : null }}"><a href="{{ url('/student/classmate') }}">作业墙</a></li>
                            <li class="{{ Request::segment(2) === 'work' ? 'active' : null }}"><a href="{{ url('/student/work') }}">个人主页</a></li>
                            <li class="{{ Request::segment(2) === 'open-classroom' ? 'active' : null }}"><a href="{{ url('/student/open-classroom') }}">开放课堂</a></li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello,
                                    {{ Auth::guard("student")->user()->username }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/student/info') }}"><i class="fa fa-btn fa-sign-out"></i>个人信息</a></li>
                                    <li><a href="{{ url('/student/reset') }}"><i class="fa fa-btn fa-sign-out"></i>修改密码</a></li>
                                    <li><a href="{{ url('/student/logout') }}"><i class="fa fa-btn fa-sign-out"></i>{{ trans("layouts.logout") }}</a></li>
                                </ul>
                            </li>
                        </ul>
                    @endif
                
            </div>
        </div>
    </nav>

    @yield('content')
    @yield('scripts')
</body>
</html>

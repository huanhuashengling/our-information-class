@extends('layouts.student')

@section('content')

    
<!-- <a-scene> -->
    <!-- <a-box color="#ff0000" position="0 0.25 -1.5" rotation="20 40 0" height="0.5" width="0.5"></a-box> -->
    <!-- <a-sky src="/images/panorama/meishujiaoshi.jpg" rotation="0 0 0"></a-sky> -->
    <!-- <a-text font="kelsonsans" value="yin yue jiao shi" color="#00ff00" width="6" position="-2.5 0.25 -1.5" -->
              <!-- rotation="0 15 0"></a-text> -->
<!-- <a-image src="/images/panorama/刘熙梓-5af11255304f3.jpg"></a-image>  -->
<!-- </a-scene> -->

<a-scene>
    <a-assets>
    <!-- <audio id="click-sound" src="/images/panorama/304_Hero.mp3"></audio> -->

    <!-- Images. -->
    <img id="p1" src="/images/panorama/dalitang.jpg">
    <!-- <img id="city-thumb" src="https://cdn.aframe.io/360-image-gallery-boilerplate/img/thumb-city.jpg"> -->
    <img id="p2" src="/images/panorama/meishujiaoshi.jpg">
    <!-- <img id="cubes-thumb" src="https://cdn.aframe.io/360-image-gallery-boilerplate/img/thumb-cubes.jpg"> -->
    <img id="p3" src="/images/panorama/yinyuejiaoshi.jpg">
    <!-- <img id="sechelt-thumb" src="https://cdn.aframe.io/360-image-gallery-boilerplate/img/thumb-sechelt.jpg"> -->
    <img id="p4" src="/images/panorama/information-room1.jpg">
    <img id="p5" src="/images/panorama/menting.jpg">
  </a-assets>

    <a-sky id="image-360" src="#p1"></a-sky>

    <a-box src="/images/panorama/pig.jpg" rotation="45 45 45" position="2 0.25 2">
        <!-- <a-animation attribute="position" begin="click" to="1 0.25 1" direction="alternate" dur="100"></a-animation> -->
        <a-animation attribute="rotation" begin="click" to="360 280 -45" dur="2000"></a-animation>
        <!-- <a-animation attribute="position" begin="mouseleave" to="2 0.25 2" dur="100"></a-animation> -->
    </a-box>
    <a-box src="/images/panorama/pig1.jpg" rotation="35 45 0" position="2 0.25 -2">
        <!-- <a-animation attribute="position" to="2 0.25 -2" direction="alternate" dur="2000" repeat="indefinite"></a-animation> -->
        <a-animation attribute="rotation" begin="click" to="-45 -45 -45" direction="alternate" dur="2000"></a-animation>
    </a-box>
    <a-box src="/images/panorama/pig2.jpeg" rotation="65 45 0" position="-2 0.25 -2">
        <!-- <a-animation attribute="position" to="-2 0.25 -2" direction="alternate" dur="2000" repeat="indefinite"></a-animation> -->
        <a-animation attribute="rotation" begin="click" to="-45 -45 -45" direction="alternate" dur="2000"></a-animation>
    </a-box>
    <a-box src="/images/panorama/pig3.jpeg" rotation="78 45 45" position="-2 0.25 2">
        <!-- <a-animation attribute="position" to="-2 0.25 2" direction="alternate" dur="2000" repeat="indefinite"></a-animation> -->
        <a-animation attribute="rotation" begin="click" to="-45 -45 -45" direction="alternate" dur="2000"></a-animation>
    </a-box>

    <a-text value="Happy New Year!" color="#ff0000" position="-0.9 0.2 -3" scale="1.5 1.5 1.5"></a-text>
    <a-camera>
        <a-cursor></a-cursor>
    </a-camera>
    <!-- <a-entity id="box" geometry="primitive: box" material="color: red rotation: 20 40 45 position: 0 0.25 -12"><a-sphere color="red" position="1 0 3"></a-sphere></a-entity> -->
</a-scene>
<!--    <div class="container">
<div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">登陆</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('student.login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">用户名</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" value="" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
!--
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        input type="checkbox" name="remember"> 记住我
                                    </label>
                                </div>
                            </div>
                        </div>
--
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    登录
                                </button>

                                <a class="btn btn-link disabled" href="{{ url('/password/reset') }}">
                                    忘记密码？请联系老师重置
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div> -->
<!-- <script src="/js/aframe-master.js"></script> -->
<!-- <script src="https://aframe.io/releases/0.5.0/aframe.min.js"></script> -->
    <!-- <script src="https://npmcdn.com/aframe-animation-component@3.0.1"></script>
    <script src="https://npmcdn.com/aframe-event-set-component@3.0.1"></script>
    <script src="https://npmcdn.com/aframe-layout-component@3.0.1"></script>
    <script src="https://npmcdn.com/aframe-template-component@3.1.1"></script> -->
    <!-- <script src="/js/set-image.js"></script> -->
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    var pnum = Math.floor(Math.random()*5) + 1;
    $("#image-360").attr("src", "#p"+pnum)
});
</script>
@endsection
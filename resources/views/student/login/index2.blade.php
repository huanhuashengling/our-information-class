@extends('layouts.student')

@section('content')

    
<!-- <a-scene> -->
    <!-- <a-box color="#ff0000" position="0 0.25 -1.5" rotation="20 40 0" height="0.5" width="0.5"></a-box> -->
    <!-- <a-sky src="/images/panorama/meishujiaoshi.jpg" rotation="0 0 0"></a-sky> -->
    <!-- <a-text font="kelsonsans" value="yin yue jiao shi" color="#00ff00" width="6" position="-2.5 0.25 -1.5" -->
              <!-- rotation="0 15 0"></a-text> -->
<!-- <a-image src="/images/panorama/刘熙梓-5af11255304f3.jpg"></a-image>  -->
<!-- </a-scene> -->
<div class="text-center col-md-4">
    <img class="img-responsive img-thumbnail" id="r1" src="/images/panorama/real1.png">
</div>
<div class="text-center col-md-8">
    <img class="img-responsive img-thumbnail" id="p1" src="/images/panorama/pic1.png">
</div>

<a-scene>
    <!-- <a-assets> -->
    <!-- <audio id="click-sound" src="/images/panorama/304_Hero.mp3"></audio> -->

    <!-- Images. -->
    <!-- <img id="p1" src="/images/panorama/pic1.png"> -->
    <!-- <img id="city-thumb" src="https://cdn.aframe.io/360-image-gallery-boilerplate/img/thumb-city.jpg"> -->
    <!-- <img id="p2" src="/images/panorama/pic2.png"> -->
    <!-- <img id="cubes-thumb" src="https://cdn.aframe.io/360-image-gallery-boilerplate/img/thumb-cubes.jpg"> -->
    <!-- <img id="p3" src="/images/panorama/pic3.png"> -->
    <!-- <img id="sechelt-thumb" src="https://cdn.aframe.io/360-image-gallery-boilerplate/img/thumb-sechelt.jpg"> -->
    <!-- <img id="p4" src="/images/panorama/pic4.png"> -->
    <!-- <img id="p5" src="/images/panorama/lt5.png"> -->
    <!-- <img id="p5" src="/images/panorama/menting.jpg"> -->
    <!-- <img id="p6" src="/images/panorama/kexue.jpg"> -->
  <!-- </a-assets> -->

    <!-- <a-sky id="image-360"></a-sky> -->

    <a-box src="/images/panorama/item1.png" rotation="45 45 45" position="1.5 0.25 1.5" id="target1" value="1">
        <!-- <a-animation attribute="position" begin="click" to="1 0.25 1" direction="alternate" dur="100"></a-animation> -->
        <a-animation attribute="rotation" begin="click" to="360 360 360" dur="2000"></a-animation>
        <!-- <a-animation attribute="position" begin="mouseleave" to="2 0.25 2" dur="100"></a-animation> -->
    </a-box>
    <a-box src="/images/panorama/item2.png" rotation="45 45 45" position="1.5 0.25 -1.5" id="target2" value="2">
        <!-- <a-animation attribute="position" to="2 0.25 -2" direction="alternate" dur="2000" repeat="indefinite"></a-animation> -->
        <a-animation attribute="rotation" begin="click" to="360 360 360" direction="alternate" dur="2000"></a-animation>
    </a-box>
    <a-box src="/images/panorama/item3.png" rotation="45 45 45" position="-1.5 0.25 -1.5" id="target3" value="3">
        <!-- <a-animation attribute="position" to="-2 0.25 -2" direction="alternate" dur="2000" repeat="indefinite"></a-animation> -->
        <a-animation attribute="rotation" begin="click" to="360 360 360" direction="alternate" dur="2000"></a-animation>
    </a-box>
    <a-box src="/images/panorama/item4.png" rotation="45 45 45" position="-1.5 0.25 1.5" id="target4" value="4">
        <!-- <a-animation attribute="position" to="-2 0.25 2" direction="alternate" dur="2000" repeat="indefinite"></a-animation> -->
        <a-animation attribute="rotation" begin="click" to="360 360 360" direction="alternate" dur="2000"></a-animation>
    </a-box>

    <!-- <a-text value="Happy New Year!" color="#ff0000" position="-1.16 2.5 -5" scale="1.5 1.5 1.5"></a-text> -->
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
        // $("#p1").attr("src", "/images/panorama/pic1.png");
    // $("#image-360").attr("rotation", "0 215 -0.8")

    // var pnum = Math.floor(Math.random()*5) + 1;
    // var pr = ["0 215 -0.8", "0 -9 -0.5", "0 190 0", "0 135 0", "0 -140 -2", "0 -180 0"];
    // var pr2 = "0 -9 -0.5";
    // var pr3 = "0 190 0";
    // var pr4 = "0 135 0";
    // var pr5 = "0 -140 -2";
    // $("#image-360").attr("src", "#p1")
    // var targetEl1 = document.querySelector('#target1');
    // targetEl1.addEventListener('click', function() {
    //     $("#p1").attr("src", "/images/panorama/pic1.png");
    //     $("#r1").attr("src", "/images/panorama/real1.png");
    // });
    // var targetEl2 = document.querySelector('#target2');
    // targetEl2.addEventListener('click', function() {
    //     $("#p1").attr("src", "/images/panorama/pic2.png");
    //     $("#r1").attr("src", "/images/panorama/real2.png");

    // });
    // var targetEl3 = document.querySelector('#target3');
    // targetEl3.addEventListener('click', function() {
    //     $("#p1").attr("src", "/images/panorama/pic3.png");
    //     $("#r1").attr("src", "/images/panorama/real3.png");
    // });
    // var targetEl4 = document.querySelector('#target4');
    // targetEl4.addEventListener('click', function() {
    //     $("#p1").attr("src", "/images/panorama/pic4.png");
    //     $("#r1").attr("src", "/images/panorama/real4.png");
    // });
    // $("#image-360").attr("src", "#p"+pnum)
    // $("#image-360").attr("rotation", pr[0])
    // $("#image-360").attr("rotation", pr[pnum-1])
    // $("#image-360").attr("src", "#p6");
    // $("#image-360").attr("rotation", "0 -180 0");
});
</script>
@endsection
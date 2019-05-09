@extends('layouts.student')

@section('content')

    

<div class="text-center col-md-10 col-md-offset-1">
    <img class="img-responsive img-thumbnail"  id="person" src="/images/panorama/person.jpg">
    <div class="col-md-12">
        <div class="text-center col-md-4">
            <!-- <img data-magnify="gallery" data-src="big-1.jpg" src="small-1.jpg" id='classmate-post-show'> -->

            <img src="/images/panorama/青铜鼎.jpg" data-src="/images/panorama/青铜鼎.jpg" data-magnify="gallery" style="height: 300px" class="img-responsive img-thumbnail item hidden" id="item1">
        </div>
        <div class="text-center col-md-4">
             <img src="/images/panorama/陶罐.jpg" data-src="/images/panorama/陶罐.jpg" data-magnify="gallery" style="height: 300px"  class="img-responsive img-thumbnail item hidden" id="item2">
        </div>
        <div class="text-center col-md-4">
             <img src="/images/panorama/衣服.jpg" data-src="/images/panorama/衣服.jpg" data-magnify="gallery" style="height: 300px"  class="img-responsive img-thumbnail item hidden" id="item3">
        </div>
    </div>
    <div class="col-md-12" style="padding-top: 10px">

        <div class="text-center col-md-4">
             <img src="/images/panorama/oneitem.png" data-src="/images/panorama/onepic.png" data-magnify="gallery" style="height: 300px"  class="img-responsive img-thumbnail item hidden" id="item4">
        </div> 
        <div class="text-center col-md-4">
             <img src="/images/panorama/twoitem.png" data-src="/images/panorama/twopic.png" data-magnify="gallery" style="height: 300px"  class="img-responsive img-thumbnail item hidden" id="item5">
        </div> 
        <div class="text-center col-md-4">
             <img src="/images/panorama/threeitem.png" data-src="/images/panorama/threepic.png" data-magnify="gallery" style="height: 300px"  class="img-responsive img-thumbnail item hidden" id="item6">
        </div> 
    </div>
</div>
         




@endsection
@section('scripts')
    <link href="/css/jquery.magnify.min.css" rel="stylesheet">
    <link href="/css/magnify-bezelless-theme.css" rel="stylesheet">
    <script src="/js/jquery.magnify.min.js"></script>
    <style type="text/css">
    img
        {
            image-rendering: optimizeSpeed;
            image-rendering: -moz-crisp-edges; /* Firefox */
            image-rendering: -o-crisp-edges; /* Opera */
            image-rendering: -webkit-optimize-contrast; /* Webkit (non-standard naming) */
            image-rendering: pixelated;
            -ms-interpolation-mode: nearest-neighbor; /* IE (non-standard property) */
   </style>
<script>
$(document).ready(function() {
        $('[data-magnify=gallery]').magnify({"modalWidth": 800, "ratioThreshold":0.25, "minRatio": 0.5, "maxRatio": 32, "modalHeight": 600, "title": false, "footToolbar": ['zoomIn', 
'zoomOut', 
'fullscreen',
'actualSize',
'rotateRight']});

    $("#person").on("click", function(e) {
        $("#person").addClass("hidden");
        $(".item").removeClass("hidden");
    });
});
</script>
@endsection
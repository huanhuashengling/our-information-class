@extends('layouts.student')

@section('content')

    

<div class="text-center col-md-10 col-md-offset-1">
    <img class="img-responsive img-thumbnail"  id="person" src="/images/panorama/person.jpg">
    <div class="col-md-12">
        <div class="text-center col-md-4">
            <img src="/images/panorama/陶罐.jpg" style="height: 200px" class="img-responsive img-thumbnail hidden" id="item1">
        </div>
        <div class="text-center col-md-4">
             <img src="/images/panorama/衣服.jpg" style="height: 200px"  class="img-responsive img-thumbnail hidden" id="item2">
        </div>
        <div class="text-center col-md-4">
             <img src="/images/panorama/像素.jpg" style="height: 200px"  class="img-responsive img-thumbnail hidden" id="item3">
        </div>
    </div>
    <div class="col-md-12">

        <div class="text-center col-md-4">
             <img src="/images/panorama/花砖.jpg" style="height: 200px"  class="img-responsive img-thumbnail hidden" id="item4">
        </div> 
        <div class="text-center col-md-4">
             <img src="/images/panorama/花砖.jpg" style="height: 200px"  class="img-responsive img-thumbnail hidden" id="item5">
        </div> 
        <div class="text-center col-md-4">
             <img src="/images/panorama/花砖.jpg" style="height: 200px"  class="img-responsive img-thumbnail hidden" id="item6">
        </div> 
    </div>
        <div class="col-md-12">

        <div class="text-center col-md-4">
             <img src="/images/panorama/花砖.jpg" style="height: 200px"  class="img-responsive img-thumbnail hidden" id="item7">
        </div> 
        <div class="text-center col-md-4">
             <img src="/images/panorama/花砖.jpg" style="height: 200px"  class="img-responsive img-thumbnail hidden" id="item8">
        </div> 
        <div class="text-center col-md-4">
             <img src="/images/panorama/花砖.jpg" style="height: 200px"  class="img-responsive img-thumbnail hidden" id="item9">
        </div> 
    </div>
    <div class="col-md-12">
        <button class="btn btn-success item-btn" value="1">青铜器</button>
        <button class="btn btn-success item-btn" value="2">古代陶罐</button>
        <button class="btn btn-success item-btn" value="3">古代衣服</button>
        <button class="btn btn-success item-btn" value="4">青铜器</button>
        <button class="btn btn-success item-btn" value="5">古代陶罐</button>
        <button class="btn btn-success item-btn" value="6">古代衣服</button>
        <button class="btn btn-success item-btn" value="7">青铜器</button>
        <button class="btn btn-success item-btn" value="8">古代陶罐</button>
        <button class="btn btn-success item-btn" value="9">古代衣服</button>
    </div>
</div>
         




@endsection
@section('scripts')

<script>
$(document).ready(function() {
    $(".item-btn").on("click", function(e) {
        $("#person").addClass("hidden");
        $("#item" + $(this).val()).removeClass("hidden");
    });
});
</script>
@endsection
@extends('layouts.student')

@section('content')

    

<div class="text-center col-md-10 col-md-offset-1">
    <img class="img-responsive img-thumbnail"  id="person" src="/images/panorama/person.jpg">
    <div class="col-md-12">
        <div class="text-center col-md-4">
            <img src="/images/panorama/青铜鼎.jpg" style="height: 250px" class="img-responsive img-thumbnail hidden" id="item1">
        </div>
        <div class="text-center col-md-4">
             <img src="/images/panorama/花砖.jpg" style="height: 250px"  class="img-responsive img-thumbnail hidden" id="item2">
        </div>
        <div class="text-center col-md-4">
             <img src="/images/panorama/包包.jpg" style="height: 250px"  class="img-responsive img-thumbnail hidden" id="item3">
        </div>
    </div>
    <div class="col-md-12">

        <div class="text-center col-md-4">
             <img src="/images/panorama/陶罐.jpg" style="height: 250px"  class="img-responsive img-thumbnail hidden" id="item4">
        </div> 
        <div class="text-center col-md-4">
             <img src="/images/panorama/碗.jpg" style="height: 250px"  class="img-responsive img-thumbnail hidden" id="item5">
        </div> 
        <div class="text-center col-md-4">
             <img src="/images/panorama/鼠标垫.jpg" style="height: 250px"  class="img-responsive img-thumbnail hidden" id="item6">
        </div> 
    </div>
        <div class="col-md-12">

        <div class="text-center col-md-4">
             <img src="/images/panorama/衣服.jpg" style="height: 250px"  class="img-responsive img-thumbnail hidden" id="item7">
        </div> 
        <div class="text-center col-md-4">
             <img src="/images/panorama/苗族服饰.jpg" style="height: 250px"  class="img-responsive img-thumbnail hidden" id="item8">
        </div> 
        <div class="text-center col-md-4">
             <img src="/images/panorama/像素.jpg" style="height: 250px"  class="img-responsive img-thumbnail hidden" id="item9">
        </div> 
    </div>
    <div class="col-md-12">
        <button class="btn btn-success item-btn" value="1">青铜鼎</button>
        <button class="btn btn-success item-btn" value="4">陶罐</button>
        <button class="btn btn-success item-btn" value="7">古代衣服</button>
        <button class="btn btn-success item-btn" value="2">厦门花砖</button>
        <button class="btn btn-success item-btn" value="5">碗</button>
        <button class="btn btn-success item-btn" value="8">民族服饰</button>
        <button class="btn btn-success item-btn" value="3">名牌包包</button>
        <button class="btn btn-success item-btn" value="6">鼠标垫</button>
        <button class="btn btn-success item-btn" value="9">像素花纹</button>
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
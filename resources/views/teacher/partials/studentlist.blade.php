@foreach ($students as $student)
    @php
        $studentPostData = $postData[$student->students_id]['post'];
        $rate = $postData[$student->students_id]['rate'];
        if ("outstanding" == $rate) {
            $ratestr = "优";
        } elseif ("good" == $rate) {
            $ratestr = "良";
        } elseif ("lower" == $rate) {
            $ratestr = "合";
        } elseif ("unqualified" == $rate) {
            $ratestr = "差";
        } else {
            $ratestr = "";
        }
        $hasComment = $postData[$student->students_id]['hasComment']?"未评":"已评";
        $marksNum = $postData[$student->students_id]['marksNum'];
        $postClass = "";
        
        if (isset($studentPostData)) {
            //$img = env('APP_URL')."/posts/".$studentPostData['storage_name'];
            //$img = env('APP_URL')."/posts/".$studentPostData['storage_name'];
            $img = $studentPostData['storage_name'];
            $postClass = "post-btn";
        } else {
            //$img = env('APP_URL')."/images/defaultphoto.png";
            $img = "defaultphoto.png";
        }
    @endphp

    @if ("posted" == $showLimit && !isset($studentPostData))
        @continue;
    @endif

    @if ("noPosted" == $showLimit && isset($studentPostData))
        @continue;
    @endif
    <!--
       
        style="background-color: #d1e9e9" img-responsive 
         style="background:url({{$img}}); background-size: '20px 20px'"
    -->
    <div class="col-md-2 col-sm-4 col-xs-6" style="padding-left: 5px; padding-right: 5px;">
        <div class="panel panel-default">
            <!--<div class="text-center"><img class="{{$postClass}}" height="90px" value="{{ $studentPostData['id'] }}" src="{{$img}}"></div>-->
            <div class="text-center"><img class="img-responsive {{$postClass}}" value="{{ $studentPostData['id'] }}" src="{{ getThumbnail($img, 140, 100, 'fit') }}" alt=""></div>
            <div class="text-center"><h3><b>{{ $py->getFirstchar($student->username) }}</b> <small>{{ $student->username }}<span class="text-right"> ({{$ratestr}}|{{$hasComment}}|{{$marksNum}}赞)</span></small></h3>  </div>
        </div>
    </div>
@endforeach
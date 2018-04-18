@foreach ($students as $student)
    @php
        $studentPostData = $postData[$student->students_id]['post'];
        $rate = $postData[$student->students_id]['rate'];
        $hasComment = $postData[$student->students_id]['hasComment'];
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
            <div class="text-center"><h3><b>{{ $py->getFirstchar($student->username) }}</b> <small>{{ $student->username }}<span class="text-right"> (优|评|20赞)</span></small></h3>  </div>

        </div>
            <!--@if (isset($studentPostData))
            <tr><td>
            @php
                $rateStr = "";
                $btnClass = "";
                @endphp
                @if ("outstanding" == $rate)
                @php
                    $rateStr = "优秀 / ";
                    $btnClass = "danger";
                    @endphp
                @elseif ("good" == $rate)
                @php
                    $rateStr = "良好 / ";
                    $btnClass = "success";
                    @endphp
                @elseif ("lower" == $rate)
                @php
                    $rateStr = "合格 / ";
                    $btnClass = "info";
                    @endphp
                @elseif ("unqualified" == $rate)
                @php
                    $rateStr = "不合格 / ";
                    $btnClass = "warning";
                    @endphp
                @else
                @php
                    $rateStr = "未评 / ";
                    $btnClass = "primary";
                    @endphp
                @endif
                <label class='post-btn' value="{{ $studentPostData['id'] }}">
                {{$rateStr}}
                
                @if ("true" == $hasComment)
                    已评 / 
                @endif
                @if (isset($studentPostData))
                    {{$marksNum}}个赞
                @endif
                </label>
                </td></tr>
            @endif-->
            
    </div>
@endforeach
@foreach ($students as $student)
    @php
        $studentPostData = $postData[$student->students_id]['post'];
        $rate = $postData[$student->students_id]['rate'];
        $hasComment = $postData[$student->students_id]['hasComment'];
        $marksNum = $postData[$student->students_id]['marksNum'];
    @endphp

    @if ("posted" == $showLimit && !isset($studentPostData))
        @continue;
    @endif

    @if ("noPosted" == $showLimit && isset($studentPostData))
        @continue;
    @endif
    <div class="col-md-2 col-sm-4 col-xs-6">
        <table class="table">
            <tr><td style="background-color: #b3d9d9"><b>{{ $py->getFirstchar($student->username) }}</b> <small>{{ $student->username }}</small></td></tr>
            <tr><td style="background-color: #d1e9e9">
            @if (isset($studentPostData))
                <button class='btn btn-success form-control post-btn' value="{{ $studentPostData['id'] }}">
                @if ("outstanding" == $rate)
                    优秀 / 
                @elseif ("good" == $rate)
                    良好 / 
                @elseif ("lower" == $rate)
                    合格 / 
                @endif
                
                @if ("true" == $hasComment)
                    已评 / 
                @endif
                @if (isset($studentPostData))
                    {{$marksNum}}个赞
                @endif
                </button>
            @else
                <button class='btn btn-default form-control'>未提交</button>
            @endif
            </td></tr>
        </table>
    </div>
@endforeach
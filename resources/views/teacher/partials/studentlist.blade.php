@foreach ($students as $student)
    @php
        $studentPostData = $postData[$student['users_id']]['post'];
        $rate = $postData[$student['users_id']]['rate'];
        $hasComment = $postData[$student['users_id']]['hasComment'];
    @endphp

    @if ("posted" == $showLimit && !isset($studentPostData))
        @continue;
    @endif

    @if ("noPosted" == $showLimit && isset($studentPostData))
        @continue;
    @endif
    <div class="col-md-2 col-sm-3 col-xs-4">
        <table class="table table-bordered">
            <tr><td>{{ $py->getFirstchar($student['username']) }} {{ $student['username'] }}</td></tr>
            <tr><td>
            @if (isset($studentPostData))
                <button class='btn btn-success form-control' value="{{ $studentPostData['id'] }},{{ $studentPostData['file_path'] }}">已提交</button>
            @else
                <button class='btn btn-default form-control disabled'>未提交</button>
            @endif
            </td></tr>
            <tr>
            <td>
            @if ("outstanding" == $rate)
                <button class="btn btn-primary btn-xs">优秀</button>
            @elseif ("good" == $rate)
                <button class="btn btn-primary btn-xs">良好</button>
            @elseif ("lower" == $rate)
                <button class="btn btn-primary btn-xs">合格</button>
            @endif
            
            @if ("true" == $hasComment)
                <button class="btn btn-info btn-xs">已评</button>
            @endif

            @if ("true" == $hasComment)
                <button class="btn btn-danger btn-xs">123 赞</button>
            @endif
            
                
            </td>
            </tr>
        </table>
    </div>
@endforeach
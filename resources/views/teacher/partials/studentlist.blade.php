@foreach ($students as $student)
    @php
        $studentPostData = $postData[$student['users_id']]['post'];
        $rate = $postData[$student['users_id']]['rate'];
        $hasComment = $postData[$student['users_id']]['hasComment'];
        //dd($postData);die();
    @endphp

    @if ("posted" == $showLimit && !isset($studentPostData))
        @continue;
    @endif

    @if ("noPosted" == $showLimit && isset($studentPostData))
        @continue;
    @endif
    <div class="col-md-2 col-sm-3 col-xs-4">
        <table class="table table-bordered">
            <tr><td><b>{{ $py->getFirstchar($student['username']) }}</b></td><td colspan="3">{{ $student['username'] }}</td></tr>
            <tr><td colspan="4">
            @if (isset($studentPostData))
                <button class='btn btn-success form-control' value="{{ $studentPostData['id'] }},{{ $studentPostData['file_path'] }}">已提交</button>
            @else
                <button class='btn btn-default form-control disabled'>未提交</button>
            @endif
            </td></tr>
            <tr>
            <td>
            @if ("outstanding" == $rate)优
                    <!-- <span class="glyphicon glyphicon-star" aria-hidden="true"></span> -->
                @elseif ("good" == $rate)良
                    <!-- <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span> -->
                @elseif ("lower" == $rate)合格
                    <!-- <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> -->
                @endif
            <!-- <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> -->
            </td>
            <td>
                @if ("true" == $hasComment)
                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                @endif

            </td>
            <td>
            <button class="btn btn-danger"><span class="badge">23</span>赞</button>
                
            </td>
            </tr>
        </table>
    </div>
@endforeach
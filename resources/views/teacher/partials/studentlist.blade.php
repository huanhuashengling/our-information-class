@foreach ($students as $student)

    @if ("posted" == $showLimit && !isset($postData[$student['users_id']]))
        @continue;
    @endif

    @if ("noPosted" == $showLimit && isset($postData[$student['users_id']]))
        @continue;
    @endif
    <div class="col-md-2 col-sm-3 col-xs-4">
        <table class="table table-bordered">
            <tr><td><b>{{ $py->getFirstchar($student['username']) }}</b></td><td colspan="3">{{ $student['username'] }}</td></tr>
            <tr><td colspan="4">
            @if (isset($postData[$student['users_id']]))
                <button class='btn btn-success form-control' value="{{ $postData[$student['users_id']]['id'] }},{{ $postData[$student['users_id']]['file_path'] }}">已提交</button>
            @else
                <button class='btn btn-default form-control disabled'>未提交</button>
            @endif
            </td></tr>
            <tr>
            <td>23<span class="glyphicon glyphicon-heart" aria-hidden="true"></span></td>
            <td><span class="glyphicon glyphicon-star" aria-hidden="true"></span></td>
            <td><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></td>
            </tr>
        </table>
    </div>
@endforeach
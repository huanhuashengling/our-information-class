@foreach ($students as $student)
    @php
        if (isset($student->rate)) {
            $ratestr = $student->rate;
            $hasCommentCss = "alert-info";
        } else {
            $ratestr = "";
            $hasCommentCss = "alert-default";
        }
        if (isset($student->content)) {
            $hasCommentCss = "alert-danger";
        }
        $marksNum = isset($student->mark_num)?($student->mark_num . "赞"):"";
    @endphp
    <div class="col-md-2 col-sm-4 col-xs-6" style="padding-left: 5px; padding-right: 5px;">
        <div class="alert {{$hasCommentCss}}" style="padding: 5px;">
            <div><img class="img-responsive post-btn center-block" value="{{ $student->posts_id }}" src="{{ getThumbnail($student->storage_name, 140, 100, 'fit') }}" alt=""></div>
            <div><h3 style="margin-top: 10px;">{{ $py->getFirstchar($student->username) }} <small>{{ $student->username }}<span class="text-right"> {{$ratestr}} {{$marksNum}}</span></small></h3>  </div>
        </div>
    </div>
@endforeach
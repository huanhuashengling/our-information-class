@foreach ($students as $student)
    @php
        if (isset($student->rate)) {
            $ratestr = $student->rate . "/";
            if ("优+" == $student->rate) {
                $postCss = "alert-danger";
            } else if ("优" == $student->rate) {
                $postCss = "alert-success";
            } else {
                $postCss = "alert-info";
            }
        } else {
            $ratestr = "";
            $postCss = "alert-default";
        }
        $commentStr = "";
        if (isset($student->content) && "" != $student->content) {
            $commentStr = "/评";
        }

        $marksNum = isset($student->mark_num)?$student->mark_num:"";
    @endphp
    <div class="col-md-2 col-sm-4 col-xs-6" style="padding-left: 5px; padding-right: 5px;">
        <div class="alert {{$postCss}}" style="padding: 5px;">
            <div><img class="img-responsive post-btn center-block" value="{{ $student->posts_id }}" src="{{ getThumbnail($student->storage_name, 140, 100, $schoolCode, 'fit', $student->file_ext) }}" alt=""></div>
            <div><h3 style="margin-top: 10px;">{{ $py->getFirstchar($student->username) }} <small>{{ $student->username }}<small></small><span class="text-right"> {{$ratestr}}{{$marksNum}}{{$commentStr}}</span></small></h3>  </div>
        </div>
    </div>
@endforeach
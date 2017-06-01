@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        @foreach ($lessonLogs as $key => $lesson)
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="heading{{$key}}">
                  <h4 class="panel-title"  value="{{$lesson['lessons_id']}}">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                      {{ $key+1 }}. {{ $lesson->title }} {{ $lesson->subtitle }}
                    </a>
                  </h4>
                </div>
                <div id="collapse{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$key}}">
                  <div class="panel-body">
                    <div id="lesson{{$lesson['lessons_id']}}">
                    </div>
                  </div>
                </div>
              </div>
        @endforeach

    </div>
</div>
@endsection

@extends('layouts.student')

@section('content')
<div class="container">
    {!! Breadcrumbs::render('lesson', $lesson) !!}
    <div class="panel panel-default">
      <div class="panel-body">
        {!! $lesson['help_md_doc'] !!}
      </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="/js/student/open-classroom.js?v={{rand()}}"></script>
@endsection
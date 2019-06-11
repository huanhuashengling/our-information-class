@extends('layouts.student')

@section('content')
<div class="container">
    {!! $lesson['help_md_doc'] !!}
</div>
@endsection

@section('scripts')
    <script src="/js/student/open-classroom.js?v={{rand()}}"></script>
@endsection
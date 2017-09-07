@extends('layouts.admin')

@section('content')
<div class="container">

<div class="panel panel-primary">
  <div class="panel-heading">导入学生账户</div>
  <div class="panel-body">
    {!! Form::open(array('url'=>'admin/importStudents','method'=>'POST','files'=>'true')) !!}
        {!! Form::file('xls', ['id' => 'import-student-account', 'type'=>"file" ]) !!}
        {!! Form::close() !!}
  </div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">管理学生账户</div>
  <div class="panel-body">

  @foreach ($schoolClasses as $schoolClass)
      <button class="btn btn-primary">{{ $schoolClass }} <span class="badge">23</span></button>
  @endforeach

  </div>
</div>
</div>
@endsection

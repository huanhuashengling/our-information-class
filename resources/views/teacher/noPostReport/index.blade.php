@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif
                    <div class="form-group">
                        {!! Form::select('sclasses_id', $classData, null, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="no-post-report" class="col-md-2 col-md-offset-4"></div>
    
</div>
@endsection

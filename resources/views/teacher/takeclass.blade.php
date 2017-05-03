@extends('layouts.teacher')

@section('content')

<div class="container">
<!--<input type="hidden" id="lesson-log-id" value="{{ $lessonLog['id'] }}">
    <div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>-->
    <!-----start panel-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-1 col-sm-4"><h4>{{ $schoolClass['title'] }}班</h4></div>
                <div class="col-md-3 col-sm-4"><h4><small>(5738号)</small>{{ $lesson['title'] }}<small>({{ $lesson['subtitle'] }})</small></h4></div>
                
                <div class="col-md-1 col-sm-2 col-xs-6">{!! Form::button('姓名排序',['class'=>'btn btn-info', 'id' => 'close-lesson-log']) !!}</div>
                <!-- <div class="col-md-1 col-sm-2 col-xs-6">{!! Form::button('点赞排序',['class'=>'btn btn-info', 'id' => 'close-lesson-log']) !!}</div> -->
                <div class="col-md-1 col-sm-2 col-xs-6">{!! Form::button('结束上课',['class'=>'btn btn-danger', 'id' => 'close-lesson-log']) !!}</div>
            </div>
        </div>
        <div class="panel-body">

            <ul class="nav nav-tabs">
                <li class='active'><a href="#identifier" data-toggle="tab">全部</a></li>
                <li><a href="#identifier" data-toggle="tab">已交作业</a></li>
                <li><a href="#identifier" data-toggle="tab">未交作业</a></li>
                <li><a href="#identifier" data-toggle="tab">已评作业</a></li>
            </ul>
            <!-- </div> -->
            <!-----start tab content-->
            <div class="tab-content">
                <!-----start tab-->
                <div class="tab-pane fade in active" id="home">
                        @foreach ($students as $student)
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <table class="table table-bordered">
                                    <tr><td><b>{{ $py->getFirstchar($student['username']) }}</b></td><td colspan="3">{{ $student['username'] }}</td></tr>
                                    <tr><td colspan="4">
                                    @if (isset($postData[$student['users_id']]))
                                        <button class='btn btn-success form-control'>已提交</button>
                                    @else
                                        <button class='btn btn-default form-control disabled'>未提交</button>
                                    @endif
                                    </td></tr>
                                    <tr>
                                    <td><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></td>
                                    <td  colspan="2"> 23 <span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span></td>
                                    <td><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span></td>
                                    </tr>
                                </table>
                            </div>
                        @endforeach
                </div>
                <!--end tab-->
                <!-----start tab-->
                <div class="tab-pane fade" id="svn">
                        @foreach ($students as $student)
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <table class="table table-bordered">
                                    <tr><td>{{ $student['username'] }}</td><td>{{ $student['username'] }}</td></tr>
                                    <tr><td colspan="2">
                                    @if (isset($postData[$student['users_id']]))
                                        <button class='btn btn-success form-control'>未提交</button>
                                    @else
                                        <button class='btn btn-default form-control disabled'>提交</button>
                                    @endif
                                    </td></tr>
                                    <tr><td><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></td><td> 23 <span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span></td></tr>
                                </table>
                            </div>
                        @endforeach
                </div>
                <!--end tab-->
            </div>
            <!--end tab content-->
        </div>
        <!--end panel body-->
    </div>
    <!-----end panel-->
</div>

@endsection
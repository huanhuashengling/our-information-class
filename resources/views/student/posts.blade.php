@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>新增失败</strong> 输入不符合要求<br><br>
            {!! implode('<br>', $errors->all()) !!}
        </div>
    @endif
        
            @foreach ($posts as $key => $post)
            <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading" role="tab">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                        #{{ $key }} 课题： {{ $post['lesson']['title'] }} <small>{{ $post['lesson']['subtitle'] }} </small>
                    </a>
                  </h4>
                </div>
                    @if (isset($post['post']))
                        <table class="table table-bordered">
                            <tr>
                            <td><span class="glyphicon glyphicon-heart" aria-hidden="true">12</span></td>
                            <td><span class="glyphicon glyphicon-star" aria-hidden="true"></span></td>
                            <td><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></td>
                            <td>
                                <button class='btn btn-success btn-sm' value="{{$post['post']['file_path']}}">查看作业</button>
                            </td>
                            <!-- <td><button class='btn btn-success btn-sm' value="{{$post['post']['file_path']}}">更新作业</button></td> -->
                            </tr>
                        </table>
                    @else
                        <table class="table table-bordered">
                            <tr>
                            <td colspan="3">本节课作业未交</td>
                            <td>
                                <!-- <button class='btn btn-success btn-sm' value="{{$post['post']['file_path']}}">补交作业</button> -->
                            </td>
                            </tr>
                        </table>
                    @endif
                </div>
        </div>

            @endforeach
    </div>
</div>
@endsection
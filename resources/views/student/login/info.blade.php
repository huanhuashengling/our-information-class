@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">你的个人信息</div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>所在学校：</dt>
                        <dd>{{ $student->district_title }}{{ $student->title }}</dd>
                        <dt>校内班级：</dt>
                        <dd>{{ $student->grade_key }}{{ $student->class_title }}班</dd>
                        <dt>班内分组：</dt>
                        <dd>暂无</dd>
                        <dt>姓名：</dt>
                        <dd>{{ $student->username }}</dd>
                        <dt>性别：</dt>
                        <dd>{{ ($student->gender == "0")?"女":"男" }}</dd>
                    </dl>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">你的全部作业情况</div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>已上信息课数量：</dt>
                        <dd>{{ $allLessonLogNum }}</dd>
                        <dt>已交作业数量：</dt>
                        <dd>{{ $postNum }}</dd>
                        <dt>未交作业数量：</dt>
                        <dd>{{ $unPostNum }}</dd>
                        <dt>评优+作业数量：</dt>
                        <dd>{{ $rateYouJiaNum }}</dd>
                        <dt>评优作业数量：</dt>
                        <dd>{{ $rateYouNum }}</dd>
                        <dt>评待完成作业数量：</dt>
                        <dd>{{ $rateDaiWanNum }}</dd>
                        <dt>未评作业数量：</dt>
                        <dd>{{ $rateWeipingNum }}</dd>
                        <dt>有评语作业数量：</dt>
                        <dd>{{ $commentNum }}</dd>
                        <dt>获得的点赞数量：</dt>
                        <dd>{{ $markNum }}</dd>
                        <dt>给别人点赞数量：</dt>
                        <dd>{{ $markOthersNum }}</dd>
                    </dl>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">你的学期作业发送至家长情况</div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>家长邮箱地址：</dt>
                        <dd>{{ ($student->email)?"$student->email":"请邀请家长提供邮箱地址，关注你的信息课堂" }}</dd>
                        @if ($student->email)
                        <dt>已发送作业次数：</dt>
                        <dd>{{ ($student->email)?"1次":"无" }}</dd>
                        <dt>已发送作业时间：</dt>
                        <dd>{{ ($student->email)?"2018年期末":"无" }}</dd>
                        <dt>是否收到家长反馈：</dt>
                        <dd>无</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

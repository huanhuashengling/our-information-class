@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="form-group col-md-2">{!! Form::select('score_report_sclasses_id', $classData, null, ['class'=>'form-control']) !!}</div>
    <div class="form-group col-md-2">
        <select name="score_report_terms_id" class='form-control'>
            <option>请先选择班级</option>
        </select>
    </div>
    <div id="toolbar">
        <button class="btn btn-success" id="export-score-report-btn">导出成绩</button>
        <button class="btn btn-success" id="email-all-out-btn">发送所有邮件</button>
    </div>
    <table id="score-report" class="table table-condensed table-responsive">
        <thead>
            <tr>
                <th data-field="" checkbox="true">

                </th>
                <th data-field="">
                    序号
                </th>
                <th data-field="users_id" data-sortable="true">
                    ID
                </th>
                <th data-field="username" data-sortable="true">
                    学生姓名
                </th>
                <th data-field="postedNum" data-sortable="true">
                    已交
                </th>
                <th data-field="rateYouJiaNum" data-sortable="true">
                    优+
                </th>
                <th data-field="rateYouNum" data-sortable="true">
                    优
                </th>
                <th data-field="rateDaiWanNum" data-sortable="true">
                    待完善
                </th>
                <th data-field="unPostedNum" data-sortable="true">
                    未交
                </th>
                <th data-field="markNum" data-sortable="true">
                    点赞
                </th>
                <th data-field="effectMarkNum" data-sortable="true">
                    有效赞
                </th>
                <th data-field="commentNum" data-sortable="true">
                    评论
                </th>
                <th data-field="scoreCount" data-sortable="true">
                    分数合计
                </th>
                <th data-field="users_id" data-formatter="emailCol" data-events="emailActionEvents">
                  邮件报告
              </th>
            </tr>
        </thead>
    </table>
    
</div>
@endsection

@section('scripts')
    <script src="/js/teacher/score-report.js"></script>

    <script src="/js/FileSaver.js"></script>
    <script src="/js/bootstrap-table-export.js"></script>
    <script src="/js/tableexport.js"></script>
@endsection
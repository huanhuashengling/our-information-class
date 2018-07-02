@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="form-group col-md-5">{!! Form::select('no_post_sclasses_id', $classData, null, ['class'=>'form-control']) !!}</div>
    <div id="toolbar">
        <button class="btn btn-success" id="export-score-report-btn">导出成绩</button>
    </div>
    <table id="score-report" class="table table-condensed table-responsive">
        <thead>
            <tr>
                <th data-field="" checkbox="true">

                </th>
                <th data-field="">
                    序号
                </th>
                <th data-field="username" data-sortable="true">
                    学生姓名
                </th>
                <th data-field="postedNum" data-sortable="true">
                    已交
                </th>
                <th data-field="unPostedNum" data-sortable="true">
                    未交
                </th>
                <th data-field="rateYouNum" data-sortable="true">
                    优
                </th>
                <th data-field="rateLiangNum" data-sortable="true">
                    良
                </th>
                <th data-field="rateHeNum" data-sortable="true">
                    合格
                </th>
                <th data-field="rateChaNum" data-sortable="true">
                    差
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
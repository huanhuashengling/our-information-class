@extends('layouts.admin')

@section('content')
<div class="container" style="">
    <h4>本页面统计为当前学期的数据</h4>
        <!-- <div class="col-md-10 col-md-offset-1"> -->
            <!-- <div class="col-md-4 col-md-offset-1"> -->
                <div class="panel panel-default">
                    <div class="panel-heading">四年级作业数统计</div>
                    <div class="panel-body">
                        <canvas id="posts-count-per-class-same-grade-chart-1"></canvas>
                    </div>
                </div>
            <!-- </div> -->
            <!-- <div class="col-md-4"> -->
                <div class="panel panel-default">
                    <div class="panel-heading">五年级作业数统计</div>
                    <div class="panel-body">
                        <canvas id="posts-count-per-class-same-grade-chart-2"></canvas>
                    </div>
                </div>
            <!-- </div> -->
        <!-- </div> -->

            <div class="panel panel-default">
                <div class="panel-heading">四年级点赞数统计</div>
                <canvas id="mark-count-per-class-same-grade-chart-1"></canvas>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">五年级点赞数统计</div>
                <canvas id="mark-count-per-class-same-grade-chart-2"></canvas>
            </div>

            <!-- <div class="panel panel-default">
                <div class="panel-heading">完成作业率统计，每节课作业数比班总人数</div>
                <canvas id="posted-percent-per-class-chart"></canvas>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">某节课在各年级完成数</div>
                <canvas id="posted-count-per-lesson-log-chart"></canvas>
            </div>
        </div> -->
<!-- </div> -->
</div>
@endsection

@section('scripts')
    <script src="/js/school/Chart.js"></script>
    <script src="/js/school/utils.js"></script>
    <script src="/js/school/dashboard.js"></script>
@endsection
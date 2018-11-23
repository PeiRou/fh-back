@extends('back.master')

@section('title','访问报表')

@section('content')
    <div class="content-top" style="position: relative">
        <div class="breadcrumb">
            <b>位置：</b>访问报表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable()"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div id="myChart" style="width:98%; height:400px"></div>
    <div class="table-content" style="margin-top:-40px;">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div style="line-height: 32px;">时间：</div>
                    <div class="ui calendar" id="rangestart" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="startTime" value="{{ date('Y-m-d') }}" placeholder="">
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="ui calendar" id="rangeend" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="endTime" value="{{ date('Y-m-d') }}" placeholder="">
                        </div>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                </div>
            </div>
        </div>
        <table id="dataTable" class="ui small selectable celled striped table" cellspacing="0" width="100%" style="text-align:center">
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/echarts/echarts.js"></script>
    <script>
        // 基于准备好的dom，初始化ECharts实例
        var myChart = echarts.init(document.getElementById('myChart'));
        // 指定图表的配置项和数据
        var option = {
            tooltip : {
                trigger: 'axis'
            },
            legend: {
                data:[]
            },
            toolbox: {
                show : true,
                feature : {
                    mark : {show: true},
                    dataView : {show: true, readOnly: false},
                    magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                    restore : {show: true},
                    saveAsImage : {show: true}
                }
            },
            calculable : true,
            xAxis : [
                {
                    type : 'category',
                    boundaryGap : false,
                    data : ['00:00:00','01:00:00','02:00:00','03:00:00','04:00:00','05:00:00','06:00:00','07:00:00','08:00:00','09:00:00','10:00:00','11:00:00','12:00:00','13:00:00','14:00:00','15:00:00','16:00:00','17:00:00','18:00:00','19:00:00','20:00:00','21:00:00','22:00:00','23:00:00']
                }
            ],
            yAxis : [
                {
                    type : 'value',
                    name : '访问次数',
                }
            ],
            series : [
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'},
                {name:'',type:'line'}
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/report_browse.js"></script>
@endsection

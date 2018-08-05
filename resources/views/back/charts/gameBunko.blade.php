@extends('back.master')

@section('title','盈亏统计')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>盈亏统计
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('reportAgentTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields"></div>
            </div>
        </div>

        <div id="gameBunkoCharts" style="width: 100%;height:600px;"></div>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/echarts/echarts.js"></script>
    <script src="/back/js/pages/charts_gamebunko.js"></script>
@endsection
@extends('back.master')

@section('title','充值统计')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>充值统计
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshCharts()"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields"></div>
            </div>
        </div>

        <div id="rechargeCharts" style="width: 100%;height:600px;"></div>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/echarts/echarts.js"></script>
    <script src="/back/js/pages/charts_recharges.js"></script>
@endsection
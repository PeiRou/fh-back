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
@endsection

@section('page-js')
    <script src="/vendor/echarts/echarts.js"></script>
    <script src="/back/js/pages/charts_gamebunko.js"></script>
@endsection
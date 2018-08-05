@extends('back.master')

@section('title','投注报表')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>投注报表
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('reportBetTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
            </div>
        </div>
        <table id="reportBetTable" class="ui right aligned small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="120px">彩种</th>
                <th>投注金额</th>
                <th>笔数</th>
                <th>人数</th>
                <th>返点</th>
                <th>中奖金额</th>
                <th>笔数(输赢占比)</th>
                <th>人数</th>
                <th>公司损益</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/report_bet.js"></script>
@endsection
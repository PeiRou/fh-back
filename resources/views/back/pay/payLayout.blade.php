@extends('back.master')
@section('title','支付层级配置')
@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>支付层级配置
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('levelTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addLevel()">添加层级</span>
        </div>
    </div>
    <div class="table-content">
        <table id="levelTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>分层名称</th>
                <th>每笔在线最高充值金额</th>
                <th>当日在线最高充值金额</th>
                <th>每笔最高提现金额</th>
                <th>当日最高提现金额</th>
                <th>状态</th>
                <th width="280">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/pay_layout.js"></script>
@endsection
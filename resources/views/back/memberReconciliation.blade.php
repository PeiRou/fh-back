@extends('back.master')

@section('title','会员对账')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>会员对账
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('memberReconciliationTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div style="line-height: 32px;">时间：</div>
                    <div class="two wide field">
                        <input type="text" id="promoter" placeholder="">
                    </div>
                    <div class="two wide field">
                        <input type="text" id="noLoginDays" placeholder="">
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                </div>
            </div>
        </div>
        <table id="memberReconciliationTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>日期</th>
                <th>昨日会员余额</th>
                <th>今日线上充值</th>
                <th>今日线下充值</th>
                <th>今日实际输赢</th>
                <th>今日未结算</th>
                <th>今日提款</th>
                <th>今日活动奖金</th>
                <th>今日红包金额</th>
                <th>今日会员余额</th>
                <th>对账差别金额</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/member_reconciliation.js"></script>
@endsection
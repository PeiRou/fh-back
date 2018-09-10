@extends('back.master')

@section('title','资金明细')

@section('content')
    <style>
        .field .active{
            background: #00b5ad !important;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>代理结算报表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('capitalDetailsTable')"><i class="iconfont">&#xe61d;</i></span>
            {{--<span onclick="settlement()">手动结算</span>--}}
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div style="line-height: 32px;">代理账号：</div>
                    <div class="one wide field" style="width: 9% !important;">
                        <input type="text" id="account" placeholder="代理账号">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="status" style='height:32px !important'>
                            <option value="">状态：</option>
                            @foreach($aStatus as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field" style="width: 9% !important;">
                        <input type="text" id="order_id" placeholder="订单号">
                    </div>
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
                    <div class="one wide field button-1">
                        <button class="fluid ui mini blue button">上月</button>
                        <input type="hidden" name="monthTime" class="monthTime" value="lastMonth">
                    </div>
                    <div class="one wide field button-1">
                        <button class="fluid ui mini blue button">本月</button>
                        <input type="hidden" name="monthTime" class="monthTime" value="month">
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                    <div class="one wide field">
                        <button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置 </button>
                    </div>
                </div>
            </div>
        </div>
        <table id="capitalDetailsTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>订单日期</th>
                <th>处理日期</th>
                <th>会员</th>
                <th>余额</th>
                <th>订单号</th>
                <th>状态</th>
                <th>付款方式</th>
                <th>操作人</th>
                <th>交易金额</th>
                <th>银行信息</th>
                <th>出款方式</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/agentSettleWithdraw.js"></script>
@endsection
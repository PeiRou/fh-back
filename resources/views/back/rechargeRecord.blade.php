@extends('back.master')

@section('title','充值记录')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>充值记录
        </div>
        <div class="pay-total-crumb">
            <div>今日线上总额：<span>¥ {{ $onlinePayToday }}</span></div>
            <div>今日线下总额：<span>¥ 0</span></div>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('rechargeRecordTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addSubAccount()">导出充值</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="recharge_type" style='height:32px !important'>
                            <option value="">充值类型</option>
                            <option value="onlinePayment">在线支付</option>
                            <option value="bankTransfer">银行汇款</option>
                            <option value="alipay">支付宝支付</option>
                            <option value="weixin">微信支付</option>
                            <option value="cft">财付通</option>
                            <option value="adminAddMoney">后台加钱</option>
                        </select>
                    </div>
                    <div class="one wide field" id="onlineTypeDiv" style="display: none">
                        <select class="ui dropdown" id="pay_online_id" style='height:32px !important'>

                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechargeType" style='height:32px !important'>
                            <option value="">收款方式</option>
                            <option value="1">手动收款</option>
                            <option value="2">自动收款</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="status" style='height:32px !important'>
                            <option value="">选择状态</option>
                            <option value="1">未受理</option>
                            <option value="2">充值成功</option>
                            <option value="3">充值失败</option>
                            <option value="4">充值中</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="account_type" style='height:32px !important'>
                            <option value="account">用户账号</option>
                            <option value="orderNum">订单号</option>
                            <option value="operation_account">操作人账号</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <input type="text" id="account_param" placeholder="用户账号">
                    </div>
                    {{--<div class="one wide field">--}}
                        {{--<input type="text" id="" placeholder="昵称">--}}
                    {{--</div>--}}
                    <div class="one wide field">
                        <input type="text" id="amount" placeholder="交易金额">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="fullName" placeholder="认证姓名">
                    </div>
                    {{--<div class="one wide field">--}}
                        {{--<input type="text" id="maxMoney" placeholder="备注码">--}}
                    {{--</div>--}}
                    <div class="one wide field">
                        <select class="ui dropdown" id="dateType" style='height:32px !important'>
                            <option value="">时间类型</option>
                            <option value="1">报表时间</option>
                            <option value="2">添加时间</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <div class="ui calendar" id="rangestart" style="width: 108px;">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" id="startTime" value="{{ $today }}" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="one wide field">
                        <div class="ui calendar" id="rangeend" style="width: 108px;">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" id="endTime" value="{{ $today }}" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="date_param" style='height:32px !important'>
                            <option value="today">今天</option>
                            <option value="yesterday">昨天</option>
                            <option value="week">本周</option>
                            <option value="month">本月</option>
                            <option value="lastMonth">上月</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                    {{--<div class="one wide field">--}}
                        {{--<button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置 </button>--}}
                    {{--</div>--}}
                    <input type="hidden" id="isSearch" value="">
                </div>
            </div>
            <div class="total-nums">
                赠送金额：<span id="rechargeGiveTotal">0</span> 充值总计：<span id="rechargeTotal">0</span>
            </div>
        </div>
        <table id="rechargeRecordTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>订单时间</th>
                <th>处理日期</th>
                <th>会员</th>
                <th>真实姓名</th>
                <th>余额</th>
                <th width="180">订单号</th>
                <th>付款方式</th>
                <th>交易金额</th>
                <th>操作人</th>
                <th>收款信息</th>
                <th>入款信息</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/recharge_record.js"></script>
@endsection
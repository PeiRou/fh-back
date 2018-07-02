@extends('back.master')

@section('title','充值记录')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>充值记录
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('rechargeRecordTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addSubAccount()">导出充值</span>
        </div>
    </div>
    <div class="table-content">
        <div class="total-recharge-bar">
            <div>今日在线支付充值总额：<span>¥ {{ $onlinePayToday }}</span></div>
            <div>今日转账充值总额：<span>¥ 0</span></div>
        </div>
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
                        <input type="text" id="startTime" placeholder="">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="endTime" placeholder="">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="date_param" style='height:32px !important'>
                            <option value="">选择周期</option>
                            <option value="1">今天</option>
                            <option value="2">昨天</option>
                            <option value="2">本周</option>
                            <option value="2">本月</option>
                            <option value="2">上月</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                    <div class="one wide field">
                        <button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置 </button>
                    </div>
                    <input type="hidden" id="isSearch" value="">
                </div>
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
                <th>订单号</th>
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
    <script src="/back/js/pages/recharge_record.js"></script>
@endsection
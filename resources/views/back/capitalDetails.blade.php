@extends('back.master')

@section('title','资金明细')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>资金明细
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('capitalDetailsTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="time_point" style='height:32px !important'>
                            <option value="">今日明细</option>
                            <option value="">昨日明细</option>
                            <option value="">历史明细</option>
                        </select>
                    </div>
                    <div style="line-height: 32px;">用户：</div>
                    <div class="one wide field" style="width: 9% !important;">
                        <input type="text" id="account" placeholder="历史明细用户名必填">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="game" style='height:32px !important'>
                            <option value="">游戏选择</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <input type="text" id="order" placeholder="订单号">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="issue" placeholder="期号">
                    </div>
                    <div class="one wide field" style="width: 9% !important;">
                        <select class="ui dropdown" id="type" style='height:32px !important'>
                            <option value="">类型</option>
                            <option value="t01">充值</option>
                            <option value="t02">撤单[中奖金额]</option>
                            <option value="t03">撤单[退水金额]</option>
                            <option value="t04">返利/手续费</option>
                            <option value="t05">下注</option>
                            <option value="t06">重新开奖[中奖金额]</option>
                            <option value="t07">重新开奖[退水金额]</option>
                            <option value="t08">活动</option>
                            <option value="t09">奖金</option>
                            <option value="t10">代理结算佣金</option>
                            <option value="t11">代理佣金提现</option>
                            <option value="t12">代理佣金提现失败退回</option>
                            <option value="t13">抢到红包</option>
                            <option value="t14">退水</option>
                            <option value="t15">提现</option>
                            <option value="t16">撤单</option>
                            <option value="t17">提现失败</option>
                            <option value="t18">后台加钱</option>
                            <option value="t19">后台扣钱</option>
                        </select>
                    </div>
                    <div style="line-height: 32px;">交易金额：</div>
                    <div class="one wide field">
                        <input type="text" id="amount_min" placeholder="最小金额">
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <input type="text" id="amount_max" placeholder="最大金额">
                    </div>
                    <div style="line-height: 32px;">时间：</div>
                    <div class="one wide field">
                        <input type="text" id="time" placeholder="">
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <input type="text" id="promoter" placeholder="">
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
                {{--<th>用户</th>--}}
                {{--<th>订单号</th>--}}
                {{--<th>交易时间</th>--}}
                {{--<th>交易类型</th>--}}
                {{--<th>交易金额</th>--}}
                {{--<th>余额</th>--}}
                {{--<th>期号</th>--}}
                {{--<th>游戏</th>--}}
                {{--<th>玩法</th>--}}
                {{--<th>操作人</th>--}}
                {{--<th>备注</th>--}}
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/capital_details.js"></script>
@endsection
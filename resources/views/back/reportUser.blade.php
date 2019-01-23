@extends('back.master')

@section('title','会员报表')

@section('content')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>会员报表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('reportUserTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="game" style='height:32px !important'>
                            <option value="">游戏选择</option>
                            @foreach($games as $item)
                                <option value="{{ $item->game_id }}">{{ $item->game_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="two wide field">
                        <input type="text" id="account" placeholder="会员账号">
                    </div>
                    <div style="line-height: 32px;">时间：</div>

                    <div class="one wide field">
                        <div class="ui calendar" id="rangestart">
                            <div class="ui input left">
                                <input type="text" id="timeStart" placeholder="起始日期" value="@if(empty($start)) {{ date('Y-m-d',time()) }} @else {{ $start }} @endif">
                            </div>
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <div class="ui calendar" id="rangeend">
                            <div class="ui input left">
                                <input type="text" id="timeEnd" placeholder="结束日期" value="@if(empty($end)) {{ date('Y-m-d',time()) }} @else {{ $end }} @endif">
                            </div>
                        </div>
                    </div>
                    <div class="one wide field">
                        <input type="text" id="minBunko" oninput = "clearNoNum(this)" placeholder="最小实际输赢">
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <input type="text" id="maxBunko" oninput = "clearNoNum(this)" placeholder="最大实际输赢">
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button" id="btnToday">今天</a>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button" id="btnYesterday">昨天</a>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button" id="btnWeek">本周</a>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button" id="btnMonth_ym">本月</a>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button"  id="btnLastMonth">上月</a>
                    </div>
                    <div class="ui checkbox">
                        <input type="checkbox" id="chkTest" checked="checked" value="1">
                        <label>过滤测试用户</label>
                    </div>
                    {{--<div class="ui checkbox">--}}
                        {{--<input type="checkbox" id="chkDouble">--}}
                        {{--<label>显示重复姓名会员</label>--}}
                    {{--</div>--}}
                    <input type="hidden" id="agent_id" value="{{ $ag }}">
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                    (<span style="color: red;">说明：历史记录不包含今天</span>)
                </div>
            </div>
        </div>
        <table id="reportUserTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>账号</th>
                <th>姓名</th>
                <th>上级代理</th>
                <th><span class="tips-icon"><i data-tooltip="线上和线下充值成功的总和" data-position="top center" data-inverted class="iconfont">&#xe61e;</i></span> 充值金额</th>
                <th><span class="tips-icon"><i data-tooltip="手动和自动提款成功的总和" data-position="top center" data-inverted class="iconfont">&#xe61e;</i></span> 取款金额</th>
                <th>笔数</th>
                <th>投注金额</th>
                <th>中奖金额</th>
                <th>赢利投注金额</th>
                <th>活动金额</th>
                <th>充值优惠/手续费</th>
                <th><span class="tips-icon"><i data-tooltip="投注金额 - 中奖金额(小于零为平台赢，大于零为会员赢)" data-position="top center" data-inverted class="iconfont">&#xe61e;</i></span> 会员输赢(不含退水)</th>
                <th><span class="tips-icon"><i data-tooltip="单笔投注金额 * 退水比例" data-position="top center" data-inverted class="iconfont">&#xe61e;</i></span> 实际退水</th>
                <th><span class="tips-icon"><i data-tooltip="会员输赢 + 活动金额 + (充值优惠和手续费) + 实际退水" data-position="top center" data-inverted class="iconfont">&#xe61e;</i></span> 实际输赢(含退水)</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>总计</th>
                <th id="count_user"></th>
                <th id="count_agent"></th>
                <th id="recharges_money"></th>
                <th id="drawing_money"></th>
                <th id="bet_count"></th>
                <th id="bet_money"></th>
                <th id="win_amount"></th>
                <th id="bet_amount"></th>
                <th id="activity_money"></th>
                <th id="handling_fee"></th>
                <th id="bet_bunko"></th>
                <th id="fact_return_amount"></th>
                <th id="fact_bet_bunko"></th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/report_user.js"></script>
@endsection
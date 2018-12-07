@extends('back.master')

@section('title','总代理报表')

@section('content')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>总代理报表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('reportGagentTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    {{--<div class="one wide field">--}}
                        {{--<select class="ui dropdown" id="recharge_type" style='height:32px !important'>--}}
                            {{--<option value="">交收报表</option>--}}
                            {{--<option value="1">分类报表</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    <div class="one wide field">
                        <select class="ui dropdown" id="game" style='height:32px !important'>
                            <option value="">游戏选择</option>
                            @foreach($games as $item)
                                <option value="{{ $item->game_id }}">{{ $item->game_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="two wide field">
                        <input type="text" id="account" placeholder="总代理账号">
                    </div>
                    <div style="line-height: 32px;">时间：</div>

                    <div class="one wide field">
                        <div class="ui calendar" id="rangestart">
                            <div class="ui input left">
                                <input type="text" id="timeStart" placeholder="起始日期" value="{{ date('Y-m-d',time()) }}">
                            </div>
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <div class="ui calendar" id="rangeend">
                            <div class="ui input left">
                                <input type="text" id="timeEnd" placeholder="结束日期" value="{{ date('Y-m-d',time()) }}">
                            </div>
                        </div>
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
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                    (<span style="color: red;">说明：历史记录不包含今天</span>)
                </div>
            </div>
        </div>
        <table id="reportGagentTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>账号</th>
                    <th>会员数</th>
                    <th>笔数</th>
                    <th>投注金额</th>
                    <th>赢利投注金额</th>
                    <th>活动金额</th>
                    <th>充值优惠/手续费</th>
                    <th>代理退水金额</th>
                    <th>会员输赢(不包括退水)</th>
                    <th>实际退水</th>
                    <th>实际输赢(包括退水)</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>总计：</th>
                    <th id="member_count"></th>
                    <th id="bet_count"></th>
                    <th id="bet_money"></th>
                    <th id="bet_amount"></th>
                    <th id="activity_money"></th>
                    <th id="handling_fee"></th>
                    <th></th>
                    <th id="bet_bunko"></th>
                    <th id="fact_return_amount"></th>
                    <th id="fact_bet_bunko"></th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/report_g_agent.js"></script>
@endsection
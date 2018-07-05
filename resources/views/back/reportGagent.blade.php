@extends('back.master')

@section('title','总代理报表')

@section('content')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>总代理报表
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('reportGagentTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="recharge_type" style='height:32px !important'>
                            <option value="">交收报表</option>
                            <option value="1">分类报表</option>
                        </select>
                    </div>
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
                        <button class="fluid ui mini blue button">今天</button>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <button class="fluid ui mini blue button">昨天</button>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <button class="fluid ui mini blue button">本周</button>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <button class="fluid ui mini blue button">本月</button>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <button class="fluid ui mini blue button">上月</button>
                    </div>
                    <div class="ui checkbox">
                        <input type="checkbox" id="chkTest" checked="checked">
                        <label>过滤测试用户</label>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                </div>
            </div>
        </div>
        <table id="reportGagentTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>账号</th>
                <th>会员数</th>
                <th>笔数</th>
                <th>投注金额</th>
                <th>赢利投注金额</th>
                <th>活动金额</th>
                <th>充值优惠/手续费</th>
                <th>代理赔率金额</th>
                <th>代理退水金额</th>
                <th>会员输赢(不包括退水)</th>
                <th>实际退水</th>
                <th>实际输赢(包括退水)</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/report_g_agent.js"></script>
@endsection
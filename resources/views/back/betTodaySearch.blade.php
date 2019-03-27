@extends('back.master')

@section('title','今日注单搜索')

@section('content')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">

    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>今日注单搜索
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
            <input id="checkMark" type="checkbox" style="margin-left: 10px;"/> 是否过滤六合彩
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('betTodayTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="excelRecharges()">导出文件</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <input type="hidden" id="markSix" name="markSix" value="1">
                    {{--<div class="one wide field">--}}
                        {{--<select class="ui dropdown" id="searchType" style='height:32px !important'>--}}
                            {{--<option value="today">今日注单</option>--}}
                            {{--<option value="yesterday">昨日注单</option>--}}
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
                    <div class="one wide field">
                        <select class="ui dropdown" id="playCate" style='height:32px !important'>
                            <option value="">玩法分类选择</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <input type="text" id="issue" placeholder="期数">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="status" style='height:32px !important'>
                            <option selected="selected" value="1">未结算</option>
                            <option value="2">已结算</option>
                            <option value="3">撤销</option>
                        </select>
                    </div>
                    <div class="two wide field">
                        <input type="text" id="order" placeholder="订单号">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="username" placeholder="账号">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="minMoney" oninput = "clearNoNum(this)" placeholder="下注最小金额">
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <input type="text" id="maxMoney" oninput = "clearNoNum(this)" placeholder="下注最大金额">
                    </div>

                    <div class="one wide field" style="display: none;">
                        <div class="ui calendar" id="rangestart">
                            <div class="ui input left">
                                <input type="text" id="timeStart" value="{{ date('Y-m-d') }}" placeholder="起始日期">
                            </div>
                        </div>
                    </div>
                    <div style="line-height: 32px;display: none">-</div>
                    <div class="one wide field" style="display: none;">
                        <div class="ui calendar" id="rangeend">
                            <div class="ui input left">
                                <input type="text" id="timeEnd" value="{{ date('Y-m-d') }}" placeholder="结束日期">
                            </div>
                        </div>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                </div>
            </div>
            <div class="total-nums">
                未结算总额：<span id="unBunkoTotal" style="font-size: 13pt;">0</span>
            </div>
        </div>
        <table id="betTodayTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="200">订单号</th>
                <th>下单时间</th>
                <th>会员</th>
                <th width="110">游戏</th>
                <th>期号</th>
                <th width="220">玩法</th>
                <th>下注金额</th>
                <th>代理赔率/比</th>
                <th>代理返水/比</th>
                <th>会员输赢</th>
                <th>终端</th>
                <th>操作</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/bet_today.js"></script>
@endsection
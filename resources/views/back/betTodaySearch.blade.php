@extends('back.master')

@section('title','今日注单搜索')

@section('content')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">

    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>今日注单搜索
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('betTodayTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="searchType" style='height:32px !important'>
                            <option value="">今日注单</option>
                            <option value="yestoday">昨日注单</option>
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
                            <option value="weijiesuan">未结算</option>
                            <option value="jiesuan">已结算</option>
                            <option value="-8888">撤销</option>
                        </select>
                    </div>
                    <div class="two wide field">
                        <input type="text" id="order" placeholder="订单号">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="username" placeholder="账号">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="minMoney" placeholder="下注最小金额">
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <input type="text" id="maxMoney" placeholder="下注最大金额">
                    </div>

                    <div class="one wide field">
                        <div class="ui calendar" id="rangestart">
                            <div class="ui input left">
                                <input type="text" id="timeStart" placeholder="起始日期">
                            </div>
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <div class="ui calendar" id="rangeend">
                            <div class="ui input left">
                                <input type="text" id="timeEnd" placeholder="结束日期">
                            </div>
                        </div>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                </div>
            </div>
        </div>
        <table id="betTodayTable" class="ui small table" cellspacing="0" width="100%">
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
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/bet_today.js"></script>
@endsection
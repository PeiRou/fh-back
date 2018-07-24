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
                            @foreach($capitalTimes as $key => $capitalTime)
                                <option value="{{ $key }}">{{ $capitalTime }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="line-height: 32px;">用户：</div>
                    <div class="one wide field" style="width: 9% !important;">
                        <input type="text" id="account" placeholder="历史明细用户名必填">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="game" style='height:32px !important'>
                            <option value="">游戏选择</option>
                            @foreach($games as $game)
                                <option value="{{ $game->game_id }}">{{ $game->game_name }}</option>
                            @endforeach
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
                            @foreach($playTypes as $key => $playtype)
                                <option value="{{ $key }}">{{ $playtype }}</option>
                            @endforeach
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
                    <div class="ui calendar" id="rangestart" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="startTime" value="" placeholder="">
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="ui calendar" id="rangeend" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="endTime" value="" placeholder="">
                        </div>
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
                <th>用户</th>
                <th>订单号</th>
                <th>交易时间</th>
                <th>交易类型</th>
                <th>交易金额</th>
                <th>余额</th>
                <th>期号</th>
                <th>游戏</th>
                <th>玩法</th>
                <th>操作人</th>
                <th>备注</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/capital_details.js"></script>
@endsection
@extends('back.master')

@section('title','投注报表')

@section('content')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>棋牌投注报表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>

        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('reportBetTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="getReport()">手动获取</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <div class="ui calendar" id="rangestart" style="width: 108px;">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" id="startTime" placeholder="起始日期" value="{{ date('Y-m-d',time()) }}">
                            </div>
                        </div>
                    </div>
                    <div class="one wide field">
                        <div class="ui calendar" id="rangeend" style="width: 108px;">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" id="endTime" placeholder="结束日期" value="{{ date('Y-m-d',time()) }}">
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
                </div>
            </div>
        </div>
        <table id="reportBetTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="120px">游戏</th>
                <th>玩家</th>
                <th>上级代理</th>
                <th>笔数</th>
                <th>投注金额</th>
                <th>盈利</th>
                <th>上分</th>
                <th>下分</th>
                <th>报表时间</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>总计：</th>
                <th></th>
                <th></th>
                <th id="BetCountSum"></th>
                <th id="betMoney"></th>
                <th id="betBunko"></th>
                <th id="upMoney"></th>
                <th id="downMoney"></th>
                <th></th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/reportCard.js"></script>
@endsection
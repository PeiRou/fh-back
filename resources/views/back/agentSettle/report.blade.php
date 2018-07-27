@extends('back.master')

@section('title','代理结算报表')

@section('content')
    <style>
        .field .active{
            background: #00b5ad !important;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>代理结算报表
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('capitalDetailsTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="settlement()">手动结算</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div style="line-height: 32px;">代理账号：</div>
                    <div class="one wide field" style="width: 9% !important;">
                        <input type="text" id="account" placeholder="代理账号">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="status" style='height:32px !important'>
                            <option value="">状态：</option>
                            @foreach($aStatus as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="line-height: 32px;">月份：</div>
                    <div class="ui calendar" id="rangestart" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="timeStart" value="{{ date('Y-m',strtotime("-1 month")) }}" placeholder="">
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="ui calendar" id="rangeend" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="timeEnd" value="{{ date('Y-m') }}" placeholder="">
                        </div>
                    </div>
                    <div class="one wide field button-1">
                        <button class="fluid ui mini blue button" id="btnLastLastMonth_ym">上上月</button>
                        <input type="hidden" name="monthTime" class="monthTime" value="lastLastMonth">
                    </div>
                    <div class="one wide field button-1">
                        <button class="fluid ui mini blue button" id="btnLastMonth_ym">上月</button>
                        <input type="hidden" name="monthTime" class="monthTime" value="lastMonth">
                    </div>
                    <div class="one wide field button-1">
                        <button class="fluid ui mini blue button" id="btnLastTwoMonth_ym">近两月</button>
                        <input type="hidden" name="monthTime" class="monthTime" value="lastTwoMonth">
                    </div>
                    <div class="one wide field" style="line-height: 32px;">
                        <input type="checkbox" id="chkTest" checked="checked" style="vertical-align: unset;" value="1">
                        <label style="display: inline">过滤测试代理</label>
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
                <th>月份</th>
                <th>代理账号</th>
                <th>姓名</th>
                <th>有效会员</th>
                <th>达标用户</th>
                <th>实际输赢</th>
                <th>平台费用比</th>
                <th>平台费用</th>
                <th>本月纯赢利</th>
                <th>累计赢利</th>
                <th>代理分红比</th>
                <th>本月佣金</th>
                <th>累计佣金</th>
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
    <script src="/back/js/pages/agentSettleReport.js"></script>
@endsection
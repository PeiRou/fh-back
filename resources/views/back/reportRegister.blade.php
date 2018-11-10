@extends('back.master')

@section('title','注册报表')

@section('content')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>注册报表
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
                    <div style="line-height: 32px;">时间：</div>
                    <div class="ui calendar" id="rangestart" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="startTime" value="{{ date('Y-m-d') }}" placeholder="">
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="ui calendar" id="rangeend" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="endTime" value="{{ date('Y-m-d') }}" placeholder="">
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
        <table id="dataTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>推广帐号</th>
                <th>注册数量</th>
                <th>首冲数量</th>
                <th>充值金额</th>
                <th>取款金额</th>
                <th>输赢金额</th>
                <th>会员余额</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>总计</th>
                <th id="countMember">0</th>
                <th id="FirstTimeNum">0</th>
                <th id="Ramount">0</th>
                <th id="Damount">0</th>
                <th id="bet_bunko">0</th>
                <th id="money">0</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/report_register.js"></script>
@endsection
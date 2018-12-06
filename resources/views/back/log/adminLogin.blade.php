@extends('back.master')

@section('title','后台登录日志')

@section('content')
    <style>
        #loginLogTable{
            white-space: nowrap;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>后台登录日志
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="ui calendar" id="rangestart" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="startTime" value="{{date("Y-m-d")}}" placeholder="开始时间">
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="ui calendar" id="rangeend" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="endTime" value="{{date("Y-m-d")}}" placeholder="结束时间">
                        </div>
                    </div>
                    <div class="one wide field">
                        <input type="text" id="username" placeholder="用户账户">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="ip" placeholder="登录IP">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="login_host" placeholder="域名">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="ip_info" placeholder="IP信息">
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

        <table id="loginLogTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>子帐号ID</th>
                <th>子帐号</th>
                <th>登录日期</th>
                <th>IP</th>
                <th style="min-width: 160px">IP信息</th>
                {{--<th>来源</th>--}}
                <th>登录域名</th>
                <th>退出时间</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/log_adminLogin.js"></script>
@endsection
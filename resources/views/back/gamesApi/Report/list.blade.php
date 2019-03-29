@extends('back.master')

@section('title','下注查询')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('back/css/pages/k3.css') }}">
@endsection

@section('content')
    <style>
        #datTable{
            white-space: nowrap;
        }
        .layui-layer-setwin .layui-layer-close2{
            right: -10px!important;
            top: -10px!important;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>下注查询
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('reportBetTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="getReport()">重新生成</span>
        </div>
    </div>
    <div class="table-content">
        <div id="context1">
            <div class="ui pointing secondary menu" id="gameTabs">
                <a class="item " data-tab="qp">棋牌游戏</a>
                <a class="item active" data-tab="tc">TC游戏</a>
            </div>
            <div class="table-quick-bar ui tab " data-tab="qp">
                <div class="ui mini form">
                    <form action="javascript:;" name="qp">
                        <div class="fields">
                            <div class="one wide field" style="width:7.25%!important">
                                <div class="ui calendar timeStart" id="tcStart">
                                    <div class="ui input left">
                                        <input type="text" name="startTime" placeholder="起始日期" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div style="line-height: 32px;">-</div>
                            <div class="one wide field"  style="width:7.25%!important">
                                <div class="ui calendar timeEnd" id="tcEnd">
                                    <div class="ui input left">
                                        <input type="text" name="endTime" placeholder="结束日期" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <button class="btn_search fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="table-quick-bar ui tab active" data-tab="tc">
                <div class="ui mini form">
                    <form action="javascript:;" name="tc">
                        <div class="fields">
                            <div class="one wide field" style="width:7.25%!important">
                                <div class="ui calendar timeStart" id="tcStart">
                                    <div class="ui input left">
                                        <input type="text" name="startTime" placeholder="起始日期" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div style="line-height: 32px;">-</div>
                            <div class="one wide field"  style="width:7.25%!important">
                                <div class="ui calendar timeEnd" id="tcEnd">
                                    <div class="ui input left">
                                        <input type="text" name="endTime" placeholder="结束日期" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <button class="btn_search fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table id="dataTable1" class="ui small selectable celled striped table" cellspacing="0" width="100%" style="text-align: center">
            <thead>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/layui/layui.js"></script>
    <link rel="stylesheet" href="/vendor/layui/css/layui.css">
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/gamesApi_report_list.js"></script>
@endsection
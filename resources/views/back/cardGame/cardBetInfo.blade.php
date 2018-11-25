@extends('back.master')

@section('title','棋牌下注查询')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('back/css/pages/k3.css') }}">
@endsection

@section('content')
    <style>
        #datTable{
            white-space: nowrap;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>棋牌下注查询
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field" style="width: initial!important;">
                        <select class="ui dropdown" id="g_id" style='height:32px !important'>
                            <option value="0">游戏选择</option>
                        @foreach($gameApiList as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field" style="width:8.25%!important">
                        <input type="text" id="Accounts" placeholder="玩家账号">
                    </div>
                    <div class="one wide field" style="width:7.25%!important">
                        <div class="ui calendar" id="rangestart">
                            <div class="ui input left">
                                <input type="text" id="startTime" placeholder="起始日期" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field"  style="width:7.25%!important">
                        <div class="ui calendar" id="rangeend">
                            <div class="ui input left">
                                <input type="text" id="endTime" placeholder="结束日期" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询</button>
                    </div>
                    <div class="field">
                        <button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置</button>
                    </div>
                </div>
            </div>
        </div>
        <table id="datTable" class="ui small selectable celled striped table" cellspacing="0" width="100%" style="text-align: center">
            <thead>
            <th>游戏名称</th>
            <th>游戏局号</th>
            <th>玩家账号</th>
            <th>总下注</th>
            <th>盈利</th>
            <th>游戏开始时间</th>
            <th>游戏结束时间</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/card_betInfo.js"></script>
@endsection
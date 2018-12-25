@extends('back.master')

@section('title','操作日志')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>操作日志
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
                    <div class="one wide field" data-tooltip="根据每天的时间段查询，例：1点-5点" data-position="right center" data-inverted="">
                        <select class="ui dropdown" id="startHour" style='height:32px !important'>
                            <option value="">时间</option>
                        </select>
                    </div>-
                    <div class="one wide field" data-tooltip="根据每天的时间段查询，例：1点-5点" data-position="right center" data-inverted="">
                        <select class="ui dropdown" id="endHour" style='height:32px !important'>
                            <option value="">时间</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <input type="text" id="username" placeholder="操作人名称">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="type_id" style='height:32px !important'>
                            <option value="">请选择类型</option>
                            @foreach($routeLists as $key => $routeList)
                                <option value="{{ $routeList['type_id'] }}">{{ $routeList['type_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field" >
                        <input type="text" id="action" placeholder="事件搜索">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="ip" placeholder="操作IP">
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
        <table id="capitalDetailsTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>

            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/log_handle.js"></script>
@endsection
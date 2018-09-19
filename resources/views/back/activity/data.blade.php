@extends('back.master')

@section('title','活动数据统计')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>活动数据统计
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('capitalDetailsTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="statistics()">每日统计</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field" style="width: 9% !important;">
                        <input type="text" id="user_account" placeholder="会员账号">
                    </div>
                    <div class="ui calendar" id="rangestart" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="startTime" value="{{ date('Y-m-d',strtotime('-2 day')) }}" placeholder="">
                        </div>
                    </div>
                    <div class="ui calendar" id="rangeend" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="endTime" value="{{ date('Y-m-d',strtotime('-2 day')) }}" placeholder="">
                        </div>
                    </div>
                    <div class="one wide field" style="width: 9% !important;">
                        <select class="ui dropdown" id="activity_type" style='height:32px !important'>
                            <option value="">请选择活动类型</option>
                            @foreach($aActivityType as $kActivityType => $iActivityType)
                                <option value="{{ $kActivityType }}">{{ $iActivityType }}</option>
                            @endforeach
                        </select>
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
                <th>日期</th>
                <th>会员</th>
                <th>活动</th>
                <th>奖品</th>
                <th>活动类型</th>
                <th>领取状态</th>
                <th>连续天数</th>
                <th>添加时间</th>
                <th>修改时间</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/activityData.js"></script>
@endsection
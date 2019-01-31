@extends('back.master')

@section('title','派奖审核')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>派奖审核
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('capitalDetailsTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="add()">新增条件</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="status" style='height:32px !important'>
                            <option value="">活动状态：</option>
                            @foreach($aStatuss as $key => $aStatus)
                                <option value="{{ $key }}">{{ $aStatus }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="type" style='height:32px !important'>
                            <option value="">活动类型</option>
                            @foreach(\App\Activity::$activityType as $key => $val)
                                <option value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field" style="width: 9% !important;">
                        <input type="text" id="user_account" placeholder="会员账号">
                    </div>
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

            <div class="total-nums">
                <i class="iconfont" data-tooltip="只包含审核通过的红包活动的金额" data-position="left center" data-inverted="" style="color: #717171"></i>
                审核通过的红包金额：<span style="font-size: 13pt;" id="hbMoney">0</span>
                <i class="iconfont" data-tooltip="所有审核通过的活动金额" data-position="left center" data-inverted="" style="color: #717171"></i>
                审核通过的中奖金额：<span style="font-size: 13pt;" id="filterMoney">0</span>
            </div>
        </div>
        <table id="capitalDetailsTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>会员</th>
                <th>奖品名称</th>
                <th data-tooltip="抢红包时的充值金额（当天）/ 抢红包次数（当天）" data-position="top center" data-inverted="" >充值金额/红包次数</th>
                <th>创建时间</th>
                <th>所属活动</th>
                <th>状态</th>
                <th>审核人</th>
                <th>审核时间</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/activityReview.js"></script>
@endsection
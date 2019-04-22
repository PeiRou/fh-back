@extends('back.master')

@section('title','支付排行榜')

@section('content')
    <style>
        #addPayOnlineForm , #editPayOnlineForm{
            padding-bottom: 40px;
        }
        .jconfirm-content-pane::-webkit-scrollbar {
            display: none;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>支付排行榜
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('payOnlineTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="type" style='height:32px !important'>
                            <option value="">选择支付类型</option>
                            @foreach($aPay as $kPay => $iPay)
                                <option value="{{ $kPay }}">{{ $iPay }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="order" style='height:32px !important'>
                            <option selected="selected" value="1">使用平台排序</option>
                            <option value="2">自动入款率排序</option>
                            <option value="3">成功笔数排序</option>
                            <option value="4">成功金额排序</option>
                        </select>
                    </div>
                    <div style="line-height: 32px;">时间：</div>
                    <div class="one wide field">
                        <div class="ui calendar" id="rangestart">
                            <div class="ui input left">
                                <input type="text" id="timeStart" placeholder="起始日期" value="@if(empty($start)) {{ date('Y-m-d',time()) }} @else {{ $start }} @endif">
                            </div>
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <div class="ui calendar" id="rangeend">
                            <div class="ui input left">
                                <input type="text" id="timeEnd" placeholder="结束日期" value="@if(empty($end)) {{ date('Y-m-d',time()) }} @else {{ $end }} @endif">
                            </div>
                        </div>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button" id="btnToday">今天</a>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button" id="btnYesterday">昨天</a>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button" id="btnWeek">本周</a>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button" id="btnMonth_ym">本月</a>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button"  id="btnLastMonth">上月</a>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                </div>
            </div>
        </div>
    <div class="table-content">
        <table id="payOnlineTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>第三方接口</th>
                <th>使用平台数</th>
                <th>成功单数</th>
                <th>总笔数</th>
                <th>成功单数/总单数</th>
                <th>自动金额</th>
                <th>总金额</th>
                <th>自动金额/总金额</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
            <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
            <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/pay_new_detail.js"></script>
@endsection
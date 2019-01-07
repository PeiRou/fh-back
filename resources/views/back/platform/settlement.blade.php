@extends('back.master')

@section('title','平台费用结算')

@section('content')
    <style>
        .field .active{
            background: #00b5ad !important;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>平台费用结算
        </div>
        {{--<div class="content-top-buttons">--}}
            {{--<span class="refresh-nav-btn" onclick="refreshTable('capitalDetailsTable')"><i class="iconfont">&#xe61d;</i></span>--}}
            {{--<span onclick="settlement()">手动结算</span>--}}
        {{--</div>--}}
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
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
                            <input type="text" id="timeStart" value="{{ date('Y-m') }}" placeholder="">
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="ui calendar" id="rangeend" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="timeEnd" value="{{ date('Y-m',strtotime("+1 month")) }}" placeholder="">
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

            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/platformSettlement.js"></script>
@endsection
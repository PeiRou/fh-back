@extends('back.master')

@section('title','资金明细')

@section('content')
    <style>
        .field .active{
            background: #00b5ad !important;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>代理结算报表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
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
                    <div style="line-height: 32px;">推广帐号：</div>
                    <div class="one wide field" style="width: 9% !important;">
                        <input type="text" id="promotion_account" placeholder="推广帐号">
                    </div>
                    <div style="line-height: 32px;">代理账号：</div>
                    <div class="one wide field" style="width: 9% !important;">
                        <input type="text" id="agent_account" placeholder="代理账号">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="status" style='height:32px !important'>
                            <option value="">状态：</option>
                            @foreach($aStatus as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="level" style='height:32px !important'>
                            <option value="">所属层级：</option>
                            @foreach($aLevel as $key => $iLevel)
                                <option value="{{ $iLevel->level }}">{{ $iLevel->level }} 级</option>
                            @endforeach
                        </select>
                    </div>
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
        <table id="capitalDetailsTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>日期</th>
                <th>推广帐号</th>
                <th>姓名</th>
                <th>投注总额</th>
                <th>分红比</th>
                <th>本月佣金</th>
                <th>所属代理</th>
                <th>所属层级</th>
                <th>操作人</th>
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
    <script src="/back/js/pages/promotionReport.js"></script>
@endsection
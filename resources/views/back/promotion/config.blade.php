@extends('back.master')

@section('title','资金明细')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>代理结算报表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('capitalDetailsTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="add()">添加层级</span>
        </div>
    </div>
    <div class="table-content">
        <table id="capitalDetailsTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>层级</th>
                <th>达标投注额</th>
                <th>提成比例</th>
                <th>操作人</th>
                <th>操作时间</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/promotionSetting.js"></script>
@endsection
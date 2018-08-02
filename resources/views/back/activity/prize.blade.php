@extends('back.master')

@section('title','奖品配置')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>奖品配置
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('capitalDetailsTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="add()">新增奖品</span>
        </div>
    </div>
    <div class="table-content">
        <table id="capitalDetailsTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>奖品配置ID</th>
                <th>奖品名称</th>
                <th>奖品类型</th>
                <th>奖品规格</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/activityPrize.js"></script>
@endsection
@extends('back.master')

@section('title','活动列表')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>活动列表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('capitalDetailsTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="add()">新增活动</span>
        </div>
    </div>
    <div class="table-content">
        <table id="capitalDetailsTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>活动编号</th>
                <th>活动名称</th>
                <th>活动类型</th>
                <th>活动起止时间</th>
                <th>状态</th>
                <th>达到人数</th>
                <th>中奖人数</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/activityList.js"></script>
@endsection
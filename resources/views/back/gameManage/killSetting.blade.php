@extends('back.master')

@section('title','杀率设定')

@section('content')
    <style>
        .contenr-title{
            border: 1px solid rgba(185, 39, 27, 1);
            border-radius: .5rem;
            padding: .7rem;
            font-size: 16px;
            background: rgba(200, 77, 65, 1);
            color: #fff;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>杀率设定
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
    </div>
    <div class="table-content">
        <div class="contenr-title">
            警告：
                1.杀率计算方式为商业机密。
                2.智慧模式会自动调节长龙不正常现象，而传统模式会以平台最大营利去选杀号，此举会造成长期用户留不住，请慎选。
        </div>
        <table id="gamesTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>游戏ID</th>
                <th>游戏名称</th>
                <th>杀率状态</th>
                <th>今日总投注</th>
                <th>今日输</th>
                <th>今日赢</th>
                <th>今日营利比</th>
                <th>保留营利比</th>
                <th>智慧杀率状态</th>
                <th width="200">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/game_killsetting.js"></script>
@endsection
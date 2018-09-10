@extends('back.master')

@section('title','杀率设定')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>杀率设定
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
    </div>
    <div class="table-content">
        <table id="gamesTable" class="ui small table" cellspacing="0" width="100%">
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
                <th>更新日期</th>
                <th width="160">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/game_killsetting.js"></script>
@endsection
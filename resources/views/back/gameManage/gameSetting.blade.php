@extends('back.master')

@section('title','游戏设定')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>游戏设定
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        {{--<a href="{{ url('inner/playCate') }}" target="_blank">玩法分类录入（内部）</a> | <a href="{{ url('inner/play') }}" target="_blank">玩法录入（内部）</a>--}}
    </div>
    <div class="table-content">
        <table id="gamesTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>游戏ID</th>
                <th>游戏名称</th>
                <th>公休开始时间</th>
                <th>公休结束时间</th>
                <th>排序</th>
                <th>封盘状态</th>
                <th>启用状态</th>
                <th width="160">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/game_setting.js"></script>
@endsection
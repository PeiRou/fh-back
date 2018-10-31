@extends('back.master')

@section('title','代理赔率设定')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>代理赔率设定
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span onclick="add()">添加赔率</span>
        </div>
        {{--<a href="{{ url('inner/playCate') }}" target="_blank">玩法分类录入（内部）</a> | <a href="{{ url('inner/play') }}" target="_blank">玩法录入（内部）</a>--}}
    </div>
    <div class="table-content">
        <table id="gamesTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>层级</th>
                <th>赔率</th>
                <th>操作时间</th>
                <th width="160">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/game_agent_odds.js"></script>
@endsection
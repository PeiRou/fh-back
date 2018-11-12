@extends('back.master')

@section('title','游戏列表')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>游戏列表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span onclick="add()">添加游戏配置</span>
        </div>
    </div>
    <div class="table-content">

        <table id="tableBox" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>名称</th>
                <th>类型</th>
                <th>别名</th>
                <th>类名</th>
                <th>描述</th>
                <th>状态</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/gamesApi_list.js"></script>
@endsection
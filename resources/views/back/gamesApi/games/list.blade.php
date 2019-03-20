@extends('back.master')

@section('title','游戏管理')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>游戏管理
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span onclick="add()">添加</span>
            <span onclick="sort()">排序</span>
        </div>
    </div>
    <div class="table-content">
        <table id="example" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>父级栏目</th>
                <th>游戏名称</th>
                <th>使用接口</th>
                <th>参数</th>
                <th>类型</th>
                <th>状态</th>
                <th>排序</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/gamesList.js"></script>
@endsection
@extends('back.master')

@section('title','角色管理')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>角色管理
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span onclick="addRole()">添加角色</span>
        </div>
    </div>
    <div class="table-content">
        <table id="roleTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>角色编号(ID)</th>
                <th>角色名称</th>
                <th>类型</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/role.js"></script>
@endsection
@extends('back.master')

@section('title','权限管理')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>权限管理
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span onclick="addPermission()">添加权限</span>
        </div>
    </div>
    <div class="table-content">
        <table id="example" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>权限编号(ID)</th>
                <th>权限名称</th>
                <th>权限分组</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/permissions.js"></script>
@endsection
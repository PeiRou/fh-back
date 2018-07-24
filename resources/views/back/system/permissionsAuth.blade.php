@extends('back.master')

@section('title','权限管理')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>权限管理
        </div>
        <div class="content-top-buttons">
            <span onclick="addPermission()">添加权限</span>
        </div>
    </div>
    <div class="table-content">
        <input id="exampleAuthId" type="hidden" value="{{ $auth_id }}">
        <table id="example" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>权限编号(ID)</th>
                <th>权限名称</th>
                <th>权限别名</th>
                <th>类型</th>
                <th>是否有下级</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/permissionsAuth.js"></script>
@endsection
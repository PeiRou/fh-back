@extends('back.master')

@section('title','子账号')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>子账号
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('subAccountTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addSubAccount()">添加子账号</span>
        </div>
    </div>
    <div class="table-content">
        <table id="subAccountTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>在线</th>
                <th>账号</th>
                <th>名称</th>
                <th>角色</th>
                <th>状态</th>
                <th>新增时间</th>
                <th>最后活动时间</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/sub_account.js"></script>
@endsection
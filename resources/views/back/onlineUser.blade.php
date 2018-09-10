@extends('back.master')

@section('title','在线会员')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>在线会员
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('onlineUserTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addSubAccount()">展开所有</span>
        </div>
    </div>
    <div class="table-content">
        <table id="onlineUserTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>在线</th>
                <th>账号</th>
                <th>用户类型</th>
                <th>可用余额</th>
                <th>状态</th>
                <th>新增时间</th>
                <th>最后活动时间</th>
                <th>登录IP</th>
                <th>IP信息</th>
                <th>网站入口</th>
                <th>终端</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/online_user.js"></script>
@endsection
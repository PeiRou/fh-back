@extends('back.master')

@section('title','消息推送')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>消息推送
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('MessageSendTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="batchDelSendMessage()">批量删除</span>
            <span onclick="addSendMessage()">添加消息推送</span>

        </div>
    </div>
    <div class="table-content">
        <table id="noticeTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="messageCheckbox"  type="checkbox"></th>
                <th width="80">公告编号</th>
                <th>标题</th>
                <th>内容</th>
                <th width="100">用户类型</th>
                <th width="100">消息类型</th>
                <th width="100">用户层级</th>
                <th width="100">部分用户(多个)</th>
                <th width="150">添加时间</th>
                <th width="150">修改时间</th>
                <th width="150">操作</th>
            </tr>
            </thead>
            <tbody id="messageTbody">

            </tbody>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/message_send.js"></script>
@endsection
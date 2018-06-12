@extends('back.master')

@section('title','消息推送')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>消息推送
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('onlineUserTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addSubAccount()">展开所有</span>
        </div>
    </div>
    <div class="table-content">

    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/message_send.js"></script>
@endsection
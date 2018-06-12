@extends('back.master')

@section('title','微信支付配置')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>微信支付配置
        </div>
        <div class="content-top-buttons">
            <span onclick="add()">添加</span>
        </div>
    </div>
    <div class="table-content">
        <table id="payWeixinTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>微信名称</th>
                <th>微信账号</th>
                <th>二维码</th>
                <th>状态</th>
                <th>层级设置</th>
                <th>备注说明</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/pay_weixin.js"></script>
@endsection
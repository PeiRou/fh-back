@extends('back.master')

@section('title','银行支付配置')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>银行支付配置
        </div>
        <div class="content-top-buttons">
            <span onclick="add()">添加</span>
        </div>
    </div>
    <div class="table-content">
        <table id="payBankTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>银行名称</th>
                <th>开户名</th>
                <th>银行账号</th>
                <th>支付地址</th>
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
    <script src="/back/js/pages/pay_bank.js"></script>
@endsection
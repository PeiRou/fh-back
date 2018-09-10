@extends('back.master')

@section('title','绑定银行配置')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>绑定银行配置
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span onclick="addBank()">添加银行</span>
        </div>
    </div>
    <div class="table-content">
        <table id="bankTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>银行编号(ID)</th>
                <th>银行标识</th>
                <th>银行名称</th>
                <th>银行缩写标识</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/bind_bank.js"></script>
@endsection
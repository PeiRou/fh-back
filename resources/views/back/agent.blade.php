@extends('back.master')

@section('title','代理')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>代理
        </div>
        <div class="content-top-buttons">
            <span onclick="addAgent()">添加代理</span>
        </div>
    </div>
    <div class="table-content">
        <input type="hidden" id="gaid" value="{{$gaid}}">
        <table id="agentTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>在线</th>
                <th>上级总代理</th>
                <th>代理</th>
                <th>会员数</th>
                <th>可用余额</th>
                <th>状态</th>
                <th>修改赔率</th>
                <th>新增时间</th>
                <th>最后活动时间</th>
                <th>未登录</th>
                <th>备注</th>
                <th width="25%">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/agent.js"></script>
@endsection
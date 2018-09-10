@extends('back.master')

@section('title','总代理')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>总代理
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span onclick="addGeneralAgent()">添加总代理</span>
        </div>
    </div>
    <div class="table-content">
        <table id="generalAgentTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>在线</th>
                <th>总代理</th>
                <th>代理数</th>
                <th>会员数</th>
                <th>可用余额</th>
                <th>状态</th>
                <th>新增时间</th>
                <th>最后活动时间</th>
                <th width="10%">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/general_agent.js"></script>
@endsection
@extends('back.master')
@section('title','充值方式配置')
@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>充值方式配置
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('rechargeWayTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="setSort()">排序</span>
        </div>
    </div>
    <div class="table-content">
        <table id="rechargeWayTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>编号ID</th>
                <th>显示名称</th>
                <th>显示是否在线</th>
                <th>标识</th>
                <th>排序</th>
                <th width="150">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/rechType.js"></script>
@endsection
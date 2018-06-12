@extends('back.master')
@section('title','公告设置')
@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>公告设置
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('noticeTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addNotice()">添加公告</span>
        </div>
    </div>
    <div class="table-content">
        <table id="noticeTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="80">公告编号</th>
                <th>标题</th>
                <th>内容</th>
                <th width="100">类型</th>
                <th width="150">添加时间</th>
                <th width="150">修改时间</th>
                <th>用户层级</th>
                <th width="150">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/notice_setting.js"></script>
@endsection
@extends('back.master')
@section('title','公告设置')
@section('content')
    @inject('hasPermission','App\Http\Proxy\CheckPermission')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>公告设置
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('noticeTable')"><i class="iconfont">&#xe61d;</i></span>
            @if($hasPermission->hasPermission('ac.ad.addNotice') == 'has')
                <span onclick="addNotice()">添加公告</span>
            @endif
            @if($hasPermission->hasPermission('ac.ad.setNoticeOrder') == 'has')
                <span onclick="setSort()">排序</span>
            @endif
        </div>
    </div>
    <div class="table-content">
        <table id="noticeTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="50px">公告编号</th>
                <th>标题</th>
                <th>内容</th>
                <th width="100px">类型</th>
                <th width="150px">添加时间</th>
                <th width="150px">修改时间</th>
                <th>用户层级</th>
                <th>排序</th>
                <th width="150px">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/notice_setting.js"></script>
@endsection
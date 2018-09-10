@extends('back.master')

@section('title','文章管理')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>文章管理
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('articleTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="add()">添加</span>
        </div>
    </div>
    <div class="table-content">
        <table id="articleTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="80">文章ID</th>
                <th>标题</th>
                <th width="100">类型</th>
                <th width="100">是否置顶</th>
                <th width="100">查看次数</th>
                <th width="150">添加时间</th>
                <th>发布者</th>
                <th width="150">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/article_manage.js"></script>
@endsection
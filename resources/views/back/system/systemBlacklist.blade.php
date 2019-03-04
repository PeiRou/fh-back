@extends('back.master')

@section('title','黑名单管理')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>黑名单管理
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('articleTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="add()">添加</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div style="line-height: 32px;">筛选：</div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="type" style='width:152px !important'>
                            <option value="">所有</option>
                            @foreach(\App\Blacklist::$types as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <table id="articleTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="80">参数</th>
                <th width="100">备注</th>
                <th width="100">类型</th>
                <th width="100">操作时间</th>
                {{--<th width="100">操作人</th>--}}
                <th width="150">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/Blacklist.js"></script>
@endsection
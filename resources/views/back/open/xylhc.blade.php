@extends('back.master')

@section('title','历史开奖-幸运六合彩')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>幸运六合彩历史记录
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('lhcHistoryTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addNewIssue()">新增下一期</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="two wide field">
                        <input type="text" id="issue" placeholder="期号">
                    </div>
                    <div class="ui calendar" id="rangeend" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="issuedate" placeholder="开奖时间" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询</button>
                    </div>
                    <div class="field">
                        <button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置</button>
                    </div>
                </div>
            </div>
        </div>
        <table id="lhcHistoryTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>期数</th>
                <th>开奖时间</th>
                <th>一</th>
                <th>二</th>
                <th>三</th>
                <th>四</th>
                <th>五</th>
                <th>六</th>
                <th>特码</th>
                <th>生肖</th>
                <th>总分</th>
                <th>状态</th>
                <th width="320px">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script>
        var gameType = "{{ $data['type'] }}";
    </script>
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/open_xylhc.js"></script>
@endsection
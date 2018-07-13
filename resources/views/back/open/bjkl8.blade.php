@extends('back.master')

@section('title','历史开奖-北京快乐8')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('back/css/pages/bjkl8.css') }}">
@endsection

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>北京快乐8历史记录
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="two wide field">
                        <input type="text" id="issue" placeholder="期号">
                    </div>
                    <div class="two wide field">
                        <input type="text" id="issuedate" placeholder="开奖时间">
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
        <table id="datTable" class="ui small selectable celled striped table" cellspacing="0" width="100%" style="text-align: center">
            <thead>
            <th width="8%">期号</th>
            <th width="10%">开奖时间</th>
            <th align="center" width="32%">开出号码</th>
            <th width="12%">总和</th>
            <th width="8%">状态</th>
            <th width="12%">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/open_bjkl8.js"></script>
@endsection
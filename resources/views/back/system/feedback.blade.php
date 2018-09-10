@extends('back.master')

@section('title','权限管理')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>建议反馈
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="type" style='height:32px !important'>
                            <option value="">类型：</option>
                            @foreach($aType as $key => $iType)
                                <option value="{{ $key }}">{{ $iType }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="status" style='height:32px !important'>
                            <option value="">状态：</option>
                            @foreach($aStatus as $key => $iStatus)
                                <option value="{{ $key}}">{{ $iStatus }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field" style="width: 9% !important;">
                        <input type="text" id="user_account" placeholder="用户名">
                    </div>
                    <div class="ui calendar" id="rangestart" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="startTime" value="{{ date('Y-m-d') }}" placeholder="">
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="ui calendar" id="rangeend" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="endTime" value="{{ date('Y-m-d') }}" placeholder="">
                        </div>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                    <div class="one wide field">
                        <button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置 </button>
                    </div>
                </div>
            </div>
        </div>
        <table id="example" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>类型</th>
                <th>内容描述</th>
                <th>提交者</th>
                <th>提交时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/feedback.js"></script>
@endsection
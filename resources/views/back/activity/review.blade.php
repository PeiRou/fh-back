@extends('back.master')

@section('title','派奖审核')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>派奖审核
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('capitalDetailsTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="add()">新增条件</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="activity_id" style='height:32px !important'>
                            <option value="">活动名称：</option>
                            @foreach($aStatuss as $key => $aStatus)
                                <option value="{{ $key }}">{{ $aStatus }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field" style="width: 9% !important;">
                        <input type="text" id="user_account" placeholder="会员账号">
                    </div>
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
        <table id="capitalDetailsTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>会员</th>
                <th>奖品名称</th>
                <th>创建时间</th>
                <th>所属活动</th>
                <th>状态</th>
                <th>审核人</th>
                <th>审核时间</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/activityReview.js"></script>
@endsection
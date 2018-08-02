@extends('back.master')

@section('title','活动条件')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>活动条件
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
                            @foreach($aActivitys as $aActivity)
                                <option value="{{ $aActivity->id }}">{{ $aActivity->name }}</option>
                            @endforeach
                        </select>
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
                <th>活动名</th>
                <th>连续天数</th>
                <th>充值金额</th>
                <th>打码量</th>
                <th>奖金总额</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/activityCondition.js"></script>
@endsection
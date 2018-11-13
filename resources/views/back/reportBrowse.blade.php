@extends('back.master')

@section('title','访问报表')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>访问报表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('dataTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div style="line-height: 32px;">时间：</div>
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
                </div>
            </div>
        </div>
        <table id="dataTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
            </tr>
            </thead>
            <tfoot>
            </tfoot>
        </table>
    </div>
@endsection

@section('page-js')
    <script>
        var columns = [
            @foreach($aArray as $iArray)
                {data:'{{ $iArray['field'] }}',title:'{{ $iArray['title'] }}'},
            @endforeach
        ];
        var  targets = '{{ count($aArray)}}'
    </script>
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/report_browse.js"></script>
@endsection
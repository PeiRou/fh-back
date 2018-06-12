@extends('back.master')

@section('title','在线报表')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>在线报表
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('reportUserTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">

    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/report_online.js"></script>
@endsection
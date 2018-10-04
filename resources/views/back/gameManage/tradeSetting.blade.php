@extends('back.master')

@section('title','交易设定')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>交易设定
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/game_trade.js"></script>
@endsection
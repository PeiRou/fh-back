@extends('back.master')

@section('title','交易设定')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>交易设定
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
    </div>
    <div class="table-content">
        <div id="context1">
            <div class="ui pointing secondary menu" id="gameTabs">
                <a class="item active" data-tab="first" data-type="gaopin">高频彩</a>
                <a class="item" data-tab="second" data-type="miaosu">秒速彩</a>
                <a class="item" data-tab="three" data-type="xingyun">幸运彩</a>
                <a class="item" data-tab="four" data-type="fucai">福彩3D</a>
                <a class="item" data-tab="five" data-type="lhc">六合彩</a>
                <a class="item" data-tab="six" data-type="nn">牛牛</a>
            </div>
            <div class="ui tab segment active" data-tab="first" style="margin-bottom: 70px;">
                高频彩
            </div>
            <div class="ui tab segment" data-tab="second" style="margin-bottom: 70px;">
                秒速彩
            </div>
            <div class="ui tab segment" data-tab="three" style="margin-bottom: 70px;">
                幸运彩
            </div>
            <div class="ui tab segment" data-tab="four" style="margin-bottom: 70px;">
                福彩3D
            </div>
            <div class="ui tab segment" data-tab="five" style="margin-bottom: 70px;">
                六合彩
            </div>
            <div class="ui tab segment" data-tab="six" style="margin-bottom: 70px;">
                牛牛
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/game_trade.js"></script>
@endsection
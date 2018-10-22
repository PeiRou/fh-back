@extends('back.master')

@section('title','盘口设定')

@section('content')
    <style>
        .ui.celled.table tr td, .ui.celled.table tr th {
            border-left: 1px solid rgba(34,36,38,.1) !important;
        }
        table td{padding: 3px !important;}
        table input{height: 23px !important;width: 100px;}
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>盘口设定
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
    </div>
    <div class="table-content">
        <div id="context1">
            <div class="ui pointing secondary menu" id="gameTabs">
                <a class="item active" data-tab="first">高频彩</a>
                <a class="item" data-tab="second">秒速彩</a>
                <a class="item" data-tab="three">幸运彩</a>
                <a class="item" data-tab="four">福彩3D</a>
                <a class="item" data-tab="five">六合彩</a>
            </div>
            <div class="ui tab segment active" data-tab="first" style="margin-bottom: 70px;">
                <div class="sub-item">
                    <ul>
                        <li data-tag="first" data-id="50">北京赛车(PK10)</li>
                        <li data-tag="first" data-id="1">重庆时时彩</li>
                        <li data-tag="first" data-id="4">新疆时时彩</li>
                        <li data-tag="first" data-id="5">天津时时彩</li>
                        <li data-tag="first" data-id="60">广东快乐十分</li>
                        <li data-tag="first" data-id="10">江苏快3</li>
                        <li data-tag="first" data-id="11">安徽快3</li>
                        <li data-tag="first" data-id="12">广西快3</li>
                        <li data-tag="first" data-id="13">湖北快3</li>
                        <li data-tag="first" data-id="61">重庆幸运农场</li>
                        <li data-tag="first" data-id="65">北京快乐8</li>
                        <li data-tag="first" data-id="21">广东十一选五</li>
                        <li data-tag="first" data-id="66">PC蛋蛋</li>
                        <li data-tag="first" data-id="15">河北快3</li>
                        <li data-tag="first" data-id="16">甘肃快3</li>w
                        <li data-tag="first" data-id="18">贵州快3</li>
                        <li data-tag="first" data-id="112">腾讯分分彩</li>
                    </ul>
                </div>
                <div id="first_content"></div>
            </div>
            <div class="ui tab segment" data-tab="second" style="margin-bottom: 70px;">
                <div class="sub-item">
                    <ul>
                        <li data-tag="second" data-id="80">秒速赛车</li>
                        <li data-tag="second" data-id="82">秒速飞艇</li>
                        <li data-tag="second" data-id="81">秒速时时彩</li>
                        <li data-tag="second" data-id="99">跑马</li>
                        <li data-tag="second" data-id="86">秒速快3</li>
                    </ul>
                </div>
                <div id="second_content"></div>
            </div>
            <div class="ui tab segment" data-tab="three" style="margin-bottom: 70px;">
                <div class="sub-item">
                    <ul>
                        {{--<li>幸运快乐8</li>--}}
                        {{--<li>幸运蛋蛋</li>--}}
                        <li data-tag="three" data-id="85">幸运六合彩</li>
                    </ul>
                </div>
                <div id="three_content"></div>
            </div>
            <div class="ui tab segment" data-tab="four" style="margin-bottom: 70px;">
                <div class="sub-item">
                    <ul>
                        <li data-tag="four" data-id="30">福彩3D</li>
                    </ul>
                </div>
                <div id="four_content"></div>
            </div>
            <div class="ui tab segment" data-tab="five" style="margin-bottom: 70px;">
                <div class="sub-item">
                    <ul>
                        <li data-tag="five" data-id="70">六合彩</li>
                    </ul>
                </div>
                <div id="five_content"></div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/handicap_setting.js"></script>
@endsection
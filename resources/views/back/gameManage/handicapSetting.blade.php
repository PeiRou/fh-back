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
                <a class="item" data-tab="second">自营高频彩</a>
                <a class="item" data-tab="three">秒速彩</a>
                <a class="item" data-tab="four">幸运彩</a>
                <a class="item" data-tab="five">福彩3D</a>
                <a class="item" data-tab="six">六合彩</a>
                <a class="item" data-tab="seven">快速彩</a>
                <a class="item" data-tab="eight">三分彩</a>
                <a class="item" data-tab="nine">极速彩</a>
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
                        <li data-tag="first" data-id="16">甘肃快3</li>
                        <li data-tag="first" data-id="18">贵州快3</li>
                        <li data-tag="first" data-id="112">腾讯分分彩</li>
                        <li data-tag="first" data-id="113">QQ分分彩</li>
                    </ul>
                </div>
                <div id="first_content"></div>
            </div>
            <div class="ui tab segment" data-tab="second" style="margin-bottom: 70px;">
                <div class="sub-item">
                    <ul>
                        <li data-tag="second" data-id="905">匈牙利赛车</li>
                        <li data-tag="second" data-id="906">匈牙利飞艇</li>
                        <li data-tag="second" data-id="907">匈牙利时时彩</li>
                    </ul>
                </div>
                <div id="second_content"></div>
            </div>
            <div class="ui tab segment" data-tab="three" style="margin-bottom: 70px;">
                <div class="sub-item">
                    <ul>
                        <li data-tag="three" data-id="80">秒速赛车</li>
                        <li data-tag="three" data-id="82">秒速飞艇</li>
                        <li data-tag="three" data-id="81">秒速时时彩</li>
                        <li data-tag="three" data-id="99">跑马</li>
                        <li data-tag="three" data-id="86">秒速快3</li>
                        <li data-tag="three" data-id="114">秒速七星彩</li>
                    </ul>
                </div>
                <div id="three_content"></div>
            </div>
            <div class="ui tab segment" data-tab="four" style="margin-bottom: 70px;">
                <div class="sub-item">
                    <ul>
                        {{--<li>幸运蛋蛋</li>--}}
                        <li data-tag="four" data-id="85">幸运六合彩</li>
                        <li data-tag="four" data-id="55">幸运飞艇</li>
                        <li data-tag="four" data-id="804">台灣幸運飛艇</li>
                        <li data-tag="four" data-id="83">幸运快乐8</li>
                    </ul>
                </div>
                <div id="four_content"></div>
            </div>
            <div class="ui tab segment" data-tab="five" style="margin-bottom: 70px;">
                <div class="sub-item">
                    <ul>
                        <li data-tag="five" data-id="30">福彩3D</li>
                    </ul>
                </div>
                <div id="five_content"></div>
            </div>
            <div class="ui tab segment" data-tab="six" style="margin-bottom: 70px;">
                <div class="sub-item">
                    <ul>
                        <li data-tag="six" data-id="70">六合彩</li>
                    </ul>
                </div>
                <div id="six_content"></div>
            </div>
            <div class="ui tab segment" data-tab="seven" style="margin-bottom: 70px;">
                <div class="sub-item">
                    <ul>
                        <li data-tag="seven" data-id="801">快速赛车</li>
                        <li data-tag="seven" data-id="802">快速飞艇</li>
                        <li data-tag="seven" data-id="803">快速时时彩</li>
                    </ul>
                </div>
                <div id="seven_content"></div>
            </div>
            <div class="ui tab segment" data-tab="eight" style="margin-bottom: 70px;">
                <div class="sub-item">
                    <ul>
                        <li data-tag="eight" data-id="901">三分赛车</li>
                        <li data-tag="eight" data-id="902">三分时时彩</li>
                        <li data-tag="eight" data-id="904">三分六合彩</li>
                    </ul>
                </div>
                <div id="eight_content"></div>
            </div>
            <div class="ui tab segment" data-tab="nine" style="margin-bottom: 70px;">
                <div class="sub-item">
                    <ul>
                        <li data-tag="nine" data-id="903">极速六合彩</li>
                    </ul>
                </div>
                <div id="nine_content"></div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/handicap_setting.js"></script>
@endsection
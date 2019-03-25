@extends('back.master')

@section('title','下注查询')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('back/css/pages/k3.css') }}">
@endsection

@section('content')
    <style>
        #datTable{
            white-space: nowrap;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>下注查询
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
    </div>
    <div class="table-content">
        <div id="context1">
            <div class="ui pointing secondary menu" id="gameTabs">
                <a class="item active" data-tab="qp">棋牌游戏</a>
                <a class="item" data-tab="tc">TC游戏</a>
            </div>
            <div class="table-quick-bar ui tab active " data-tab="qp">
                {{--<div class="sub-item">--}}
                    {{--<ul>--}}
                        {{--@foreach(\App\GamesList::getList(['type' => 1]) as $k=>$v)--}}
                            {{--<li data-tag="qp" data-id="{{ $v->game_id }}">{{ $v->name }}</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</div>--}}
                <div class="ui mini form">
                    <form action="javascript:;" name="qp">
                        <div class="fields">
                            <div class="one wide field" style="width: initial!important;">
                                <select class="ui dropdown" name="dataId" style="height:32px !important">
                                    <option value="">游戏名称</option>
                                    @foreach(\App\GamesList::getList(['type' => 1]) as $k=>$v)
                                        <option value="{{ $v->game_id }}">{{ $v->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="two wide field" style="width:150px !important">
                                <input type="text" name="Accounts" placeholder='账号'>
                            </div>
                            <div class="one wide field" style="width:7.25%!important">
                                <div class="ui calendar timeStart" id="tcStart">
                                    <div class="ui input left">
                                        <input type="text" name="startTime" placeholder="起始日期" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div style="line-height: 32px;">-</div>
                            <div class="one wide field"  style="width:7.25%!important">
                                <div class="ui calendar timeEnd" id="tcEnd">
                                    <div class="ui input left">
                                        <input type="text" name="endTime" placeholder="结束日期" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <button class="btn_search fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="table-quick-bar ui tab " data-tab="tc">
                <div class="ui mini form">
                    <form action="javascript:;" name="tc">
                        <div class="fields">
                            <div class="one wide field" style="width: initial!important;">
                                <select class="ui dropdown" name="gameCategory" style="height:32px !important">
                                    <option value="">游戏名称</option>
                                    <option value="RNG">电子</option>
                                    <option value="LIVE">真人</option>
                                    <option value="FISH">捕鱼</option>
                                    <option value="SPORTS">体育</option>
                                </select>
                            </div>
                            <div class="one wide field" style="width: initial!important;">
                                <select class="ui dropdown" name="productType" style="height:32px !important">
                                    <option value="">产品</option>
                                    @foreach(\App\GamesList::$productType as $k=>$v)
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="two wide field" style="width:150px !important">
                                <input type="text" name="Accounts" placeholder='账号'>
                            </div>
                            <div class="one wide field" style="width:7.25%!important">
                                <div class="ui calendar timeStart" id="tcStart">
                                    <div class="ui input left">
                                        <input type="text" name="startTime" placeholder="起始日期" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div style="line-height: 32px;">-</div>
                            <div class="one wide field"  style="width:7.25%!important">
                                <div class="ui calendar timeEnd" id="tcEnd">
                                    <div class="ui input left">
                                        <input type="text" name="endTime" placeholder="结束日期" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <button class="btn_search fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table id="dataTable1" class="ui small selectable celled striped table" cellspacing="0" width="100%" style="text-align: center">
            <thead>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/gamesApi_TCBetInfo_list.js"></script>
@endsection
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
            <div class="table-quick-bar ui">
                <div class="ui mini form">
                    <div class="fields">
                        <div class="one wide field" style="width: initial!important;">
                            <select class="ui dropdown" id="g_id" style="height:32px !important">
                                <option value="">游戏名称</option>
                                @foreach(\App\GamesApi::getBetList() as $k=>$v)
                                    <option value="{{ $v->g_id }}">{{ $v->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="two wide field" style="width:150px !important">
                            <input type="text" id="username" placeholder='账号'>
                        </div>
                        <div class="two wide field" style="width:150px !important">
                            <input type="text" id="GameID" placeholder='局号'>
                        </div>
                        <div class="one wide field" style="width: initial!important;">
                            <select class="ui dropdown" id="gameCategory" style="height:32px !important">
                                <option value="">游戏</option>
                                @foreach(\App\GamesList::$gameCategory as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
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
                </div>
            </div>
        </div>
        <table id="dataTable1" class="ui small selectable celled striped table" cellspacing="0" width="100%" style="text-align: center">
            <thead>
            </thead>
            <tfoot>
                <tr>
                    <th>总计：</th>
                    <th id=""></th>
                    <th id="BetCountSum"></th>
                    <th id=""></th>
                    <th id=""></th>
                    <th id="AllBet"></th>
                    <th id="bet_money"></th>
                    <th id="bunkoSum"></th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/gamesApi_TCBetInfo_list.js"></script>
@endsection
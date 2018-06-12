@extends('back.master')

@section('title','实时滚单')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>实时滚单
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('betRealTimeTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar" style="padding-bottom: 10px;">
            @foreach($games as $item)
                <div class="ui checkbox">
                    <input type="checkbox" tabindex="0" value="{{ $item->game_id }}" name="gamesData" class="hidden">
                    <label>{{ $item->game_name }}</label>
                </div>
            @endforeach
        </div>
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <input type="text" id="issue" placeholder="期数">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="username" placeholder="账号">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="minMoney" placeholder="下注最小金额">
                    </div>

                    <div class="one wide field">
                        <select class="ui dropdown" id="time" style='height:32px !important'>
                            <option value="10000">10秒</option>
                            <option value="15000">15秒</option>
                            <option value="20000">20秒</option>
                            <option value="30000">30秒</option>
                            <option value="40000">40秒</option>
                            <option value="60000">60秒</option>
                        </select>
                    </div>
                    <div class="two wide field" style="width: 8.5%!important;">
                        <button id="btn_hand_search" class="fluid ui mini labeled icon teal button"><i class="history icon"></i> 手动刷新 </button>
                    </div>
                    <div class="two wide field" style="width: 8.5%!important;">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="external icon"></i> 新窗口打开 </button>
                    </div>
                </div>
            </div>
        </div>
        <table id="betRealTimeTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>订单号</th>
                <th>下单时间</th>
                <th>会员</th>
                <th>游戏</th>
                <th>期号</th>
                <th>玩法</th>
                <th>返水</th>
                <th>下注金额</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/bet_realtime.js"></script>
@endsection
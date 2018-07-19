@extends('back.master')

@section('title','会员报表')

@section('content')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>会员报表
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('reportUserTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="game" style='height:32px !important'>
                            <option value="">游戏选择</option>
                            @foreach($games as $item)
                                <option value="{{ $item->game_id }}">{{ $item->game_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="two wide field">
                        <input type="text" id="account" placeholder="会员账号">
                    </div>
                    <div style="line-height: 32px;">时间：</div>

                    <div class="one wide field">
                        <div class="ui calendar" id="rangestart">
                            <div class="ui input left">
                                <input type="text" id="timeStart" placeholder="起始日期" value="@if($start == "") {{ date('Y-m-d',time()) }} @else {{ $start }} @endif">
                            </div>
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <div class="ui calendar" id="rangeend">
                            <div class="ui input left">
                                <input type="text" id="timeEnd" placeholder="结束日期" value="@if($end == "") {{ date('Y-m-d',time()) }} @else {{ $end }} @endif">
                            </div>
                        </div>
                    </div>
                    <div class="one wide field">
                        <input type="text" id="minBunko" placeholder="最小实际输赢">
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <input type="text" id="maxBunko" placeholder="最大实际输赢">
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button" id="btnToday">今天</a>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button" id="btnYesterday">昨天</a>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button" id="btnWeek">本周</a>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button" id="btnMonth">本月</a>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button"  id="btnLastMonth">上月</a>
                    </div>
                    <div class="ui checkbox">
                        <input type="checkbox" id="chkTest" checked="checked">
                        <label>过滤测试用户</label>
                    </div>
                    <div class="ui checkbox">
                        <input type="checkbox" id="chkDouble">
                        <label>显示重复姓名会员</label>
                    </div>
                    <input type="hidden" id="ag" value="{{ $ag }}">
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                </div>
            </div>
        </div>
        <table id="reportUserTable" class="ui right aligned small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>账号</th>
                <th>姓名</th>
                <th>上级代理</th>
                <th>充值金额</th>
                <th>取款金额</th>
                <th>笔数</th>
                <th>投注金额</th>
                <th>赢利投注金额</th>
                <th>活动金额</th>
                <th>充值优惠/手续费</th>
                <th>代理赔率金额</th>
                <th>代理退水金额</th>
                <th>会员输赢(不含退水)</th>
                <th>实际退水</th>
                <th>实际输赢(含退水)</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/report_user.js"></script>
@endsection
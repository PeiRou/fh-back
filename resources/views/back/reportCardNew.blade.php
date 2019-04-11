@extends('back.master')

@section('title','投注报表')

@section('content')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <style>
        .spanClassHeight{
            height: 20px;
        }
        .spanClassNum{
            margin-right: 10px;
            color:#ff392b;
            font-size: 15px;
        }
        .divClass{
            height: 40px;
        }
        .mt20 {
            margin-top: 20px;
            font-weight: bold;
            color:#111;
            font-size: 15px;
            float: right;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>棋牌报表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>

        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('reportBetTable')"><i class="iconfont">&#xe61d;</i></span>
            <div class="content-top-buttons">
                <?php $hasPermission = app('App\Http\Proxy\CheckPermission'); ?>
                @if($hasPermission->hasPermission('member.exportReportCart') == 'has')
                    <span onclick="exportUser()">导出数据</span>
                @endif
            </div>
            {{--<span onclick="addSubAccount()">导出记录</span>--}}
{{--            <span onclick="getReport()">手动获取</span>--}}
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <input type="text" id="user_account" placeholder="用户账号">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="agent_account" placeholder="代理">
                    </div>
                    <div style="line-height: 32px;">时间：</div>

                    <div class="one wide field">
                        <div class="ui calendar" id="rangestart">
                            <div class="ui input left">
                                <input type="text" id="timeStart" placeholder="起始日期" value="{{ date('Y-m-d',time()) }}">
                            </div>
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <div class="ui calendar" id="rangeend">
                            <div class="ui input left">
                                <input type="text" id="timeEnd" placeholder="结束日期" value="{{ date('Y-m-d',time()) }}">
                            </div>
                        </div>
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
                        <a class="fluid ui mini blue button" id="btnMonth_ym">本月</a>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <a class="fluid ui mini blue button"  id="btnLastMonth">上月</a>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                    <div class="divClass">
                        <span class="spanClassHeight mt20">
                            上分：<span id="betCount" class="spanClassNum">0</span>
                            下分：<span id="betMoney" class="spanClassNum">0</span>
                            投注额：<span id="betMoney1" class="spanClassNum">0.00</span>
                            总输赢：<span id="betBunko" class="spanClassNum">0.00</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <table id="reportBetTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>用户名</th>
                <th>代理</th>
                @foreach ($aGame as $iGame)
                <th>{{ $iGame->name }}</th>
                @endforeach
                <th>总计</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>总计：</th>
                <th></th>
                @foreach ($aGame as $iGame)
                    <th id="game{{ $iGame->g_id }}"></th>
                @endforeach
                <th></th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('page-js')
    <script>
        var column = [
            {
                data:'user_account'
            },{
                data:'agent_account'
            }
        ];
        @foreach($aGame as $iGame)
        column.push({data:'game{{ $iGame->g_id }}'});
        @endforeach
        column.push({data:'total'});
    </script>
    <script src="/back/js/pages/reportCardNew.js"></script>
@endsection
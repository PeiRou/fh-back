@extends('back.master')

@section('title','资金明细')

@section('content')
    <style>
        .borderR{
            border-right: 1px solid #eee;
        }
    .canshu{
        text-align: center;
        border-right: 1px solid #eee;
    }
        #capitalDetailsTable1{
            text-align: center;
        }
        #capitalDetailsTable1 input{
            border:1px solid #bbb;
        }
        .iconfont125{
            display: block;
            width: 80px;
            height: 30px;
            background-color: #5e96b5;
            line-height: 30px;
            text-align: center;
            border-radius: 2px;
            color: #ffffff;
            margin: auto;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>代理结算报表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('capitalDetailsTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <form id="editArticleForm" action="{{ url('/action/admin/agentSettle/editConfig') }}">
            <table id="capitalDetailsTable" class="ui small table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="canshu">参数说明</th>
                        <th>参数</th>
                    </tr>
                </thead>
                <tr>
                    <td class="borderR">当月有效会员数：</td>
                    <td><input type="text" name="valid_member" value="{{ $aConfigInfo->valid_member }}"></td>
                </tr>
                <tr>
                    <td class="borderR">下月递增有效会员数：</td>
                    <td><input type="text" name="incre_member" value="{{ $aConfigInfo->incre_member }}"></td>
                </tr>
                <tr>
                    <td class="borderR">平台百分比：</td>
                    <td><input type="text" name="feesProp" value="{{ $aConfigInfo->feesProp }}"></td>
                </tr>
                <tr>
                    <td class="borderR">金牌代理用户：</td>
                    <td><input type="text" name="gold_agent" value="{{ $aConfigInfo->gold_agent }}" placeholder="多个用户请使用分号(;)来分割"></td>
                </tr>
                <tr>
                    <td class="borderR">不需要统计代理账号：</td>
                    <td><input type="text" name="noNeed_agent" value="{{ $aConfigInfo->noNeed_agent }}" placeholder="多个用户请使用分号(;)来分割"></td>
                </tr>
                <tr>
                    <td class="borderR">有效会员的最低投注数：</td>
                    <td><input type="text" name="effective_bet" value="{{ $aConfigInfo->effective_bet }}"></td>
                </tr>
                <tr>
                    <td class="borderR">有效会员的最低金额：</td>
                    <td><input type="text" name="effective_money" value="{{ $aConfigInfo->effective_money }}"></td>
                </tr>
                <thead>
                    <tr>
                        <th class="borderR">纯赢利</th>
                        <th><input type="button" value="增加纯赢利区间" onclick="add()"></th>
                    </tr>
                </thead>
            </table>
            <table id="capitalDetailsTable1" class="ui small table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>纯赢利开始</th>
                        <th>纯赢利结束</th>
                        <th>分红比</th>
                        <th>操作</th>
                    </tr>
                </thead>
                @foreach($aConfigInfo->fenhong_rate as $value)
                    <tr>
                        <td><input type="text" name="profitStart[]" value="{{ $value['profitStart'] }}"/>元</td>
                        <td><input type="text" name="profitEnd[]" value="{{ $value['profitEnd'] }}"/>元</td>
                        <td><input type="text" name="proportion[]" value="{{ $value['proportion'] }}"/></td>
                        <td><a href="javascript:;" onclick="del(this)">删除</a></td>
                    </tr>
                @endforeach
            </table>
        </form>
        <table id="capitalDetailsTable2" class="ui small table" cellspacing="0" width="100%">
            <thead>
                <th>
                    <span onclick="edit()"><i class="iconfont iconfont125">保存</i></span>
                </th>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/agentSettleConfig.js"></script>
@endsection
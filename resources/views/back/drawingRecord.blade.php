@extends('back.master')

@section('title','提款记录')

@section('content')
    @inject('hasPermission','App\Http\Proxy\CheckPermission')
    <style>
        .red {
            color: #ff6470 !important;
        }
        .amount{
            display: none;
        }

    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>提款记录
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="select-test-user">
            <label>
                <input type="checkbox" value="1" id="killTestUser" checked>
                过滤测试用户
            </label>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('drawingRecordTable')"><i class="iconfont">&#xe61d;</i></span>
            @if($hasPermission->hasPermission('ac.ad.exportExcel.userDrawing') == 'has')
                <span onclick="addSubAccount()">导出记录</span>
            @endif
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="status" style='height:32px !important'>
                            <option value="">选择状态</option>
                            <option value="no">未受理</option>
                            <option value="1">处理中</option>
                            <option value="2">通过</option>
                            <option value="3">不通过</option>
                            <option value="4">锁定</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="draw_type" style='height:32px !important'>
                            <option value="">出款方式</option>
                            <option value="1">手动出款</option>
                            <option value="0">自动出款</option>
                            <option value="2">后台扣钱</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="account_type" style='height:32px !important'>
                            <option value="account">用户账号</option>
                            <option value="amount">交易金额</option>
                            <option value="amount_fw">金额范围</option>
                            <option value="orderNum">订单号</option>
                            <option value="operation_account">操作人账号</option>
                        </select>
                    </div>
                    <div class="one wide field account_param">
                        <input type="text" id="account_param" placeholder="用户账号">
                    </div>

                    <div class="one wide field amount">
                        <input type="text" id="amount-min" placeholder="金额">
                    </div>
                    <div style="line-height: 32px;" class="amount">-</div>
                    <div class="one wide field amount">
                        <input type="text" id="amount-max" placeholder="金额">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechLevel" style='height:32px !important'>
                            <option value="">用户层级</option>
                            @foreach($rechLevel as $item)
                                <option value="{{ $item->value }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="bao_time" style='height:32px !important'>
                            <option value="1">报表时间</option>
                            <option value="2">添加时间</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <div class="ui calendar" id="rangestart" style="width: 108px;">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" id="startTime" value="{{ $today }}" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="one wide field">
                        <div class="ui calendar" id="rangeend" style="width: 108px;">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" id="endTime" value="{{ $today }}" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="date_param" style='height:32px !important'>
                            <option value="today">今天</option>
                            <option value="yesterday">昨天</option>
                            <option value="week">本周</option>
                            <option value="month">本月</option>
                            <option value="lastMonth">上月</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                    {{--<div class="one wide field">--}}
                        {{--<button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置 </button>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="total-nums">
                <span class="tips-icon tips-info" style="cursor:pointer "><i  class="iconfont" style="color: #717171"></i></span>
                后台扣款：<span style="font-size: 13pt;" id="adminDrawing">0</span>
                提款总计：<span style="font-size: 13pt;" id="drawingTotal">0</span>
            </div>
        </div>
        <table id="drawingRecordTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th >订单时间</th>
                <th >处理日期</th>
                <th>会员</th>
                <th>层级</th>
                <th>余额</th>
                <th width="65">有效投注</th>
                <th width="65">提款总次数</th>
                <th>订单号</th>
                <th>流水层</th>
                <th>交易金额</th>
                <th>操作人</th>
                <th width="370">银行信息</th>
                <th width="165">IP信息</th>
                <th>终端</th>
                <th>出款方式</th>
                <th width="72">状态</th>
                <th width="92">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script>
        @if(session('message'))
            var message = '{{ session('message') }}';
            alert(message);
        @endif
        $('.tips-info').click(function(){
            $.dialog({
                title: '说明：',
                content: '当前搜索条件下的所有正式用户的总计' +
                '<br/>注：' +
                '<br/>后台扣款：后台扣款金额' +
                '<br/>提款总计：包含后台扣款金额，默认显示通过状态的总计，选择状态后显示当前选择下的提款总计' +
                '<br/>用户层级：选择用户层级后显示当前层级下的用户记录，不包含用户历史层级下的记录' +
                '<br/>更换会员层级以后会在会员下一次操作后生效' +
                '<br/>导出记录会导出当前搜索条件下的所有正式用户的数据'
            });
        });
    </script>
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">

    <script src="/back/js/pages/drawing_record.js"></script>
@endsection
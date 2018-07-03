@extends('back.master')

@section('title','提款记录')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>提款记录
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('drawingRecordTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addSubAccount()">导出充值</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechLevel" style='height:32px !important'>
                            <option value="">选择状态</option>
                            <option value="">未受理</option>
                            <option value="">处理中</option>
                            <option value="">通过</option>
                            <option value="">不通过</option>
                            <option value="">锁定</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechLevel" style='height:32px !important'>
                            <option value="">出款方式</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechLevel" style='height:32px !important'>
                            <option value="">用户账号</option>
                            <option value="1">交易金额</option>
                            <option value="1">金额范围</option>
                            <option value="1">订单号</option>
                            <option value="2">操作人账号</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <input type="text" id="account" placeholder="用户账号">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechLevel" style='height:32px !important'>
                            <option value="">用户层级</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechLevel" style='height:32px !important'>
                            <option value="1">报表时间</option>
                            <option value="2">添加时间</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <input type="text" id="promoter" placeholder="">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="noLoginDays" placeholder="">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechLevel" style='height:32px !important'>
                            <option value="1">今天</option>
                            <option value="2">昨天</option>
                            <option value="2">本周</option>
                            <option value="2">本月</option>
                            <option value="2">上月</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                    <div class="one wide field">
                        <button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置 </button>
                    </div>
                </div>
            </div>
        </div>
        <table id="drawingRecordTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>订单时间</th>
                <th>处理日期</th>
                <th>会员</th>
                <th>层级</th>
                <th>余额</th>
                <th>有效投注</th>
                <th>订单号</th>
                <th>流水层</th>
                <th>交易金额</th>
                <th>操作人</th>
                <th>银行信息</th>
                <th>IP信息</th>
                <th>终端</th>
                <th>出款方式</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/drawing_record.js"></script>
@endsection
@extends('back.master')

@section('title','会员')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>会员
        </div>
        <div class="pay-total-crumb">
            <div><span>今日新增会员：</span><span>{{ $todayRegUsers }}</span></div>
            <div><span>本月新增会员：</span><span>{{ $monthRegUsers }}</span></div>
            <div><span>上月新增会员：</span><span>{{ $lastMonthRegUsers }}</span></div>
            <div><span>全部会员总数：</span><span>{{ $allUser }}</span></div>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('userTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="">导出用户数据</span>
            <span onclick="">更新邮箱</span>
            <span onclick="">回访用户</span>
            <span onclick="addUser()">添加会员</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div style="line-height: 32px;">查询</div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="status" style='height:32px !important'>
                            <option value="">状态</option>
                            <option value="1">正常</option>
                            <option value="2">冻结</option>
                            <option value="3">停用</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="agent" style='height:32px !important'>
                            <option value="">所属代理</option>
                            @foreach($agent as $item)
                                <option value="{{ $item->a_id }}">{{ $item->account }}({{ $item->name }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechLevel" style='height:32px !important'>
                            <option value="">用户层级</option>
                            @foreach($levels as $item)
                                <option value="{{ $item->value }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field">
                        <input type="text" id="account" placeholder="账号/邮箱/名称">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="mobile" placeholder="手机">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="qq" placeholder="QQ">
                    </div>
                    <div style="line-height: 32px;">用户余额</div>
                    <div class="one wide field">
                        <input type="text" id="minMoney" placeholder="最小金额">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="maxMoney" placeholder="最大金额">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="promoter" placeholder="推广人账号">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="noLoginDays" placeholder="未登录天数">
                    </div>
                    <input type="hidden" id="aid" value="{{$aid}}">
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                    {{--<div class="one wide field">--}}
                        {{--<button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置 </button>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="total-nums">
                会员余额总计：<span style="font-size: 13pt;" id="moneyTotal">0</span>
            </div>
        </div>
        <table id="userTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>在线</th>
                <th>会员</th>
                <th>上级代理</th>
                <th>推广人</th>
                <th>会员层级</th>
                <th>可用额度</th>
                <th>状态</th>
                <th>新增时间</th>
                <th>最后活动时间</th>
                <th>存取次数</th>
                <th>存款总额</th>
                <th>取款总额</th>
                <th>未登录</th>
                <th>备注</th>
                <th width="320px">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/user.js"></script>
@endsection
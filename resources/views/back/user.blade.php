@extends('back.master')

@section('title','会员')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>会员
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="select-test-user">
            <label>
                <input type="checkbox" value="1" id="killTestUser" checked>
                过滤测试用户
            </label>
        </div>
        @inject('hasPermission','App\Http\Proxy\CheckPermission')
        @if($hasPermission->hasPermission('m.user.userTotal') == "has")
        <div class="pay-total-crumb">
            <div><span>今日新增：</span><span id="todayRegUsers">0</span></div>
            <div><span>今日首充：</span><span id="todayRechargesUser">0</span></div>
            <div><span>昨日首充：</span><span id="yesterdayRechargesUser">0</span></div>
            <div><span>本月首充：</span><span id="monthRechargesUser">0</span></div>
            <div><span>昨日新增：</span><span id="yesterdayRegUsers">0</span></div>
            <div><span>本月新增：</span><span id="monthRegUsers">0</span></div>
            <div><span>上月新增：</span><span id="lastMonthRegUsers">0</span></div>
            <div><span>会员总数：</span><span id="allUser">0</span></div>
        </div>
        @endif
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('userTable')"><i class="iconfont">&#xe61d;</i></span>
            @if($hasPermission->hasPermission('member.exportUser'))
            <span onclick="exportUser()">导出用户数据</span>
            @endif
            {{--<span onclick="">更新邮箱</span>--}}
            @if($hasPermission->hasPermission('member.returnVisit.view'))
            <span onclick="returnVisit()">回访用户</span>
            @endif
            @if($hasPermission->hasPermission('m.user.add'))
            <span onclick="addUser()">添加会员</span>
            @endif
            @if($hasPermission->hasPermission('m.user.addMoneyAllUser'))
                <span onclick="addMoneyAllUser()">批量修改余额</span>
            @endif
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
                        <input type="text" id="mobile" oninput = " value=value.replace(/[^\d]/g,'')"  placeholder="手机">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="qq" oninput = " value=value.replace(/[^\d]/g,'')"  placeholder="QQ">
                    </div>
                    <div class="one wide field" style="width:9%!important;">
                        <input type="text" id="bank" oninput = " value=value.replace(/[^\d]/g,'')"  placeholder="银行卡">
                    </div>
                    <div style="line-height: 32px;">用户余额</div>
                    <div class="one wide field">
                        <input type="text" id="minMoney" oninput = "clearNoNum(this)" placeholder="最小金额">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="maxMoney" oninput = "clearNoNum(this)" placeholder="最大金额">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="promoter" placeholder="推广人账号" value="{{ $promoter }}">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="noLoginDays" oninput = " value=value.replace(/[^\d]/g,'')"  placeholder="未登录天数">
                    </div>
                    <input type="hidden" id="aid" value="{{$aid}}">
                    <input type="hidden" id="gaid" value="{{$gaid}}">
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
    <script>
        @if(session('message'))
            var message = '{{ session('message') }}';
            alert(message);
        @endif
        @if($hasPermission->hasPermission('m.user.userTotal') == "has")
            $.ajax({
                url:'/back/datatables/userTotal',
                type:'get',
                dataType:'json',
                data:{},
                success:function (data) {
                    $('#allUser').html(data.allUser);
                    $('#todayRegUsers').html(data.todayRegUsers);
                    $('#yesterdayRegUsers').html(data.yesterdayRegUsers);
                    $('#monthRegUsers').html(data.monthRegUsers);
                    $('#lastMonthRegUsers').html(data.lastMonthRegUsers);
                    $('#todayRechargesUser').html(data.todayRechargesUser);
                    $('#yesterdayRechargesUser').html(data.yesterdayRechargesUser);
                    $('#monthRechargesUser').html(data.monthRechargesUser);
                }
            });
        @endif
        $('.tips-info').click(function(){
            $.dialog({
                title: '说明：',
                content:'会员余额总计为当前搜索条件下的会员的余额总计！'
                // content: '余额总计只包含正式用户余额' +
                // '<br/>注：dl02（测试账号代理）、dl03（试玩账号代理）将不包含在内'
            });
        });
    </script>
@endsection
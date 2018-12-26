@extends('back.master')

@section('title','代理')

@section('content')
    @inject('hasPermission','App\Http\Proxy\CheckPermission')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>代理
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            @if($hasPermission->hasPermission('m.agent.add') == 'has')
                <span onclick="addAgent(0)">添加代理</span>
            @endif
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div style="line-height: 32px;">筛选：</div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="status" style='height:32px !important'>
                            <option value="">所有</option>
                            @foreach($aStatus as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="line-height: 32px;">搜索：</div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="type" style='height:32px !important'>
                            <option value="1">帐号</option>
                            <option value="2">名称</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <input type="text" id="name">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="day" placeholder="未登录天数">
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                    <div class="one wide field">
                        <button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置 </button>
                    </div>
                    <div style="line-height: 32px;margin-left: 20px;">
                        <span class="tips-icon tips-info" style="cursor:pointer "><i  class="iconfont" style="color: #717171"></i>代理说明</span>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="gaid" value="{{$gaid}}">
        <input type="hidden" id="agentId" value="{{$agentId}}">
        <table id="agentTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>在线</th>
                <th>上级总代理</th>
                <th>代理</th>
                @if(env('TEST',0) == 1)
                <th>下级代理数</th>
                @endif
                <th>会员数</th>
                <th>可用余额</th>
                @if(env('TEST',0) == 1)
                <th>模式</th>
                @endif
                <th>状态</th>
                <th>修改赔率</th>
                <th>新增时间</th>
                <th>最后活动时间</th>
                <th>未登录</th>
                <th>备注</th>
                <th width="25%">操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script>
        var columns = [
            {data:'online'},
            {data:'general_agent'},
            {data:'agent'},
            @if(env('TEST',0) == 1)
            {data:'agentCount'},
            @endif
            {data:'members'},
            {data:'balance'},
                @if(env('TEST',0) == 1)
            {data:'model'},
                @endif
            {data:'status'},
            {data:'editOdds'},
            {data:'created_at'},
            {data:'updated_at'},
            {data:'login'},
            {data:'content'},
            {data:'control'}
        ]
    </script>
    <script src="/back/js/pages/agent.js"></script>
    <script>
                @if(session('message'))
        var message = '{{ session('message') }}';
        alert(message);
        @endif
        $('.tips-info').click(function(){
            $.dialog({
                title: '说明：',
                content: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;默认和会员模式的代理将没有盘口设定' +
                    '<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;金字塔模式代理的盘口设定只能查看所属层级的盘口赔率' +
                    '<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;直属代理的盘口设定可以设置赔率和返水，若没有设置则和平台赔率一致，不然就以设置赔率和返水一致',
            });
        });
    </script>
@endsection
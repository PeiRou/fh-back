@extends('back.master')

@section('title','代理赔率设定')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>代理赔率设定
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span onclick="add()">添加赔率</span>
        </div>
        {{--<a href="{{ url('inner/playCate') }}" target="_blank">玩法分类录入（内部）</a> | <a href="{{ url('inner/play') }}" target="_blank">玩法录入（内部）</a>--}}
    </div>
    <div class="table-content">
        <table id="gamesTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>层级</th>
                <th>赔率</th>
                <th>操作时间</th>
                <th width="160">操作</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="table-content" style="margin-left: 100px;">
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;说明：一级代理赔率请与平台赔率保持一致。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;代理赔率的计算方式为：如一级代理赔率为1.997，二级代理赔率设置为1.996，则单个投注赔率计算公式为： </p>
        <p>（1.997-1.996）/1.997 = （一级代理投注赔率 - 二级代理投注赔率）/一级代理投注赔率 。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;同上，三级代理赔率设置为1.995的单个投注赔率为(1.996-1.995)/1.996 = （二级投注赔率 - 三级投注赔率）/二级投注赔率，以此类推。</p>
        <p>需要更改的投注赔率的小数位，如果小于两位，将强制保留两位小数，若大于等于两位，则与需要更改的投注赔率的小数位保持一致。</p>
        <p>若每次计算的赔率不能改变，则会强制减少最低位，如1.997会减少到1.996,9.97会减少到9.96。</p>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/game_agent_odds.js"></script>
@endsection
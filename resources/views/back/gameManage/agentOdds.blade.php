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
    <div class="table-content">
        <p>一级赔率请于平台赔率保持一致。代理赔率的计算方式为，如二级赔率为1.996的单个投注赔率为（1.997-1.996）/1.997 = （一级投注赔率 - 二级投注赔率）/一级投注赔率 ，三级赔率为1.995的单个投注赔率为(1.996-1.995)/1.996 = （二级投注赔率 - 三级投注赔率）/二级投注赔率,后面的依次类推。且与需要更改的投注赔率的小数位保持一致</p>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/game_agent_odds.js"></script>
@endsection
@extends('back.master')

@section('title','资金转账记录')

@section('content')
    <style>
        .contenr-title{
            border: 1px solid rgba(185, 39, 27, 1);
            border-radius: .5rem;
            padding: .7rem;
            font-size: 16px;
            background: rgba(200, 77, 65, 1);
            color: #fff;
        }
        .sort{
            text-align: center;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>资金转账记录
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
    </div>

    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field" style="width: initial!important;">
                        <select class="ui dropdown" id="code" style="height:32px !important">
                            <option value="">全部</option>
                            <option value="0">成功</option>
                            <option value="-1">失败</option>
                            <option value="500">超时</option>
                        </select>
                    </div>
                    <div class="one wide field" style="width: initial!important;">
                        <select class="ui dropdown" id="g_id" style="height:32px !important">
                            <option value="">使用接口</option>
                            @foreach(App\GamesApi::pluck('name','g_id') as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="two wide field" style="width:150px !important">
                        <input type="text" id="username" name="username" placeholder='账号'>
                    </div>
                    <div class="field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询</button>
                    </div>
                </div>
            </div>
        </div>
        <table id="tableBox" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>会员</th>
                <th>使用接口</th>
                <th>游戏</th>
                <th>订单号</th>
                <th>类型</th>
                <th>状态</th>
                <th>返回码</th>
                <th>返回码对应信息</th>
                <th>金额</th>
                <th>冻结金额</th>
                <th>解冻金额</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>

@endsection

@section('page-js')
    <script>
        var adminName = '';
    <?php if(Session::get('account') === 'admin'){ ?>
        adminName = 'admin';
    <?php } ?>
    </script>
    <script src="/back/js/pages/gamesApi_recharges.js"></script>
@endsection
@extends('back.master')

@section('title','拉取失败列表')

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
            <b>位置：</b>拉取失败列表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
    </div>

    <div class="table-content">
        <table id="tableBox" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>游戏名称</th>
                <th>错误码</th>
                <th>错误信息</th>
                {{--<th>参数</th>--}}
                <th>重试次数</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>

@endsection

@section('page-js')
    <script src="/vendor/layui/layui.js"></script>
    <link rel="stylesheet" href="/vendor/layui/css/layui.css">
    <script>
        var layer;
        layui.use('layer', function(){
            layer = layui.layer;
        });
    </script>
    <script src="/back/js/pages/errorBet.js"></script>

@endsection
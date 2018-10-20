@extends('back.master')

@section('title','代理专属域名')

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
            <span class="refresh-nav-btn" onclick="refreshTable('editArticleForm')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="add()">添加</span>
        </div>
    </div>
    <div class="table-content">
        <table id="editArticleForm" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>代理地址</th>
                <th>名称</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/agentSettleDomain.js"></script>
@endsection
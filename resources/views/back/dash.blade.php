@extends('back.master')

@section('title','控制台')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>控制台首页
        </div>
        <div class="content-top-buttons">
        </div>
    </div>

    <div class="dash-content">
        <div class="line">
            <span class="icon1"><img src="{{ asset('back/img/cloud.png') }}"> </span>
            <span class="txt1"><b>{{ Session::get('account_name') }} 您好，欢迎使用彩票网后台管理系统</b></span>
        </div>
        <div class="line">
            <span class="icon2"><img src="{{ asset('back/img/time.png') }}"></span>
            <span class="txt2">
                {{ $accountInfo->last_login_time ? '您上次登录时间：'.$accountInfo->last_login_time.',' : '' }}
                {{--您上次登录时间：，--}}
                {{ $accountInfo->last_login_ip ? '上次登录IP：'.$accountInfo->last_login_ip : '' }}

                </span>
        </div>
    </div>

    <div class="dash-tables">
        <div class="ui grid">
            <div class="six wide column">
                <div class="outline">
                    <div class="title">最新公告</div>
                    <div class="content" id="noticeMessageBox" style="padding: 10px 0px;"></div>
                </div>
            </div>
            <div class="six wide column">
                <div class="outline">
                    <div class="title">系统更新日志</div>
                    <div class="content" id="systemUpdateMessageBox" style="padding: 10px 0px;"></div>
                </div>
            </div>
            <div class="four wide column">
                <div class="outline">
                    <div class="title">相关下载</div>
                    <div class="content" id="downloadMessageBox" style="padding: 10px 0px 10px 3px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/dash.js"></script>
@endsection
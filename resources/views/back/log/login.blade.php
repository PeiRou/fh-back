@extends('back.master')

@section('title','登录日志')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>登录日志
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <input type="text" id="account" placeholder="开始时间">
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <input type="text" id="mobile" placeholder="结束时间">
                    </div>
                    <div class="two wide field">
                        <input type="text" id="qq" placeholder="用户账户">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="minMoney" placeholder="登录IP">
                    </div>
                    <div class="two wide field">
                        <input type="text" id="maxMoney" placeholder="域名">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="promoter" placeholder="IP信息">
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
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/log_login.js"></script>
@endsection
@extends('back.master')

@section('title','历史开奖-六合彩')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>六合彩历史记录
        </div>
        <div class="content-top-buttons">
            <span onclick="addBank()">新增下一期</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <input type="text" id="account" placeholder="期号">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="mobile" placeholder="开奖时间">
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询</button>
                    </div>
                    <div class="one wide field">
                        <button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/open_lhc.js"></script>
@endsection
<style type="text/css">
    #v{
        float:left;
        line-height:30px;
        padding:5px;
        margin-right:10px;
        margin-bottom:10px;
        border:1px #1e70bf solid;
        background:#ecf3fb;
        border-radius:5px;
    }
    p{ padding-top:5px;}
    .ui.form .fields .wide.field {
        padding-left: .1em;
        padding-right: .1em;
    }
    .ui.form .one.wide.field {
        width:5.25%!important;
    }

    .dialog-container-4:after,.dialog-container-8:after,.dialog-container-12:after,.dialog-container:after,.dialog-container-16:after,
    .dialog-container-24:after,.dialog-container-32:after,.dialog-container-48:after,.dialog-container-64:after,
    .dialog-container-4{padding:0.01em 4px}.dialog-container-8{padding:0.01em 8px}.dialog-container-12{padding:0.01em 12px}.dialog-container,.dialog-container-16{padding:0.01em 16px}
    .dialog-container-24{padding:0.01em 24px}.dialog-container-32{padding:0.01em 32px}.dialog-container-48{padding:0.01em 48px}.dialog-container-64{padding:0.01em 64px}
    .dialog-section-4{margin-top:4px;margin-bottom:4px}
    .dialog-section-8{margin-top:8px;margin-bottom:8px}
    .dialog-section-12{margin-top:12px;margin-bottom:12px}
    .dialog-section,.dialog-section-16,.w3.paragraph{margin-top:16px;margin-bottom:16px}
    .dialog-section-24{margin-top:24px;margin-bottom:24px}
    .dialog-section-32{margin-top:32px;margin-bottom:32px}
    .dialog-section-48{margin-top:48px;margin-bottom:48px}
    .dialog-section-64{margin-top:64px;margin-bottom:64px}
    .dialog-section-128{margin-top:128px;margin-bottom:128px}
    .dialog-red,.w3-hover-red:hover{color:#fff!important;background-color:#f44336!important}
    .dialog-card{box-shadow:0 24px 24px 0 rgba(0,0,0,0.2),0 40px 77px 0 rgba(0,0,0,0.22)!important}

</style>

@extends('back.master')

@section('title','会员对账')

@section('content')
    <div id="user" value="{{Session::get('account')}}"/>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>会员对账
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable()"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="refreshExcel()">重新执行</span>
        </div>
    </div>
    <div class="table-content">
        <div id="dialog" class="dialog-container dialog-section dialog-red dialog-card"  style="display: none;">
            <p>执行中请勿关闭页面或操作其他按钮</p>
        </div>
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div style="line-height: 32px;">日期：</div>
                    <div class="one wide field" style="width:10.25%!important;">
                        <div class="ui calendar" id="rangestart">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" id="startTime" value="{{$date}}" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                </div>
            </div>
        </div>
        <table id="memberReconciliationTable" class="ui small table" cellspacing="0" width="100%">
            <thead><tr><th>在线支付</th></tr></thead>
            <tbody><tr><td>
                    @if($data != '')
                        @foreach($data[$date]['onlinePayment'] as $k=>$v)
                            <div id="v">{{$v->rechname}}</br><p>赠送{{$v->giftamount}}   总计{{isset($v->amount)?$v->amount:'0'}}</p></div>
                        @endforeach
                    @endif
            </td></tr></tbody>
            <thead><tr><th>银行汇款</th></tr></thead>
            <tbody><tr><td>
                    @if($data != '')
                        @foreach($data[$date]['bankTransfer'] as $k=>$v)
                            <div id="v">{{$v->rechname}}</br><p>赠送{{$v->giftamount}}   总计{{isset($v->amount)?$v->amount:'0'}}</p></div>
                        @endforeach
                    @endif
            </td></tr></tbody>
            <thead><tr><th>支付宝支付</th></tr></thead>
            <tbody><tr><td>
                    @if($data != '')
                        @foreach($data[$date]['alipay'] as $k=>$v)
                            <div id="v">{{$v->rechname}}</br><p>赠送{{$v->giftamount}}   总计{{isset($v->amount)?$v->amount:'0'}}</p></div>
                        @endforeach
                    @endif
            </td></tr></tbody>
            <thead><tr><th>微信支付</th></tr></thead>
            <tbody><tr><td>
                    @if($data != '')
                        @foreach($data[$date]['weixin'] as $k=>$v)
                            <div id="v">{{$v->rechname}}</br><p>赠送{{$v->giftamount}}   总计{{isset($v->amount)?$v->amount:'0'}}</p></div>
                        @endforeach
                    @endif
            </td></tr></tbody>
            <thead><tr><th>财付通</th></tr></thead>
            <tbody><tr><td>
                    @if($data != '')
                        @foreach($data[$date]['cft'] as $k=>$v)
                            <div id="v">{{$v->rechname}}</br><p>赠送{{$v->giftamount}}   总计{{isset($v->amount)?$v->amount:'0'}}</p></div>
                        @endforeach
                    @endif
            </td></tr></tbody>
            <thead><tr><th>后台加钱</th></tr></thead>
            <tbody><tr><td>
                    @if($data != '')
                        @foreach($data[$date]['adminAddMoney'] as $k=>$v)
                            <div id="v">{{$v->rechname}}</br><p>赠送{{$v->giftamount}}   总计{{isset($v->amount)?$v->amount:'0'}}</p></div>
                        @endforeach
                    @endif
            </td></tr></tbody>
            <thead><tr><th>提款</th></tr></thead>
            <tbody><tr><td>
                    @if($data != '')
                        @foreach($data[$date]['draw'] as $k=>$v)
                            <div id="v">{{$v->rechname}}</br><p>提款总计{{isset($v->amount)?$v->amount:'0'}}</p></div>
                        @endforeach
                    @endif
            </td></tr></tbody>
            <thead><tr><th>资金明细</th></tr></thead>
            <tbody><tr><td>
                    @if($data != '')
                        @foreach($data[$date]['capital'] as $k=>$v)
                            <div id="v">{{$v->rechname}}</br><p>总计{{isset($v->amount)?$v->amount:'0'}}</p></div>
                        @endforeach
                    @endif
            </td></tr></tbody>
            <thead><tr><th>会员馀额</th></tr></thead>
            <tbody><tr><td>{{$memberquota}}</td></tr></tbody>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/member_reconciliation.js"></script>
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
@endsection

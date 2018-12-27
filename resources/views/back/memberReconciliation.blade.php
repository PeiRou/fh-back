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
    @inject('hasPermission','App\Http\Proxy\CheckPermission')
    <div id="user" value="{{Session::get('account')}}"/>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>会员对账
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable()" id="btn_refresh"><i class="iconfont">&#xe61d;</i></span>
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
                                <input type="text" id="startTime" value="{{$startime}}" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="one wide field" style="width:10.25%!important;">
                        <div class="ui calendar" id="rangeend">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" id="endTime" value="{{$endtime}}" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding-top:1rem;" ></div>
        <table id="memberReconciliationTable" class="ui small selectable celled striped table dataTable no-footer" cellspacing="13" width="100%" aria-describedby="agentTable_info">
            <thead><tr>
                <th>日期</th>
                <th>在线支付</th>
                <th>银行汇款</th>
                <th>支付宝支付</th>
                <th>微信支付</th>
                <th>财付通</th>
                <th>充值</th>
                <th>提款</th>
                <th>资金明细</th>
                <th>后台加钱<br>-掉单补发</th>
                <th>后台加钱<br>-加彩金</th>
                <th>后台加钱<br>-其他</th>
                <th>后台加钱</th>
                <th>今日实际输赢<br>(含退水)</th>
                <th>昨日会员馀额</th>
                <th>今日盈亏</th>
                <th>今日会员馀额</th>
                <th>操作人帐号</th>
                <th>操作</th>
            </tr></thead>
            <tbody>
            @foreach($totalreport as $k=>$v)
                <tr role="row" class="odd"><td>{{$v->daytime}}</td>
                    @if($v->onlinePayment == '0.00')<td><span>{{$v->onlinePayment}}</span></td> @else <td><span OnMouseOver="this.style.fontWeight='bold'" OnMouseOut="this.style.fontWeight=''" style="color:red" class="edit-link" onclick="searchclick('{{$v->daytime}}|onlinePayment|{{$v->onlinePayment}}')">{{$v->onlinePayment}}</span></td>@endif
                    @if($v->bankTransfer == '0.00')<td><span>{{$v->bankTransfer}}</span></td> @else <td><span OnMouseOver="this.style.fontWeight='bold'" OnMouseOut="this.style.fontWeight=''" style="color:red" class="edit-link" onclick="searchclick('{{$v->daytime}}|bankTransfer|{{$v->bankTransfer}}')">{{$v->bankTransfer}}</span></td>@endif
                    @if($v->alipay == '0.00')<td><span>{{$v->alipay}}</span></td> @else <td><span OnMouseOver="this.style.fontWeight='bold'" OnMouseOut="this.style.fontWeight=''" style="color:red" class="edit-link" onclick="searchclick('{{$v->daytime}}|alipay|{{$v->alipay}}')">{{$v->alipay}}</span></td>@endif
                    @if($v->weixin == '0.00')<td><span>{{$v->weixin}}</span></td> @else <td><span OnMouseOver="this.style.fontWeight='bold'" OnMouseOut="this.style.fontWeight=''" style="color:red" class="edit-link" onclick="searchclick('{{$v->daytime}}|weixin|{{$v->weixin}}')">{{$v->weixin}}</span></td>@endif
                    @if($v->cft == '0.00')<td><span>{{$v->cft}}</span></td> @else <td><span OnMouseOver="this.style.fontWeight='bold'" OnMouseOut="this.style.fontWeight=''" style="color:red" class="edit-link" onclick="searchclick('{{$v->daytime}}|cft|{{$v->cft}}')">{{$v->cft}}</span></td>@endif
                    <td>{{$v->echarges}}</td>
                    @if($v->draw == '0.00')<td><span>{{$v->draw}}</span></td> @else <td><span OnMouseOver="this.style.fontWeight='bold'" OnMouseOut="this.style.fontWeight=''" style="color:red" class="edit-link" onclick="searchclick('{{$v->daytime}}|draw|{{$v->draw}}')">{{$v->draw}}</span></td>@endif
                    @if($v->capital == '0.00')<td><span>{{$v->capital}}</span></td> @else <td><span OnMouseOver="this.style.fontWeight='bold'" OnMouseOut="this.style.fontWeight=''" style="color:red" class="edit-link" onclick="searchclick('{{$v->daytime}}|capital|{{$v->capital}}')">{{$v->capital}}</span></td>@endif
                    @if($v->adminAddMoney_reissue == '0.00')<td><span>{{$v->adminAddMoney_reissue}}</span></td> @else <td><span OnMouseOver="this.style.fontWeight='bold'" OnMouseOut="this.style.fontWeight=''" style="color:red" class="edit-link" onclick="searchclick('{{$v->daytime}}|adminAddMoney_reissue|{{$v->adminAddMoney_reissue}}')">{{$v->adminAddMoney_reissue}}</span></td>@endif
                    @if($v->adminAddMoney_pluscolor == '0.00')<td><span>{{$v->adminAddMoney_pluscolor}}</span></td> @else <td><span OnMouseOver="this.style.fontWeight='bold'" OnMouseOut="this.style.fontWeight=''" style="color:red" class="edit-link" onclick="searchclick('{{$v->daytime}}|adminAddMoney_pluscolor|{{$v->adminAddMoney_pluscolor}}')">{{$v->adminAddMoney_pluscolor}}</span></td>@endif
                    @if($v->adminAddMoney_other == '0.00')<td><span>{{$v->adminAddMoney_other}}</span></td> @else <td><span OnMouseOver="this.style.fontWeight='bold'" OnMouseOut="this.style.fontWeight=''" style="color:red" class="edit-link" onclick="searchclick('{{$v->daytime}}|adminAddMoney_other|{{$v->adminAddMoney_other}}')">{{$v->adminAddMoney_other}}</span></td>@endif
                    <td>{{$v->adminAddMoney}}</td>
                    @if($v->bunko > 0) <td><span style="color:blue">{{$v->bunko}}</span></td> @elseif($v->bunko == '0') <td><span>{{$v->bunko}}</span></td>  @else <td><span style="color:green">{{$v->bunko}}</span></td> @endif
                    <td>{{$v->memberquotayday}}</td>
                    @if(isset($v->todayprofitloss) && $v->todayprofitloss != '0.00')<td><span OnMouseOver="this.style.fontWeight='bold'" OnMouseOut="this.style.fontWeight=''" style="color:red" class="edit-link" onclick="searchclick('{{$v->daytime}}|todayprofitlossitem|{{$v->phonyfitloss}}|{{$v->phonyfitloss}}')">{{$v->phonyfitloss}}</span></td>@else<td>0.00</td>@endif
                    <td>{{$v->memberquota}}</td>
                    <td>{{$v->operation_account}}</td>
                    <td><ul class="control-menu"><li  onclick="refreshExcel('{{$v->daytime}}')">重新执行</li></ul></td></tr>
            @endforeach
            </tbody>
        </table>
        <div  style="padding-top:1rem;" >
            1、统计每个会员(仅正式会员)的资金情况，再进行总计。<br>
            2、每天0点01分后自动纪录「今日会员馀额」数据，并在每天4点后自动进行前一天数据的统计。<br>
            3、算法：<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            资金明细 = 返利/手续费 + 下注 + 重新开奖[中奖金额] + 重新开奖[退水金额] + 活动金额 + 红包金额 + 提款 + 撤单 + 提现失败 + 后台加钱 + 后台扣钱 + 棋牌上分 + 棋牌下分 + 推广人佣金。<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            今日实际输赢（含退水）= 会员输赢（含退水）+ 红包金额 + 返利/手续费 + 活动金额。<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            今日盈亏 = 充值（在线充值、线下充值、后台加钱）+ 返利/手续费 + 活动金额 + 棋牌下分 + 红包金额 + 会员输赢（含退水）- 提款（自动出款、手动出款、后台扣钱）- 棋牌上分 - 未结算的。<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            今日会员余额 = 昨天会员余额 + 今日盈亏。<br>
            4、重新执行按钮只重新计算当天的数据，并且不会更新昨日会员余额以及未结算金额。<br>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/member_reconciliation.js"></script>
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
@endsection

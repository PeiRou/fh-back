<?php $__env->startSection('title','充值记录'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>充值记录
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('rechargeRecordTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addSubAccount()">导出充值</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="recharge_type" style='height:32px !important'>
                            <option value="">充值类型</option>
                            <option value="1">在线支付</option>
                            <option value="2">银行汇款</option>
                            <option value="3">支付宝支付</option>
                            <option value="3">微信支付</option>
                            <option value="3">财付通</option>
                            <option value="3">后台加钱</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechLevel" style='height:32px !important'>
                            <option value="">收款方式</option>
                            <option value="1">手动收款</option>
                            <option value="2">自动收款</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechLevel" style='height:32px !important'>
                            <option value="">选择状态</option>
                            <option value="1">未受理</option>
                            <option value="2">充值成功</option>
                            <option value="2">充值失败</option>
                            <option value="2">充值中</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechLevel" style='height:32px !important'>
                            <option value="">用户账号</option>
                            <option value="1">订单号</option>
                            <option value="2">操作人账号</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <input type="text" id="account" placeholder="用户账号">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="mobile" placeholder="昵称">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="qq" placeholder="交易金额">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="minMoney" placeholder="认证姓名">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="maxMoney" placeholder="备注码">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechLevel" style='height:32px !important'>
                            <option value="1">报表时间</option>
                            <option value="2">添加时间</option>
                        </select>
                    </div>
                    <div class="one wide field">
                        <input type="text" id="promoter" placeholder="">
                    </div>
                    <div class="one wide field">
                        <input type="text" id="noLoginDays" placeholder="">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="rechLevel" style='height:32px !important'>
                            <option value="1">今天</option>
                            <option value="2">昨天</option>
                            <option value="2">本周</option>
                            <option value="2">本月</option>
                            <option value="2">上月</option>
                        </select>
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
        <table id="rechargeRecordTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>订单时间</th>
                <th>处理日期</th>
                <th>会员</th>
                <th>真实姓名</th>
                <th>余额</th>
                <th>订单号</th>
                <th>付款方式</th>
                <th>交易金额</th>
                <th>操作人</th>
                <th>收款信息</th>
                <th>入款信息</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script src="/back/js/pages/recharge_record.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
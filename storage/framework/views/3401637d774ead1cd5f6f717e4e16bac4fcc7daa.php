<?php $__env->startSection('title','代理对账'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>代理对账
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('agentReconciliationTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div style="line-height: 32px;">时间：</div>
                    <div class="two wide field">
                        <input type="text" id="promoter" placeholder="">
                    </div>
                    <div class="two wide field">
                        <input type="text" id="noLoginDays" placeholder="">
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                </div>
            </div>
        </div>
        <table id="agentReconciliationTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>日期</th>
                <th>昨日代理余额</th>
                <th>今日结算佣金</th>
                <th>今日返水</th>
                <th>今日盘口抽水</th>
                <th>今日出款</th>
                <th>今日活动奖金</th>
                <th>今日红包金额</th>
                <th>今日代理余额</th>
                <th>对账差别金额</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script src="/back/js/pages/agent_reconciliation.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
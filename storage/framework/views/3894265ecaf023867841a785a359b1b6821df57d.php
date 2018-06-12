<?php $__env->startSection('title','代理报表'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>代理报表
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('reportAgentTable')"><i class="iconfont">&#xe61d;</i></span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="recharge_type" style='height:32px !important'>
                            <option value="">游戏选择</option>
                        </select>
                    </div>
                    <div class="two wide field">
                        <input type="text" id="promoter" placeholder="代理账号">
                    </div>
                    <div style="line-height: 32px;">时间：</div>
                    <div class="one wide field">
                        <input type="text" id="noLoginDays" placeholder="">
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field">
                        <input type="text" id="noLoginDays" placeholder="">
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <button class="fluid ui mini blue button">今天</button>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <button class="fluid ui mini blue button">昨天</button>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <button class="fluid ui mini blue button">本周</button>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <button class="fluid ui mini blue button">本月</button>
                    </div>
                    <div class="one wide field" style="width: 4.2%!important;">
                        <button class="fluid ui mini blue button">上月</button>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                </div>
            </div>
        </div>
        <table id="reportAgentTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>账号</th>
                <th>会员数</th>
                <th>充值金额</th>
                <th>取款金额</th>
                <th>笔数</th>
                <th>投注金额</th>
                <th>赢利投注金额</th>
                <th>活动金额</th>
                <th>充值优惠/手续费</th>
                <th>代理赔率金额</th>
                <th>代理退水金额</th>
                <th>会员输赢(不含退水)</th>
                <th>实际退水</th>
                <th>实际输赢(含退水)</th>
            </tr>
            </thead>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script src="/back/js/pages/report_agent.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link rel="stylesheet" href="/vendor/zTree_v3/css/metroStyle/metroStyle.css">
<script type="text/javascript" src="/vendor/zTree_v3/js/jquery.ztree.core.min.js"></script>
<script type="text/javascript" src="/vendor/zTree_v3/js/jquery.ztree.excheck.js"></script>
<form id="addPermissionForm" class="ui form" action="<?php echo e(route('addPermission')); ?>">
    <div class="field">
        <label>权限名称</label>
        <div class="ui input icon">
            <input type="text" name="permission_name" id="permission_name"/>
        </div>
    </div>
    <div class="field">
        <label>权限分组</label>
        <div class="ui input icon">
            <input type="text" name="permission_group" id="permission_group"/>
        </div>
    </div>
    <div class="tree">
        <ul id="treeDemo" class="ztree"></ul>
    </div>
    <div class="field">
        <label>已选择权限 (<span id="checkCount">0</span>)</label>
        <div class="ui input icon">
            <input type="text" name="permission_selected" readonly id="permission_selected"/>
        </div>
    </div>
</form>
<script>
    $(function () {
        var zTreeObj;
        var setting = {
            check: {
                enable: true,
                autoCheckTrigger: true,
                chkboxType: { "Y": "ps", "N": "ps" }
            },
            data:{
                simpleData: {
                    enable: true
                }
            },
            view: {
                expandSpeed: ""
            },
            callback: {
                onCheck: zTreeOnCheck//复选框选中
            }
        };
        var zNodes =[
            { id:1, pId:0, name:"用户管理",value:'m', open:true},
            { id:101, pId:1, name:"总代理",value:'m.gAgent', open:true},
            { id:10101, pId:101, name:"查看",value:'m.gAgent.view'},
            { id:10102, pId:101, name:"添加",value:'m.gAgent.add'},
            { id:10103, pId:101, name:"修改",value:'m.gAgent.edit'},
            { id:10104, pId:101, name:"删除",value:'m.gAgent.del'},
            { id:102, pId:1, name:"代理",value:'m.agent', open:true},
            { id:10201, pId:102, name:"查看",value:'m.agent.view'},
            { id:10202, pId:102, name:"添加",value:'m.agent.add'},
            { id:10203, pId:102, name:"修改",value:'m.agent.edit'},
            { id:10204, pId:102, name:"删除",value:'m.agent.del'},
            { id:10205, pId:102, name:"会员转移",value:'m.agent.transfer'},
            { id:10206, pId:102, name:"修改金额",value:'m.agent.editMoney'},
            { id:10207, pId:102, name:"资金明细",value:'m.agent.capitalDetails'},
            { id:10208, pId:102, name:"查看详情",value:'m.agent.viewDetails'},
            { id:103, pId:1, name:"会员",value:'m.user', open:true},
            { id:10301, pId:103, name:"查看",value:'m.user.view'},
            { id:10302, pId:103, name:"添加",value:'m.user.add'},
            { id:10303, pId:103, name:"编辑",value:'m.user.edit'},
            { id:10304, pId:103, name:"余额变更",value:'m.user.changeBalance'},
            { id:10305, pId:103, name:"修改真实姓名",value:'m.user.editTrueName'},
            { id:10306, pId:103, name:"批量导出",value:'m.user.batchExport'},
            { id:10307, pId:103, name:"批量更新邮箱",value:'m.user.batchUpdateEmail'},
            { id:10308, pId:103, name:"删除会员",value:'m.user.delUser'},
            { id:10309, pId:103, name:"更换代理",value:'m.user.changeAgent'},
            { id:10310, pId:103, name:"交易设定",value:'m.user.tradeSetting'},
            { id:10311, pId:103, name:"盘口设定",value:'m.user.handicapSetting'},
            { id:10312, pId:103, name:"查看详情",value:'m.user.viewDetails'},
            { id:104, pId:1, name:"在线用户",value:'m.onlineUser', open:true},
            { id:10401, pId:104, name:"查看在线用户",value:'m.onlineUser.viewOnline'},
            { id:10402, pId:104, name:"踢人",value:'m.onlineUser.kill'},
            { id:105, pId:1, name:"子账号",value:'m.subAccount', open:true},
            { id:10501, pId:105, name:"查看",value:'m.subAccount.view'},
            { id:10502, pId:105, name:"添加",value:'m.subAccount.add'},
            { id:10503, pId:105, name:"修改",value:'m.subAccount.edit'},
            { id:10504, pId:105, name:"删除",value:'m.subAccount.del'},
            { id:10505, pId:105, name:"Google验证码",value:'m.subAccount.googleOTP'},

            { id:2, pId:0, name:"财务管理",value:'finance', open:true},
            { id:201, pId:2, name:"充值记录",value:'finance.rechargeRecord', open:true},
            { id:20101, pId:201, name:"充值",value:'finance.rechargeRecord.recharge'},
            { id:20102, pId:201, name:"充值通过",value:'finance.rechargeRecord.pass'},
            { id:20103, pId:201, name:"充值驳回",value:'finance.rechargeRecord.reject'},
            { id:202, pId:2, name:"提款记录",value:'finance.drawingRecord', open:true},
            { id:20201, pId:202, name:"提现",value:'finance.drawingRecord.draw'},
            { id:20202, pId:202, name:"提现通过",value:'finance.drawingRecord.pass'},
            { id:20203, pId:202, name:"提现驳回",value:'finance.drawingRecord.reject'},
            { id:20204, pId:202, name:"提款设定",value:'finance.drawingRecord.drawSetting'},
            { id:203, pId:2, name:"资金明细",value:'finance.capitalDetails'},
            { id:204, pId:2, name:"会员对账",value:'finance.memberReconciliation'},
            { id:205, pId:2, name:"代理对账",value:'finance.agentReconciliation'},

            { id:3, pId:0, name:"投注记录",value:'bet', open:true},
            { id:301, pId:3, name:"今日注单搜索",value:'bet.todaySearch', open:true},
            { id:30101, pId:301, name:"取消注单",value:'bet.todaySearch.cancel'},
            { id:302, pId:3, name:"历史注单搜索",value:'bet.historySearch'},
            { id:303, pId:3, name:"实时滚单",value:'bet.betRealTime'},

            { id:4, pId:0, name:"报表管理",value:'report', open:true},
            { id:401, pId:4, name:"总代理报表",value:'report.gAgent'},
            { id:402, pId:4, name:"代理报表",value:'report.agent'},
            { id:403, pId:4, name:"会员报表",value:'report.user'},
            { id:404, pId:4, name:"过滤默认代理报表(无需特殊需求请勿勾选此权限)",value:'report.filter'},
            { id:405, pId:4, name:"在线报表",value:'report.online'},

            { id:5, pId:0, name:"游戏管理",value:'game', open:true},
            { id:501, pId:5, name:"游戏设定",value:'game.gameSetting'},
            { id:502, pId:5, name:"交易设定",value:'game.tradeSetting'},
            { id:503, pId:5, name:"盘口设定",value:'game.handicapSetting'},

            { id:6, pId:0, name:"历史开奖",value:'historyLottery', open:true},
            { id:601, pId:6, name:"操盘权限",value:'historyLottery.operatePermission'},
            { id:602, pId:6, name:"北京PK10",value:'historyLottery.bjpk10'},
            { id:603, pId:6, name:"秒速赛车",value:'historyLottery.mssc'},
            { id:604, pId:6, name:"秒速飞艇",value:'historyLottery.msft'},
            { id:605, pId:6, name:"秒速时时彩",value:'historyLottery.msssc'},
            { id:606, pId:6, name:"重庆时时彩",value:'historyLottery.cqssc'},
            { id:607, pId:6, name:"幸运快乐8",value:'historyLottery.xykl8'},
            { id:608, pId:6, name:"幸运蛋蛋",value:'historyLottery.xydd'},
            { id:609, pId:6, name:"幸运六合彩",value:'historyLottery.xylhc'},
            { id:610, pId:6, name:"香港六合彩",value:'historyLottery.xglhc'},
            { id:611, pId:6, name:"北京快乐8",value:'historyLottery.bjkl8'},
            { id:612, pId:6, name:"PC蛋蛋",value:'historyLottery.pcdd'},
            { id:613, pId:6, name:"新疆时时彩",value:'historyLottery.xjssc'},
            { id:614, pId:6, name:"天津时时彩",value:'historyLottery.tjssc'},
            { id:615, pId:6, name:"福彩3D",value:'historyLottery.fc3d'},
            { id:616, pId:6, name:"重庆幸运农场",value:'historyLottery.cqxync'},
            { id:617, pId:6, name:"广东快乐十分",value:'historyLottery.gdklsf'},
            { id:618, pId:6, name:"江苏骰宝",value:'historyLottery.jstb'},
            { id:619, pId:6, name:"江西时时彩",value:'historyLottery.jxssc'},
            { id:620, pId:6, name:"广东11选5",value:'historyLottery.gd11x5'},

            { id:7, pId:0, name:"公告管理",value:'notice', open:true},
            { id:701, pId:7, name:"公告设置",value:'notice.noticeSetting'},
            { id:702, pId:7, name:"消息推送",value:'notice.messageSend'},

            { id:8, pId:0, name:"充值配置",value:'pay', open:true},
            { id:801, pId:8, name:"在线支付配置",value:'pay.online'},
            { id:802, pId:8, name:"银行支付配置",value:'pay.bank'},
            { id:803, pId:8, name:"支付宝配置",value:'pay.alipay'},
            { id:804, pId:8, name:"微信配置",value:'pay.wechat'},
            { id:805, pId:8, name:"财付通配置",value:'pay.cft'},
            { id:806, pId:8, name:"支付层级配置",value:'pay.payLayout'},
            { id:807, pId:8, name:"绑定银行配置",value:'pay.bindBank'},
            { id:808, pId:8, name:"充值方式配置",value:'pay.rechargeWay'},

            { id:9, pId:0, name:"系统管理",value:'system', open:true},
            { id:901, pId:9, name:"权限配置",value:'system.permission'},
            { id:902, pId:9, name:"角色配置",value:'system.role'},
            { id:903, pId:9, name:"系统参数配置",value:'system.systemSetting'},

            { id:10, pId:0, name:"日志管理",value:'log', open:true},
            { id:1001, pId:10, name:"登录日志",value:'log.login'},
            { id:1002, pId:10, name:"操作日志",value:'log.handle'},
            { id:1003, pId:10, name:"异常日志",value:'log.abnormal'},

            { id:11, pId:0, name:"活动管理",value:'activity', open:true},
            { id:1101, pId:11, name:"活动列表",value:'activity.list'},
            { id:1102, pId:11, name:"奖品配置",value:'activity.gift'},
            { id:1103, pId:11, name:"派奖审核",value:'activity.review'},

            { id:12, pId:0, name:"代理结算",value:'agentSettle', open:true},
            { id:1201, pId:12, name:"代理结算报表",value:'agentSettle.report'},
            { id:1202, pId:12, name:"代理结算审核",value:'agentSettle.review'},
            { id:1203, pId:12, name:"代理提现",value:'agentSettle.draw'},
            { id:1204, pId:12, name:"代理结算配置",value:'agentSettle.setting'},

            { id:13, pId:0, name:"平台费用",value:'platform', open:true},
            { id:1301, pId:13, name:"平台费用结算",value:'platform.settlement'},
            { id:1302, pId:13, name:"付款记录",value:'platform.payRecord'}
        ];

        zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
        function zTreeOnCheck(){
            count();
            var nodes = zTreeObj.getCheckedNodes(true);
            var tempDepNames = new Array;
            $(nodes).each(function(index, obj) {
                tempDepNames.push(obj.value)
            });
            $('#permission_selected').val(tempDepNames);
            console.log(tempDepNames)
        }
        
        function count() {
            var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
            checkCount = zTree.getCheckedNodes(true).length;
            $("#checkCount").text(checkCount);
        }

        $('#addPermissionForm').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {
                permission_name: {
                    validators: {
                        notEmpty: {
                            message: '请输入权限名称'
                        }
                    }
                },
                permission_selected:{
                    validators: {
                        notEmpty: {
                            message: '请至少选择一项权限'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            var $form = $(e.target),
                fv    = $form.data('formValidation');
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {

                }
            });
        });
    })
</script>
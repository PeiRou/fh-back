<form id="addPayOnlineForm" class="ui mini form" action="<?php echo e(url('/action/admin/addPayOnline')); ?>">
    <div class="field">
        <label>支付类型</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="payType">
                <option value="">请选择支付类型</option>
                <?php $__currentLoopData = $payType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="field">
        <label>不可见地区</label>
        <div class="ui input icon">
            <select id="noArea" name="lockArea[]" multiple="multiple">
                <option value="北京">北京</option>
                <option value="天津">天津</option>
                <option value="河北">河北</option>
                <option value="山西">山西</option>
                <option value="内蒙古">内蒙古</option>
                <option value="辽宁">辽宁</option>
                <option value="吉林">吉林</option>
                <option value="黑龙江">黑龙江</option>
                <option value="上海">上海</option>
                <option value="江苏">江苏</option>
                <option value="浙江">浙江</option>
                <option value="安徽">安徽</option>
                <option value="福建">福建</option>
                <option value="江西">江西</option>
                <option value="山东">山东</option>
                <option value="河南">河南</option>
                <option value="湖北">湖北</option>
                <option value="湖南">湖南</option>
                <option value="广东">广东</option>
                <option value="广西">广西</option>
                <option value="海南">海南</option>
                <option value="重庆">重庆</option>
                <option value="四川">四川</option>
                <option value="贵州">贵州</option>
                <option value="云南">云南</option>
                <option value="西藏">西藏</option>
                <option value="陕西">陕西</option>
                <option value="甘肃">甘肃</option>
                <option value="青海">青海</option>
                <option value="宁夏">宁夏</option>
                <option value="新疆">新疆</option>
                <option value="台湾">台湾</option>
                <option value="香港">香港</option>
                <option value="澳门">澳门</option>
            </select>
        </div>
    </div>

    <div class="field">
        <label>支付名称</label>
        <div class="ui input icon">
            <input type="text" name="pay_name"/>
        </div>
    </div>

    <div class="field">
        <label>商户号</label>
        <div class="ui input icon">
            <input type="text" name="merchant_id"/>
        </div>
    </div>

    <div class="field">
        <label>商户密钥</label>
        <div class="ui input icon">
            <input type="text" name="merchant_key"/>
        </div>
    </div>

    <div class="field">
        <label>第三方公钥</label>
        <div class="ui input icon">
            <input type="text" name="public_key" placeholder="非必填"/>
        </div>
    </div>

    <div class="field">
        <label>第三方域名</label>
        <div class="ui input icon">
            <input type="text" name="public_domain" placeholder="非必填"/>
        </div>
    </div>

    <div class="field">
        <label>终端号</label>
        <div class="ui input icon">
            <input type="text" name="terminal_id" placeholder="非必填"/>
        </div>
    </div>

    <div class="field">
        <label>请求网址</label>
        <div class="ui input icon">
            <input type="text" name="req_url"/>
        </div>
    </div>

    <div class="field">
        <label>返回地址</label>
        <div class="ui input icon">
            <input type="text" name="res_url" placeholder="http://pay.****.com"/>
        </div>
    </div>

    <div class="two fields">
        <div class="field">
            <label>最小金额</label>
            <div class="ui input icon">
                <input type="text" name="min_money"/>
            </div>
        </div>
        <div class="field">
            <label>最大金额</label>
            <div class="ui input icon">
                <input type="text" name="max_money"/>
            </div>
        </div>
    </div>

    <div class="field">
        <label>返利/手续费</label>
        <div class="ui input icon">
            <input type="text" name="rebate_or_fee"  placeholder="0.001即是千分之一，正数返利、负数手续费"/>
        </div>
    </div>

    <div class="field">
        <label>状态</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="status">
                <option value="1">正常</option>
                <option value="0">停用</option>
            </select>
        </div>
    </div>

    <div class="field">
        <label>前端备注说明</label>
        <div class="ui input icon">
            <input type="text" name="before_content"/>
        </div>
    </div>

    <div class="field">
        <label>后台备注说明</label>
        <div class="ui input icon">
            <input type="text" name="after_content"/>
        </div>
    </div>

    <div class="field">
        <label>层设置</label>
        <?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="ui checkbox">
                <input type="checkbox" tabindex="0" value="<?php echo e($item->value); ?>" name="levels[]" class="hidden">
                <label><?php echo e($item->name); ?></label>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</form>

<style>
    .select2-search__field{border: none !important;}
    .select2-container{z-index: 9999999999 !important;}
</style>

<script>
    $(function () {
        $('.ui.checkbox').checkbox();
        $('#noArea').select2();

        $('#addPayOnlineForm')
            .formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {
                payType:{
                    validators: {
                        notEmpty: {
                            message: '请选择支付类型'
                        }
                    }
                },
                pay_name: {
                    validators: {
                        notEmpty: {
                            message: '支付名称必须填写'
                        }
                    }
                },
                merchant_id:{
                    validators: {
                        notEmpty: {
                            message: '商户号必须填写'
                        }
                    }
                },
                merchant_key:{
                    validators: {
                        notEmpty: {
                            message: '商户密钥必须填写'
                        }
                    }
                },
                req_url:{
                    validators: {
                        notEmpty: {
                            message: '请求地址必须填写'
                        }
                    }
                },
                res_url:{
                    validators: {
                        notEmpty: {
                            message: '返回地址必须填写'
                        }
                    }
                },
                min_money:{
                    validators: {
                        notEmpty: {
                            message: '最小金额必须填写'
                        }
                    }
                },
                max_money:{
                    validators: {
                        notEmpty: {
                            message: '最大金额必须填写'
                        }
                    }
                },
                before_content:{
                    validators: {
                        notEmpty: {
                            message: '前端备注说明必须填写'
                        }
                    }
                },
                after_content:{
                    validators: {
                        notEmpty: {
                            message: '后台备注说明必须填写'
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
                    if(result.status == true){
                        jc.close();
                        $('#payOnlineTable').DataTable().ajax.reload(null,false);
                    } else {
                        Calert(result.msg,'red');
                    }
                }
            });
        });
    });
</script>
<form id="changeUserMoneyForm" class="ui mini form" action="<?php echo e(url('/action/admin/changeUserMoney')); ?>">
    <div class="field">
        <label>会员账号</label>
        <div class="ui input icon">
            <input type="text" name="account" value="<?php echo e($user->username); ?>" readonly/>
        </div>
    </div>
    <div class="field">
        <label>当前余额</label>
        <div class="ui input icon">
            <input type="text" name="balance" value="<?php echo e($user->money); ?>" readonly/>
        </div>
    </div>
    <div class="field">
        <label>增减余额 <span class="tips-small">输入负值表示减少金额</span></label>
        <div class="ui input icon">
            <input type="text" name="money"/>
        </div>
    </div>
    <div class="field">
        <label>备注</label>
        <div class="ui input icon">
            <input type="text" name="content" placeholder="备注必填"/>
        </div>
    </div>
    <input type="hidden" name="uid" value="<?php echo e($user->id); ?>"/>
</form>
<script>
    $('#changeUserMoneyForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            money:{
                validators: {
                    notEmpty: {
                        message: '<i class="fas fa-exclamation-circle"></i> 请输入金额'
                    },
                    numeric: {
                        message: '<i class="fas fa-exclamation-circle"></i> 不是有效的数字',
                        thousandsSeparator: '',
                        decimalSeparator: '.'
                    }
                }
            },
            content: {
                validators: {
                    notEmpty: {
                        message: '<i class="fas fa-exclamation-circle"></i> 备注必须填写'
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
                    $('#userTable').DataTable().ajax.reload(null,false);
                } else {
                    Calert(result.msg,'red')
                }
            }
        });
    });
</script>
<form id="addLevelForm" class="ui mini form" action="<?php echo e(url('/action/admin/addLevel')); ?>">
    <div class="field">
        <label>层级名称</label>
        <div class="ui input icon">
            <input type="text" name="name" id="name"/>
        </div>
    </div>

    <div class="field">
        <label>分层值(此值必须为整数，且唯一存在)</label>
        <div class="ui input icon">
            <input type="text" name="value" id="value"/>
        </div>
    </div>

    <div class="field">
        <label>每笔在线充值最高金额</label>
        <div class="ui input icon">
            <input type="text" name="oneRechMoney" id="oneRechMoney"/>
        </div>
    </div>

    <div class="field">
        <label>当日在线充值最高金额</label>
        <div class="ui input icon">
            <input type="text" name="allRechMoney" id="allRechMoney"/>
        </div>
    </div>

    <div class="field">
        <label>每笔提现最高金额</label>
        <div class="ui input icon">
            <input type="text" name="oneDrawMoney" id="oneDrawMoney"/>
        </div>
    </div>

    <div class="field">
        <label>当日提现最高金额</label>
        <div class="ui input icon">
            <input type="text" name="allDrawMoney" id="allDrawMoney"/>
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
</form>
<script>
    $('#addLevelForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            name:{
                validators: {
                    notEmpty: {
                        message: '请输入层级名称'
                    }
                }
            },
            value: {
                validators: {
                    notEmpty: {
                        message: '请输入分层值'
                    },
                    integer: {
                        message: '该值不是一个整数',
                        // The default separators
                        thousandsSeparator: '',
                        decimalSeparator: '.'
                    }
                }
            },
            oneRechMoney:{
                validators: {
                    integer: {
                        message: '该值不是一个整数',
                        // The default separators
                        thousandsSeparator: '',
                        decimalSeparator: '.'
                    }
                }
            },
            allRechMoney:{
                validators: {
                    integer: {
                        message: '该值不是一个整数',
                        // The default separators
                        thousandsSeparator: '',
                        decimalSeparator: '.'
                    }
                }
            },
            oneDrawMoney:{
                validators: {
                    integer: {
                        message: '该值不是一个整数',
                        // The default separators
                        thousandsSeparator: '',
                        decimalSeparator: '.'
                    }
                }
            },
            allDrawMoney:{
                validators: {
                    integer: {
                        message: '该值不是一个整数',
                        // The default separators
                        thousandsSeparator: '',
                        decimalSeparator: '.'
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
                    $('#levelTable').DataTable().ajax.reload(null,false);
                } else {
                    Calert(result.msg,'red');
                }
            }
        });
    });
</script>
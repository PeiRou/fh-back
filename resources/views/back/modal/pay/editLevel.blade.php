<form id="editLevelForm" class="ui mini form" action="{{ url('/action/admin/editLevel') }}">
    <div class="field">
        <label>层级名称</label>
        <div class="ui input icon">
            <input type="text" name="name" @if($level->value == 0) readonly @endif id="name" value="{{ $level->name }}"/>
        </div>
    </div>

    <div class="field">
        <label>分层值</label>
        <div class="ui input icon">
            <input type="text" name="value" readonly id="value" value="{{ $level->value }}"/>
        </div>
    </div>

    <div class="field">
        <label>状态</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="status">
                <option value="1" @if($level->status == 1) selected @endif>正常</option>
                <option value="0" @if($level->status == 0) selected @endif>停用</option>
            </select>
        </div>
    </div>

    <div class="field">
        <label>每笔在线充值最高金额</label>
        <div class="ui input icon">
            <input type="text" name="oneRechMoney" id="oneRechMoney" value="{{ $level->oneRechMoney }}"/>
        </div>
    </div>

    <div class="field">
        <label>当日在线充值最高金额</label>
        <div class="ui input icon">
            <input type="text" name="allRechMoney" id="allRechMoney" value="{{ $level->allRechMoney }}"/>
        </div>
    </div>

    <div class="field">
        <label>每笔提现最高金额</label>
        <div class="ui input icon">
            <input type="text" name="oneDrawMoney" id="oneDrawMoney" value="{{ $level->oneDrawMoney }}"/>
        </div>
    </div>

    <div class="field">
        <label>当日提现最高金额</label>
        <div class="ui input icon">
            <input type="text" name="allDrawMoney" id="allDrawMoney" value="{{ $level->allDrawMoney }}"/>
        </div>
    </div>

    <a href="javascript:void(0)" onclick="clearInput()">一键清空所有限制金额</a>

    <input type="hidden" name="id" value="{{ $id }}">
</form>
<script>
    $('#editLevelForm').formValidation({
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
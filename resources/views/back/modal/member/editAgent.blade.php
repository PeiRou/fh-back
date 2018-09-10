<form id="editAgentForm" class="ui mini form" action="{{ url('/action/admin/editAgent') }}">
    <div class="two fields">
        <div class="field">
            <label>代理账号</label>
            <div class="ui input icon">
                <input type="text" name="account" value="{{ $info->account }}" readonly/>
            </div>
        </div>
        <div class="field">
            <label>账号状态</label>
            <div class="ui input icon">
                <select class="ui dropdown" name="status" style="height: 32px !important;">
                    <option @if($info->status == 1) selected @endif value="1">正常</option>
                    <option @if($info->status == 2) selected @endif value="2">冻结</option>
                    <option @if($info->status == 3) selected @endif value="3">停用</option>
                </select>
            </div>
        </div>
    </div>

    <div class="two fields">
        <div class="field">
            <label>报表显示名</label>
            <div class="ui input icon">
                <input type="text" name="name" value="{{ $info->name }}"/>
            </div>
        </div>
        <div class="field">
            <label>真实姓名</label>
            <div class="ui input icon">
                <input type="text" name="truename" value="{{ $info->truename }}"/>
            </div>
        </div>
    </div>

    <div class="two fields">
        <div class="field">
            <label>开户银行</label>
            <div class="ui input icon">
                <select class="ui dropdown" name="bank" style="height: 32px !important;">
                    <option value="">请选择</option>
                    @foreach($bank as $item)
                        <option @if($info->bank_id == $item->bank_id) selected @endif value="{{ $item->bank_id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="field">
            <label>银行卡号</label>
            <div class="ui input icon">
                <input type="text" name="bank_num" value="{{ $info->bank_num }}"/>
            </div>
        </div>
    </div>

    <div class="two fields">
        <div class="field">
            <label>支行地址</label>
            <div class="ui input icon">
                <input type="text" name="bank_addr" value="{{ $info->bank_addr }}"/>
            </div>
        </div>
        <div class="field">
            <label>手机号码</label>
            <div class="ui input icon">
                <input type="text" name="mobile" value="{{ $info->mobile }}"/>
            </div>
        </div>
    </div>

    <div class="two fields">
        <div class="field">
            <label>QQ</label>
            <div class="ui input icon">
                <input type="text" name="qq" value="{{ $info->qq }}"/>
            </div>
        </div>
        <div class="field">
            <label>Email</label>
            <div class="ui input icon">
                <input type="text" name="email" value="{{ $info->email }}"/>
            </div>
        </div>
    </div>

    <div class="two fields">
        <div class="field">
            <label>微信</label>
            <div class="ui input icon">
                <input type="text" name="wechat" value="{{ $info->wechat }}"/>
            </div>
        </div>
        <div class="field">
            <label>提款密码</label>
            <div class="ui input icon">
                <input type="text" name="draw_password" placeholder="留空为不修改"/>
            </div>
        </div>
    </div>

    <div class="two fields">
        <div class="field">
            <label>代理账号密码</label>
            <div class="ui input icon">
                <input type="text" name="password" placeholder="留空视为不修改"/>
            </div>
        </div>
        <div class="field">
            <label>开启赔率修改权限</label>
            <div class="ui input icon">
                <select class="ui fluid dropdown" name="editodds" style="height: 32px !important;">
                    <option @if($info->editodds == 0) selected @endif value="0">关闭</option>
                    <option @if($info->editodds == 1) selected @endif value="1">开启</option>
                </select>
            </div>
        </div>
    </div>

    <div class="field">
        <label>备注</label>
        <div class="ui input icon">
            <textarea name="content" rows="3">{{ $info->content }}</textarea>
        </div>
    </div>
    <input type="hidden" name="a_id" value="{{ $info->a_id }}">
</form>
<script>
    $('#editAgentForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            bank_num:{
                validators: {
                    numeric: {
                        message: '银行卡号码必须是数字',
                        // The default separators
                        thousandsSeparator: ''
                    }
                }
            },
            mobile: {
                validators: {
                    phone: {
                        country: 'CN',
                        message: '不是有效的中国大陆手机号码'
                    }
                }
            },
            email: {
                validators: {
                    emailAddress: {
                        message: '邮箱地址格式错误'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: '邮箱地址格式错误'
                    }
                }
            }
        }
    }).on('err.validator.fv', function(e, data) {
        // data.bv        --> The FormValidation.Base instance
        // data.field     --> The field name
        // data.element   --> The field element
        // data.validator --> The current validator name

        if (data.field === 'email') {
            // The email field is not valid
            data.element
                .data('fv.messages')
                // Hide all the messages
                .find('small[data-fv-for="' + data.field + '"]').hide()
            // Show only message associated with current validator
                .filter('[data-fv-validator="' + data.validator + '"]').show();
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
                    $('#agentTable').DataTable().ajax.reload(null,false);
                }
            }
        });
    });
</script>
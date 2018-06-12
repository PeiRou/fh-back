<form id="changeAgentMoneyForm" class="ui mini form" action="{{ url('/action/admin/changeAgentMoney') }}">
    <div class="field">
        <label>代理账号</label>
        <div class="ui input icon">
            <input type="text" name="account" value="{{ $info->account }}" readonly/>
        </div>
    </div>
    <div class="field">
        <label>当前余额</label>
        <div class="ui input icon">
            <input type="text" name="balance" value="{{ $info->balance }}" readonly/>
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
            <input type="text" name="content" placeholder="备注可留空"/>
        </div>
    </div>
    <input type="hidden" name="a_id" value="{{ $info->a_id }}"/>
</form>
<script>
    $('#changeAgentMoneyForm').formValidation({
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
                    $('#agentTable').DataTable().ajax.reload(null,false);
                } else {
                    Calert(result.msg,'red')
                }
            }
        });
    });
</script>
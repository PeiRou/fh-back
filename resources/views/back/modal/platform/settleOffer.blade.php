<form id="addBankForm" class="ui mini form" action="{{ url('/action/admin/platform/pay') }}">
    <div class="field">
        <label>支付订单</label>
        <div class="ui input icon">
            <input type="text" readonly="readonly" value="{{ $iInfo->order_id }}"/>
        </div>
    </div>
    <div class="field">
        <label>支付类型</label>
        <div class="ui input icon">
            <input type="text" readonly="readonly" value="{{ $iInfo->typestr }}"/>
        </div>
    </div>
    <div class="field">
        <label>支付费用</label>
        <div class="ui input icon">
            <input type="text" readonly="readonly" value="{{ $iInfo->money }}"/>
        </div>
    </div>
    <div class="field">
        <label>备注信息</label>
        <div class="ui input icon">
            <input type="text" readonly="readonly" value="{{ $iInfo->content }}"/>
        </div>
    </div>
    <div class="field">
        <label>支付方式</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="type">
                @foreach($aPay as $iPay)
                <option value="{{ $iPay['id'] }}">{{ $iPay['web_name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <input type="hidden" value="{{ $iInfo->id }}" name="id">
</form>
<div style="display: none" id="abcd"></div>
<script>
    $('#addBankForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {

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
                    $('#abcd').html(result.data);
                }else{
                    alert('支付失败');
                }
            }
        });
    });
</script>
<form id="formData" class="ui mini form" action="{{ url('/action/admin/platform/payUnpaid') }}">
    <style>
        .centerPaysop{
            width: initial!important;
        }
    </style>
    <table class="ui small table dataTable no-footer">
        <thead>
            <tr role="row">
                <th>备注</th>
                <th width="40%">费用</th>
            </tr>
        </thead>
        <tbldy>
            @foreach($data['list'] as $v)
                <tr>
                    <td>{{ $v['content'] }}</td>
                    <td>
                        {{ $v['money'] }}
                        {{--<input type="hidden" name="orders[]" value="{{ $v['order_id'] }}">--}}
                    </td>
                </tr>
            @endforeach
                <tr>
                    <td>总计：</td>
                    <td style="color: #FF3000">{{ $data['totalMoney'] }}</td>
                </tr>
                <tr>
                    <td>支付订单号</td>
                    <td ><input type="text" name="order_no" readonly value="{{ $data['order_no'] }}"></td>
                </tr>
                <tr>
                    <td>支付方式</td>
                    <td  id="centerPays">
                        <select class="ui fluid centerPaysop" name="type">
                            @foreach($data['aPay'] as $v)
                            <option value="{{ $v['id'] }}">{{ $v['web_name'] }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
        </tbldy>
    </table>
</form>
<div style="display: none" id="abcd"></div>
<script>
    $('#formData').formValidation({
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
                console.log(result);
                if(result.status == true){
                    $('#abcd').html(result.data);
                }else{
                    alert('支付失败');
                }
            }
        });
    });
    $(function(){

    })
</script>
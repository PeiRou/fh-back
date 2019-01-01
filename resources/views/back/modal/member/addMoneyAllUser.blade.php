<link href="/js/jquery.searchableSelect.css" rel="stylesheet" type="text/css">
<form id="changeUserMoneyForm" class="ui mini form" action="{{ url('/action/admin/addMoneyAllUser') }}">
    <div class="field">
        <label>会员层级</label>
        <div class="ui input icon">
            <select class="ui dropdown" id="admin_add_money" name="level" style='height:32px !important'>
                <option value="">请选择层级</option>
                @foreach($levelArr as $k => $v)
                    <option value="{{ $v->value }}">{{ $v->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="field">
        <label>加钱类型</label>
        <select class="ui dropdown" id="admin_add_money" name="admin_add_money" style='height:32px !important'>
            @foreach($aRechargesType as $kRechargesType => $iRechargesType)
                <option value="{{ $kRechargesType }}">{{ $iRechargesType }}</option>
            @endforeach
        </select>
    </div>
    <div class="field">
        <label>增减余额 <span class="tips-small">输入负值表示减少金额</span></label>
        <div class="ui input icon">
            <input type="text" name="money" id ="money"/>
        </div>
    </div>
    <div class="field">
        <label>备注</label>
        <input type="text"  name="beizhu" id ="beizhu" />
    </div>
</form>
<script src="/js/jquery.searchableInputSelect.js"></script>
<script type="text/javascript">
    $('#select').searchableInputSelect();
    $('#money').click(function() {
        var selectholderval = document.getElementById('select-holder').innerHTML;
        document.getElementById('beizhu').value = selectholderval;
    });
    $('#admin_add_money').on('mouseleave', function(event) {
        document.getElementById('select-holder').addEventListener('click',function () {
            var moneyType = $('#admin_add_money').val();
            $.ajax({
                url:'/usermoney/selectData/addmoneytype/'+moneyType,
                type:'get',
                dataType:'json',
                success:function (result) {
                    var str = '';
                    result.forEach(function(item){
                        str += '<option value="'+item.msg+'">'+item.msg+'</option>';
                    });
                    $("#select").html(str);
                    $("#searchable-select").remove();
                    $('#select').searchableInputSelect();
                }
            });
        });
    });
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
            beizhu: {
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

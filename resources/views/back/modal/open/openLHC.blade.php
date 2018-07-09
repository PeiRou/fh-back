<form id="openLhc" class="ui mini form" action="{{ url('/action/admin/openLhc') }}">
    <div class="field">
        <label>期号</label>
        <div class="ui input icon">
            <input type="text" name="issue" value="{{ $lhc->issue }}" readonly/>
        </div>
    </div>
    <div class="field openSelect">
        <label>开奖号码</label>
        <div class="ui input icon">
            <select name="nums">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select name="nums">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select name="nums">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select name="nums">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select name="nums">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select name="nums">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <span>特码：</span>
            <select name="nums">
                <option value=""></option>
            </select>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $lhc->id }}">
</form>

<script>
    $(function () {
        var selectNum = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49];
        var str;
        for(var i = 0;i<selectNum.length;i++){
            str += '<option value="'+selectNum[i]+'">'+selectNum[i]+'</option>'
        }
        $('select[name="nums"]').html(str);
    });
    $('#openLhc').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            issue:{
                validators: {
                    notEmpty: {
                        message: '请输入期号'
                    }
                }
            },
            end_time: {
                validators: {
                    notEmpty: {
                        message: '请输入封盘时间'
                    }
                }
            },
            open_time: {
                validators: {
                    notEmpty: {
                        message: '请输入开奖时间'
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
                    $('#lhcHistoryTable').DataTable().ajax.reload(null,false);
                } else {
                    Calert(result.msg,'red');
                    jc.close();
                    $('#lhcHistoryTable').DataTable().ajax.reload(null,false);
                }
            }
        });
    });
</script>
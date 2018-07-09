<form id="openLhc" class="ui mini form" action="{{ url('/action/admin/openLhc') }}">
    <div class="field" style="width: 120px;">
        <label>期号</label>
        <div class="ui input icon">
            <input type="text" name="issue" value="{{ $lhc->issue }}" readonly/>
        </div>
    </div>
    <div class="field openSelect">
        <label>开奖号码</label>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon" style="width: 104px !important;margin-right: 0;">
            <span style="width: 70px;margin-left: 10px;line-height: 37px;">特码：</span>
            <select class="ui dropdown" name="nums">
                <option value=""></option>
            </select>
        </div>
    </div>
    <div class="field" style="margin-top: 15px;">
        <label>自动获取</label>
        <span onclick="getLHCData('{{ $lhc->issue }}')" class="getBtn">点击获取开奖号码</span>
    </div>
    <div class="field" style="width: 120px;">
        <label>开奖理由</label>
        <select class="ui dropdown" name="msg">
            <option value="1">无</option>
            <option value="2">官方未开奖</option>
            <option value="3">水位错误</option>
            <option value="4">非正常投注</option>
            <option value="5">未接受注单</option>
        </select>
    </div>
    <input type="hidden" name="id" value="{{ $lhc->id }}">
</form>

<script>
    $(function () {
        var selectNum = ['',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49];
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
    
    function getLHCData(issue) {
        var subIssue = issue.slice(2);
        $.ajax({
            url:'https://vip.jiangyuan365.com/K25ae456c03d2df/'+subIssue+'/xglhc.json',
            type:'get',
            dataType:'json',
            success:function (result) {
                alert(result);
            }
        });
    }
</script>
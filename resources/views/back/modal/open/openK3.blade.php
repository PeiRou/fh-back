<div class="modal-mask">
    <div>获取开奖数据中...请稍后</div>
</div>
<form id="openK3" class="ui mini form" action="{{ url('/action/admin/openK3') }}">
    <div class="field" style="width: 120px;">
        <label>期号</label>
        <div class="ui input icon">
            <input type="text" name="issue" value="{{ $data->issue }}" readonly/>
        </div>
    </div>
    <div class="field openSelect">
        <label>开奖号码</label>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n1">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n2">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n3">
                <option value=""></option>
            </select>
        </div>
    </div>
    <div class="field" style="margin-top: 15px;">
        <label>自动获取</label>
        <span onclick="getk3Data('{{ date('Ymd',strtotime($data->opentime)) }}','{{ $data->issue }}')" class="getBtn">点击获取开奖号码</span>
    </div>
    <div class="field" style="width: 120px;">
        <label>开奖理由</label>
        <select class="ui dropdown" name="msg" id="msg">
            <option value="1">无</option>
            <option value="2">官方未开奖</option>
            <option value="3">水位错误</option>
            <option value="4">非正常投注</option>
            <option value="5">未接受注单</option>
        </select>
    </div>
    <input type="hidden" id="type" value="{{ $type }}">
    <input type="hidden" name="id" id="id" value="{{ $data->id }}">
</form>

<script>
    $(function () {
        var selectNum = ['',1,2,3,4,5,6];
        var str;
        for(var i = 0;i<selectNum.length;i++){
            str += '<option value="'+selectNum[i]+'">'+selectNum[i]+'</option>'
        }
        $('select[name="nums"]').html(str);
    });
    $('#openK3').formValidation({
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
            data: {id:$('#id').val(),n1:$('#n1').val(),n2:$('#n2').val(),n3:$('#n3').val(),msg:$('#msg').val(),type:$('#type').val()},
            success: function(result) {
                if(result.status == true){
                    jc.close();
                    $('#datTable').DataTable().ajax.reload(null,false);
                } else {
                    Calert(result.msg,'red');
                }
            }
        });
    });

    function getk3Data(date,issue) {
        $('.modal-mask').fadeIn();
        $('.getBtn').html('获取中...');
        $.ajax({
            url:'/back/openData/{{ $type }}/'+date+'/'+issue,
            type:'get',
            dataType:'json',
            success:function (result) {
                if(result.status == true){
                    $('#n1').val(result.n1);
                    $('#n2').val(result.n2);
                    $('#n3').val(result.n3);
                    $('.getBtn').html('获取成功（点击可重新获取）');
                    $('.modal-mask').fadeOut();
                }
                if(result.status == false){
                    $('.getBtn').html('点击获取开奖号码');
                    Calert(result.msg,'red');
                    $('.modal-mask').fadeOut();
                }
            }
        });
    }
</script>
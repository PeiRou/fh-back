<div class="modal-mask">
    <div>获取开奖数据中...请稍后</div>
</div>
<form id="openBjkl8" class="ui mini form" action="{{ url('/action/admin/openBjkl8') }}">
    <div class="field" style="width: 120px;">
        <label>期号</label>
        <div class="ui input icon">
            <input type="text" name="issue" value="{{ $bjkl8->issue }}" readonly/>
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
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n4">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n5">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n6">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n7">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n8">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n9">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n10">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n11">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n12">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n13">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n14">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n15">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n16">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n17">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n18">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n19">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n20">
                <option value=""></option>
            </select>
        </div>
    </div>
    <div class="field" style="margin-top: 15px;">
        <label>自动获取</label>
        <span onclick="getBJKL8Data('{{ date('Ymd',strtotime($bjkl8->opentime)) }}','{{ $bjkl8->opentime }}')" class="getBtn">点击获取开奖号码</span>
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
    <input type="hidden" name="id" id="id" value="{{ $bjkl8->id }}">
</form>

<script>
    $(function () {
        var selectNum = ['',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80];
        var str;
        for(var i = 0;i<selectNum.length;i++){
            str += '<option value="'+selectNum[i]+'">'+selectNum[i]+'</option>'
        }
        $('select[name="nums"]').html(str);
    });
    $('#openBjkl8').formValidation({
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
        var data = {
            n1:$('#n1').val(),
            n2:$('#n2').val(),
            n3:$('#n3').val(),
            n4:$('#n4').val(),
            n5:$('#n5').val(),
            n6:$('#n5').val(),
            n7:$('#n5').val(),
            n8:$('#n5').val(),
            n9:$('#n5').val(),
            n10:$('#n5').val(),
            n11:$('#n5').val(),
            n12:$('#n5').val(),
            n13:$('#n5').val(),
            n14:$('#n5').val(),
            n15:$('#n5').val(),
            n16:$('#n5').val(),
            n17:$('#n5').val(),
            n18:$('#n5').val(),
            n19:$('#n5').val(),
            n20:$('#n5').val(),
        }
        if(gameType == 'bjkl8'){
            if(!checkRepeatValue(data)){
                return Calert('请勿提交重复号码','red');
            }
        }
        data.msg = $('#msg').val();
        data.id = $('#id').val();
        data.type = $('#type').val();
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: data,
            success: function(result) {
                if(result.status == true){
                    jc.close();
                    $('#datTable').DataTable().ajax.reload(null,false);
                } else {
                    Calert(result.msg,'red');
                    // jc.close();
                    // $('#datTable').DataTable().ajax.reload(null,false);
                }
            }
        });
    });
    
    function getBJKL8Data(date,issue) {
        $('.modal-mask').fadeIn();
        $('.getBtn').html('获取中...');
        $.ajax({
            url:'/back/openData/bjkl8/'+date+'/'+issue,
            type:'get',
            dataType:'json',
            success:function (result) {
                if(result.status == true){
                    $('#n1').val(result.n1);
                    $('#n2').val(result.n2);
                    $('#n3').val(result.n3);
                    $('#n4').val(result.n4);
                    $('#n5').val(result.n5);
                    $('#n6').val(result.n6);
                    $('#n7').val(result.n7);
                    $('#n8').val(result.n8);
                    $('#n9').val(result.n9);
                    $('#n10').val(result.n10);
                    $('#n11').val(result.n11);
                    $('#n12').val(result.n12);
                    $('#n13').val(result.n13);
                    $('#n14').val(result.n14);
                    $('#n15').val(result.n15);
                    $('#n16').val(result.n16);
                    $('#n17').val(result.n17);
                    $('#n18').val(result.n18);
                    $('#n19').val(result.n19);
                    $('#n20').val(result.n20);
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
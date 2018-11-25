<div class="modal-mask">
    <div>获取开奖数据中...请稍后</div>
</div>
<form id="openCqssc" class="ui mini form" @if($typeC == 1) action="{{ url('/action/admin/openxync') }}" @else action="{{ url('/action/admin/renewLottery/'.$issue.'/'.$type) }}" @endif>
    <div class="field" style="width: 120px;">
        <label>期号</label>
        <div class="ui input icon">
            <input type="text" name="issue" value="{{ $data->issue }}" readonly/>
        </div>
    </div>
    <div class="field openSelect">
        <label>开奖号码</label>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n1" data-nums="@if($typeC == 2) {{ $nums[0] }} @endif">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n2" data-nums="@if($typeC == 2) {{ $nums[1] }} @endif">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n3" data-nums="@if($typeC == 2) {{ $nums[2] }} @endif">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n4" data-nums="@if($typeC == 2) {{ $nums[3] }} @endif">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n5" data-nums="@if($typeC == 2) {{ $nums[4] }} @endif">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n6" data-nums="@if($typeC == 2) {{ $nums[5] }} @endif">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n7" data-nums="@if($typeC == 2) {{ $nums[6] }} @endif">
                <option value=""></option>
            </select>
        </div>
        <div class="ui input icon">
            <select class="ui dropdown" name="nums" id="n8" data-nums="@if($typeC == 2) {{ $nums[7] }} @endif">
                <option value=""></option>
            </select>
        </div>
    </div>
    <div class="field" style="margin-top: 15px;">
        <label>自动获取</label>
        <span onclick="getBJPK10Data('{{ date('Ymd',strtotime($data->opentime)) }}','{{ $data->issue }}')" class="getBtn">点击获取开奖号码</span>
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
    <input type="hidden" name="id" id="id" value="{{ $data->id }}">
    <input type="hidden" id="type" value="{{ $type }}">
</form>

<script>
    $(function () {
        var selectNum = ['',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
        $('select[name="nums"]').each(function (i,e) {
            var nums = $(e).attr('data-nums');
            var str = '';
            for(var i = 0;i<selectNum.length;i++){
                str += '<option ';
                if(selectNum[i] == nums)
                    str += 'selected="selected" ';
                str += 'value="'+selectNum[i]+'">'+selectNum[i]+'</option>'
            }
            $(e).html(str);
        })
    });
    $('#openCqssc').formValidation({
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
            data: {id:$('#id').val(),n1:$('#n1').val(),n2:$('#n2').val(),n3:$('#n3').val(),n4:$('#n4').val(),n5:$('#n5').val(),n6:$('#n6').val(),n7:$('#n7').val(),n8:$('#n8').val(),n9:$('#n9').val(),n10:$('#n10').val(),msg:$('#msg').val(),type:$('#type').val()},
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
    
    function getBJPK10Data(date,issue) {
        $('.modal-mask').fadeIn();
        $('.getBtn').html('获取中...');
        $.ajax({
            url:'/back/openData/'+gameType+'/'+date+'/'+issue.slice(2),
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
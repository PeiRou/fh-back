<form id="addAgentForm" class="ui mini form" action="{{ url('/action/admin/addAgent') }}">
    <div class="field">
        <label>上级总代理</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="gagent">
                <option value="">请选择</option>
                @foreach($info as $item)
                    <option value="{{ $item->ga_id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if(env('TEST',0) == 1)
        <div class="field">
            <label>代理模式</label>
            <div class="ui input icon">
                <select class="ui fluid dropdown" name="modelStatus" id="modelStatus" onchange="modelStatusChange()">
                    @foreach($agentModelStatus as $kAgentModelStatus => $iAgentModelStatus)
                        <option value="{{ $kAgentModelStatus }}">{{ $iAgentModelStatus }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div id="commission" style="display: none;margin-bottom: 10px;">
            @foreach($aAgentOdds as $iAgentOdds)
            <div class="field">
                <label>{{ $iAgentOdds->title }}提成</label>
                <div class="ui input icon">
                    <select class="ui fluid dropdown" name="odds_level[]" id="odds_level">
                        @foreach($iAgentOdds->info as $iInfo)
                            <option value="{{ $iInfo->id }}">{{ $iInfo->odds }} %</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    <div class="field">
        <label>代理账号</label>
        <div class="ui input icon">
            <input type="text" name="account" id="account"/>
        </div>
    </div>
    <div class="field">
        <label>账号密码</label>
        <div class="ui input icon">
            <input type="text" name="password" id="password"/>
        </div>
    </div>
    <div class="field">
        <label>代理名称</label>
        <div class="ui input icon">
            <input type="text" name="name" id="name"/>
        </div>
    </div>
    @if(!empty($iAgent) && $iAgent->modelStatus == 3)
    <div class="field">
        <label>开启赔率修改权限</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="editodds">
                <option value="0">关闭</option>
                <option value="1">开启</option>
            </select>
        </div>
    </div>
    @endif
    @if(!empty($agentId))
        <input type="hidden" name="agentId" value="{{ $agentId }}">
    @endif
</form>
<script>
    // $('#agentId').on('change',function () {
    //     var agentId = $(this).val();
    //     $.ajax({
    //         url:'/action/admin/selectAgentOdds',
    //         type:'post',
    //         dataType:'json',
    //         data:{id:agentId},
    //         success:function (data) {
    //             var html = "<option value=''>请选择代理赔率</option>";
    //             for(i of data.aAgentOdds) {
    //                 html += "<option value='"+i.level+"'>"+i.odds+"</option>";
    //             }
    //             $('#odds_level').html(html);
    //         },
    //         error:function (e) {
    //             if(e.status == 403)
    //             {
    //                 Calert('您没有此项权限！无法继续！','red')
    //             }
    //         }
    //     });
    // });

    $('#addAgentForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            gagent:{
                validators: {
                    notEmpty: {
                        message: '请选择上级总代理'
                    }
                }
            },
            account: {
                validators: {
                    notEmpty: {
                        message: '请输入代理账号'
                    }
                }
            },
            password:{
                validators: {
                    notEmpty: {
                        message: '请输入代理账号密码'
                    }
                }
            },
            name:{
                validators: {
                    notEmpty: {
                        message: '请输入代理名称'
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
                }else{
                    alert(result.msg);
                }
            }
        });
    });

    function modelStatusChange() {
        var modelStatus =  $('#modelStatus').val();
        console.log(modelStatus);
        if(modelStatus == 1){
            $('#commission').show();
        }else{
            $('#commission').hide();
        }
    }
</script>
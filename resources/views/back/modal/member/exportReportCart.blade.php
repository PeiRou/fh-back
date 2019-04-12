<style>
    #addAgentForm{
        width: 100%;
    }
    #addAgentForm label{
        display: inline-block;
        width: 40%;
        padding: 3px;
        margin-bottom: 3px;
        /*display: flex;*/
        /*justify-content: center;*/
        /*justify-items: center;*/
    }
    #addAgentForm label input{
        margin-top: -2px;
        margin-bottom: 1px;
        vertical-align: middle;
    }
</style>
<form id="addAgentForm" class="ui mini form" style="height: 320px;">
    <label>
        <input name="user_account" type="checkbox" disabled="disabled"  checked="checked">
        <span >账号</span>
    </label>
    <label>
        <input name="agent_account" type="checkbox" disabled="disabled" checked="checked">
        <span >代理</span>
    </label>
    @foreach(\App\GamesApi::getOpenData() as $k=>$v)
        <label>
            <input name="{{ $v->g_id }}" type="checkbox" checked="checked">
            <span >{{ $v->name }}</span>
        </label>
    @endforeach
</form>
<script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
<link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
<script>

    $('#addAgentForm').formValidation({
        framework: 'semantic',
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        var $form = $(e.target),
            fv    = $form.data('formValidation');
        var column_ = [];
        $('#addAgentForm input[type="checkbox"]').each(function(k,v){
            if($(v).prop("checked")){
                column_.push($(v).attr('name'));
            }
        });
        if(column_.length < 1) return Calert('请选择导出的字段','red');
        var data = {};
        data.startTime = $('#timeStart').val();
        data.endTime = $('#timeEnd').val();
        data.userAccount = $('#user_account').val();
        data.agent_account = $('#agent_account').val();
        data.column_ = column_.join(',');
        var str = '?';
        for(k in data){
            if(data[k])str += (k+'='+data[k]+'&');
        }
        {{--window.open("{{ url('/action/admin/member/exportReportCart') }}"+str);--}}
        window.location.href = "{{ url('/action/admin/member/exportReportCart') }}"+str;
    });


</script>
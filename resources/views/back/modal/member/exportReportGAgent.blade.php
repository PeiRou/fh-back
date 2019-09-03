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
        <input name="general_account" type="checkbox" checked="checked">
        <span >账号</span>
    </label>
    <label>
        <input name="memberCount" type="checkbox" checked="checked">
        <span >会员数</span>
    </label>
    <label>
        <input name="bet_count" type="checkbox" checked="checked">
        <span >笔数</span>
    </label>
    <label>
        <input name="bet_money" type="checkbox" checked="checked">
        <span >投注金额</span>
    </label>
    <label>
        <input name="win_amount" type="checkbox" checked="checked">
        <span >中奖金额</span>
    </label>
    <label>
        <input name="bet_amount" type="checkbox" checked="checked">
        <span >赢利投注金额</span>
    </label>
    <label>
        <input name="activity_money" type="checkbox" checked="checked">
        <span >活动金额</span>
    </label>
    <label>
        <input name="handling_fee" type="checkbox" checked="checked">
        <span >充值优惠/手续费</span>
    </label>
    <label>
        <input name="return_amount" type="checkbox" checked="checked">
        <span >代理退水金额</span>
    </label>
    <label>
        <input name="bet_bunko" type="checkbox" checked="checked">
        <span >会员输赢(不包括退水)</span>
    </label>
    <label>
        <input name="fact_return_amount" type="checkbox" checked="checked">
        <span >实际退水</span>
    </label>
    <label>
        <input name="fact_bet_bunko" type="checkbox" checked="checked">
        <span >实际输赢(包括退水)</span>
    </label>

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
        data.game_id = $('#game').val();
        data.account = $('#account').val();
        data.timeStart = $('#timeStart').val();
        data.timeEnd = $('#timeEnd').val();
        data.column_ = column_.join(',');
        var str = '?';
        for(k in data){
            if(data[k])str += (k+'='+data[k]+'&');
        }
        {{--window.open("{{ url('/action/admin/member/exportReportGAgent') }}"+str);--}}
        window.location.href = "{{ url('/action/admin/member/exportReportGAgent') }}"+str;
    });


</script>
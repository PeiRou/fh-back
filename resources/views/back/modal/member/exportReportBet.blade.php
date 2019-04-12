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
        <input name="game_name" type="checkbox" checked="checked">
        <span >彩种</span>
    </label>
    <label>
        <input name="sumMoney" type="checkbox" checked="checked">
        <span >投注金额</span>
    </label>
    <label>
        <input name="countBets" type="checkbox" checked="checked">
        <span >笔数</span>
    </label>
    <label>
        <input name="countMember" type="checkbox" checked="checked">
        <span >人数</span>
    </label>
    <label>
        <input name="rebate" type="checkbox" checked="checked">
        <span >返点</span>
    </label>
    <label>
        <input name="sumWinBunko" type="checkbox" checked="checked">
        <span >中奖金额</span>
    </label>
    <label>
        <input name="countWinBunkoBet" type="checkbox" checked="checked">
        <span >笔数(输赢占比)</span>
    </label>
    <label>
        <input name="countWinBunkoMember" type="checkbox" checked="checked">
        <span >人数</span>
    </label>
    <label>
        <input name="sumBunko" type="checkbox" checked="checked">
        <span >公司损益</span>
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
        data.startTime = $('#startTime').val();
        data.endTime = $('#endTime').val();
        data.killZeroBetGame = $('#killZeroBetGame:checked').val();
        data.killCloseGame = $('#killCloseGame:checked').val();
        data.column_ = column_.join(',');
        var str = '?';
        for(k in data){
            if(data[k])str += (k+'='+data[k]+'&');
        }
        window.location.href = "{{ url('/action/admin/member/exportReportBet') }}"+str;
    });


</script>
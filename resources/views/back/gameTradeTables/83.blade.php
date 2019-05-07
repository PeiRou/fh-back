<style>
    .table-small-title{
        word-break: break-all;
        text-align: center !important;
        color: #2d2d2d;
        background: #f9f9f9;
        font-weight: bold;
    }
    .table-title{
        word-break: break-all;
        text-align: center !important;
        font-size: 16px;
        background: #fdf1f1;
        font-weight: bold;
        color: red;
        padding: 6px !important;
    }
    input{
        border: 1px solid #a2a2a2;
        height: 20px;
    }
    .small-padding{
        padding: 5px !important;
    }
</style>
<form id="game83Form" action="{{ url('/game/trade/table/save/xykl8') }}">
    <input type="hidden" name="userId" value="{{ $userId }}">
<table align="center" class="ui celled small table selectable">
    <tbody>
    <tr class="firstRow">
        <td width="190" align="center" class="table-small-title">玩法</td>
        <td width="190" align="center" class="table-small-title">单注下注最低金额</td>
        <td width="190" align="center" class="table-small-title">单注下注最高金额</td>
        <td width="190" align="center" class="table-small-title">当期下注最大</td>
    </tr>
    <tr>
        <td align="center" rowspan="1" colspan="4" class="table-title">
            幸运快乐8
        </td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">正码</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZM_min" value="{{ $mm['GAME83_ZM_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZM_max" value="{{ $mm['GAME83_ZM_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZM_turnMax" value="{{ $mm['GAME83_ZM_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">两面</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_LM_min" value="{{ $mm['GAME83_LM_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_LM_max" value="{{ $mm['GAME83_LM_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_LM_turnMax" value="{{ $mm['GAME83_LM_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">总和810</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZH810_min" value="{{ $mm['GAME83_ZH810_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZH810_max" value="{{ $mm['GAME83_ZH810_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZH810_turnMax" value="{{ $mm['GAME83_ZH810_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">五行</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_WX_min" value="{{ $mm['GAME83_WX_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_WX_max" value="{{ $mm['GAME83_WX_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_WX_turnMax" value="{{ $mm['GAME83_WX_turnMax'] }}"></td>
    </tr>
    </tbody>
</table>
<div class="foot-submit">
    <button class="ui primary button">保 存</button>
</div>
</form>
<script>
    $('#game83Form').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {}
    }).on('success.form.fv', function(e) {
        loader(true);
        e.preventDefault();
        var $form = $(e.target),
            fv    = $form.data('formValidation');
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            success: function(result) {
                if(result.status == true){
                    loader(false);
                }
            }
        });
    });
</script>
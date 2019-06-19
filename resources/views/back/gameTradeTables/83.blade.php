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
            <td width="190" valign="top" class="small-padding">大、小、单、双</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_DXDS_min" value="{{ $mm['GAME83_DXDS_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_DXDS_max" value="{{ $mm['GAME83_DXDS_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_DXDS_turnMax" value="{{ $mm['GAME83_DXDS_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">总和810</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZH810_min" value="{{ $mm['GAME83_ZH810_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZH810_max" value="{{ $mm['GAME83_ZH810_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZH810_turnMax" value="{{ $mm['GAME83_ZH810_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">总和大单、大双、小单、小双</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZHDXDS_min" value="{{ $mm['GAME83_ZHDXDS_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZHDXDS_max" value="{{ $mm['GAME83_ZHDXDS_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZHDXDS_turnMax" value="{{ $mm['GAME83_ZHDXDS_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">前后和、单双和</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_QHHDSH_min" value="{{ $mm['GAME83_QHHDSH_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_QHHDSH_max" value="{{ $mm['GAME83_QHHDSH_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_QHHDSH_turnMax" value="{{ $mm['GAME83_QHHDSH_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">金</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_JIN_min" value="{{ $mm['GAME83_JIN_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_JIN_max" value="{{ $mm['GAME83_JIN_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_JIN_turnMax" value="{{ $mm['GAME83_JIN_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">木</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_MU_min" value="{{ $mm['GAME83_MU_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_MU_max" value="{{ $mm['GAME83_MU_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_MU_turnMax" value="{{ $mm['GAME83_MU_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">水</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_SHUI_min" value="{{ $mm['GAME83_SHUI_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_SHUI_max" value="{{ $mm['GAME83_SHUI_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_SHUI_turnMax" value="{{ $mm['GAME83_SHUI_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">火</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_HUO_min" value="{{ $mm['GAME83_HUO_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_HUO_max" value="{{ $mm['GAME83_HUO_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_HUO_turnMax" value="{{ $mm['GAME83_HUO_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">土</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_TU_min" value="{{ $mm['GAME83_TU_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_TU_max" value="{{ $mm['GAME83_TU_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_TU_turnMax" value="{{ $mm['GAME83_TU_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">正码</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZM_min" value="{{ $mm['GAME83_ZM_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZM_max" value="{{ $mm['GAME83_ZM_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME83_ZM_turnMax" value="{{ $mm['GAME83_ZM_turnMax'] }}"></td>
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
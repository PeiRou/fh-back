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
<form id="game13Form" action="{{ url('/game/trade/table/save/hbk3') }}">
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
                湖北快3
            </td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">和值、大、小、单、双</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_DXDS_min" value="{{ $mm['GAME13_DXDS_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_DXDS_max" value="{{ $mm['GAME13_DXDS_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_DXDS_turnMax" value="{{ $mm['GAME13_DXDS_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">和值-3、18</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_318_min" value="{{ $mm['GAME13_318_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_318_max" value="{{ $mm['GAME13_318_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_318_turnMax" value="{{ $mm['GAME13_318_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">和值-4、5、16、17</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_451617_min" value="{{ $mm['GAME13_451617_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_451617_max" value="{{ $mm['GAME13_451617_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_451617_turnMax" value="{{ $mm['GAME13_451617_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">和值-6、7、8、9、10、11、12、13、14、15</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_6D15_min" value="{{ $mm['GAME13_6D15_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_6D15_max" value="{{ $mm['GAME13_6D15_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_6D15_turnMax" value="{{ $mm['GAME13_6D15_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">三连号-123、234、345、456</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_SLH_min" value="{{ $mm['GAME13_SLH_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_SLH_max" value="{{ $mm['GAME13_SLH_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_SLH_turnMax" value="{{ $mm['GAME13_SLH_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">三连号-三同通选</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_SLTX_min" value="{{ $mm['GAME13_SLTX_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_SLTX_max" value="{{ $mm['GAME13_SLTX_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_SLTX_turnMax" value="{{ $mm['GAME13_SLTX_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">三同号-111、222、333、444、555、666</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_STH_min" value="{{ $mm['GAME13_STH_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_STH_max" value="{{ $mm['GAME13_STH_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_STH_turnMax" value="{{ $mm['GAME13_STH_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">三同号-三同通选</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_STTX_min" value="{{ $mm['GAME13_STTX_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_STTX_max" value="{{ $mm['GAME13_STTX_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_STTX_turnMax" value="{{ $mm['GAME13_STTX_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">二同号-11、22、33、44、55、66</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_ETH_min" value="{{ $mm['GAME13_ETH_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_ETH_max" value="{{ $mm['GAME13_ETH_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_ETH_turnMax" value="{{ $mm['GAME13_ETH_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">跨度-0</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_KD0_min" value="{{ $mm['GAME13_KD0_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_KD0_max" value="{{ $mm['GAME13_KD0_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_KD0_turnMax" value="{{ $mm['GAME13_KD0_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">跨度-其他</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_KDQT_min" value="{{ $mm['GAME13_KDQT_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_KDQT_max" value="{{ $mm['GAME13_KDQT_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_KDQT_turnMax" value="{{ $mm['GAME13_KDQT_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">跨度-大小单双</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_KDDXDS_min" value="{{ $mm['GAME13_KDDXDS_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_KDDXDS_max" value="{{ $mm['GAME13_KDDXDS_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_KDDXDS_turnMax" value="{{ $mm['GAME13_KDDXDS_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">牌点-大小单双</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_PDDXDS_min" value="{{ $mm['GAME13_PDDXDS_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_PDDXDS_max" value="{{ $mm['GAME13_PDDXDS_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_PDDXDS_turnMax" value="{{ $mm['GAME13_PDDXDS_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">牌点-其他</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_PDQT_min" value="{{ $mm['GAME13_PDQT_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_PDQT_max" value="{{ $mm['GAME13_PDQT_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_PDQT_turnMax" value="{{ $mm['GAME13_PDQT_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">不出号码、必出号码</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_BUCUBICHU_min" value="{{ $mm['GAME13_BUCUBICHU_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_BUCUBICHU_max" value="{{ $mm['GAME13_BUCUBICHU_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME13_BUCUBICHU_turnMax" value="{{ $mm['GAME13_BUCUBICHU_turnMax'] }}"></td>
        </tr>
        </tbody>
    </table>
    <div class="foot-submit">
        <button class="ui primary button">保 存</button>
    </div>
</form>
<script>
    $('#game13Form').formValidation({
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
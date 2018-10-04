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
<form id="game50Form" action="{{ url('/game/trade/table/save/bjpk10') }}">
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
                北京赛车
            </td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">大、小、单、双、龙、虎</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME50_DXDS_min" value="{{ $mm['GAME50_DXDS_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME50_DXDS_max" value="{{ $mm['GAME50_DXDS_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME50_DXDS_turnMax" value="{{ $mm['GAME50_DXDS_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">单号1～10</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME50_1D10_min" value="{{ $mm['GAME50_1D10_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME50_1D10_max" value="{{ $mm['GAME50_1D10_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME50_1D10_turnMax" value="{{ $mm['GAME50_1D10_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">冠亚组合</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME50_GYZH_min" value="{{ $mm['GAME50_GYZH_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME50_GYZH_max" value="{{ $mm['GAME50_GYZH_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME50_GYZH_turnMax" value="{{ $mm['GAME50_GYZH_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">冠亚大、小、单、双</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME50_GYDXDS_min" value="{{ $mm['GAME50_GYDXDS_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME50_GYDXDS_max" value="{{ $mm['GAME50_GYDXDS_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME50_GYDXDS_turnMax" value="{{ $mm['GAME50_GYDXDS_turnMax'] }}"></td>
        </tr>
        </tbody>
    </table>
    <div class="foot-submit">
        <button class="ui primary button">保 存</button>
    </div>
</form>
<script>
    $('#game50Form').formValidation({
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
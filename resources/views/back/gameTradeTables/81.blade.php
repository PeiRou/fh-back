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
<form id="game81Form" action="{{ url('/game/trade/table/save/msssc') }}">
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
                秒速时时彩
            </td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">大、小、单、双、龙、虎、和</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_DXDSLHH_min" value="{{ $mm['GAME81_DXDSLHH_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_DXDSLHH_max" value="{{ $mm['GAME81_DXDSLHH_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_DXDSLHH_turnMax" value="{{ $mm['GAME81_DXDSLHH_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">单号1～5</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_1D5_min" value="{{ $mm['GAME81_1D5_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_1D5_max" value="{{ $mm['GAME81_1D5_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_1D5_turnMax" value="{{ $mm['GAME81_1D5_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">豹子</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_BAOZI_min" value="{{ $mm['GAME81_BAOZI_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_BAOZI_max" value="{{ $mm['GAME81_BAOZI_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_BAOZI_turnMax" value="{{ $mm['GAME81_BAOZI_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">顺子</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_SHUNZI_min" value="{{ $mm['GAME81_SHUNZI_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_SHUNZI_max" value="{{ $mm['GAME81_SHUNZI_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_SHUNZI_turnMax" value="{{ $mm['GAME81_SHUNZI_turnMax'] }}"></td>
        </tr>
        <tr>
            <td width="190" valign="top" class="small-padding">对子、半顺、杂六</td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_DBZ_min" value="{{ $mm['GAME81_DBZ_min'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_DBZ_max" value="{{ $mm['GAME81_DBZ_max'] }}"></td>
            <td width="190" valign="top" class="small-padding"><input type="text" name="GAME81_DBZ_turnMax" value="{{ $mm['GAME81_DBZ_turnMax'] }}"></td>
        </tr>
        </tbody>
    </table>
    <div class="foot-submit">
        <button class="ui primary button">保 存</button>
    </div>
</form>
<script>
    $('#game81Form').formValidation({
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
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
<form id="game21Form" action="{{ url('/game/trade/table/save/gd11x5') }}">
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
            广东11选5
        </td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">大、小、单、双、龙、虎</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_DXDSLH_min" value="{{ $mm['GAME21_DXDSLH_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_DXDSLH_max" value="{{ $mm['GAME21_DXDSLH_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_DXDSLH_turnMax" value="{{ $mm['GAME21_DXDSLH_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">一中一</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_1Z1_min" value="{{ $mm['GAME21_1Z1_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_1Z1_max" value="{{ $mm['GAME21_1Z1_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_1Z1_turnMax" value="{{ $mm['GAME21_1Z1_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">单号1～5</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_1D5_min" value="{{ $mm['GAME21_1D5_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_1D5_max" value="{{ $mm['GAME21_1D5_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_1D5_turnMax" value="{{ $mm['GAME21_1D5_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">任选二中二</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_2Z2_min" value="{{ $mm['GAME21_2Z2_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_2Z2_max" value="{{ $mm['GAME21_2Z2_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_2Z2_turnMax" value="{{ $mm['GAME21_2Z2_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">任选三中三</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_3Z3_min" value="{{ $mm['GAME21_3Z3_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_3Z3_max" value="{{ $mm['GAME21_3Z3_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_3Z3_turnMax" value="{{ $mm['GAME21_3Z3_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">任选四中四</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_4Z4_min" value="{{ $mm['GAME21_4Z4_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_4Z4_max" value="{{ $mm['GAME21_4Z4_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_4Z4_turnMax" value="{{ $mm['GAME21_4Z4_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">任选五中五</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_5Z5_min" value="{{ $mm['GAME21_5Z5_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_5Z5_max" value="{{ $mm['GAME21_5Z5_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_5Z5_turnMax" value="{{ $mm['GAME21_5Z5_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">任选六中五</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_6Z5_min" value="{{ $mm['GAME21_6Z5_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_6Z5_max" value="{{ $mm['GAME21_6Z5_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_6Z5_turnMax" value="{{ $mm['GAME21_6Z5_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">任选七中五</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_7Z5_min" value="{{ $mm['GAME21_7Z5_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_7Z5_max" value="{{ $mm['GAME21_7Z5_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_7Z5_turnMax" value="{{ $mm['GAME21_7Z5_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">任选八中五</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_8Z5_min" value="{{ $mm['GAME21_8Z5_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_8Z5_max" value="{{ $mm['GAME21_8Z5_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_8Z5_turnMax" value="{{ $mm['GAME21_8Z5_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">前二组选</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_Q2ZUX_min" value="{{ $mm['GAME21_Q2ZUX_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_Q2ZUX_max" value="{{ $mm['GAME21_Q2ZUX_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_Q2ZUX_turnMax" value="{{ $mm['GAME21_Q2ZUX_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">前三组选</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_Q3ZUX_min" value="{{ $mm['GAME21_Q3ZUX_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_Q3ZUX_max" value="{{ $mm['GAME21_Q3ZUX_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_Q3ZUX_turnMax" value="{{ $mm['GAME21_Q3ZUX_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">前二直选</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_Q2ZHIX_min" value="{{ $mm['GAME21_Q2ZHIX_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_Q2ZHIX_max" value="{{ $mm['GAME21_Q2ZHIX_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_Q2ZHIX_turnMax" value="{{ $mm['GAME21_Q2ZHIX_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">前三直选</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_Q3ZHIX_min" value="{{ $mm['GAME21_Q3ZHIX_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_Q3ZHIX_max" value="{{ $mm['GAME21_Q3ZHIX_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME21_Q3ZHIX_turnMax" value="{{ $mm['GAME21_Q3ZHIX_turnMax'] }}"></td>
    </tr>
    </tbody>
</table>
<div class="foot-submit">
    <button class="ui primary button">保 存</button>
</div>
</form>
<script>
    $('#game21Form').formValidation({
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
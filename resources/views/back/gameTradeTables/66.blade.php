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
<form id="game66Form" action="{{ url('/game/trade/table/save/pcdd') }}">
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
            PC蛋蛋
        </td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">混合-大小单双</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_HHDXDS_min" value="{{ $mm['GAME66_HHDXDS_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_HHDXDS_max" value="{{ $mm['GAME66_HHDXDS_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_HHDXDS_turnMax" value="{{ $mm['GAME66_HHDXDS_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">混合-大单、大双、小单、小双</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_HHDDDSXDXS_min" value="{{ $mm['GAME66_HHDDDSXDXS_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_HHDDDSXDXS_max" value="{{ $mm['GAME66_HHDDDSXDXS_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_HHDDDSXDXS_turnMax" value="{{ $mm['GAME66_HHDDDSXDXS_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">混合-极大、极小</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_JDJX_min" value="{{ $mm['GAME66_JDJX_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_JDJX_max" value="{{ $mm['GAME66_JDJX_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_JDJX_turnMax" value="{{ $mm['GAME66_JDJX_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">混合-豹子</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_BAOZI_min" value="{{ $mm['GAME66_BAOZI_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_BAOZI_max" value="{{ $mm['GAME66_BAOZI_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_BAOZI_turnMax" value="{{ $mm['GAME66_BAOZI_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">波色</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_BOSE_min" value="{{ $mm['GAME66_BOSE_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_BOSE_max" value="{{ $mm['GAME66_BOSE_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_BOSE_turnMax" value="{{ $mm['GAME66_BOSE_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">特码-0，27</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM027_min" value="{{ $mm['GAME66_TM027_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM027_max" value="{{ $mm['GAME66_TM027_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM027_turnMax" value="{{ $mm['GAME66_TM027_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">特码-1，26</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM126_min" value="{{ $mm['GAME66_TM126_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM126_max" value="{{ $mm['GAME66_TM126_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM126_turnMax" value="{{ $mm['GAME66_TM126_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">特码-2，25</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM225_min" value="{{ $mm['GAME66_TM225_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM225_max" value="{{ $mm['GAME66_TM225_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM225_turnMax" value="{{ $mm['GAME66_TM225_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">特码-3，4，23</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM3423_min" value="{{ $mm['GAME66_TM3423_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM3423_max" value="{{ $mm['GAME66_TM3423_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM3423_turnMax" value="{{ $mm['GAME66_TM3423_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">特码-5，22</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM522_min" value="{{ $mm['GAME66_TM522_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM522_max" value="{{ $mm['GAME66_TM522_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM522_turnMax" value="{{ $mm['GAME66_TM522_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">特码-6，7，20，21</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM672021_min" value="{{ $mm['GAME66_TM672021_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM672021_max" value="{{ $mm['GAME66_TM672021_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM672021_turnMax" value="{{ $mm['GAME66_TM672021_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">特码-8，9，18，19</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM891819_min" value="{{ $mm['GAME66_TM891819_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM891819_max" value="{{ $mm['GAME66_TM891819_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM891819_turnMax" value="{{ $mm['GAME66_TM891819_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">特码-10，11，12，13，14，15，16，17</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM10D17_min" value="{{ $mm['GAME66_TM10D17_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM10D17_max" value="{{ $mm['GAME66_TM10D17_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM10D17_turnMax" value="{{ $mm['GAME66_TM10D17_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">特码-24</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM24_min" value="{{ $mm['GAME66_TM24_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM24_max" value="{{ $mm['GAME66_TM24_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME66_TM24_turnMax" value="{{ $mm['GAME66_TM24_turnMax'] }}"></td>
    </tr>
    </tbody>
</table>
<div class="foot-submit">
    <button class="ui primary button">保 存</button>
</div>
</form>
<script>
    $('#game66Form').formValidation({
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
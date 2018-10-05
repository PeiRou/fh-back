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
<form id="game85Form" action="{{ url('/game/trade/table/save/xylhc') }}">
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
            幸运六合彩
        </td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">特码-A、B</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_TMAB_min" value="{{ $mm['GAME85_TMAB_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_TMAB_max" value="{{ $mm['GAME85_TMAB_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_TMAB_turnMax" value="{{ $mm['GAME85_TMAB_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">两面</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_LM_min" value="{{ $mm['GAME85_LM_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_LM_max" value="{{ $mm['GAME85_LM_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_LM_turnMax" value="{{ $mm['GAME85_LM_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">色波</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SB_min" value="{{ $mm['GAME85_SB_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SB_max" value="{{ $mm['GAME85_SB_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SB_turnMax" value="{{ $mm['GAME85_SB_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">特肖</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_TX_min" value="{{ $mm['GAME85_TX_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_TX_max" value="{{ $mm['GAME85_TX_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_TX_turnMax" value="{{ $mm['GAME85_TX_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">合肖</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_HX_min" value="{{ $mm['GAME85_HX_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_HX_max" value="{{ $mm['GAME85_HX_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_HX_turnMax" value="{{ $mm['GAME85_HX_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">头尾数</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_TWS_min" value="{{ $mm['GAME85_TWS_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_TWS_max" value="{{ $mm['GAME85_TWS_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_TWS_turnMax" value="{{ $mm['GAME85_TWS_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">正码</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZM_min" value="{{ $mm['GAME85_ZM_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZM_max" value="{{ $mm['GAME85_ZM_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZM_turnMax" value="{{ $mm['GAME85_ZM_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">正码特</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZMT_min" value="{{ $mm['GAME85_ZMT_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZMT_max" value="{{ $mm['GAME85_ZMT_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZMT_turnMax" value="{{ $mm['GAME85_ZMT_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">五行</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_WUXING_min" value="{{ $mm['GAME85_WUXING_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_WUXING_max" value="{{ $mm['GAME85_WUXING_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_WUXING_turnMax" value="{{ $mm['GAME85_WUXING_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">平特一肖尾数</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_PTYXWS_min" value="{{ $mm['GAME85_PTYXWS_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_PTYXWS_max" value="{{ $mm['GAME85_PTYXWS_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_PTYXWS_turnMax" value="{{ $mm['GAME85_PTYXWS_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">正肖</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZXIAO_min" value="{{ $mm['GAME85_ZXIAO_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZXIAO_max" value="{{ $mm['GAME85_ZXIAO_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZXIAO_turnMax" value="{{ $mm['GAME85_ZXIAO_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">七色波-红波、绿波、蓝波</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_7SB_min" value="{{ $mm['GAME85_7SB_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_7SB_max" value="{{ $mm['GAME85_7SB_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_7SB_turnMax" value="{{ $mm['GAME85_7SB_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">七色波-和局</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_7SBHJ_min" value="{{ $mm['GAME85_7SBHJ_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_7SBHJ_max" value="{{ $mm['GAME85_7SBHJ_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_7SBHJ_turnMax" value="{{ $mm['GAME85_7SBHJ_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">总肖-2肖、3肖、4肖</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZONGXIAO234_min" value="{{ $mm['GAME85_ZONGXIAO234_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZONGXIAO234_max" value="{{ $mm['GAME85_ZONGXIAO234_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZONGXIAO234_turnMax" value="{{ $mm['GAME85_ZONGXIAO234_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">总肖-其他（不包含：2肖、3肖、4肖）</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZONGXIAOQT_min" value="{{ $mm['GAME85_ZONGXIAOQT_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZONGXIAOQT_max" value="{{ $mm['GAME85_ZONGXIAOQT_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZONGXIAOQT_turnMax" value="{{ $mm['GAME85_ZONGXIAOQT_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">自选不中</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZXBZ_min" value="{{ $mm['GAME85_ZXBZ_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZXBZ_max" value="{{ $mm['GAME85_ZXBZ_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ZXBZ_turnMax" value="{{ $mm['GAME85_ZXBZ_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连肖连尾-二连肖</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ELX_min" value="{{ $mm['GAME85_ELX_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ELX_max" value="{{ $mm['GAME85_ELX_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_ELX_turnMax" value="{{ $mm['GAME85_ELX_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连肖连尾-三连肖</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SLX_min" value="{{ $mm['GAME85_SLX_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SLX_max" value="{{ $mm['GAME85_SLX_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SLX_turnMax" value="{{ $mm['GAME85_SLX_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连肖连尾-四连肖</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SILX_min" value="{{ $mm['GAME85_SILX_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SILX_max" value="{{ $mm['GAME85_SILX_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SILX_turnMax" value="{{ $mm['GAME85_SILX_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连肖连尾-五连肖</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_WLX_min" value="{{ $mm['GAME85_WLX_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_WLX_max" value="{{ $mm['GAME85_WLX_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_WLX_turnMax" value="{{ $mm['GAME85_WLX_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连肖连尾-二连尾</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_EELW_min" value="{{ $mm['GAME85_EELW_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_EELW_max" value="{{ $mm['GAME85_EELW_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_EELW_turnMax" value="{{ $mm['GAME85_EELW_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连肖连尾-三连尾</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SSLW_min" value="{{ $mm['GAME85_SSLW_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SSLW_max" value="{{ $mm['GAME85_SSLW_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SSLW_turnMax" value="{{ $mm['GAME85_SSLW_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连肖连尾-四连尾</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SILW_min" value="{{ $mm['GAME85_SILW_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SILW_max" value="{{ $mm['GAME85_SILW_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SILW_turnMax" value="{{ $mm['GAME85_SILW_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连肖连尾-五连尾</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_WULW_min" value="{{ $mm['GAME85_WULW_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_WULW_max" value="{{ $mm['GAME85_WULW_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_WULW_turnMax" value="{{ $mm['GAME85_WULW_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连码-三中二</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_3Z2_min" value="{{ $mm['GAME85_3Z2_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_3Z2_max" value="{{ $mm['GAME85_3Z2_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_3Z2_turnMax" value="{{ $mm['GAME85_3Z2_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连码-三全中</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_3QZ_min" value="{{ $mm['GAME85_3QZ_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_3QZ_max" value="{{ $mm['GAME85_3QZ_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_3QZ_turnMax" value="{{ $mm['GAME85_3QZ_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连码-二全中</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_2QZ_min" value="{{ $mm['GAME85_2QZ_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_2QZ_max" value="{{ $mm['GAME85_2QZ_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_2QZ_turnMax" value="{{ $mm['GAME85_2QZ_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连码-特串</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_TC_min" value="{{ $mm['GAME85_TC_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_TC_max" value="{{ $mm['GAME85_TC_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_TC_turnMax" value="{{ $mm['GAME85_TC_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连码-四全中</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SQZ_min" value="{{ $mm['GAME85_SQZ_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SQZ_max" value="{{ $mm['GAME85_SQZ_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_SQZ_turnMax" value="{{ $mm['GAME85_SQZ_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">连码-二中特</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_2ZT_min" value="{{ $mm['GAME85_2ZT_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_2ZT_max" value="{{ $mm['GAME85_2ZT_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME85_2ZT_turnMax" value="{{ $mm['GAME85_2ZT_turnMax'] }}"></td>
    </tr>
    </tbody>
</table>
<div class="foot-submit">
    <button class="ui primary button">保 存</button>
</div>
</form>
<script>
    $('#game85Form').formValidation({
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
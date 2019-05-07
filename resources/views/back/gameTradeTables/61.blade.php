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
<form id="game61Form" action="{{ url('/game/trade/table/save/cqxync') }}">
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
            重庆幸运农场
        </td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">大、小、单、双、龙、虎</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_DXDS_min" value="{{ $mm['GAME61_DXDS_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_DXDS_max" value="{{ $mm['GAME61_DXDS_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_DXDS_turnMax" value="{{ $mm['GAME61_DXDS_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">单号1～8</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_DH1D8_min" value="{{ $mm['GAME61_DH1D8_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_DH1D8_max" value="{{ $mm['GAME61_DH1D8_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_DH1D8_turnMax" value="{{ $mm['GAME61_DH1D8_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">东、南、西、北、中、发、白</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_DNXBZFB_min" value="{{ $mm['GAME61_DNXBZFB_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_DNXBZFB_max" value="{{ $mm['GAME61_DNXBZFB_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_DNXBZFB_turnMax" value="{{ $mm['GAME61_DNXBZFB_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">正码</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_ZM_min" value="{{ $mm['GAME61_ZM_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_ZM_max" value="{{ $mm['GAME61_ZM_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_ZM_turnMax" value="{{ $mm['GAME61_ZM_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">任选二</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_RXE_min" value="{{ $mm['GAME61_RXE_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_RXE_max" value="{{ $mm['GAME61_RXE_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_RXE_turnMax" value="{{ $mm['GAME61_RXE_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">选二连组</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_XELZ_min" value="{{ $mm['GAME61_XELZ_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_XELZ_max" value="{{ $mm['GAME61_XELZ_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_XELZ_turnMax" value="{{ $mm['GAME61_XELZ_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">任选三</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_RXS_min" value="{{ $mm['GAME61_RXS_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_RXS_max" value="{{ $mm['GAME61_RXS_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_RXS_turnMax" value="{{ $mm['GAME61_RXS_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">选三前组</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_XSQZ_min" value="{{ $mm['GAME61_XSQZ_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_XSQZ_max" value="{{ $mm['GAME61_XSQZ_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_XSQZ_turnMax" value="{{ $mm['GAME61_XSQZ_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">任选四</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_RXSI_min" value="{{ $mm['GAME61_RXSI_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_RXSI_max" value="{{ $mm['GAME61_RXSI_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_RXSI_turnMax" value="{{ $mm['GAME61_RXSI_turnMax'] }}"></td>
    </tr>
    <tr>
        <td width="190" valign="top" class="small-padding">任选五</td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_RXW_min" value="{{ $mm['GAME61_RXW_min'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_RXW_max" value="{{ $mm['GAME61_RXW_max'] }}"></td>
        <td width="190" valign="top" class="small-padding"><input type="text" name="GAME61_RXW_turnMax" value="{{ $mm['GAME61_RXW_turnMax'] }}"></td>
    </tr>
    </tbody>
</table>
<div class="foot-submit">
    <button class="ui primary button">保 存</button>
</div>
</form>
<script>
    $('#game61Form').formValidation({
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
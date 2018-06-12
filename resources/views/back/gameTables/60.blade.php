<!-- 广东快乐十分 -->
<form id="game60Form" action="{{ url('/game/table/save/gdklsf') }}">
    <table align="center" class="ui celled small table">
        <tbody>
        <tr class="firstRow">
            <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">广东快乐十分</td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-8球号</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="1_8_odds" value="{{ $odds['1_8_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="1_8_rebate" value="{{ $rebate['1_8_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="2face_odds" value="{{ $odds['2face_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="2face_rebate" value="{{ $rebate['2face_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">1-8方位</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="1_8_FW_odds" value="{{ $odds['1_8_FW_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="1_8_FW_rebate" value="{{ $rebate['1_8_FW_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">1-8中发白</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中发</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="zhongfa_odds" value="{{ $odds['zhongfa_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="zhongfa_rebate" value="{{ $rebate['zhongfa_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">白</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="bai_odds" value="{{ $odds['bai_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="bai_rebate" value="{{ $rebate['bai_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">正码</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="ZM_odds" value="{{ $odds['ZM_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="ZM_rebate" value="{{ $rebate['ZM_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和单双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总单</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="zongdan_odds" value="{{ $odds['zongdan_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="zongdan_rebate" value="{{ $rebate['zongdan_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="zongshuang_odds" value="{{ $odds['zongshuang_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="zongshuang_rebate" value="{{ $rebate['zongshuang_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和尾数大小</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾大</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="zongweida_odds" value="{{ $odds['zongweida_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="zongweida_rebate" value="{{ $rebate['zongweida_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾小</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="zongweixiao_odds" value="{{ $odds['zongweixiao_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="zongweixiao_rebate" value="{{ $rebate['zongweixiao_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="6" align="center" class="deep-blue-td">连码</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选二</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx2_odds" value="{{ $odds['rx2_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx2_rebate" value="{{ $rebate['rx2_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">选二连组</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="x2lz_odds" value="{{ $odds['x2lz_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="x2lz_rebate" value="{{ $rebate['x2lz_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选三</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx3_odds" value="{{ $odds['rx3_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx3_rebate" value="{{ $rebate['rx3_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">选三前组</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="x3qz_odds" value="{{ $odds['x3qz_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="x3qz_rebate" value="{{ $rebate['x3qz_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选四</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx4_odds" value="{{ $odds['rx4_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx4_rebate" value="{{ $rebate['rx4_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选五</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx5_odds" value="{{ $odds['rx5_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx5_rebate" value="{{ $rebate['rx5_rebate'] }}">
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="foot-submit">
        <button class="ui primary button">保 存</button>
    </div>
</form>
<script>
    $('#game60Form').formValidation({
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
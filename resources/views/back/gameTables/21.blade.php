<!-- 广东11选5 -->
<form id="game21Form" action="{{ url('/game/table/save/gd11x5') }}">
    <table align="center" class="ui celled small table">
        <tbody>
        <tr class="firstRow">
            <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">广东11选5</td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-5球号</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="1_5_odds" value="{{ $odds['1_5_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="1_5_rebate" value="{{ $rebate['1_5_rebate'] }}">
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
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和单双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总和单</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="ZHDS_dan_odds" value="{{ $odds['ZHDS_dan_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="ZHDS_dan_rebate" value="{{ $rebate['ZHDS_dan_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总和双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="ZHDS_shuang_odds" value="{{ $odds['ZHDS_shuang_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="ZHDS_shuang_rebate" value="{{ $rebate['ZHDS_shuang_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和尾数大小</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾大</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="ZHWS_da_odds" value="{{ $odds['ZHWS_da_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="ZHWS_da_rebate" value="{{ $rebate['ZHWS_da_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾小</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="ZHWS_xiao_odds" value="{{ $odds['ZHWS_xiao_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="ZHWS_xiao_rebate" value="{{ $rebate['ZHWS_xiao_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">一中一</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="YZY_odds" value="{{ $odds['YZY_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="YZY_rebate" value="{{ $rebate['YZY_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="11" align="center" class="deep-blue-td">连码</td>
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
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选六</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx6_odds" value="{{ $odds['rx6_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx6_rebate" value="{{ $rebate['rx6_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选七</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx7_odds" value="{{ $odds['rx7_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx7_rebate" value="{{ $rebate['rx7_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选八</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx8_odds" value="{{ $odds['rx8_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rx8_rebate" value="{{ $rebate['rx8_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前二组选</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q2zx_odds" value="{{ $odds['q2zx_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q2zx_rebate" value="{{ $rebate['q2zx_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前三组选</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3zx_odds" value="{{ $odds['q3zx_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3zx_rebate" value="{{ $rebate['q3zx_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前二直选</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q2zhix_odds" value="{{ $odds['q2zhix_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q2zhix_rebate" value="{{ $rebate['q2zhix_rebate'] }}">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前三直选</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3zhix_odds" value="{{ $odds['q3zhix_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3zhix_rebate" value="{{ $rebate['q3zhix_rebate'] }}">
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
                    alert('ok');
                }
            }
        });
    });
</script>
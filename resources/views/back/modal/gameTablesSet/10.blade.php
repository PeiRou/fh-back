<!-- 江苏骰宝(快3) -->
<form id="game10Form" action="{{ url('/game/table/agent/odds/save/'.$gameId.'/'.$agentId) }}">
<table align="center" class="ui celled small table">
    <tbody>
    <tr class="firstRow">
        <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">江苏快3</td>
    </tr>
    <tr class="firstRow">
        <td valign="middle" rowspan="1" colspan="2" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">种类</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">赔率</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">退水</td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="9" align="center" class="deep-blue-td">和值</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大小单双</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['HZ_DXDS_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['HZ_DXDS_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="HZ_DXDS_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3，18</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['HZ_318_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['HZ_318_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="HZ_318_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4，17</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['HZ_417_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['HZ_417_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="HZ_417_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5，16</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['HZ_516_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['HZ_516_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="HZ_516_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6，15</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['HZ_615_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['HZ_615_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="HZ_615_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7，14</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['HZ_714_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['HZ_714_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="HZ_714_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8，13</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['HZ_813_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['HZ_813_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="HZ_813_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9，12</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['HZ_912_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['HZ_912_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="HZ_912_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10，11</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['HZ_1011_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['HZ_1011_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="HZ_1011_odds">
    </tr>

    {{--三连号--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td" width="200">三连号</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200">123，234，345，456</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['SLH_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['SLH_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="SLH_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">三连通选</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['SLH_SLTX_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['SLH_SLTX_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="SLH_SLTX_odds">
    </tr>

    {{--三同号--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td" width="200">三同号</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200">111，222，333，444，555，666</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['STH_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['STH_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="STH_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">三同通选</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['STH_STTX_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['STH_STTX_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="STH_STTX_odds">
    </tr>

    {{--二同号--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td" width="200">二同号</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200">11，22，33，44，55，66</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['ETH_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['ETH_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="ETH_odds">
    </tr>

    {{--跨度--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="8" align="center" class="deep-blue-td" width="200">跨度</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200">0</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['KD_0_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['KD_0_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="KD_0_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">1，5</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['KD_15_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['KD_15_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="KD_15_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">2，4</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['KD_24_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['KD_24_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="KD_24_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['KD_3_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['KD_3_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="KD_3_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['KD_DA_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['KD_DA_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="KD_DA_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">小</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['KD_XIAO_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['KD_XIAO_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="KD_XIAO_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['KD_DAN_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['KD_DAN_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="KD_DAN_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">双</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['KD_SHUANG_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['KD_SHUANG_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="KD_SHUANG_odds">
    </tr>

    {{--牌点--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="7" align="center" class="deep-blue-td" width="200">牌点</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200">1，10</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['PD_110_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['PD_110_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="PD_110_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">2，9</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['PD_29_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['PD_29_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="PD_29_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['PD_3_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['PD_3_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="PD_3_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4，7</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['PD_47_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['PD_47_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="PD_47_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5，6</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['PD_56_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['PD_56_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="PD_56_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['PD_8_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['PD_8_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="PD_8_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大小单双</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['PD_DXDS_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['PD_DXDS_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="PD_DXDS_odds">
    </tr>

    {{--不出号码--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td" width="200">不出号码</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['BUCHU_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['BUCHU_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="BUCHU_odds">
    </tr>

    {{--必出号码--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td" width="200">必出号码</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['BICHU_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['BICHU_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="BICHU_odds">
    </tr>

    </tbody>
    <div class="foot-submit">
        <button class="ui primary button">保 存</button>
    </div>
</table>
</form>
<script>
    $('#game10Form').formValidation({
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
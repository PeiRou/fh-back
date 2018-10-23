<!-- 贵州快3 -->
<form id="game18Form" action="{{ url('/game/table/save/gzk3') }}">
<table align="center" class="ui celled small table">
    <tbody>
    <tr class="firstRow">
        <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">贵州快3</td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="9" align="center" class="deep-blue-td">和值</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大小单双</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_DXDS_odds" value="{{ $odds['HZ_DXDS_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_DXDS_rebate" value="{{ $rebate['HZ_DXDS_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3，18</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_318_odds" value="{{ $odds['HZ_318_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_318_rebate" value="{{ $rebate['HZ_318_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4，17</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_417_odds" value="{{ $odds['HZ_417_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_417_rebate" value="{{ $rebate['HZ_417_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5，16</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_516_odds" value="{{ $odds['HZ_516_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_516_rebate" value="{{ $rebate['HZ_516_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6，15</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_615_odds" value="{{ $odds['HZ_615_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_615_rebate" value="{{ $rebate['HZ_615_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7，14</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_714_odds" value="{{ $odds['HZ_714_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_714_rebate" value="{{ $rebate['HZ_714_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8，13</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_813_odds" value="{{ $odds['HZ_813_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_813_rebate" value="{{ $rebate['HZ_813_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9，12</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_912_odds" value="{{ $odds['HZ_912_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_912_rebate" value="{{ $rebate['HZ_912_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10，11</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_1011_odds" value="{{ $odds['HZ_1011_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="HZ_1011_rebate" value="{{ $rebate['HZ_1011_rebate'] }}">
            </div>
        </td>
    </tr>

    {{--三连号--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td" width="200">三连号</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200">123，234，345，456</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SLH_odds" value="{{ $odds['SLH_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SLH_rebate" value="{{ $rebate['SLH_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">三连通选</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SLH_SLTX_odds" value="{{ $odds['SLH_SLTX_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="SLH_SLTX_rebate" value="{{ $rebate['SLH_SLTX_rebate'] }}">
            </div>
        </td>
    </tr>

    {{--三同号--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td" width="200">三同号</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200">111，222，333，444，555，666</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="STH_odds" value="{{ $odds['STH_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="STH_rebate" value="{{ $rebate['STH_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">三同通选</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="STH_STTX_odds" value="{{ $odds['STH_STTX_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="STH_STTX_rebate" value="{{ $rebate['STH_STTX_rebate'] }}">
            </div>
        </td>
    </tr>

    {{--二同号--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td" width="200">二同号</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200">11，22，33，44，55，66</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ETH_odds" value="{{ $odds['ETH_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ETH_rebate" value="{{ $rebate['ETH_rebate'] }}">
            </div>
        </td>
    </tr>

    {{--跨度--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="8" align="center" class="deep-blue-td" width="200">跨度</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200">0</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_0_odds" value="{{ $odds['KD_0_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_0_rebate" value="{{ $rebate['KD_0_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">1，5</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_15_odds" value="{{ $odds['KD_15_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_15_rebate" value="{{ $rebate['KD_15_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">2，4</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_24_odds" value="{{ $odds['KD_24_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_24_rebate" value="{{ $rebate['KD_24_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_3_odds" value="{{ $odds['KD_3_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_3_rebate" value="{{ $rebate['KD_3_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_DA_odds" value="{{ $odds['KD_DA_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_DA_rebate" value="{{ $rebate['KD_DA_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">小</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_XIAO_odds" value="{{ $odds['KD_XIAO_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_XIAO_rebate" value="{{ $rebate['KD_XIAO_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_DAN_odds" value="{{ $odds['KD_DAN_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_DAN_rebate" value="{{ $rebate['KD_DAN_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">双</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_SHUANG_odds" value="{{ $odds['KD_SHUANG_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="KD_SHUANG_rebate" value="{{ $rebate['KD_SHUANG_rebate'] }}">
            </div>
        </td>
    </tr>

    {{--牌点--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="7" align="center" class="deep-blue-td" width="200">牌点</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200">1，10</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_110_odds" value="{{ $odds['PD_110_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_110_rebate" value="{{ $rebate['PD_110_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">2，9</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_29_odds" value="{{ $odds['PD_29_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_29_rebate" value="{{ $rebate['PD_29_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_3_odds" value="{{ $odds['PD_3_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_3_rebate" value="{{ $rebate['PD_3_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4，7</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_47_odds" value="{{ $odds['PD_47_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_47_rebate" value="{{ $rebate['PD_47_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5，6</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_56_odds" value="{{ $odds['PD_56_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_56_rebate" value="{{ $rebate['PD_56_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_8_odds" value="{{ $odds['PD_8_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_8_rebate" value="{{ $rebate['PD_8_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大小单双</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_DXDS_odds" value="{{ $odds['PD_DXDS_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="PD_DXDS_rebate" value="{{ $rebate['PD_DXDS_rebate'] }}">
            </div>
        </td>
    </tr>

    {{--不出号码--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td" width="200">不出号码</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="BUCHU_odds" value="{{ $odds['BUCHU_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="BUCHU_rebate" value="{{ $rebate['BUCHU_rebate'] }}">
            </div>
        </td>
    </tr>

    {{--必出号码--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td" width="200">必出号码</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="BICHU_odds" value="{{ $odds['BICHU_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="BICHU_rebate" value="{{ $rebate['BICHU_rebate'] }}">
            </div>
        </td>
    </tr>

    </tbody>
    <div class="foot-submit">
        <button class="ui primary button">保 存</button>
    </div>
</table>
</form>
<script>
    $('#game18Form').formValidation({
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
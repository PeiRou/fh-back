<!-- 北京赛车（PK10） -->
<form id="game50Form" action="{{ url('/game/table/agent/odds/save/'.$gameId.'/'.$agentId) }}">
    <table align="center" class="ui celled small table">
        <tbody>
        <tr class="firstRow">
            <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">北京赛车(PK10)</td>
        </tr>
        <tr class="firstRow">
            <td valign="middle" rowspan="1" colspan="2" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">种类</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">赔率</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">退水</td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-10号车</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['1_10_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['1_10_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="1_10_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['2face_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['2face_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="2face_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和大小</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['GYD_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['GYD_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="GYD_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">小</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['GYX_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['GYX_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="GYX_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和单双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['GYDan_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['GYDan_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="GYDan_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['GYS_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['GYS_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="GYS_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">冠亚军和</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3,4,18,19</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['341819_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['341819_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="341819_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5,6,16,17</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['561617_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['561617_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="561617_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7,8,14,15</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['781415_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['781415_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="781415_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9,10,12,13</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['9101213_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['9101213_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="9101213_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['11_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['11_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="11_odds">
        </tr>
        </tbody>
    </table>
    <div class="foot-submit">
        <button class="ui primary button" onclick="resetOdds()" type="button">重 置</button>
        <button class="ui primary button" onclick="saveOdds()">保 存</button>
        <button class="ui primary button" onclick="restore()" type="button">默 认</button>
    </div>
</form>
<script>
    function saveOdds() {
        $('#game50Form').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {}
        }).on('success.form.fv', function (e) {
            loader(true);
            e.preventDefault();
            var $form = $(e.target),
                fv = $form.data('formValidation');
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function (result) {
                    if (result.status == true) {
                        loader(false);
                    }
                }
            });
        });
    }

    function restore() {
        $.ajax({
            url: '{{ url('/game/table/agent/odds/restore/'.$gameId.'/'.$agentId) }}',
            type: 'POST',
            data: [],
            success: function (result) {
                if (result.status == true) {
                    resetOdds();
                }
            }
        });
    }

    function resetOdds() {
        $('#first_content').load('/game/agent/tables/set/{{ $gameId }}/{{ $agentId }}',function () {
            loader(false);
        });
    }
</script>
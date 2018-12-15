<!-- 广东11选5 -->
<form id="game21Form" action="{{ url('/game/table/agent/odds/save/'.$gameId.'/'.$agentId) }}">
    <table align="center" class="ui celled small table">
        <tbody>
        <tr class="firstRow">
            <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">广东11选5</td>
        </tr>
        <tr class="firstRow">
            <td valign="middle" rowspan="1" colspan="2" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">种类</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">赔率</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">退水</td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-5球号</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['1_5_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['1_5_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="1_5_odds">
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
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和单双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总和单</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['ZHDS_dan_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['ZHDS_dan_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="ZHDS_dan_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总和双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['ZHDS_shuang_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['ZHDS_shuang_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="ZHDS_shuang_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和尾数大小</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾大</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['ZHWS_da_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['ZHWS_da_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="ZHWS_da_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾小</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['ZHWS_xiao_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['ZHWS_xiao_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="ZHWS_xiao_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">一中一</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['YZY_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['YZY_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="YZY_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="11" align="center" class="deep-blue-td">连码</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选二</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['rx2_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['rx2_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="rx2_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选三</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['rx3_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['rx3_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="rx3_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选四</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['rx4_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['rx4_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="rx4_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选五</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['rx5_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['rx5_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="rx5_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选六</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['rx6_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['rx6_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="rx6_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选七</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['rx7_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['rx7_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="rx7_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选八</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['rx8_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['rx8_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="rx8_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前二组选</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['q2zx_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['q2zx_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="q2zx_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前三组选</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['q3zx_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['q3zx_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="q3zx_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前二直选</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['q2zhix_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['q2zhix_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="q2zhix_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前三直选</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['q3zhix_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['q3zhix_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="q3zhix_odds">
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
        $('#game21Form').formValidation({
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
                },
                error: function(data, status, xhr){
                    if(data.status == 403)
                    {
                        loader(false);
                        alert('您无权操作');
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
            },
            error: function(data, status, xhr){
                if(data.status == 403)
                {
                    loader(false);
                    alert('您无权操作');
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
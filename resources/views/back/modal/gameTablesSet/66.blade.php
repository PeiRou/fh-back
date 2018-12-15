<!-- PC蛋蛋 -->
<form id="game66Form" action="{{ url('/game/table/agent/odds/save/'.$gameId.'/'.$agentId) }}">
    <table align="center" class="ui celled small table">
        <tbody>
        <tr class="firstRow">
            <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">PC蛋蛋</td>
        </tr>
        <tr class="firstRow">
            <td valign="middle" rowspan="1" colspan="2" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">种类</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">赔率</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">退水</td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="4" align="center" width="200" class="deep-blue-td">混合</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">大，小，单，双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['HH_dxds_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['HH_dxds_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="HH_dxds_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大单，大双，小单，小双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['HH_dd_ds_xd_xs_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['HH_dd_ds_xd_xs_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="HH_dd_ds_xd_xs_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">极大，极小</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['HH_jd_jx_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['HH_jd_jx_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="HH_jd_jx_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">豹子</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['HH_baozi_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['HH_baozi_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="HH_baozi_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">波色</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红波，绿波，蓝波</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['BS_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['BS_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="BS_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="16" align="center" class="deep-blue-td">特码</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_0_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_0_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_0_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">1，26</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_0126_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_0126_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_0126_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">2，25</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_0225_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_0225_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_0225_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_3_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_3_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_3_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4，23</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_0423_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_0423_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_0423_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5，22</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_0522_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_0522_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_0522_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6，21</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_0621_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_0621_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_0621_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7，20</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_0720_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_0720_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_0720_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8，19</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_0819_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_0819_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_0819_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9，18</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_0918_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_0918_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_0918_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10，17</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_1017_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_1017_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_1017_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11，16</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_1116_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_1116_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_1116_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">12，15</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_1215_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_1215_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_1215_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">13，14</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_1314_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_1314_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_1314_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">24</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_24_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_24_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_24_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">27</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['TM_27_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['TM_27_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="TM_27_odds">
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
        $('#game66Form').formValidation({
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
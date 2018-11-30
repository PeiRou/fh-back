<!-- 秒速赛车 -->
<form id="game80Form">
    <table align="center" class="ui celled small table">
        <tbody>
        <tr class="firstRow">
            <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">秒速赛车</td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-10号车</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="1_10_odds" value="{{ $odds['1_10_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="1_10_rebate" value="{{ $rebate['1_10_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="2face_odds" value="{{ $odds['2face_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="2face_rebate" value="{{ $rebate['2face_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和大小</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYD_odds" value="{{ $odds['GYD_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYD_rebate" value="{{ $rebate['GYD_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">小</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYX_odds" value="{{ $odds['GYX_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYX_rebate" value="{{ $rebate['GYX_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和单双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYDan_odds" value="{{ $odds['GYDan_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYDan_rebate" value="{{ $rebate['GYDan_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYS_odds" value="{{ $odds['GYS_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYS_rebate" value="{{ $rebate['GYS_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">冠亚军和</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3,4,18,19</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="341819_odds" value="{{ $odds['341819_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="341819_rebate" value="{{ $rebate['341819_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5,6,16,17</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="561617_odds" value="{{ $odds['561617_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="561617_rebate" value="{{ $rebate['561617_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7,8,14,15</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="781415_odds" value="{{ $odds['781415_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="781415_rebate" value="{{ $rebate['781415_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9,10,12,13</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="9101213_odds" value="{{ $odds['9101213_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="9101213_rebate" value="{{ $rebate['9101213_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="11_odds" value="{{ $odds['11_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="11_rebate" value="{{ $rebate['11_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</form>
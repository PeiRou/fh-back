<form id="gameOddsForm" method="post" action="{{ url('/action/admin/saveOddsRebate') }}">
    <div class="ui pointing secondary menu">
        <a class="item active" data-tab="first">高频彩</a>
        <a class="item" data-tab="second">秒速彩</a>
        <a class="item" data-tab="three">幸运彩</a>
        <a class="item" data-tab="four">福彩3D</a>
        <a class="item" data-tab="five">六合彩</a>
    </div>
    <div class="ui tab segment active" data-tab="first" style="margin-bottom: 70px;">
        <!-- 北京赛车（PK10） -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">北京赛车(PK10)</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-10号车</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_110_odds" value="{{ $gameData['50_110_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_110_rebate" value="{{ $gameData['50_110_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_twoFace_odds" value="{{ $gameData['50_twoFace_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_twoFace_rebate" value="{{ $gameData['50_twoFace_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和大小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_big_odds" value="{{ $gameData['50_G_big_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_big_rebate" value="{{ $gameData['50_G_big_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_small_odds" value="{{ $gameData['50_G_small_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_small_rebate" value="{{ $gameData['50_G_small_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和单双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_single_odds" value="{{ $gameData['50_G_single_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_single_rebate" value="{{ $gameData['50_G_single_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_double_odds" value="{{ $gameData['50_G_double_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_double_rebate" value="{{ $gameData['50_G_double_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">冠亚军和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3,4,18,19</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_num1_odds" value="{{ $gameData['50_G_num1_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_num1_rebate" value="{{ $gameData['50_G_num1_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5,6,16,17</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_num2_odds" value="{{ $gameData['50_G_num2_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_num2_rebate" value="{{ $gameData['50_G_num2_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7,8,14,15</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_num3_odds" value="{{ $gameData['50_G_num3_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_num3_rebate" value="{{ $gameData['50_G_num3_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9,10,12,13</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_num4_odds" value="{{ $gameData['50_G_num4_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_num4_rebate" value="{{ $gameData['50_G_num4_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_num5_odds" value="{{ $gameData['50_G_num5_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="50_G_num5_rebate" value="{{ $gameData['50_G_num5_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- 重庆时时彩 -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">重庆时时彩</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-5球号</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_1_5_odds" value="{{ $gameData['1_1_5_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_1_5_rebate" value="{{ $gameData['1_1_5_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_twoFace_odds" value="{{ $gameData['1_twoFace_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_twoFace_rebate" value="{{ $gameData['1_twoFace_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">龙虎和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙，虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_LHH_LH_odds" value="{{ $gameData['1_LHH_LH_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_LHH_LH_rebate" value="{{ $gameData['1_LHH_LH_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_LHH_H_odds" value="{{ $gameData['1_LHH_H_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_LHH_H_rebate" value="{{ $gameData['1_LHH_H_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">前三中三后三</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">豹子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_QZH3_baozi_odds" value="{{ $gameData['1_QZH3_baozi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_QZH3_baozi_rebate" value="{{ $gameData['1_QZH3_baozi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">顺子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_QZH3_shunzi_odds" value="{{ $gameData['1_QZH3_shunzi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_QZH3_shunzi_rebate" value="{{ $gameData['1_QZH3_shunzi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">对子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_QZH3_duizi_odds" value="{{ $gameData['1_QZH3_duizi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_QZH3_duizi_rebate" value="{{ $gameData['1_QZH3_duizi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">半顺</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_QZH3_banshun_odds" value="{{ $gameData['1_QZH3_banshun_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_QZH3_banshun_rebate" value="{{ $gameData['1_QZH3_banshun_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">杂六</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_QZH3_zaliu_odds" value="{{ $gameData['1_QZH3_zaliu_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="1_QZH3_zaliu_rebate" value="{{ $gameData['1_QZH3_zaliu_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- 新疆时时彩 -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">新疆时时彩</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-5球号</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_1_5_odds" value="{{ $gameData['4_1_5_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_1_5_rebate" value="{{ $gameData['4_1_5_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_twoFace_odds" value="{{ $gameData['4_twoFace_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_twoFace_rebate" value="{{ $gameData['4_twoFace_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">龙虎和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙，虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_LHH_LH_odds" value="{{ $gameData['4_LHH_LH_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_LHH_LH_rebate" value="{{ $gameData['4_LHH_LH_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_LHH_H_odds" value="{{ $gameData['4_LHH_H_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_LHH_H_rebate" value="{{ $gameData['4_LHH_H_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">前三中三后三</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">豹子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_QZH3_baozi_odds" value="{{ $gameData['4_QZH3_baozi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_QZH3_baozi_rebate" value="{{ $gameData['4_QZH3_baozi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">顺子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_QZH3_shunzi_odds" value="{{ $gameData['4_QZH3_shunzi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_QZH3_shunzi_rebate" value="{{ $gameData['4_QZH3_shunzi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">对子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_QZH3_duizi_odds" value="{{ $gameData['4_QZH3_duizi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_QZH3_duizi_rebate" value="{{ $gameData['4_QZH3_duizi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">半顺</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_QZH3_banshun_odds" value="{{ $gameData['4_QZH3_banshun_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_QZH3_banshun_rebate" value="{{ $gameData['4_QZH3_banshun_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">杂六</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_QZH3_zaliu_odds" value="{{ $gameData['4_QZH3_zaliu_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="4_QZH3_zaliu_rebate" value="{{ $gameData['4_QZH3_zaliu_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- 天津时时彩 -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">天津时时彩</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-5球号</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_1_5_odds" value="{{ $gameData['5_1_5_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_1_5_rebate" value="{{ $gameData['5_1_5_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_twoFace_odds" value="{{ $gameData['5_twoFace_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_twoFace_rebate" value="{{ $gameData['5_twoFace_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">龙虎和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙，虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_LHH_LH_odds" value="{{ $gameData['5_LHH_LH_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_LHH_LH_rebate" value="{{ $gameData['5_LHH_LH_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_LHH_H_odds" value="{{ $gameData['5_LHH_H_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_LHH_H_rebate" value="{{ $gameData['5_LHH_H_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">前三中三后三</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">豹子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_QZH3_baozi_odds" value="{{ $gameData['5_QZH3_baozi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_QZH3_baozi_rebate" value="{{ $gameData['5_QZH3_baozi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">顺子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_QZH3_shunzi_odds" value="{{ $gameData['5_QZH3_shunzi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_QZH3_shunzi_rebate" value="{{ $gameData['5_QZH3_shunzi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">对子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_QZH3_duizi_odds" value="{{ $gameData['5_QZH3_duizi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_QZH3_duizi_rebate" value="{{ $gameData['5_QZH3_duizi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">半顺</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_QZH3_banshun_odds" value="{{ $gameData['5_QZH3_banshun_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_QZH3_banshun_rebate" value="{{ $gameData['5_QZH3_banshun_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">杂六</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_QZH3_zaliu_odds" value="{{ $gameData['5_QZH3_zaliu_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="5_QZH3_zaliu_rebate" value="{{ $gameData['5_QZH3_zaliu_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- 广东快乐十分 -->
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
                        <input type="text" name="60_1_8_odds" value="{{ $gameData['60_1_8_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_1_8_rebate" value="{{ $gameData['60_1_8_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_twoFace_odds" value="{{ $gameData['60_twoFace_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_twoFace_rebate" value="{{ $gameData['60_twoFace_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">1-8方位</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_fangwei_1_8_odds" value="{{ $gameData['60_fangwei_1_8_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_fangwei_1_8_rebate" value="{{ $gameData['60_fangwei_1_8_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">1-8中发白</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中发</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZFB18_zhongfa_odds" value="{{ $gameData['60_ZFB18_zhongfa_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZFB18_zhongfa_rebate" value="{{ $gameData['60_ZFB18_zhongfa_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">白</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZFB18_bai_odds" value="{{ $gameData['60_ZFB18_bai_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZFB18_bai_rebate" value="{{ $gameData['60_ZFB18_bai_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">正码</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZM_odds" value="{{ $gameData['60_ZM_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZM_rebate" value="{{ $gameData['60_ZM_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和单双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总单</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZHDS_dan_odds" value="{{ $gameData['60_ZHDS_dan_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZHDS_dan_rebate" value="{{ $gameData['60_ZHDS_dan_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZHDS_shuang_odds" value="{{ $gameData['60_ZHDS_shuang_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZHDS_shuang_rebate" value="{{ $gameData['60_ZHDS_shuang_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和尾数大小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾大</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZHWSDX_da_odds" value="{{ $gameData['60_ZHWSDX_da_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZHWSDX_da_rebate" value="{{ $gameData['60_ZHWSDX_da_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZHWSDX_xiao_odds" value="{{ $gameData['60_ZHWSDX_xiao_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_ZHWSDX_xiao_rebate" value="{{ $gameData['60_ZHWSDX_xiao_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="6" align="center" class="deep-blue-td">连码</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选二</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_LM_rx2_odds" value="{{ $gameData['60_LM_rx2_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_LM_rx2_rebate" value="{{ $gameData['60_LM_rx2_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">选二连组</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_LM_x2lz_odds" value="{{ $gameData['60_LM_x2lz_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_LM_x2lz_rebate" value="{{ $gameData['60_LM_x2lz_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选三</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_LM_rx3_odds" value="{{ $gameData['60_LM_rx3_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_LM_rx3_rebate" value="{{ $gameData['60_LM_rx3_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">选三前组</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_LM_x3qz_odds" value="{{ $gameData['60_LM_x3qz_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_LM_x3qz_rebate" value="{{ $gameData['60_LM_x3qz_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选四</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_LM_rx4_odds" value="{{ $gameData['60_LM_rx4_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_LM_rx4_rebate" value="{{ $gameData['60_LM_rx4_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选五</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_LM_rx5_odds" value="{{ $gameData['60_LM_rx5_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="60_LM_rx5_rebate" value="{{ $gameData['60_LM_rx5_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- 江苏骰宝(快3) -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">江苏骰宝(快3)</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">大小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_daxiao_odds" value="{{ $gameData['10_daxiao_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_daxiao_rebate" value="{{ $gameData['10_daxiao_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">三军</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_3jun_odds" value="{{ $gameData['10_3jun_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_3jun_rebate" value="{{ $gameData['10_3jun_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">围骰</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_weitou_odds" value="{{ $gameData['10_weitou_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_weitou_rebate" value="{{ $gameData['10_weitou_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">全骰</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_quantou_odds" value="{{ $gameData['10_quantou_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_quantou_rebate" value="{{ $gameData['10_quantou_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="7" align="center" class="deep-blue-td">点数</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4，17</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_0417_odds" value="{{ $gameData['10_DS_0417_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_0417_rebate" value="{{ $gameData['10_DS_0417_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5，16</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_0516_odds" value="{{ $gameData['10_DS_0516_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_0516_rebate" value="{{ $gameData['10_DS_0516_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6，15</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_0615_odds" value="{{ $gameData['10_DS_0615_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_0615_rebate" value="{{ $gameData['10_DS_0615_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7，14</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_0714_odds" value="{{ $gameData['10_DS_0714_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_0714_rebate" value="{{ $gameData['10_DS_0714_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8，13</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_0813_odds" value="{{ $gameData['10_DS_0813_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_0813_rebate" value="{{ $gameData['10_DS_0813_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9，12</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_0912_odds" value="{{ $gameData['10_DS_0912_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_0912_rebate" value="{{ $gameData['10_DS_0912_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10，11</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_1011_odds" value="{{ $gameData['10_DS_1011_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_DS_1011_rebate" value="{{ $gameData['10_DS_1011_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">长牌</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_changpai_odds" value="{{ $gameData['10_changpai_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_changpai_rebate" value="{{ $gameData['10_changpai_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">短牌</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_duanpai_odds" value="{{ $gameData['10_duanpai_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="10_duanpai_rebate" value="{{ $gameData['10_duanpai_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- 重庆幸运农场 -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">重庆幸运农场</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-8球号</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_1_8_odds" value="{{ $gameData['61_1_8_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_1_8_rebate" value="{{ $gameData['61_1_8_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_twoFace_odds" value="{{ $gameData['61_twoFace_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_twoFace_rebate" value="{{ $gameData['61_twoFace_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">1-8方位</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_fangwei_1_8_odds" value="{{ $gameData['61_fangwei_1_8_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_fangwei_1_8_rebate" value="{{ $gameData['61_fangwei_1_8_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">1-8中发白</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中发</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZFB18_zhongfa_odds" value="{{ $gameData['61_ZFB18_zhongfa_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZFB18_zhongfa_rebate" value="{{ $gameData['61_ZFB18_zhongfa_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">白</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZFB18_bai_odds" value="{{ $gameData['61_ZFB18_bai_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZFB18_bai_rebate" value="{{ $gameData['61_ZFB18_bai_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">正码</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZM_odds" value="{{ $gameData['61_ZM_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZM_rebate" value="{{ $gameData['61_ZM_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和单双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总单</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZHDS_dan_odds" value="{{ $gameData['61_ZHDS_dan_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZHDS_dan_rebate" value="{{ $gameData['61_ZHDS_dan_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZHDS_shuang_odds" value="{{ $gameData['61_ZHDS_shuang_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZHDS_shuang_rebate" value="{{ $gameData['61_ZHDS_shuang_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和尾数大小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾大</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZHWSDX_da_odds" value="{{ $gameData['61_ZHWSDX_da_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZHWSDX_da_rebate" value="{{ $gameData['61_ZHWSDX_da_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZHWSDX_xiao_odds" value="{{ $gameData['61_ZHWSDX_xiao_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_ZHWSDX_xiao_rebate" value="{{ $gameData['61_ZHWSDX_xiao_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="6" align="center" class="deep-blue-td">连码</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选二</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_LM_rx2_odds" value="{{ $gameData['61_LM_rx2_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_LM_rx2_rebate" value="{{ $gameData['61_LM_rx2_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">选二连组</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_LM_x2lz_odds" value="{{ $gameData['61_LM_x2lz_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_LM_x2lz_rebate" value="{{ $gameData['61_LM_x2lz_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选三</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_LM_rx3_odds" value="{{ $gameData['61_LM_rx3_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_LM_rx3_rebate" value="{{ $gameData['61_LM_rx3_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">选三前组</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_LM_x3qz_odds" value="{{ $gameData['61_LM_x3qz_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_LM_x3qz_rebate" value="{{ $gameData['61_LM_x3qz_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选四</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_LM_rx4_odds" value="{{ $gameData['61_LM_rx4_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_LM_rx4_rebate" value="{{ $gameData['61_LM_rx4_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选五</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_LM_rx5_odds" value="{{ $gameData['61_LM_rx5_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="61_LM_rx5_rebate" value="{{ $gameData['61_LM_rx5_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- 北京快乐8 -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">北京快乐8</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">正码</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_ZM_odds" value="{{ $gameData['83_ZM_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_ZM_rebate" value="{{ $gameData['83_ZM_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_twoFace_odds" value="{{ $gameData['83_twoFace_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_twoFace_rebate" value="{{ $gameData['83_twoFace_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">总和和局</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_ZHHJ_odds" value="{{ $gameData['83_ZHHJ_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_ZHHJ_rebate" value="{{ $gameData['83_ZHHJ_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">总和过关</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_ZHGG_odds" value="{{ $gameData['83_ZHGG_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_ZHGG_rebate" value="{{ $gameData['83_ZHGG_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">前后和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前（多）后（多）</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_QHH_qianhou_odds" value="{{ $gameData['83_QHH_qianhou_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_QHH_qianhou_rebate" value="{{ $gameData['83_QHH_qianhou_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_QHH_he_odds" value="{{ $gameData['83_QHH_he_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_QHH_he_rebate" value="{{ $gameData['83_QHH_he_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">单双和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单（多）双（多）</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_DSH_danshuang_odds" value="{{ $gameData['83_DSH_danshuang_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_DSH_danshuang_rebate" value="{{ $gameData['83_DSH_danshuang_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_DSH_he_odds" value="{{ $gameData['83_DSH_he_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_DSH_he_rebate" value="{{ $gameData['83_DSH_he_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="3" align="center" class="deep-blue-td">五行</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">金，土</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_WX_jin_tu_odds" value="{{ $gameData['83_WX_jin_tu_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_WX_jin_tu_rebate" value="{{ $gameData['83_WX_jin_tu_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">木，火</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_WX_mu_huo_odds" value="{{ $gameData['83_WX_mu_huo_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_WX_mu_huo_rebate" value="{{ $gameData['83_WX_mu_huo_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">水</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_WX_shui_odds" value="{{ $gameData['83_WX_shui_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="83_WX_shui_rebate" value="{{ $gameData['83_WX_shui_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- 广东11选5 -->
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
                        <input type="text" name="21_1_5_odds" value="{{ $gameData['21_1_5_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_1_5_rebate" value="{{ $gameData['21_1_5_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_twoFace_odds" value="{{ $gameData['21_twoFace_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_twoFace_rebate" value="{{ $gameData['21_twoFace_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和单双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总和单</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_ZHDS_dan_odds" value="{{ $gameData['21_ZHDS_dan_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_ZHDS_dan_rebate" value="{{ $gameData['21_ZHDS_dan_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总和双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_ZHDS_shuang_odds" value="{{ $gameData['21_ZHDS_shuang_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_ZHDS_shuang_rebate" value="{{ $gameData['21_ZHDS_shuang_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和尾数大小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾大</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_ZHWSDX_da_odds" value="{{ $gameData['21_ZHWSDX_da_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_ZHWSDX_da_rebate" value="{{ $gameData['21_ZHWSDX_da_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_ZHWSDX_xiao_odds" value="{{ $gameData['21_ZHWSDX_xiao_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_ZHWSDX_xiao_rebate" value="{{ $gameData['21_ZHWSDX_xiao_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">一中一</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_YZY_odds" value="{{ $gameData['21_YZY_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_YZY_rebate" value="{{ $gameData['21_YZY_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="11" align="center" class="deep-blue-td">连码</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选二</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx2_odds" value="{{ $gameData['21_LM_rx2_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx2_rebate" value="{{ $gameData['21_LM_rx2_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选三</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx3_odds" value="{{ $gameData['21_LM_rx3_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx3_rebate" value="{{ $gameData['21_LM_rx3_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选四</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx4_odds" value="{{ $gameData['21_LM_rx4_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx4_rebate" value="{{ $gameData['21_LM_rx4_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选五</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx5_odds" value="{{ $gameData['21_LM_rx5_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx5_rebate" value="{{ $gameData['21_LM_rx5_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选六</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx6_odds" value="{{ $gameData['21_LM_rx6_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx6_rebate" value="{{ $gameData['21_LM_rx6_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选七</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx7_odds" value="{{ $gameData['21_LM_rx7_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx7_rebate" value="{{ $gameData['21_LM_rx7_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选八</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx8_odds" value="{{ $gameData['21_LM_rx8_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_rx8_rebate" value="{{ $gameData['21_LM_rx8_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前二组选</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_q2zx_odds" value="{{ $gameData['21_LM_q2zx_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_q2zx_rebate" value="{{ $gameData['21_LM_q2zx_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前三组选</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_q3zx_odds" value="{{ $gameData['21_LM_q3zx_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_q3zx_rebate" value="{{ $gameData['21_LM_q3zx_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前二直选</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_q2zhix_odds" value="{{ $gameData['21_LM_q2zhix_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_q2zhix_rebate" value="{{ $gameData['21_LM_q2zhix_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前三直选</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_q3zhix_odds" value="{{ $gameData['21_LM_q3zhix_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="21_LM_q3zhix_rebate" value="{{ $gameData['21_LM_q3zhix_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- PC蛋蛋 -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">PC蛋蛋</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="4" align="center" width="200" class="deep-blue-td">混合</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">大，小，单，双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_HH_dxds_odds" value="{{ $gameData['66_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_HH_dxds_rebate" value="{{ $gameData['66_HH_dxds_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大单，大双，小单，小双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_HH_dd_ds_xd_xs_odds" value="{{ $gameData['66_HH_dd_ds_xd_xs_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_HH_dd_ds_xd_xs_rebate" value="{{ $gameData['66_HH_dd_ds_xd_xs_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">极大，极小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_HH_jd_jx_odds" value="{{ $gameData['66_HH_jd_jx_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_HH_jd_jx_rebate" value="{{ $gameData['66_HH_jd_jx_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">豹子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_HH_baozi_odds" value="{{ $gameData['66_HH_baozi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_HH_baozi_rebate" value="{{ $gameData['66_HH_baozi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">波色</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大，小，单，双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_BS_dxds_odds" value="{{ $gameData['66_BS_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_BS_dxds_rebate" value="{{ $gameData['66_BS_dxds_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="16" align="center" class="deep-blue-td">特码</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0_odds" value="{{ $gameData['66_TM_0_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0_rebate" value="{{ $gameData['66_TM_0_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">1，26</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0126_odds" value="{{ $gameData['66_TM_0126_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0126_rebate" value="{{ $gameData['66_TM_0126_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">2，25</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0225_odds" value="{{ $gameData['66_TM_0225_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0225_rebate" value="{{ $gameData['66_TM_0225_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_03_odds" value="{{ $gameData['66_TM_03_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_03_rebate" value="{{ $gameData['66_TM_03_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4，23</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0423_odds" value="{{ $gameData['66_TM_0423_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0423_rebate" value="{{ $gameData['66_TM_0423_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5，22</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0522_odds" value="{{ $gameData['66_TM_0522_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0522_rebate" value="{{ $gameData['66_TM_0522_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6，21</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0621_odds" value="{{ $gameData['66_TM_0621_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0621_rebate" value="{{ $gameData['66_TM_0621_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7，20</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0720_odds" value="{{ $gameData['66_TM_0720_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0720_rebate" value="{{ $gameData['66_TM_0720_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8，19</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0819_odds" value="{{ $gameData['66_TM_0819_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0819_rebate" value="{{ $gameData['66_TM_0819_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9，18</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0918_odds" value="{{ $gameData['66_TM_0918_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_0918_rebate" value="{{ $gameData['66_TM_0918_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10，17</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_1017_odds" value="{{ $gameData['66_TM_1017_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_1017_rebate" value="{{ $gameData['66_TM_1017_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11，16</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_1116_odds" value="{{ $gameData['66_TM_1116_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_1116_rebate" value="{{ $gameData['66_TM_1116_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">12，15</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_1215_odds" value="{{ $gameData['66_TM_1215_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_1215_rebate" value="{{ $gameData['66_TM_1215_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">13，14</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_1314_odds" value="{{ $gameData['66_TM_1314_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_1314_rebate" value="{{ $gameData['66_TM_1314_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">24</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_24_odds" value="{{ $gameData['66_TM_24_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_24_rebate" value="{{ $gameData['66_TM_24_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">27</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_27_odds" value="{{ $gameData['66_TM_27_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="66_TM_27_rebate" value="{{ $gameData['66_TM_27_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="ui tab segment" data-tab="second" style="margin-bottom: 70px;">
        <!-- 秒速赛车 -->
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
                        <input type="text" name="80_110_odds" value="{{ $gameData['80_110_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_110_rebate" value="{{ $gameData['80_110_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_twoFace_odds" value="{{ $gameData['80_twoFace_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_twoFace_rebate" value="{{ $gameData['80_twoFace_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和大小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_big_odds" value="{{ $gameData['80_G_big_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_big_rebate" value="{{ $gameData['80_G_big_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_small_odds" value="{{ $gameData['80_G_small_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_small_rebate" value="{{ $gameData['80_G_small_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和单双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_single_odds" value="{{ $gameData['80_G_single_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_single_rebate" value="{{ $gameData['80_G_single_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_double_odds" value="{{ $gameData['80_G_double_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_double_rebate" value="{{ $gameData['80_G_double_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">冠亚军和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3,4,18,19</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_num1_odds" value="{{ $gameData['80_G_num1_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_num1_rebate" value="{{ $gameData['80_G_num1_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5,6,16,17</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_num2_odds" value="{{ $gameData['80_G_num2_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_num2_rebate" value="{{ $gameData['80_G_num2_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7,8,14,15</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_num3_odds" value="{{ $gameData['80_G_num3_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_num3_rebate" value="{{ $gameData['80_G_num3_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9,10,12,13</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_num4_odds" value="{{ $gameData['80_G_num4_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_num4_rebate" value="{{ $gameData['80_G_num4_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_num5_odds" value="{{ $gameData['80_G_num5_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="80_G_num5_rebate" value="{{ $gameData['80_G_num5_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- 秒速飞艇 -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">秒速飞艇</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-10号车</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_110_odds" value="{{ $gameData['82_110_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_110_rebate" value="{{ $gameData['82_110_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_twoFace_odds" value="{{ $gameData['82_twoFace_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_twoFace_rebate" value="{{ $gameData['82_twoFace_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和大小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_big_odds" value="{{ $gameData['82_G_big_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_big_rebate" value="{{ $gameData['82_G_big_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_small_odds" value="{{ $gameData['82_G_small_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_small_rebate" value="{{ $gameData['82_G_small_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和单双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_single_odds" value="{{ $gameData['82_G_single_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_single_rebate" value="{{ $gameData['82_G_single_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_double_odds" value="{{ $gameData['82_G_double_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_double_rebate" value="{{ $gameData['82_G_double_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">冠亚军和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3,4,18,19</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_num1_odds" value="{{ $gameData['82_G_num1_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_num1_rebate" value="{{ $gameData['82_G_num1_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5,6,16,17</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_num2_odds" value="{{ $gameData['82_G_num2_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_num2_rebate" value="{{ $gameData['82_G_num2_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7,8,14,15</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_num3_odds" value="{{ $gameData['82_G_num3_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_num3_rebate" value="{{ $gameData['82_G_num3_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9,10,12,13</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_num4_odds" value="{{ $gameData['82_G_num4_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_num4_rebate" value="{{ $gameData['82_G_num4_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_num5_odds" value="{{ $gameData['82_G_num5_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="82_G_num5_rebate" value="{{ $gameData['82_G_num5_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- 秒速时时彩 -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">秒速时时彩</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-5球号</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_1_5_odds" value="{{ $gameData['81_1_5_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_1_5_rebate" value="{{ $gameData['81_1_5_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_twoFace_odds" value="{{ $gameData['81_twoFace_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_twoFace_rebate" value="{{ $gameData['81_twoFace_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">龙虎和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙，虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_LHH_LH_odds" value="{{ $gameData['81_LHH_LH_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_LHH_LH_rebate" value="{{ $gameData['81_LHH_LH_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_LHH_H_odds" value="{{ $gameData['81_LHH_H_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_LHH_H_rebate" value="{{ $gameData['81_LHH_H_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">前三中三后三</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">豹子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_QZH3_baozi_odds" value="{{ $gameData['81_QZH3_baozi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_QZH3_baozi_rebate" value="{{ $gameData['81_QZH3_baozi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">顺子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_QZH3_shunzi_odds" value="{{ $gameData['81_QZH3_shunzi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_QZH3_shunzi_rebate" value="{{ $gameData['81_QZH3_shunzi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">对子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_QZH3_duizi_odds" value="{{ $gameData['81_QZH3_duizi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_QZH3_duizi_rebate" value="{{ $gameData['81_QZH3_duizi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">半顺</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_QZH3_banshun_odds" value="{{ $gameData['81_QZH3_banshun_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_QZH3_banshun_rebate" value="{{ $gameData['81_QZH3_banshun_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">杂六</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_QZH3_zaliu_odds" value="{{ $gameData['81_QZH3_zaliu_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="81_QZH3_zaliu_rebate" value="{{ $gameData['81_QZH3_zaliu_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="ui tab segment" data-tab="three" style="margin-bottom: 70px;">
        <!-- 幸运飞艇 -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">幸运飞艇</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-10号车</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_110_odds" value="{{ $gameData['55_110_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_110_rebate" value="{{ $gameData['55_110_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_twoFace_odds" value="{{ $gameData['55_twoFace_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_twoFace_rebate" value="{{ $gameData['55_twoFace_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和大小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_big_odds" value="{{ $gameData['55_G_big_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_big_rebate" value="{{ $gameData['55_G_big_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_small_odds" value="{{ $gameData['55_G_small_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_small_rebate" value="{{ $gameData['55_G_small_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和单双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_single_odds" value="{{ $gameData['55_G_single_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_single_rebate" value="{{ $gameData['55_G_single_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_double_odds" value="{{ $gameData['55_G_double_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_double_rebate" value="{{ $gameData['55_G_double_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">冠亚军和</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3,4,18,19</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_num1_odds" value="{{ $gameData['55_G_num1_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_num1_rebate" value="{{ $gameData['55_G_num1_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5,6,16,17</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_num2_odds" value="{{ $gameData['55_G_num2_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_num2_rebate" value="{{ $gameData['55_G_num2_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7,8,14,15</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_num3_odds" value="{{ $gameData['55_G_num3_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_num3_rebate" value="{{ $gameData['55_G_num3_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9,10,12,13</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_num4_odds" value="{{ $gameData['55_G_num4_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_num4_rebate" value="{{ $gameData['55_G_num4_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_num5_odds" value="{{ $gameData['55_G_num5_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="55_G_num5_rebate" value="{{ $gameData['55_G_num5_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- 幸运蛋蛋 -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">幸运蛋蛋</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="4" align="center" width="200" class="deep-blue-td">混合</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">大，小，单，双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_HH_dxds_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_HH_dxds_rebate" value="{{ $gameData['84_HH_dxds_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大单，大双，小单，小双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_HH_dd_ds_xd_xs_odds" value="{{ $gameData['84_HH_dd_ds_xd_xs_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_HH_dd_ds_xd_xs_rebate" value="{{ $gameData['84_HH_dd_ds_xd_xs_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">极大，极小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_HH_jd_jx_odds" value="{{ $gameData['84_HH_jd_jx_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_HH_jd_jx_rebate" value="{{ $gameData['84_HH_jd_jx_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">豹子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_HH_baozi_odds" value="{{ $gameData['84_HH_baozi_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_HH_baozi_rebate" value="{{ $gameData['84_HH_baozi_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">波色</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大，小，单，双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_BS_dxds_odds" value="{{ $gameData['84_BS_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_BS_dxds_rebate" value="{{ $gameData['84_BS_dxds_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="16" align="center" class="deep-blue-td">特码</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0_odds" value="{{ $gameData['84_TM_0_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0_rebate" value="{{ $gameData['84_TM_0_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">1，26</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0126_odds" value="{{ $gameData['84_TM_0126_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0126_rebate" value="{{ $gameData['84_TM_0126_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">2，25</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0225_odds" value="{{ $gameData['84_TM_0225_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0225_rebate" value="{{ $gameData['84_TM_0225_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_03_odds" value="{{ $gameData['84_TM_03_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_03_rebate" value="{{ $gameData['84_TM_03_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4，23</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0423_odds" value="{{ $gameData['84_TM_0423_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0423_rebate" value="{{ $gameData['84_TM_0423_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5，22</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0522_odds" value="{{ $gameData['84_TM_0522_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0522_rebate" value="{{ $gameData['84_TM_0522_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6，21</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0621_odds" value="{{ $gameData['84_TM_0621_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0621_rebate" value="{{ $gameData['84_TM_0621_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7，20</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0720_odds" value="{{ $gameData['84_TM_0720_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0720_rebate" value="{{ $gameData['84_TM_0720_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8，19</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0819_odds" value="{{ $gameData['84_TM_0819_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0819_rebate" value="{{ $gameData['84_TM_0819_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9，18</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0918_odds" value="{{ $gameData['84_TM_0918_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_0918_rebate" value="{{ $gameData['84_TM_0918_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10，17</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_1017_odds" value="{{ $gameData['84_TM_1017_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_1017_rebate" value="{{ $gameData['84_TM_1017_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11，16</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_1116_odds" value="{{ $gameData['84_TM_1116_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_1116_rebate" value="{{ $gameData['84_TM_1116_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">12，15</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_1215_odds" value="{{ $gameData['84_TM_1215_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_1215_rebate" value="{{ $gameData['84_TM_1215_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">13，14</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_1314_odds" value="{{ $gameData['84_TM_1314_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_1314_rebate" value="{{ $gameData['84_TM_1314_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">24</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_24_odds" value="{{ $gameData['84_TM_24_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_24_rebate" value="{{ $gameData['84_TM_24_rebate'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">27</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_27_odds" value="{{ $gameData['84_TM_27_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="84_TM_27_rebate" value="{{ $gameData['84_TM_27_rebate'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- 幸运六合彩 -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">幸运六合彩</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" width="200" class="deep-blue-td">特码</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">特码A</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM_temaA_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM_temaA_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">特码B</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM_temaB_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM_temaB_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_twoFace_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_twoFace_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">正码两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZM_twoFace_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZM_twoFace_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">特码色波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZMSB_hong_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZMSB_hong_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蓝波，绿波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZMSB_lan_lv_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZMSB_lan_lv_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="4" align="center" class="deep-blue-td">特码半波大小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红大，蓝小，绿小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDX_hd_lx_lv_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDX_hd_lx_lv_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDX_hx_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDX_hx_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蓝大</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDX_landa_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDX_landa_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">绿大</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDX_lvda_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDX_lvda_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="3" align="center" class="deep-blue-td">特码半波单双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红单，蓝单，蓝双，绿单</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDS_hd_ld_ls_lvd_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDS_hd_ld_ls_lvd_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDS_hs_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDS_hs_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">绿双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDS_lvs_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBDS_lvs_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="3" align="center" class="deep-blue-td">特码半半波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红大单，蓝小单，绿小双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBB_hdd_lxd_lxs_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBB_hdd_lxd_lxs_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红小单，红小双，蓝大单</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBB_hxd_hxs_ldd_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBB_hxd_hxs_ldd_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红大双，蓝小双，蓝大双，绿大单，绿小单，绿大双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBB_hds_lxs_lds_ldd_lxd_lds_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMBBB_hds_lxs_lds_ldd_lxd_lds_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">特码十二生肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_shu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_shu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_niu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_niu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_hu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_hu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">兔</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_tu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_tu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_long_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_long_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_she_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_she_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_ma_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_ma_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_yang_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_yang_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_hou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_hou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_ji_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_ji_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_gou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_gou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_zhu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TM12X_zhu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="10" align="center" class="deep-blue-td">特码合肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">2肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_2x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_2x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_3x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_3x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_4x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_4x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_5x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_5x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_6x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_6x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_7x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_7x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_8x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_8x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_9x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_9x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_10x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_10x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_11x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMHX_11x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">特码头数</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0头</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMTS_0t_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMTS_0t_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMTS_other_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMTS_other_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">特码尾数</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMWS_0w_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMWS_0w_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMWS_other_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMWS_other_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">五行</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">金</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WX_jin_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WX_jin_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">木</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WX_mu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WX_mu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">水</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WX_shui_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WX_shui_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">火</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WX_huo_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WX_huo_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">土</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WX_tu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WX_tu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">正码</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZM_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZM_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">特码大小单双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMDXDS_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TMDXDS_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">正码特</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZMT_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZMT_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">正码1-6色波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZM16SB_hong_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZM16SB_hong_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蓝波，绿波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZM16SB_lanlv_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZM16SB_lanlv_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">一肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_shu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_shu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_niu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_niu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_hu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_hu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">土</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_tu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_tu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_long_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_long_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_she_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_she_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_ma_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_ma_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_yang_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_yang_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_hou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_hou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_ji_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_ji_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_gou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_gou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_zhu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_YX_zhu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">尾数</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WS_0w_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WS_0w_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WS_other_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_WS_other_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="3" align="center" class="deep-blue-td">7色波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_7SB_hong_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_7SB_hong_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蓝波，绿波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_7SB_lanlv_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_7SB_lanlv_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和局</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_7SB_he_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_7SB_he_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="6" align="center" class="deep-blue-td">总肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">2肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_2x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_2x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_3x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_3x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_4x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_4x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_5x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_5x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_6x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_6x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_7x_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_7x_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总肖单双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXDS_dan_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXDS_dan_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXDS_shuang_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXDS_shuang_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">三中二</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中二</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3Z2_zhong2_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3Z2_zhong2_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中三</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3Z2_zhong3_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3Z2_zhong3_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">三全中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3QZ_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3QZ_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">四全中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4QZ_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4QZ_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">二全中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2QZ_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2QZ_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">二中特</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中特</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2ZT_zhongte_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2ZT_zhongte_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中二</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2ZT_zhong2_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2ZT_zhong2_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">特串</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中特</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TC_zhongte_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_TC_zhongte_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">正肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_shu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_shu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_niu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_niu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_hu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_hu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">兔</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_tu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_tu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_long_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_long_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_she_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_she_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_ma_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_ma_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_yang_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_yang_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_hou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_hou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_ji_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_ji_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_gou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_gou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_zhu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZX_zhu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">二连肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_shu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_shu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_niu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_niu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_hu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_hu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">兔</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_tu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_tu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_long_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_long_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_she_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_she_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_ma_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_ma_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_yang_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_yang_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_hou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_hou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_ji_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_ji_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_gou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_gou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_zhu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LX_zhu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">三连肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_shu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_shu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_niu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_niu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_hu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_hu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">兔</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_tu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_tu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_long_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_long_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_she_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_she_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_ma_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_ma_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_yang_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_yang_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_hou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_hou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_ji_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_ji_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_gou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_gou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_zhu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LX_zhu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">四连肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_shu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_shu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_niu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_niu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_hu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_hu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">兔</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_tu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_tu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_long_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_long_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_she_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_she_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_ma_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_ma_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_yang_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_yang_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_hou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_hou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_ji_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_ji_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_gou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_gou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_zhu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LX_zhu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">五连肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_shu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_shu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_niu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_niu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_hu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_hu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">兔</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_tu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_tu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_long_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_long_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_she_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_she_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_ma_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_ma_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_yang_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_yang_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_hou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_hou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_ji_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_ji_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_gou_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_gou_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_zhu_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LX_zhu_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">二连尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LW_0w_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LW_0w_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LW_other_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_2LW_other_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">三连尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LW_0w_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LW_0w_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LW_other_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_3LW_other_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">四连尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LW_0w_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LW_0w_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LW_other_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_4LW_other_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">五连尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LW_0w_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LW_0w_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LW_other_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_5LW_other_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="8" align="center" class="deep-blue-td">自选不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_5_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_5_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_6_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_6_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_7_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_7_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_8_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_8_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_9_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_9_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_10_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_10_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_11_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_11_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">12不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_12_odds" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="85_ZXBZ_12_rebate" value="{{ $gameData['84_HH_dxds_odds'] }}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="ui tab segment" data-tab="four" style="margin-bottom: 70px;">
        <!-- 福彩3D -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">福彩3D</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">主势盘</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_main_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_main_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">一字组合</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0~9</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_1Group_0_9_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_1Group_0_9_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">二字组合</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">对子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2Group_duizi_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2Group_duizi_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2Group_other_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2Group_other_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="3" align="center" class="deep-blue-td">三字组合</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">对子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3Group_duizi_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3Group_duizi_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">豹子</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3Group_baozi_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3Group_baozi_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3Group_other_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3Group_other_odds" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">一字定位</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_1DW_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_1DW_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="3" align="center" class="deep-blue-td">二字定位</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">佰拾定位</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2DW_baishi_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2DW_baishi_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">佰个定位</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2DW_baige_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2DW_baige_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">拾个定位</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2DW_shige_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2DW_shige_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">三字定位</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3DW_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3DW_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="7" align="center" width="200" class="deep-blue-td">二字和数</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：0~4，14~18</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_00041418_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_00041418_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：5，13</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_0513_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_0513_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：6，12</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_0612_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_0612_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：7，11</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_0711_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_0711_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：8，10</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_0810_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_0810_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：9</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_09_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_09_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">尾数</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_ws_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_2HS_ws_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="9" align="center" width="200" class="deep-blue-td">三字和数</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：0~6，21~27</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_00062127_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_00062127_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：7，20</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_0720_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_0720_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：8，19</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_0819_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_0819_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：9，18</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_0918_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_0918_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：10，17</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_1017_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_1017_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：11，16</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_1116_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_1116_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：12，15</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_1215_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_1215_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">和数：13，14</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_1314_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_1314_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">尾数</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_ws_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_3HS_ws_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="6" align="center" class="deep-blue-td">组选三</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX3_5_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX3_5_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX3_6_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX3_6_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX3_7_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX3_7_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX3_8_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX3_8_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX3_9_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX3_9_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX3_10_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX3_10_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">组选六</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX6_4_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX6_4_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX6_5_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX6_5_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX6_6_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX6_6_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX6_7_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX6_7_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX6_8_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_ZX6_8_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="10" align="center" class="deep-blue-td">跨度</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_0_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_0_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">1</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_1_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_1_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">2</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_2_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_2_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_3_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_3_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_4_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_4_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_5_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_5_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_6_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_6_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_7_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_7_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_8_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_8_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_9_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="30_KDU_9_rebate" value="">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="ui tab segment" data-tab="five" style="margin-bottom: 70px;">
        <!-- 六合彩 -->
        <table align="center" class="ui celled small table">
            <tbody>
            <tr class="firstRow">
                <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">六合彩</td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" width="200" class="deep-blue-td">特码</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td">特码A</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM_temaA_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM_temaA_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">特码B</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM_temaB_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM_temaB_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_twoFace_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_twoFace_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">正码两面</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZM_twoFace_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZM_twoFace_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">特码色波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZMSB_hong_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZMSB_hong_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蓝波，绿波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZMSB_lan_lv_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZMSB_lan_lv_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="4" align="center" class="deep-blue-td">特码半波大小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红大，蓝小，绿小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDX_hd_lx_lv_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDX_hd_lx_lv_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红小</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDX_hx_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDX_hx_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蓝大</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDX_landa_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDX_landa_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">绿大</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDX_lvda_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDX_lvda_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="3" align="center" class="deep-blue-td">特码半波单双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红单，蓝单，蓝双，绿单</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDS_hd_ld_ls_lvd_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDS_hd_ld_ls_lvd_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDS_hs_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDS_hs_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">绿双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDS_lvs_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBDS_lvs_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="3" align="center" class="deep-blue-td">特码半半波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红大单，蓝小单，绿小双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBB_hdd_lxd_lxs_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBB_hdd_lxd_lxs_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红小单，红小双，蓝大单</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBB_hxd_hxs_ldd_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBB_hxd_hxs_ldd_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红大双，蓝小双，蓝大双，绿大单，绿小单，绿大双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBB_hds_lxs_lds_ldd_lxd_lds_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMBBB_hds_lxs_lds_ldd_lxd_lds_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">特码十二生肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_shu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_shu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_niu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_niu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_hu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_hu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">兔</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_tu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_tu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_long_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_long_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_she_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_she_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_ma_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_ma_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_yang_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_yang_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_hou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_hou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_ji_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_ji_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_gou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_gou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_zhu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TM12X_zhu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="10" align="center" class="deep-blue-td">特码合肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">2肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_2x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_2x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_3x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_3x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_4x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_4x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_5x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_5x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_6x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_6x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_7x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_7x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_8x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_8x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_9x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_9x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_10x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_10x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_11x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMHX_11x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">特码头数</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0头</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMTS_0t_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMTS_0t_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMTS_other_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMTS_other_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">特码尾数</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMWS_0w_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMWS_0w_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMWS_other_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMWS_other_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">五行</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">金</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WX_jin_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WX_jin_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">木</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WX_mu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WX_mu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">水</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WX_shui_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WX_shui_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">火</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WX_huo_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WX_huo_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">土</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WX_tu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WX_tu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">正码</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZM_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZM_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">特码大小单双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMDXDS_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TMDXDS_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">正码特</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZMT_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZMT_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">正码1-6色波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZM16SB_hong_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZM16SB_hong_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蓝波，绿波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZM16SB_lanlv_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZM16SB_lanlv_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">一肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_shu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_shu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_niu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_niu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_hu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_hu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">土</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_tu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_tu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_long_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_long_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_she_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_she_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_ma_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_ma_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_yang_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_yang_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_hou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_hou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_ji_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_ji_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_gou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_gou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_zhu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_YX_zhu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">尾数</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WS_0w_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WS_0w_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WS_other_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_WS_other_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="3" align="center" class="deep-blue-td">7色波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">红波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_7SB_hong_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_7SB_hong_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蓝波，绿波</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_7SB_lanlv_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_7SB_lanlv_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和局</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_7SB_he_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_7SB_he_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="6" align="center" class="deep-blue-td">总肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">2肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_2x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_2x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_3x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_3x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_4x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_4x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_5x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_5x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_6x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_6x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_7x_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_7x_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总肖单双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXDS_dan_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXDS_dan_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">双</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXDS_shuang_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXDS_shuang_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">三中二</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中二</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3Z2_zhong2_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3Z2_zhong2_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中三</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3Z2_zhong3_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3Z2_zhong3_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">三全中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3QZ_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3QZ_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">四全中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4QZ_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4QZ_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">二全中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2QZ_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2QZ_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">二中特</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中特</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2ZT_zhongte_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2ZT_zhongte_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中二</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2ZT_zhong2_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2ZT_zhong2_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">特串</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中特</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TC_zhongte_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_TC_zhongte_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">正肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_shu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_shu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_niu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_niu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_hu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_hu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">兔</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_tu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_tu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_long_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_long_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_she_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_she_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_ma_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_ma_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_yang_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_yang_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_hou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_hou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_ji_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_ji_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_gou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_gou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_zhu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZX_zhu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">二连肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_shu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_shu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_niu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_niu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_hu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_hu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">兔</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_tu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_tu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_long_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_long_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_she_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_she_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_ma_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_ma_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_yang_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_yang_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_hou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_hou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_ji_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_ji_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_gou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_gou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_zhu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LX_zhu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">三连肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_shu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_shu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_niu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_niu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_hu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_hu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">兔</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_tu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_tu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_long_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_long_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_she_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_she_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_ma_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_ma_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_yang_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_yang_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_hou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_hou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_ji_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_ji_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_gou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_gou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_zhu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LX_zhu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">四连肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_shu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_shu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_niu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_niu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_hu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_hu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">兔</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_tu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_tu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_long_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_long_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_she_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_she_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_ma_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_ma_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_yang_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_yang_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_hou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_hou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_ji_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_ji_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_gou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_gou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_zhu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LX_zhu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="12" align="center" class="deep-blue-td">五连肖</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鼠</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_shu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_shu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">牛</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_niu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_niu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">虎</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_hu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_hu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">兔</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_tu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_tu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_long_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_long_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">蛇</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_she_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_she_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">马</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_ma_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_ma_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">羊</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_yang_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_yang_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猴</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_hou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_hou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">鸡</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_ji_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_ji_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">狗</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_gou_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_gou_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">猪</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_zhu_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LX_zhu_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">二连尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LW_0w_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LW_0w_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LW_other_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_2LW_other_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">三连尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LW_0w_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LW_0w_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LW_other_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_3LW_other_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">四连尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LW_0w_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LW_0w_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LW_other_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_4LW_other_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">五连尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">0尾</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LW_0w_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LW_0w_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">其他</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LW_other_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_5LW_other_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="8" align="center" class="deep-blue-td">自选不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_5_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_5_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_6_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_6_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_7_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_7_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_8_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_8_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_9_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_9_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_10_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_10_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_11_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_11_rebate" value="">
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">12不中</td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_12_odds" value="">
                    </div>
                </td>
                <td valign="middle" colspan="1" rowspan="1" align="center">
                    <div class="ui input">
                        <input type="text" name="70_ZXBZ_12_rebate" value="">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="foot-submit">
        <button class="ui primary button">保 存</button>
    </div>
    {{ csrf_field() }}
</form>
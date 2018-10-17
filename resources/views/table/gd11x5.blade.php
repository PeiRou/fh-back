<div>
    <table width="100%" class="info-table">
        <thead>
        <tr>
            <th colspan="2">玩法</th>
            <th>赔率</th>
            <th>退水</th>
            <th>单注最低</th>
            <th>单注最高</th>
            <th>单期最高</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="2">1-5球号</td>
            <td>{{ $odds['1_5_odds']['key'] }}</td>
            <td>{{ $rebate['1_5_rebate']['key'] }}%</td>
            <td>{{ $odds['1_5_odds']['minMoney'] }}</td>
            <td>{{ $odds['1_5_odds']['maxMoney'] }}</td>
            <td>{{ $odds['1_5_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td colspan="2">两面</td>
            <td>{{ $odds['2face_odds']['key'] }}</td>
            <td>{{ $rebate['2face_rebate']['key'] }}%</td>
            <td>{{ $odds['2face_odds']['minMoney'] }}</td>
            <td>{{ $odds['2face_odds']['maxMoney'] }}</td>
            <td>{{ $odds['2face_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="2">总和单双</td>
            <td>总和单</td>
            <td>{{ $odds['ZHDS_dan_odds']['key'] }}</td>
            <td>{{ $rebate['ZHDS_dan_rebate']['key'] }}%</td>
            <td>{{ $odds['ZHDS_dan_odds']['minMoney'] }}</td>
            <td>{{ $odds['ZHDS_dan_odds']['maxMoney'] }}</td>
            <td>{{ $odds['ZHDS_dan_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>总和双</td>
            <td>{{ $odds['ZHDS_shuang_odds']['key'] }}</td>
            <td>{{ $rebate['ZHDS_shuang_rebate']['key'] }}%</td>
            <td>{{ $odds['ZHDS_shuang_odds']['minMoney'] }}</td>
            <td>{{ $odds['ZHDS_shuang_odds']['maxMoney'] }}</td>
            <td>{{ $odds['ZHDS_shuang_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="2">总和尾数大小</td>
            <td>总尾大</td>
            <td>{{ $odds['ZHWS_da_odds']['key'] }}</td>
            <td>{{ $rebate['ZHWS_da_rebate']['key'] }}%</td>
            <td>{{ $odds['ZHWS_da_odds']['minMoney'] }}</td>
            <td>{{ $odds['ZHWS_da_odds']['maxMoney'] }}</td>
            <td>{{ $odds['ZHWS_da_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>总尾小</td>
            <td>{{ $odds['ZHWS_xiao_odds']['key'] }}</td>
            <td>{{ $rebate['ZHWS_xiao_rebate']['key'] }}%</td>
            <td>{{ $odds['ZHWS_xiao_odds']['minMoney'] }}</td>
            <td>{{ $odds['ZHWS_xiao_odds']['maxMoney'] }}</td>
            <td>{{ $odds['ZHWS_xiao_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td colspan="2">一中一</td>
            <td>{{ $odds['YZY_odds']['key'] }}</td>
            <td>{{ $rebate['YZY_rebate']['key'] }}%</td>
            <td>{{ $odds['YZY_odds']['minMoney'] }}</td>
            <td>{{ $odds['YZY_odds']['maxMoney'] }}</td>
            <td>{{ $odds['YZY_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="11">连码</td>
            <td>任选二</td>
            <td>{{ $odds['rx2_odds']['key'] }}</td>
            <td>{{ $rebate['rx2_rebate']['key'] }}%</td>
            <td>{{ $odds['rx2_odds']['minMoney'] }}</td>
            <td>{{ $odds['rx2_odds']['maxMoney'] }}</td>
            <td>{{ $odds['rx2_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>任选三</td>
            <td>{{ $odds['rx3_odds']['key'] }}</td>
            <td>{{ $rebate['rx3_rebate']['key'] }}%</td>
            <td>{{ $odds['rx3_odds']['minMoney'] }}</td>
            <td>{{ $odds['rx3_odds']['maxMoney'] }}</td>
            <td>{{ $odds['rx3_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>任选四</td>
            <td>{{ $odds['rx4_odds']['key'] }}</td>
            <td>{{ $rebate['rx4_rebate']['key'] }}%</td>
            <td>{{ $odds['rx4_odds']['minMoney'] }}</td>
            <td>{{ $odds['rx4_odds']['maxMoney'] }}</td>
            <td>{{ $odds['rx4_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>任选五</td>
            <td>{{ $odds['rx5_odds']['key'] }}</td>
            <td>{{ $rebate['rx5_rebate']['key'] }}%</td>
            <td>{{ $odds['rx5_odds']['minMoney'] }}</td>
            <td>{{ $odds['rx5_odds']['maxMoney'] }}</td>
            <td>{{ $odds['rx5_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>任选六</td>
            <td>{{ $odds['rx6_odds']['key'] }}</td>
            <td>{{ $rebate['rx6_rebate']['key'] }}%</td>
            <td>{{ $odds['rx6_odds']['minMoney'] }}</td>
            <td>{{ $odds['rx6_odds']['maxMoney'] }}</td>
            <td>{{ $odds['rx6_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>任选七</td>
            <td>{{ $odds['rx7_odds']['key'] }}</td>
            <td>{{ $rebate['rx7_rebate']['key'] }}%</td>
            <td>{{ $odds['rx7_odds']['minMoney'] }}</td>
            <td>{{ $odds['rx7_odds']['maxMoney'] }}</td>
            <td>{{ $odds['rx7_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>任选八</td>
            <td>{{ $odds['rx8_odds']['key'] }}</td>
            <td>{{ $rebate['rx8_rebate']['key'] }}%</td>
            <td>{{ $odds['rx8_odds']['minMoney'] }}</td>
            <td>{{ $odds['rx8_odds']['maxMoney'] }}</td>
            <td>{{ $odds['rx8_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>前二组选</td>
            <td>{{ $odds['q2zx_odds']['key'] }}</td>
            <td>{{ $rebate['q2zx_rebate']['key'] }}%</td>
            <td>{{ $odds['q2zx_odds']['minMoney'] }}</td>
            <td>{{ $odds['q2zx_odds']['maxMoney'] }}</td>
            <td>{{ $odds['q2zx_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>前三组选</td>
            <td>{{ $odds['q3zx_odds']['key'] }}</td>
            <td>{{ $rebate['q3zx_rebate']['key'] }}%</td>
            <td>{{ $odds['q3zx_odds']['minMoney'] }}</td>
            <td>{{ $odds['q3zx_odds']['maxMoney'] }}</td>
            <td>{{ $odds['q3zx_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>前二直选</td>
            <td>{{ $odds['q2zhix_odds']['key'] }}</td>
            <td>{{ $rebate['q2zhix_rebate']['key'] }}%</td>
            <td>{{ $odds['q2zhix_odds']['minMoney'] }}</td>
            <td>{{ $odds['q2zhix_odds']['maxMoney'] }}</td>
            <td>{{ $odds['q2zhix_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>前三直选</td>
            <td>{{ $odds['q3zhix_odds']['key'] }}</td>
            <td>{{ $rebate['q3zhix_rebate']['key'] }}%</td>
            <td>{{ $odds['q3zhix_odds']['minMoney'] }}</td>
            <td>{{ $odds['q3zhix_odds']['maxMoney'] }}</td>
            <td>{{ $odds['q3zhix_odds']['maxTurnMoney'] }}</td>
        </tr>
        </tbody>
    </table>
</div>

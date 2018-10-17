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
            <td colspan="2">1-10车号</td>
            <td>{{ $odds['1_10_odds']['key'] }}</td>
            <td>{{ $rebate['1_10_rebate']['key'] }}%</td>
            <td>{{ $odds['1_10_odds']['minMoney'] }}</td>
            <td>{{ $odds['1_10_odds']['maxMoney'] }}</td>
            <td>{{ $odds['1_10_odds']['maxTurnMoney'] }}</td>
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
            <td rowspan="2">冠亚军和大小</td>
            <td>大</td>
            <td>{{ $odds['GYD_odds']['key'] }}</td>
            <td>{{ $rebate['GYD_rebate']['key'] }}%</td>
            <td>{{ $odds['GYD_odds']['minMoney'] }}</td>
            <td>{{ $odds['GYD_odds']['maxMoney'] }}</td>
            <td>{{ $odds['GYD_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>小</td>
            <td>{{ $odds['GYX_odds']['key'] }}</td>
            <td>{{ $rebate['GYX_rebate']['key'] }}%</td>
            <td>{{ $odds['GYX_odds']['minMoney'] }}</td>
            <td>{{ $odds['GYX_odds']['maxMoney'] }}</td>
            <td>{{ $odds['GYX_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="2">冠亚军和单双</td>
            <td>单</td>
            <td>{{ $odds['GYDan_odds']['key'] }}</td>
            <td>{{ $rebate['GYDan_rebate']['key'] }}%</td>
            <td>{{ $odds['GYDan_odds']['minMoney'] }}</td>
            <td>{{ $odds['GYDan_odds']['maxMoney'] }}</td>
            <td>{{ $odds['GYDan_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>双</td>
            <td>{{ $odds['GYS_odds']['key'] }}</td>
            <td>{{ $rebate['GYS_rebate']['key'] }}%</td>
            <td>{{ $odds['GYS_odds']['minMoney'] }}</td>
            <td>{{ $odds['GYS_odds']['maxMoney'] }}</td>
            <td>{{ $odds['GYS_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="5">冠亚军和</td>
            <td>3,4,18,19</td>
            <td>{{ $odds['341819_odds']['key'] }}</td>
            <td>{{ $rebate['341819_rebate']['key'] }}%</td>
            <td>{{ $odds['341819_odds']['minMoney'] }}</td>
            <td>{{ $odds['341819_odds']['maxMoney'] }}</td>
            <td>{{ $odds['341819_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>5,6,16,17</td>
            <td>{{ $odds['561617_odds']['key'] }}</td>
            <td>{{ $rebate['561617_rebate']['key'] }}%</td>
            <td>{{ $odds['561617_odds']['minMoney'] }}</td>
            <td>{{ $odds['561617_odds']['maxMoney'] }}</td>
            <td>{{ $odds['561617_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>7,8,14,15</td>
            <td>{{ $odds['781415_odds']['key'] }}</td>
            <td>{{ $rebate['781415_rebate']['key'] }}%</td>
            <td>{{ $odds['781415_odds']['minMoney'] }}</td>
            <td>{{ $odds['781415_odds']['maxMoney'] }}</td>
            <td>{{ $odds['781415_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>9,10,12,13</td>
            <td>{{ $odds['9101213_odds']['key'] }}</td>
            <td>{{ $rebate['9101213_rebate']['key'] }}%</td>
            <td>{{ $odds['9101213_odds']['minMoney'] }}</td>
            <td>{{ $odds['9101213_odds']['maxMoney'] }}</td>
            <td>{{ $odds['9101213_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>11</td>
            <td>{{ $odds['11_odds']['key'] }}</td>
            <td>{{ $rebate['11_rebate']['key'] }}%</td>
            <td>{{ $odds['11_odds']['minMoney'] }}</td>
            <td>{{ $odds['11_odds']['maxMoney'] }}</td>
            <td>{{ $odds['11_odds']['maxTurnMoney'] }}</td>
        </tr>
        </tbody>
    </table>
</div>
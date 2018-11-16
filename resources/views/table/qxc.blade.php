<div>
    <table width="100%" class="info-table" border="1" style="white-space: nowrap;">
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
            <td colspan="2">1-7球号</td>
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
            <td rowspan="2">龙虎和</td>
            <td>龙，虎</td>
            <td>{{ $odds['longhu_odds']['key'] }}</td>
            <td>{{ $rebate['longhu_rebate']['key'] }}%</td>
            <td>{{ $odds['longhu_odds']['minMoney'] }}</td>
            <td>{{ $odds['longhu_odds']['maxMoney'] }}</td>
            <td>{{ $odds['longhu_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>和</td>
            <td>{{ $odds['he_odds']['key'] }}</td>
            <td>{{ $rebate['he_rebate']['key'] }}%</td>
            <td>{{ $odds['he_odds']['minMoney'] }}</td>
            <td>{{ $odds['he_odds']['maxMoney'] }}</td>
            <td>{{ $odds['he_odds']['maxTurnMoney'] }}</td>
        </tr>
        </tbody>
    </table>
</div>
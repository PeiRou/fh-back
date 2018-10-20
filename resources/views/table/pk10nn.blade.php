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
            <td colspan="2">牛6及以下</td>
            <td>2</td>
            <td>0</td>
            <td>1</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan="2">牛7/牛8</td>
            <td>3</td>
            <td>0</td>
            <td>1</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan="2">牛9</td>
            <td>4</td>
            <td>0</td>
            <td>1</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan="2">牛牛</td>
            <td>6</td>
            <td>0</td>
            <td>1</td>
            <td>-</td>
            <td>-</td>
        </tr>
        @foreach($odds as $k => $v)
            <tr>
                <td colspan="2">{{ $k }}</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>{{ $odds[$k]['maxMoney'] }}</td>
                <td>{{ $odds[$k]['maxTurnMoney'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
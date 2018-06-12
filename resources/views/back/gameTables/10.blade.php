<!-- 江苏骰宝(快3) -->
<form id="game10Form" action="{{ url('/game/table/save/jsk3') }}">
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
                <input type="text" name="daxiao_odds" value="{{ $odds['daxiao_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="daxiao_rebate" value="{{ $rebate['daxiao_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">三军</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="sanjun_odds" value="{{ $odds['sanjun_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="sanjun_rebate" value="{{ $rebate['sanjun_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">围骰</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="weitou_odds" value="{{ $odds['weitou_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="weitou_rebate" value="{{ $rebate['weitou_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">全骰</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="quantou_odds" value="{{ $odds['quantou_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="quantou_rebate" value="{{ $rebate['quantou_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="7" align="center" class="deep-blue-td">点数</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4，17</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="0417_odds" value="{{ $odds['0417_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="0417_rebate" value="{{ $rebate['0417_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5，16</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="0516_odds" value="{{ $odds['0516_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="0516_rebate" value="{{ $rebate['0516_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6，15</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="0615_odds" value="{{ $odds['0615_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="0615_rebate" value="{{ $rebate['0615_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7，14</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="0714_odds" value="{{ $odds['0714_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="0714_rebate" value="{{ $rebate['0714_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8，13</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="0813_odds" value="{{ $odds['0813_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="0813_rebate" value="{{ $rebate['0813_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9，12</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="0912_odds" value="{{ $odds['0912_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="0912_rebate" value="{{ $rebate['0912_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10，11</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="1011_odds" value="{{ $odds['1011_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="1011_rebate" value="{{ $rebate['1011_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">长牌</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="changpai_odds" value="{{ $odds['changpai_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="changpai_rebate" value="{{ $rebate['changpai_rebate'] }}">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">短牌</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="duanpai_odds" value="{{ $odds['duanpai_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="duanpai_rebate" value="{{ $rebate['duanpai_rebate'] }}">
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
    $('#game10Form').formValidation({
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
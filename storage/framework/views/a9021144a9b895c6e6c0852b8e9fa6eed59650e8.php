<!-- 新疆时时彩 -->
<form id="game4Form" action="<?php echo e(url('/game/table/save/xjssc')); ?>">
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
                    <input type="text" name="1_5_odds" value="<?php echo e($odds['1_5_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="1_5_rebate" value="<?php echo e($rebate['1_5_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="2face_odds" value="<?php echo e($odds['2face_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="2face_rebate" value="<?php echo e($rebate['2face_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">龙虎和</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙，虎</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="longhu_odds" value="<?php echo e($odds['longhu_odds']); ?>" >
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="longhu_rebate" value="<?php echo e($rebate['longhu_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="he_odds" value="<?php echo e($odds['he_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="he_rebate" value="<?php echo e($rebate['he_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">前三中三后三</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">豹子</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_baozi_odds" value="<?php echo e($odds['q3z3h3_baozi_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_baozi_rebate" value="<?php echo e($rebate['q3z3h3_baozi_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">顺子</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_shunzi_odds" value="<?php echo e($odds['q3z3h3_shunzi_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_shunzi_rebate" value="<?php echo e($rebate['q3z3h3_shunzi_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">对子</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_duizi_odds" value="<?php echo e($odds['q3z3h3_duizi_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_duizi_rebate" value="<?php echo e($rebate['q3z3h3_duizi_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">半顺</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_banshun_odds" value="<?php echo e($odds['q3z3h3_banshun_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_banshun_rebate" value="<?php echo e($rebate['q3z3h3_banshun_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">杂六</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_zaliu_odds" value="<?php echo e($odds['q3z3h3_zaliu_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_zaliu_rebate" value="<?php echo e($rebate['q3z3h3_zaliu_rebate']); ?>">
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="foot-submit">
        <button class="ui primary button">保 存</button>
    </div>
</form>
<script>
    $('#game4Form').formValidation({
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
<!-- 北京赛车（PK10） -->
<form id="game50Form" action="<?php echo e(url('/game/table/save/bjpk10')); ?>">
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
                    <input type="text" name="1_10_odds" value="<?php echo e($odds['1_10_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="1_10_rebate" value="<?php echo e($rebate['1_10_rebate']); ?>">
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
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和大小</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYD_odds" value="<?php echo e($odds['GYD_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYD_rebate" value="<?php echo e($rebate['GYD_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">小</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYX_odds" value="<?php echo e($odds['GYX_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYX_rebate" value="<?php echo e($rebate['GYX_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">冠亚军和单双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYDan_odds" value="<?php echo e($odds['GYDan_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYDan_rebate" value="<?php echo e($rebate['GYDan_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">双</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYS_odds" value="<?php echo e($odds['GYS_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="GYS_rebate" value="<?php echo e($rebate['GYS_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">冠亚军和</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3,4,18,19</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="341819_odds" value="<?php echo e($odds['341819_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="341819_rebate" value="<?php echo e($rebate['341819_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5,6,16,17</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="561617_odds" value="<?php echo e($odds['561617_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="561617_rebate" value="<?php echo e($rebate['561617_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7,8,14,15</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="781415_odds" value="<?php echo e($odds['781415_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="781415_rebate" value="<?php echo e($rebate['781415_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9,10,12,13</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="9101213_odds" value="<?php echo e($odds['9101213_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="9101213_rebate" value="<?php echo e($rebate['9101213_rebate']); ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">11</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="11_odds" value="<?php echo e($odds['11_odds']); ?>">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="11_rebate" value="<?php echo e($rebate['11_rebate']); ?>">
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
    $('#game50Form').formValidation({
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
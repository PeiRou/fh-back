<!-- 江苏骰宝(快3) -->
<form id="game10Form" action="{{ url('/game/table/save/jsk3') }}">
<table align="center" class="ui celled small table">
    <tbody>
    <tr class="firstRow">
        <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">江苏快3</td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="9" align="center" class="deep-blue-td">和值</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">大小单双</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">3，18</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">4，17</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">5，16</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">6，15</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">7，14</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">8，13</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">9，12</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">10，11</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
    </tr>

    {{--三连号--}}
    <tr>
        <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td" width="200">三连号</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td" width="200">123，234，345，456</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">三连通选</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="" value="">
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
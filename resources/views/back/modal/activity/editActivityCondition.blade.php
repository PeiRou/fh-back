<link rel="stylesheet" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css">
<script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<style>
    .fl50{
        width: 50%;
        float: left;
    }
    .fl50 button,
    .fl50 label,
    .fl50 span{
        display: inline-block;
    }
    .fl50 label{
        margin-right: 10px;
    }
</style>
<form id="editArticleForm" class="ui form" action="{{ url('/action/admin/activity/editCondition') }}">
    <div class="field">
        <label>连续天数(请填写数字)</label>
        <div class="ui input icon">
            <input type="text" name="day" value="{{ $conditionInfo->day }}"/>
        </div>
    </div>
    <div class="field">
        <label>活动名</label>
        <select class="ui dropdown" name="activity_id" id="status" style='height:32px !important'>
            @foreach($activityLists as $value)
                <option @if($conditionInfo->activity_id == $value->id) selected="selected" @endif value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="field">
        <label>充值金额</label>
        <div class="ui input icon">
            <input type="text" name="money" value="{{ $conditionInfo->money }}"/>
        </div>
    </div>
    <div class="field">
        <label>打码量</label>
        <div class="ui input icon">
            <input type="text" name="bet" value="{{ $conditionInfo->bet }}"/>
        </div>
    </div>
    <div class="field fl50">
        <label style="display: inline-block;margin-right: 20px;">奖项设置</label>
        <button type="button" onclick="addAward()">添加奖项</button>
    </div>
    <div class="fl50">
        <label>奖金总金额 : </label>
        <span id="totalMoney">{{ $conditionInfo->total_money }}元</span>
        <input id="totalMoneyInput" type="hidden" name="total_money" value="{{ $conditionInfo->total_money }}"/>
    </div>
    <div class="field">
        <label>活动奖励</label>
        <table class="ui small table" cellspacing="0">
            <thead>
                <tr>
                    <th>名次</th>
                    <th>奖项</th>
                    <th>中奖人数</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody id="awardTr">
                    @foreach($conditionInfo->content as $content)
                        <tr>
                            <td class="award">第{{ $content['ranking'] }}名</td>
                            <td>
                                <select class="ui dropdown" name="award[]" onchange="selectAward($(this))">
                                    @foreach($prizeLists as $prizeList)
                                        <option @if($prizeList->id == $content['award']) selected="selected" @endif value="{{ $prizeList->id }}">{{ $prizeList->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" class="numInput" name="num[]" onblur="totalMoney()" value="{{ $content['num'] }}"/></td>
                            <td>
                                <a href="javascript:;" onclick="delAward($(this))">删除</a>
                            </td>
                            <input class="rankingInput" type="hidden" value="{{ $content['ranking'] }}" name="ranking[]"><input class="bonusInput" type="hidden" value="{{ $content['bonus'] }}" name="bonus[]">
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <input type="hidden" name="id" value="{{ $conditionInfo->id }}"/>
</form>
<script>
    $(function () {
        $('#editArticleForm').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            var $form = $(e.target),
                fv    = $form.data('formValidation');
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                    if(result.status == true){
                        jc1.close();
                        $('#capitalDetailsTable').DataTable().ajax.reload(null,false);
                    }
                }
            });
        });
    });


    var awardHtml = '<tr>';
    awardHtml += '<td class="award"></td>';
    awardHtml += '<td>';
    awardHtml += '<select class="ui dropdown" name="award[]" onchange="selectAward($(this))">';
    awardHtml += '<option value="0">请选择奖项</option>';
    @foreach($prizeLists as $prizeList)
        awardHtml += '<option value="{{ $prizeList->id }}" data-money="{{ $prizeList->quantity }}">{{ $prizeList->name }}</option>';
    @endforeach
        awardHtml += '</select>';
    awardHtml += '</td>';
    awardHtml += '<td><input type="text" class="numInput" name="num[]" onblur="totalMoney()" value="0"></td>';
    awardHtml += '<td><a href="javascript:;" onclick="delAward($(this))">删除</a></td>';
    awardHtml += '<input class="rankingInput" type="hidden" value="0" name="ranking[]"><input class="bonusInput" type="hidden" value="0" name="bonus[]"></tr>';

    function addAward() {
        $('#awardTr').append(awardHtml);
        refreshAward();
    }

    function delAward(e) {
        e.parent().parent().remove();
        refreshAward();
    }

    function refreshAward() {
        var award = $('.award');
        var ranking = $('.rankingInput');
        award.each(function (i,e) {
            var k = i*1 + 1;
            e.innerHTML = '第'+ k +'名';
            ranking[i].value = k;
        });
    }
    
    function totalMoney() {
        var money = 0;
        var bonus = $('.bonusInput');
        $('.numInput').each(function (i,e) {
            money = money * 1 + e.value * bonus[i].value;
        });
        $('#totalMoney').text(money + '元');
        $('#totalMoneyInput').val(money);
    }
    
    function selectAward(obj) {
        var money = obj.find("option:selected").attr('data-money');
        obj.parent().siblings('.bonusInput').val(money);
    }
</script>
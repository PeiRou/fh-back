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
    ._money{
        width: 80px!important;
    }
    .checkMoney{
        display: flex;
    }
    .times{
        width: 60px!important;
    }
</style>
<form id="editArticleForm" class="ui form" action="{{ url('/action/admin/activity/editCondition') }}">
    <div class="field one" >
        <div class="field">
            <label>连续天数(请填写数字)</label>
            <div class="ui input icon">
                <input type="text" name="day" value="{{ $conditionInfo->day ?? $conditionInfoHongbao->day }}"/>
            </div>
        </div>
    </div>
    <div class="field">
        <label>活动名</label>
        {{--<select class="ui dropdown" name="activity_id" id="status" style='height:32px !important'>--}}
            {{--@foreach($activityLists as $value)--}}
                {{--<option @if($activity_id == $value->id) selected="selected" @endif value="{{ $value->id }}">{{ $value->name }}</option>--}}
            {{--@endforeach--}}
        {{--</select>--}}
        @foreach($activityLists as $value)
            @if($activity_id == $value->id)
                <input type="text" readonly value="{{ $value->name }}">
            @endif
        @endforeach
    </div>
    <div class="one">
        <div class="field">
            <label>充值金额</label>
            <div class="ui input icon">
                <input type="text"  name="money" value="{{ $conditionInfo->money ?? $conditionInfoHongbao->money ?? null }}"/>
            </div>
        </div>
        <div class="field">
            <label>打码量</label>
            <div class="ui input icon">
                <input type="text" name="bet" value="{{ $conditionInfo->bet ?? null }}"/>
            </div>
        </div>
        <div class="field fl50">
            <label style="display: inline-block;margin-right: 20px;">奖项设置</label>
            <button type="button" onclick="addAward()">添加奖项</button>
        </div>
        <div class="fl50">
            <label>奖金总金额 : </label>
            <span id="totalMoney">{{ $conditionInfo->total_money ?? 0 }}元</span>
            <input id="totalMoneyInput" type="hidden" name="total_money" value="{{ $conditionInfo->total_money ?? 0 }}"/>
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
                    @if(isset($conditionInfo->content) && $conditionInfo->type !== 3)
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
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="tow" style="display: none">
        {{--<div class="field">--}}
        {{--<label>打码量</label>--}}
        {{--<div class="ui input icon">--}}
        {{--<input type="text" name="bet" value=""/>--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="field">
            <label>活动总金额</label>
            <div class="ui input icon">
                <input type="text" readonly name="total_money1" value="{{ $conditionInfo->total_money ?? null }}"/>
            </div>
        </div>
        {{--<div class="field">--}}
            {{--<label>抽奖次数</label>--}}
            {{--<div class="ui input icon">--}}
                {{--<input type="text" name="times" oninput="this.value=value.replace(/[^\d]/g,'')"  value="{{ $conditionInfo->times ?? null }}"/>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="field fl50">
            <label style="display: inline-block;margin-right: 20px;">抽奖设置</label>
            <button type="button" onclick="addNumList()">添加</button>
        </div>
        <div class="field">
            <label>列表</label>
            <table class="ui small table" cellspacing="0">
                <thead>
                <tr>
                    <th>充值金额范围</th>
                    <th>抽奖次数</th>
                    {{--<th>中奖人数</th>--}}
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="NumList">
                @if(isset($conditionInfo->content) && $conditionInfo->type == 3)
                    @foreach($conditionInfo->content as $content)
                        <td class="checkMoney">
                            <input type="text" class="_money" name="min_money[]" oninput="clearNoNum(this)" value="{{ $content['min_money'] }}">
                            -
                            <input type="text" class="_money" name="max_money[]" oninput="clearNoNum(this)" value="{{ $content['max_money'] }}">
                        </td>
                        <td><input type="text" class="times" name="times[]"  value="{{ $content['times'] }}"></td>
                        <td>
                            <a href="javascript:;" onclick="delNumList($(this))">删除</a>
                        </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $conditionInfo->id }}"/>
    <input type="hidden" name="activity_id" value="{{ $activity_id }}"/>
</form>
<script>
    $(function () {
        @if($conditionInfo->type == 3)
        $('form .tow').show();
        $('form .one').hide();
        @endif
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
                    }else{
                        Calert(result.msg,'red');
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
    @if(isset($prizeLists))
    @foreach($prizeLists as $prizeList)
        awardHtml += '<option value="{{ $prizeList->id }}" data-money="{{ $prizeList->quantity }}">{{ $prizeList->name }}</option>';
    @endforeach
    @endif
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
    function delNumList(obj){
        $(obj).parent().parent('tr').remove();
    }
    function addNumList (){
        $('#NumList').append(`<tr>
            <td class="checkMoney">
                <input type="text" class="_money" name="min_money[]" oninput="clearNoNum(this)" value="">
                -
                <input type="text" class="_money" name="max_money[]" oninput="clearNoNum(this)" value="">
            </td>
            <td><input type="text" class="times" name="times[]"  value=""></td>
            <td>
                <a href="javascript:;" onclick="delNumList($(this))">删除</a>
            </td>
           </tr>`);
    }
</script>
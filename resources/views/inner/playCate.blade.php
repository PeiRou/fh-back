@extends('back.master')

@section('content')
    <div style="width: 400px;padding: 30px;">
        <form id="addPlayCateForm" class="ui form" action="{{ url('/action/inner/playCate') }}">
            <div class="field">
                <label>游戏</label>
                <div class="ui input icon">
                    <select class="ui fluid dropdown" name="gameId">
                        @foreach($game as $item)
                            <option value="{{ $item->game_id }}">【{{ $item->game_id }}】-{{ $item->game_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="field">
                <label>玩法分类名称</label>
                <div class="ui input icon">
                    <input type="text" name="name" id="name"/>
                </div>
            </div>
            <div class="field">
                <label>玩法分类字母缩写</label>
                <div class="ui input icon">
                    <input type="text" name="code" id="code"/>
                </div>
            </div>
            <div class="field">
                <label>是否显示</label>
                <input type="radio" name="isShow" value="1" checked/>是
                <input type="radio" name="isShow" value="0"/>否
            </div>
            <div class="field">
                <label>是否禁用</label>
                <input type="radio" name="isBan" value="1"/>是
                <input type="radio" name="isBan" value="0" checked/>否
            </div>
            <div class="field">
                <button class="ui button blue">保存</button>
            </div>
        </form>
    </div>
@endsection

@section('page-js')
<script>
    $(function () {
        $('#addPlayCateForm').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: '请填写玩法分类名称'
                        }
                    }
                },
                code: {
                    validators: {
                        notEmpty: {
                            message: '填写分类字母缩写'
                        }
                    }
                }
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
                        $('#name').val("");
                        $('#code').val("");
                    } else {
                        Calert(result.msg,'red');
                    }
                }
            });
        });
    })
</script>
@endsection
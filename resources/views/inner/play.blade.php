@extends('back.master')

@section('content')
    <div style="width: 600px;padding: 30px;">
        <form id="addPlayCateForm" class="ui form" action="{{ url('/action/inner/play') }}">
            <div class="field">
                <label>游戏</label>
                <div class="ui input icon">
                    <select class="ui fluid dropdown" name="gameId" id="gameId">
                        <option value="">选择游戏</option>
                        @foreach($game as $item)
                            <option value="{{ $item->game_id }}">【{{ $item->game_id }}】-{{ $item->game_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="field">
                <label>玩法分类</label>
                <div class="ui input icon">
                    <select class="ui fluid dropdown" name="playCateId" id="playCateId"></select>
                </div>
            </div>
            <div class="field">
                <label>Alias</label>
                <div class="ui input icon">
                    <input type="text" name="alias" id="alias"/>
                </div>
            </div>
            <div class="field">
                <label>玩法名称</label>
                <div class="ui input icon">
                    <input type="text" name="name" id="name"/>
                </div>
                <div class="fast-name">
                    <ul>
                        <li>大</li>
                        <li>小</li>
                        <li>单</li>
                        <li>双</li>
                        <li>和</li>
                        <li>龙</li>
                        <li>虎</li>
                        <li>尾大</li>
                        <li>尾小</li>
                        <li>合数单</li>
                        <li>合数双</li>
                        <li>东</li>
                        <li>南</li>
                        <li>西</li>
                        <li>北</li>
                        <li>中</li>
                        <li>发</li>
                        <li>白</li>
                        <li>0</li>
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                        <li>4</li>
                        <li>5</li>
                        <li>6</li>
                        <li>7</li>
                        <li>8</li>
                        <li>9</li>
                        <li>10</li>
                        <li>11</li>
                    </ul>
                </div>
            </div>
            <div class="field">
                <label>玩法字母缩写</label>
                <div class="ui input icon">
                    <input type="text" name="code" id="code"/>
                </div>
                <div class="fast-code">
                    <ul>
                        <li>DA</li>
                        <li>XIAO</li>
                        <li>DAN</li>
                        <li>SHUANG</li>
                        <li>LONG</li>
                        <li>HU</li>
                        <li>WEIDA</li>
                        <li>WEIXIAO</li>
                        <li>HSD</li>
                        <li>HSS</li>
                        <li>DONG</li>
                        <li>NAN</li>
                        <li>XI</li>
                        <li>BEI</li>
                        <li>ZHONG</li>
                        <li>FA</li>
                        <li>BAI</li>
                        <li>BIG</li>
                        <li>SMALL</li>
                        <li>SINGLE</li>
                        <li>DOUBLE</li>
                        <li>TOTAL</li>
                        <li>TOTAL_DOUBLE</li>
                        <li>TOTAL_SINGLE</li>
                        <li>TOTAL_SMALL</li>
                        <li>TOTAL_BIG</li>
                        <li>0</li>
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                        <li>4</li>
                        <li>5</li>
                        <li>6</li>
                        <li>7</li>
                        <li>8</li>
                        <li>9</li>
                        <li>10</li>
                        <li>11</li>
                    </ul>
                </div>
            </div>
            <div class="field">
                <label>赔率</label>
                <div class="ui input icon">
                    <input type="text" name="odds" id="odds"/>
                </div>
                <div class="fast-odds">
                    <ul>
                        <li>1.995</li>
                        <li>9</li>
                        <li>9.95</li>
                        <li>2</li>
                        <li>6</li>
                        <li>11</li>
                        <li>1.993</li>
                        <li>9.93</li>
                    </ul>
                </div>
            </div>
            <div class="field">
                <label>退水</label>
                <div class="ui input icon">
                    <input type="text" name="rebate" id="rebate" value="0"/>
                </div>
            </div>
            <div class="field">
                <label>最小下注金额</label>
                <div class="ui input icon">
                    <input type="text" name="minMoney" id="minMoney" value="1"/>
                </div>
            </div>
            <div class="field">
                <label>最大下注金额</label>
                <div class="ui input icon">
                    <input type="text" name="maxMoney" id="maxMoney" value="100000"/>
                </div>
            </div>
            <div class="field">
                <label>当期下注最大金额</label>
                <div class="ui input icon">
                    <input type="text" name="maxTurnMoney" id="maxTurnMoney" value="100000"/>
                </div>
            </div>
            <div class="field">
                <button class="ui button blue">保存</button>
            </div>
        </form>
    </div>
    <style>
        .fast-odds ul li,.fast-name ul li,.fast-code ul li{
            float: left;
            border: 1px solid #e3e897;
            background: #fffff4;
            font-size: 16px;
            padding: 3px 6px;
            margin-right: 3px;
            margin-top: 4px;
            margin-bottom: 4px;
            border-radius: 3px;
        }
        .fast-odds ul li:hover,.fast-name ul li:hover,.fast-code ul li:hover{
            cursor: pointer;
            background: #ebebe0;
        }
    </style>
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
                                message: '请填写玩法名称'
                            }
                        }
                    },
//                    code: {
//                        validators: {
//                            notEmpty: {
//                                message: '填写玩法字母缩写'
//                            }
//                        }
//                    },
                    odds: {
                        validators: {
                            notEmpty: {
                                message: '填写赔率'
                            }
                        }
                    },
                    rebate: {
                        validators: {
                            notEmpty: {
                                message: '填写退水'
                            }
                        }
                    },
                    minMoney: {
                        validators: {
                            notEmpty: {
                                message: '填写最小下注金额'
                            }
                        }
                    },
                    maxMoney: {
                        validators: {
                            notEmpty: {
                                message: '填写最大下注金额'
                            }
                        }
                    },
                    maxTurnMoney: {
                        validators: {
                            notEmpty: {
                                message: '填写当期最大下注金额'
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
                            $('#odds').val("");
                            $('#name').focus();
                        } else {
                            Calert(result.msg,'red');
                        }
                    }
                });
            });
        });
        
        $('.fast-odds ul li').on('click',function () {
            $('#odds').val($(this).html())
        });
        $('.fast-name ul li').on('click',function () {
            $('#name').val($(this).html())
        });
        $('.fast-code ul li').on('click',function () {
            $('#code').val($(this).html())
        });

        $('#gameId').on('change',function () {
            var val = $(this).val();
            $('#playCateId').html("");
            $.ajax({
                url:'/action/inner/getPlayCateItem',
                type:'post',
                dataType:'json',
                data:{gameId:val},
                success:function (result) {
                    $.each(result.data,function (index,value) {
                        $('#playCateId').append('<option value="'+ value.id +'">【'+ value.id +'】-'+ value.name +'</option>')
                    });
                }
            })
        })
    </script>
@endsection
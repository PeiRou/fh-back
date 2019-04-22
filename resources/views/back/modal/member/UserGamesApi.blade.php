<style>
    .ui.form .fields {
        margin: 0 -0.5em .6em;
    }
    .ui.form .three.wide.field{
        width: 100%;
    }
    .list_{
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(0,0,0,0);
        padding: 5px 15px ;
    }
    .list_:hover{
        border-bottom: 1px solid rgba(150,150,150,.4);
    }
    .left_{
        display: flex;
        justify-items: center;
        align-items: center;
    }
    .left_ input{
        margin: 0 15px!important;
        line-height: .51428571em!important;
        padding:.4em 1em !important;
    }
    .number{
        width: 100px!important;
    }

</style>
<form id="fromBox" class="ui mini form" action="{{ url('/action/admin/editUser') }}">
    <div class="three wide field" style='width:100% !important;'>
        <label>请选择游戏</label>
        <select class="ui dropdown" id="game_id" style='width:100%; height:32px !important'>
            <option value="">请选择游戏</option>
            @foreach(\App\GamesList::getChildList() as $k=>$v)
                <option value="{{ $v->game_id }}">{{ $v->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        {{--<div type="upMoney" class="list_  ">--}}
            {{--<div class="left_"><span>上分</span><input type="text" class="number" name="money" value=""></div>--}}
            {{--<div><button type="button" class="btn btn-blue">确定</button></div>--}}
        {{--</div>--}}
        {{--<div type="downMoney" class="list_  ">--}}
            {{--<div class="left_"><span>下分</span><input type="text" class="number" name="money" value=""></div>--}}
            {{--<div><button type="button" class="btn btn-blue">确定</button></div>--}}
        {{--</div>--}}
        <div type="getMoney" class="list_  ">
            <div class="left_"><span>余额</span><input type="text" class="number" readonly="readonly" value="0"></div>
            <button type="button" class="btn btn-blue">刷新</button>
        </div>
        <div type="offline" class="list_  ">
            <div class="left_">踢下线</div>
            <button type="button" class="btn btn-blue">确定</button>
        </div>
    </div>

</form>

<script>
    var user_id = {{ request()->user_id }};
    var moneys = [];

$(function(){

    $('#game_id').change(function(){
        $('.list_[type="getMoney"] input').val(moneys[$(this).val()] || 0)
    });
    $('.list_ button').on('click',function(){
        var parent = $(this).parent('.list_');
        var type = parent.attr('type');
        var data = {
            type:type,
            user_id:user_id,
            game_id:$('#game_id').val()
        }
        if(data.game_id <= 0)
            return Calert('请选择游戏','red')

        var lading = layer.load(1, {
            shade: [0.1,'#fff'], //0.1透明度的白色背景
            zIndex:99999999999
        });
        $.ajax({
            url:'/action/admin/gamesApi/UserGamesApi',
            type:'get',
            data:data,
            dataType:'json',
            success:function(e){
                layer.close(lading);
                if(e.code == 0){
                    if(type == 'getMoney'){
                        parent.find('.number').val(e.data.money);
                        moneys[$('#game_id').val()] = e.data.money
                    }else{
                        Calert('操作成功','green')
                    }
                }else
                    Calert(e.msg,'red')
            },
        })
    })
})
</script>
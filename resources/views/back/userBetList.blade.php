<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <link rel="stylesheet" href="/vendor/Semantic/semantic.min.css">
    <link rel="stylesheet" href="/vendor/confirm/dist/jquery-confirm.min.css">
    <link rel="stylesheet" href="/vendor/dataTables/DataTables-1.10.16/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="/back/css/core.css">

    <script src="/js/jquery.min.js"></script>
    <script src="/vendor/Semantic/semantic.min.js"></script>
    <script src="/vendor/confirm/dist/jquery-confirm.min.js"></script>
    <script src="/vendor/dataTables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/dataTables/DataTables-1.10.16/js/dataTables.semanticui.min.js"></script>
    <style>
        .user-bet-list .title{
            border-left: 3px solid red;
            font-size: 14px;
            padding-left: 10px;
            border-bottom: 1px solid #ddd;
            height: 25px;
            line-height: 24px;
        }
        .games{height: auto;overflow: hidden;padding: 4px 0;}
        .games .title{float: left;border: none;}
        .games .list{float: left;font-size: 14px;}
    </style>
</head>
<body>
<div class="user-bet-list">
    <div class="title">会员：{{ $getUserInfo->username }}-注单详情</div>
    <div class="games">
        <div class="title">游戏选择：</div>
        <div class="list">
            @foreach($games as $item)
                <label>
                    <input type="checkbox" name="games" id="games" checked value="{{ $item->game_id }}"> {{ $item->game_name }}
                </label>
            @endforeach
        </div>
    </div>
    <div class="table-quick-bar" style="margin-top: 0;padding-top: 11px;padding-left: 3px;">
        <div class="ui mini form">
            <div class="fields">
                <div class="one wide field">
                    <select class="ui dropdown" id="status" style='height:32px !important'>
                        <option value="">今日注单</option>
                        <option value="1">昨日注单</option>
                        <option value="2">历史注单</option>
                    </select>
                </div>
                <div class="one wide field">
                    <select class="ui dropdown" id="status" style='height:32px !important'>
                        <option value="">结算状态</option>
                        <option value="1">未结算</option>
                        <option value="2">已结算</option>
                        <option value="2">撤销</option>
                    </select>
                </div>
                <div class="one wide field">
                    <input type="text" id="account" placeholder="期数">
                </div>
                <div class="one wide field">
                    <input type="text" id="mobile" placeholder="订单号">
                </div>
                <div class="one wide field">
                    <div class="ui calendar" id="rangestart">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="timeStart" placeholder="时间-开始">
                        </div>
                    </div>
                </div>
                <div style="line-height: 32px;">-</div>
                <div class="one wide field">
                    <div class="ui calendar" id="rangeend">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="timeEnd" placeholder="时间-结束">
                        </div>
                    </div>
                </div>
                <div class="one wide field">
                    <input type="text" id="minMoney" placeholder="下注最小金额">
                </div>
                <div class="one wide field">
                    <input type="text" id="maxMoney" placeholder="输赢起始">
                </div>
                <div class="one wide field">
                    <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                </div>
                <div class="one wide field">
                    <button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置 </button>
                </div>
            </div>
        </div>
    </div>
    <table id="userBetTable" class="ui small celled striped table" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>订单号</th>
            <th>下单时间</th>
            <th>会员</th>
            <th>游戏</th>
            <th>期号</th>
            <th>玩法类型</th>
            <th>返水</th>
            <th>下注金额</th>
            <th>代理赔率/比</th>
            <th>代理返水/比</th>
            <th>会员输赢</th>
            <th>冻结金额</th>
            <th>解冻金额</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(function () {
        getCheckBox();

        dataTable = $('#userBetTable').DataTable({
            searching: false,
            bLengthChange: false,
            ordering:false,
            processing: true,
            serverSide: true,
            aLengthMenu: [[20]],
            ajax: {
                url:'/back/datatables/userBetSearch',
                data:function (d) {
                    d.games = check_val;
                    d.userId = {{ $userId }};
                //     d.rechLevel = $('#rechLevel').val();
                //     d.account = $('#account').val();
                //     d.mobile = $('#mobile').val();
                //     d.qq = $('#qq').val();
                //     d.minMoney = $('#minMoney').val();
                //     d.maxMoney = $('#maxMoney').val();
                //     d.promoter = $('#promoter').val();
                //     d.noLoginDays = $('#noLoginDays').val();
                }
            },
            columns: [
                {data:'order_id'},
                {data:'created_at'},
                {data:'user'},
                {data:'game'},
                {data:'issue'},
                {data:'play'},
                {data:'rebate'},
                {data:'bet_money'},
                {data:'none1'},
                {data:'none2'},
                {data:'bunko'},
                {data:'dongjie'},
                {data:'jiedong'}
            ],
            language: {
                "zeroRecords": "暂无数据",
                "info": "当前显示第 _PAGE_ 页，共 _PAGES_ 页",
                "infoEmpty": "没有记录",
                "loadingRecords": "请稍后...",
                "processing":     "读取中...",
                "paginate": {
                    "first":      "首页",
                    "last":       "尾页",
                    "next":       "下一页",
                    "previous":   "上一页"
                }
            }
        });

        $('#btn_search').on('click',function () {
            getCheckBox();
            if(check_val.length !== 0){
                dataTable.ajax.reload();
            } else {
                $.alert({
                    icon: 'warning sign icon',
                    type: 'red',
                    title: '提示',
                    animateFromElement: false,
                    draggable: false,
                    useBootstrap: false,
                    content: '必须选择一个游戏作为基本搜索条件',
                    boxWidth: '20%',
                    buttons: {
                        ok:{
                            text:'确定'
                        }
                    }
                });
            }
        });
        // $('#reset').on('click',function () {
        //     $('#status').val("");
        //     $('#rechLevel').val("");
        //     $('#account').val("");
        //     $('#mobile').val("");
        //     $('#qq').val("");
        //     $('#minMoney').val("");
        //     $('#maxMoney').val("");
        //     $('#promoter').val("");
        //     $('#noLoginDays').val("");
        //     dataTable.ajax.reload();
        // });
    });


    function getCheckBox() {
        var checkBox = $(".user-bet-list .games .list input[name='games']");
        check_val = [];
        for(k in checkBox){
            if(checkBox[k].checked)
                check_val.push(checkBox[k].value);
        }
    }
</script>
</body>
</html>

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
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <style>
        body{
            font-family: '微软雅黑';
            font-size: 9pt;
        }
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
        .show-open{
            border: 1px solid #d6d6d6;
            height: auto;
            width: 300px;
            position: absolute;
            left: 0;
            background: #fff;
            top: -80px;
            display: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.21);
            border-radius: 5px;
            cursor: pointer;
            overflow: hidden;
        }
        .open-float-num span{
            font-size: 12pt;
            font-weight: bold;
            padding: 5px;
            display: block;
            float: left;
            margin-right: 0px;
        }
        .ll-text{
            text-align: center;
            padding: 20px;
            color: #b5b5b5;
        }
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
                    <select class="ui dropdown" id="date" style='height:32px !important'>
                        <option value="today">今日注单</option>
                        <option value="yesterday">昨天注单</option>
                        <option value="week">本周注单</option>
                        <option value="month">本月注单</option>
                        <option value="lastMonth">上月注单</option>
                    </select>
                </div>
                <div class="one wide field">
                    <select class="ui dropdown" id="status" style='height:32px !important'>
                        <option value="">结算状态</option>
                        <option value="1">未结算</option>
                        <option value="2">已结算</option>
                        <option value="3">撤销</option>
                    </select>
                </div>
                <div class="one wide field">
                    <input type="text" id="issue" placeholder="期数">
                </div>
                <div class="one wide field">
                    <input type="text" id="orderNum" placeholder="订单号">
                </div>
                <div class="one wide field">
                    <div class="ui calendar" id="rangestart" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="startTime" value="{{ $today }}" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="one wide field">
                    <div class="ui calendar" id="rangeend" style="width: 108px;">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" id="endTime" value="{{ $today }}" placeholder="">
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
        <div class="total-nums">
            下注总金额：<span id="totalBetMoney" style="font-size: 13pt;">0</span> 输赢总金额：<span id="totalWinMoney" style="font-size: 13pt;">0</span>
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
            <th>终端</th>
            <th>代理赔率/比</th>
            <th>代理返水/比</th>
            <th>会员输赢</th>
            <th>冻结金额</th>
            <th>解冻金额</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </tfoot>
    </table>
</div>

<script>
    $(function () {
        // $('body').on('click',function () {
        //     $('.show-open').hide();
        // });

        getCheckBox();
        getTotalWin();
        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
        };
        $('#rangestart').calendar({
            type: 'date',
            endCalendar: $('#rangeend'),
            formatter: {
                date: function (date, settings) {
                    if (!date) return '';
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    return year+'-'+month+'-'+day;
                }
            },
            text: {
                days: ['日', '一', '二', '三', '四', '五', '六'],
                months: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                monthsShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                today: '今天',
                now: '现在',
                am: 'AM',
                pm: 'PM'
            }
        });
        $('#rangeend').calendar({
            type: 'date',
            startCalendar: $('#rangestart'),
            formatter: {
                date: function (date, settings) {
                    if (!date) return '';
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    return year+'-'+month+'-'+day;
                }
            },
            text: {
                days: ['日', '一', '二', '三', '四', '五', '六'],
                months: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                monthsShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                today: '今天',
                now: '现在',
                am: 'AM',
                pm: 'PM'
            }
        });

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
                    d.userId = '{{ $userId }}';
                    d.date = $('#date').val();
                    d.status = $('#status').val();
                    d.startTime = $('#startTime').val();
                    d.endTime = $('#endTime').val();
                    d.issue = $('#issue').val();
                    d.orderNum = $('#orderNum').val();
                    // d.end = $('#endTime').val();
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
                {data: function (data) {
                        return "<span class='bet-text'>"+(parseFloat(data.bet_bet_money)).toFixed(2)+"</span>";
                    }},
                {data:'platform'},
                {data:'none1'},
                {data:'none2'},
                {data: function (data) {
                        if(data.bet_bunko == 0){
                            txt = '<span class=\'tiny-blue-text\'>未结算</span>';
                        }else{
                            if(data.bet_bunko > 0){
                                lastMoney = (parseFloat(intVal(data.bet_bunko) - intVal(data.bet_bet_money))).toFixed(2);
                                txt = "<span class='blue-text'><b>"+lastMoney+"</b></span>";
                            }
                            if(data.bet_bunko < 0){
                                txt = "<span class='red-text'><b>"+data.bet_bunko+"</b></span>";
                            }
                        }
                        return txt;
                    }},
                {data:'dongjie'},
                {data:'jiedong'}
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api();

                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var Total7 = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b,c) {
                        return parseFloat((intVal(a) + intVal(data[c].bet_bet_money)).toFixed(2));
                    }, 0 );
                var Total11 = api
                    .column( 11 )
                    .data()
                    .reduce( function (a, b,c) {
                        return parseFloat((intVal(a) + intVal(data[c].bet_bunko)).toFixed(2));
                    }, 0 );
                // Update footer by showing the total with the reference of the column index
                $( api.column( 0 ).footer() ).html('总计');
                $( api.column( 7 ).footer() ).html(Total7);
                $( api.column( 11 ).footer() ).html(Total11);
            },
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
            getTotalWin();
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
    
    function getTotalWin() {
        var userId = {{ $getUserInfo->id }};
        var date = $('#date').val();
        var startTime = $('#startTime').val();
        var endTime = $('#endTime').val();
        var token = '{{ csrf_token() }}';
        var issue = $('#issue').val();
        var orderNum = $('#orderNum').val();
        $.ajax({
            url:'/action/userBetList/total',
            type:'post',
            dataType:'json',
            data:{userId:userId,date:date,startTime:startTime,endTime:endTime,_token:token,issue:issue,orderNum:orderNum},
            success:function (data) {
                var winTotal = data[0]['winTotal'];
                var betTotal = data[0]['betTotal'];
                if(winTotal == null){
                    winTotal = 0;
                }
                if(betTotal == null){
                    betTotal = 0;
                }
                $('#totalBetMoney').html(betTotal);
                $('#totalWinMoney').html(winTotal);
            }
        });
    }


    function getCheckBox() {
        var checkBox = $(".user-bet-list .games .list input[name='games']");
        check_val = [];
        for(k in checkBox){
            if(checkBox[k].checked)
                check_val.push(checkBox[k].value);
        }
    }

    function showOpenHistory(gameId,issue,id){
        $('#openH_'+id).show();
        if($('#openH_'+id).html() == ""){
            $('#openH_'+id).html('<div class="ll-text">查询中...</div>');
            setTimeout(function () {
                $.ajax({
                    url:'/ajax/openHistory/'+gameId+'/'+issue,
                    type:'get',
                    dataType:'json',
                    success:function (r) {
                        if(r.status == true){
                            $('#openH_'+id).html(r.openNum)
                        } else {
                            $('#openH_'+id).html('<div class="ll-text">暂未开奖</div>');
                        }
                    }
                })
            },400);
        }

    }

    function hideOpenHistory(gameId,issue,id){
        $('#openH_'+id).hide();
    }

    $('#date').on('change',function () {
        var data = $(this).val();
        $.ajax({
            url:'/recharge/selectData/dateChange/'+data,
            type:'get',
            dataType:'json',
            success:function (result) {
                $('#startTime').val(result.start);
                $('#endTime').val(result.end);
            }
        });
    });
</script>
</body>
</html>

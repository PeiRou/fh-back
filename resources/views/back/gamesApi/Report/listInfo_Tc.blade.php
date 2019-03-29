<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>统计报表</title>
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
    <script src="/vendor/Semantic/semantic.min.js"></script>
    <script src="/vendor/formvalidation/dist/js/formValidation.min.js"></script>
    <script src="/vendor/formvalidation/dist/js/framework/semantic.min.js"></script>
    <script src="/back/js/core.js"></script>

    <style>
        .ui.grid{
            margin: -1px;
        }
        #tableData{
            /*margin-top: 30px;*/
        }
    </style>
</head>
<body>
<div class="user-bet-list">
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>统计报表
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="parent.layer.close(parent.openIndex)">返回</button>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field" style="width: initial!important;">
                        <select class="ui dropdown" name="productType" id="productType" style="height:32px !important">
                            <option value="">产品</option>
                            @foreach(\App\GamesList::$productType as $k=>$v)
                                <option @if(isset(request()->productType) && request()->productType == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field"  style="width: 130px !important;">
                        <input type="text" id="username"  placeholder="会员">
                    </div>
                    <div class="one wide field" style="width:7.25%!important">
                        <div class="ui calendar timeStart" id="tcStart">
                            <div class="ui input left">
                                <input type="text" name="startTime" id="startTime" placeholder="起始日期" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div style="line-height: 32px;">-</div>
                    <div class="one wide field"  style="width:7.25%!important">
                        <div class="ui calendar timeEnd" id="tcEnd">
                            <div class="ui input left">
                                <input type="text" name="endTime" id="endTime" placeholder="结束日期" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <button class="btn_search fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询</button>
                    </div>
                </div>

            </div>
        </div>
        <table id="tableData" class="ui small celled striped table" cellspacing="0" width="100%">
            <thead>
            </thead>
            <tfoot>
            <tr>
                <th>总计</th>
                <th id="user_count"></th>
                <th id=""></th>
                <th id="bet_count"></th>
                <th id="AllBet"></th>
                <th id="validBetAmount"></th>
                <th id="Profit"></th>
                <th id="upMoney"></th>
                <th id="downMoney"></th>
                <th></th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    var openIndex1 = 123465;
    layer = parent.layer;
    // laydate = parent.laydate;

    var dataTable;

    $(function () {
        var columns = [
            {data: 'productType',title:'平台'},
            {data: 'username',title:'会员'},
            {data: 'agent_account',title:'代理'},
            {data: 'bet_count',title:'下注笔数'},
            {data: 'AllBet',title:'投注金额'},
            {data: 'validBetAmount',title:'有效投注额'},
            {data: 'Profit',title:'游戏输赢'},
            {data: 'upMoney',title:'上分'},
            {data: 'downMoney',title:'下分'},
            {data: 'control',title:'操作'},
        ];
        function createTable(columns) {
            return $('#tableData').DataTable({
                searching: false,
                bLengthChange: false,
                processing: true,
                serverSide: true,
                ordering: false,
                destroy: true,
                aLengthMenu: [[20]],
                ajax: {
                    url:'/back/datatables/reportGamesApiInfo_tc',
                    type:'get',
                    data:function (d) {
                        d.startTime = $('#startTime').val();
                        d.endTime = $('#endTime').val();
                        d.username = $('#username').val();
                        d.productType = $('#productType').val();
                        if(typeof d.productType == 'string'){
                            d.isGroupUser = true
                        }
                    },
                    dataSrc:function(e){
                        $('#user_count').html(e.totalArr.user_count);
                        $('#bet_count').html(e.totalArr.bet_count);
                        $('#AllBet').html(e.totalArr.AllBet);
                        $('#validBetAmount').html(e.totalArr.validBetAmount);
                        $('#Profit').html(e.totalArr.Profit);
                        $('#upMoney').html(e.totalArr.upMoney);
                        $('#downMoney').html(e.totalArr.downMoney);
                        return e.data;
                    }
                },
                columns: columns,
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
                },
            });
        }
        dataTable = createTable(columns);

        var createdDate = {
            type: 'date',
            endCalendar: $('#issuedate'),
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
        };
        $('.timeStart').calendar(createdDate);
        $('.timeEnd').calendar(createdDate);

        $('.btn_search').click(function(){
            dataTable.ajax.reload();
        });
    });

    function info(productType,username){
        window.open('/back/control/reportManage/GamesApiUserBet_Tc?productType='+productType+'&username='+username);
        // parent.openIndex1 = layer.open({
        //     type: 2,
        //     title:false,
        //     content: '/back/control/reportManage/GamesApiUserBet_Tc?productType='+productType+'&username='+username,
        //     area: ['90%', '90%'],
        //     maxmin: false,
        // });
    }

</script>
</body>
</html>

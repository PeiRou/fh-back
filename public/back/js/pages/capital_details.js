var columns = [
    {data:'username',title:'用户'},
    {data:'order_id',title:'订单号'},
    {data:'created_at',title:'交易时间'},
    {data:'type',title:'交易类型'},
    {data:'money',title:'交易金额'},
    {data:'balance',title:'余额'},
    {data:'issue',title:'期号'},
    {data:'game_name',title:'游戏'},
    {data:'play_type',title:'玩法'},
    {data:'account',title:'操作人'},
    {data:'content',title:'备注'},
];

var text = {
    days: ['日', '一', '二', '三', '四', '五', '六'],
    months: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
    monthsShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
    today: '今天',
    now: '现在',
    am: 'AM',
    pm: 'PM'
};

var dataTable;

function createTable(columns) {
    return $('#capitalDetailsTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        destroy: true,
        aLengthMenu: [[50]],
        ajax: {
            url:'/back/datatables/capitalDetails',
            data:function (d) {
                d.time_point = $('#time_point').val();
                d.account = $('#account').val();
                d.game_id = $('#game').val();
                d.order_id = $('#order').val();
                d.issue = $('#issue').val();
                d.type = $('#type').val();
                d.amount_min = $('#amount_min').val();
                d.amount_max = $('#amount_max').val();
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
                d.recharges_id = $('#rechargesType').val();
            }
        },
        columns: columns,
        columnDefs: [ {
            "targets": 3,
            "createdCell": function (td, cellData, rowData, row, col) {
                if(cellData == '用户已被删除'){
                    $(td).parent().css('background', '#ffd6d6')
                }
            }
        }],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();

            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            var Total4 = api
                .column( 4 )
                .data()
                .reduce( function (a, b,c) {
                    return parseFloat((intVal(a) + intVal(data[c].c_money)).toFixed(2));
                }, 0 );
            // Update footer by showing the total with the reference of the column index
            $( api.column( 0 ).footer() ).html('总计');
            $( api.column( 4 ).footer() ).html(Total4);
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
        },
    });

}

$(function () {
    $('#menu-financeManage').addClass('nav-show');
    $('#menu-financeManage-capitalDetails').addClass('active');

    dataTable = createTable(columns);
    $('#btn_search').on('click',function () {
        if($('#game').val()){
            $('#type').val('t05');
        }
        var type = $('#type').val();
        var time_point = $('#time_point').val();
        var account = $('#account').val();
        var order = $('#order').val();
        var search = typeTable(type,time_point,account,order);

        if(search == true){
            dataTable.destroy();
            // 列改变了，需要清空table
            $("#capitalDetailsTable").empty();
            dataTable = createTable(columns);
            //dataTable.ajax.reload();
        }

    });


    $(document).keyup(function(e){
        var key = e.which;
        if(key == 13 || key == 32){
            if($('#game').val()){
                $('#type').val('t05');
            }
            var type = $('#type').val();
            var time_point = $('#time_point').val();
            var account = $('#account').val();
            var search = typeTable(type,time_point,account);

            if(search == true){
                dataTable.destroy();
                // 列改变了，需要清空table
                $("#capitalDetailsTable").empty();
                dataTable = createTable(columns);
                //dataTable.ajax.reload();
            }
        }
    });

    $('#rangestart').calendar({
        type: 'date',
        endCalendar: $('#startTime'),
        formatter: {
            date: function (date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                return year+'-'+month+'-'+day;
            }
        },
        text: text
    });
    $('#rangeend').calendar({
        type: 'date',
        startCalendar: $('#endTime'),
        formatter: {
            date: function (date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                return year+'-'+month+'-'+day;
            }
        },
        text: text
    });
    $('#type').on('change',function () {
        var value = $(this).val();
        if(value === 't18'){
            $('#rechargesType-div').show();
        }else{
            $('#rechargesType-div').hide();
        }
    });
    $('#time').hide();
    $('#time_point').on('change',function () {
        if($('#time_point').val()=='history'){
            var lastwomonthdate = getLasTwotMonthYestdy();
            $('#startTime').val(lastwomonthdate);
            $('#time').show();
        }else{
            $('#time').hide();
        }
    });
    $('#game').on('click',function () {
        $('#type').val('t05');
    });
    $('#reset').on('click',function () {
        $('#time_point').val('today');
        $('#account').val("");
        $('#game').val('');
        $('#order').val("");
        $('#issue').val("");
        $('#type').val('');
        $('#amount_min').val("");
        $('#amount_max').val("");
        var today = getDay(0, '-');
        $('#startTime').val(today);
        $('#endTime').val(today);
    });
});

function typeTable(type,time_point,account,order) {
    var search = true;
    if(type == ""){
        if(order != ""){
            var ordertype = '';
            if(order.slice(0,2) != 'BW' && order.slice(0,1) == 'B'){
                ordertype = '下注、奖金、撤单、解冻金额、冻结';
            }
            if(order.slice(0,2) == 'BW'){
                ordertype = '退水';
            }
            if(order.slice(0,3) != 'CNC' && order.slice(0,1) == 'C'){
                ordertype = '返利/手续费、活动、抢到红包、后台加钱、后台扣钱、棋牌上分、棋牌下分、冻结';
            }
            if(order.slice(0,2) == 'CN'){
                ordertype = '撤单';
            }
            if(order.slice(0,3) == 'CNC'){
                ordertype = '撤单[退水金额]';
            }
            if(order.slice(0,1) == 'D'){
                ordertype = '充值、提现、提现失败';
            }
            if(order.slice(0,2) == 'FC'){
                ordertype = '冻结[退水金额]';
            }
            if(order.slice(0,3) == 'PAY'){
                ordertype = '充值';
            }
            if(order.slice(0,2) == 'WS'){
                ordertype = '棋牌上分、棋牌下分';
            }
            alert('没有选择类型\n\n根据订单号类型，可选择 '+ordertype);
            search = false;
            return search;
        }
        alert('没有选择类型');
        search = false;
        return search;
    }
    if(time_point == 'history' && account == ''){
        alert('选择历史明细，请填写用户名');
        search = false;
        return search;
    }
    if(time_point == 'today'){
        var today = getDay(0, '-');
        $('#startTime').val(today);
        $('#endTime').val(today);
    }
    if(time_point == 'yesterday'){
        var yesterday = getDay(-1, '-');
        $('#startTime').val(yesterday);
        $('#endTime').val(yesterday);
    }
    if(type == 't01'){
        columns = [
            {data:'username',title:'用户'},
            {data:'order_id',title:'订单号'},
            {data:'created_at',title:'交易时间'},
            {data:'type',title:'交易类型'},
            {data:'money',title:'交易金额'},
            {data:'balance',title:'余额'},
            {data:'issue',title:'期号'},
            {data:'game_name',title:'游戏'},
            {data:'play_type',title:'玩法'},
            {data:'account',title:'操作人'},
            {data:'content',title:'备注'},
        ];
    }else if(type == 't02'){
        columns = [
            {data:'username',title:'用户'},
            {data:'order_id',title:'订单号'},
            {data:'created_at',title:'交易时间'},
            {data:'type',title:'交易类型'},
            {data:'money',title:'交易金额'},
        ];
    }else{
        columns = [
            {data:'username',title:'用户'},
            {data:'order_id',title:'订单号'},
            {data:'created_at',title:'交易时间'},
            {data:'type',title:'交易类型'},
            {data:'money',title:'交易金额'},
            {data:'balance',title:'余额'},
            {data:'issue',title:'期号'},
            {data:'game_name',title:'游戏'},
            {data:'play_type',title:'玩法'},
            {data:'account',title:'操作人'},
            {data:'content',title:'备注'},
        ];
    }
    return search;
}

function refreshTable(){
    window.location.href = '/back/control/financeManage/capitalDetails';
}

function getLasTwotMonthYestdy(){
    var date = new Date();
    var daysInMonth = new Array([0],[31],[28],[31],[30],[31],[30],[31],[31],[30],[31],[30],[31]);
    var strYear = date.getFullYear();
    var strDay = date.getDate();
    var strMonth = date.getMonth()+1;
    if(strYear%4 == 0 && strYear%100 != 0){
        daysInMonth[2] = 29;
    }
    if(strMonth - 1 == 0) {
        strYear -= 1;
        strMonth = 12;
    }else{
        strMonth -= 2;
    }
    strDay = daysInMonth[strMonth] >= strDay ? strDay : daysInMonth[strMonth];
    if(strMonth<10){
        strMonth="0"+strMonth;
    }
    if(strDay<10){
        strDay="0"+strDay;
    }
    var datastr = strYear+"-"+strMonth+"-"+strDay;
    return datastr;
}

function getDay(num, str) {
    var today = new Date();
    var nowTime = today.getTime();
    var ms = 24*3600*1000*num;
    today.setTime(parseInt(nowTime + ms));
    var oYear = today.getFullYear();
    var oMoth = (today.getMonth() + 1).toString();
    if (oMoth.length <= 1) oMoth = '0' + oMoth;
    var oDay = today.getDate().toString();
    if (oDay.length <= 1) oDay = '0' + oDay;
    return oYear + str + oMoth + str + oDay;
}

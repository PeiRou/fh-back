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

});

function typeTable(type,time_point,account) {
    var search = true;
    if(type == ""){
        alert('没有选择类型');
        search = false;
        return search;
    }
    if(time_point == 'history' && account == ''){
        alert('请填写用户名');
        search = false;
        return search;
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

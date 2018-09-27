/**
 * Created by vincent on 2018/2/14.
 */
$(function () {
    $('#menu-reportManage').addClass('nav-show');
    $('#menu-reportManage-user').addClass('active');

    var today = new Date();
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
        },
        minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 99),
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate())
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
        },
        minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 99),
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate())
    });

    dataTable = $('#reportUserTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: true,
        "order": [],
        aLengthMenu: [[100]],
        ajax: {
            url:'/back/datatables/reportUser',
            data:function (d) {
                d.game_id = $('#game').val();
                d.account = $('#account').val();
                d.timeStart = $('#timeStart').val();
                d.timeEnd = $('#timeEnd').val();
                d.minBunko = $('#minBunko').val();
                d.maxBunko = $('#maxBunko').val();
                d.chkTest = $('#chkTest').prop('checked')?$('#chkTest').val():'';
                d.chkDouble = $('#chkDouble').prop('checked')?$('#chkDouble').val():'';
                d.ag = $('#ag').val();
            }
        },
        columns: [
            {data:'user_account'},              //账号
            {data:'user_name'},              //全名
            {data:'agent_account'},             //上级代理
            {data:'recharges_money'},
            {data:'drawing_money'},
            {data:function (data) {         //笔数
                    return '<a href="/back/control/userManage/userBetList/'+data.user_id+'">'+data.bet_count+'</a>';
                }},
            {data:'bet_money'},             //投注金额
            {data:'bet_amount'},             //赢利投注金额
            {data:'activity_money'},
            {data:'handling_fee'},
            {data:'odds_amount'},           //代理赔率金额
            {data:'return_amount'},         //代理退水金额
            {data:'bet_bunko'},             //会员输赢（不包括退水）
            {data:'fact_return_amount'},   //实际退水
            {data:'fact_bet_bunko'},             //会员输赢（不包括退水）
        ],
        "pagingType": "full_numbers",
        language: {
            "zeroRecords": "暂无数据",
            "info": "当前显示第 _START_ 到 _END_ 笔数，总 _TOTAL_ 笔数，当前显示第 _PAGE_ 页，共 _PAGES_ 页",
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

    $(document).keyup(function(e){
        var key = e.which;
        if(key == 13 || key == 32){
            dataTable.ajax.reload();
        }
    });

    $('#btn_search').on('click',function () {
        dataTable.ajax.reload();
        footerTotal();
    });

    $('#reset').on('click',function () {
        $('#game').val("");
        $('#rechLevel').val("");
        $('#account').val("");
        $('#mobile').val("");
        $('#qq').val("");
        $('#minMoney').val("");
        $('#maxMoney').val("");
        $('#promoter').val("");
        $('#noLoginDays').val("");
        dataTable.ajax.reload();
        footerTotal();
    });

    function footerTotal() {
        $.ajax({
            url:'/back/datatables/reportUserTotal',
            type:'get',
            dataType:'json',
            data:{
                game_id : $('#game').val(),
                account : $('#account').val(),
                timeStart : $('#timeStart').val(),
                timeEnd : $('#timeEnd').val(),
                minBunko : $('#minBunko').val(),
                maxBunko : $('#maxBunko').val(),
                chkTest : $('#chkTest').prop('checked')?$('#chkTest').val():''
            },
            success:function (data) {
                $('#recharges_money').text(data.recharges_money);
                $('#drawing_money').text(data.drawing_money);
                $('#bet_count').text(data.bet_count);
                $('#bet_money').text(data.bet_money);
                $('#bet_amount').text(data.bet_amount);
                $('#activity_money').text(data.activity_money);
                $('#handling_fee').text(data.handling_fee);
                $('#bet_amount').text(data.bet_amount);
                $('#bet_bunko').text(data.bet_bunko);
                $('#fact_bet_bunko').text(data.fact_bet_bunko);
            }
        });
    }
    footerTotal();
});
/**
 * Created by vincent on 2018/2/14.
 */
$(function () {
    $('#menu-betManage').addClass('nav-show');
    $('#menu-betManage-today').addClass('active');

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

    dataTable = $('#betTodayTable').DataTable({
        searching: false,
        bLengthChange: false,
        aLengthMenu: [[50]],
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: {
            url:'/back/datatables/betToday',
            data:function (d) {
                d.searchType = $('#searchType').val();
                d.game = $('#game').val();
                d.playCate = $('#playCate').val();
                d.issue = $('#issue').val();
                d.status = $('#status').val();
                d.order = $('#order').val();
                d.username = $('#username').val();
                d.minMoney = $('#minMoney').val();
                d.maxMoney = $('#maxMoney').val();
                d.timeStart = $('#timeStart').val();
                d.timeEnd = $('#timeEnd').val();
            }
        },
        columns: [
            {data: 'order_id'},
            {data: 'created_at'},
            {data: 'user'},
            {data: 'game'},
            {data: 'issue'},
            {data: 'play'},
            {data: 'bet_money'},
            {data: 'agnet_odds'},
            {data: 'agent_rebate'},
            {data: 'bunko'},
            {data: 'platform'},
            {data: 'control'}
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
});

$('#btn_search').on('click',function () {
    dataTable.ajax.reload();
});

$('#game').on('change',function () {
    var gameId = $(this).val();
    $.ajax({
        url:'/today/selectData/playCate/'+gameId,
        type:'get',
        dataType:'json',
        success:function (result) {
            $('#playCate').empty();
            var str = '<option value="">全部</option>';
            result.forEach(function(item){
                str += '<option value="'+item.id+'">'+item.name+'</option>';
            });
            $("#playCate").html(str);
        }
    });
});
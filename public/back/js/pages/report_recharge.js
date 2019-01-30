$(function () {
    $('#menu-reportManage').addClass('nav-show');
    $('#menu-reportManage-recharge').addClass('active');
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
    dataTable = $('#dataTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        "order": [],
        aLengthMenu: [[100]],
        ajax: {
            url:'/back/datatables/reportRecharge',
            data:function (d) {
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
            }
        },
        columns: [
            {data:'date'},
            {data:'register_person'},
            {data:'register_member'},
            {data:'register_agent'},
            {data:'recharge_first'},
            {data:'recharge_second'},
            {data:'current_count'},
            {data:'current_money'},
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
        dataTable.ajax.reload();
        getTotal();
    });
    function getTotal(){
        var data = {};
        data.startTime = $('#startTime').val();
        data.endTime = $('#endTime').val();
        $.ajax({
            url:'/back/datatables/reportRechargeTotal',
            dataType:'json',
            type:'get',
            data:data,
            success:function(e){
                if(e.code == 0){
                    var data = e.data;
                    $('#countMember').html(data.countMember || 0);
                    $('#FirstTimeNum').html(data.FirstTimeNum || 0);
                    $('#Ramount').html(data.Ramount || 0);
                    $('#Damount').html(data.Damount || 0);
                    $('#bet_bunko').html(data.bet_bunko || 0);
                    $('#money').html(data.money || 0);
                }
            }
        })
    }
    getTotal();

});

function refreshTable(table) {
    dataTable.ajax.reload();
}
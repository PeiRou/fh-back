$(function () {
    $('#menu-reportManage').addClass('nav-show');
    $('#menu-reportManage-register').addClass('active');
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
            url:'/back/datatables/reportRegister',
            data:function (d) {
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
            }
        },
        columns: [
            {data:'name'},
            {data:function(e){
                return e.countMember || 0
                }},
            {data:function(e){
                return e.FirstTimeNum || 0
                }},
            {data:function(e){
                return e.Ramount || 0
                }},
            {data:function(e){
                return e.Damount || 0
                }},
            {data:function(e){
                return e.bet_bunko || 0
                }},
            {data:function(e){
                return e.money || 0
                }},
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
    });
    window.onload = function(){
        $.ajax({
            url:'/back/datatables/reportRegisterTotal',
            dataType:'json',
            type:'get',
            success:function(e){
                if(e.code == 0){
                    var data = e.data;
                    $('#countMember').html(data.countMember);
                    $('#FirstTimeNum').html(data.FirstTimeNum);
                    $('#Ramount').html(data.Ramount);
                    $('#Damount').html(data.Damount);
                    $('#bet_bunko').html(data.bet_bunko);
                    $('#money').html(data.money);
                }
            }
        })
    }
});

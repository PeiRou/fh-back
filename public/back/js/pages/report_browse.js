/**
 * Created by vincent on 2018/2/14.
 */
var text = {
    days: ['日', '一', '二', '三', '四', '五', '六'],
    months: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
    monthsShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
    today: '今天',
    now: '现在',
    am: 'AM',
    pm: 'PM'
};

$(function () {
    $('#menu-reportManage').addClass('nav-show');
    $('#menu-reportManage-browse').addClass('active');

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

    dataTable = $('#dataTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        "order": [],
        aLengthMenu: [[20]],
        ajax: {
            url:'/back/datatables/reportBrowse',
            data:function (d) {
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
                console.log(d)
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
        }
    });
    $('#btn_search').on('click',function () {
        dataTable.ajax.reload();
    });
});

function refreshTable(table) {
    dataTable.ajax.reload();
}

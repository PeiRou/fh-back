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

                day = day < 10 ? '0'+day : day;
                month = month < 10 ? '0'+month : month;
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

                day = day < 10 ? '0'+day : day;
                month = month < 10 ? '0'+month : month;
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
        aLengthMenu: [[5]],
        ajax: {
            url:'/back/datatables/reportBrowse',
            data:function (d) {
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
            }
        },
        columns: [
            {data:'domain',title:'站点域名'},
            {data:'day',title:'日期'},
            {data:'00:00:00',title:'00:00<br>~<br>00:59'},
            {data:'01:00:00',title:'01:00<br>~<br>01:59'},
            {data:'02:00:00',title:'02:00<br>~<br>02:59'},
            {data:'03:00:00',title:'03:00<br>~<br>03:59'},
            {data:'04:00:00',title:'04:00<br>~<br>04:59'},
            {data:'05:00:00',title:'05:00<br>~<br>05:59'},
            {data:'06:00:00',title:'06:00<br>~<br>06:59'},
            {data:'07:00:00',title:'07:00<br>~<br>07:59'},
            {data:'08:00:00',title:'08:00<br>~<br>08:59'},
            {data:'09:00:00',title:'09:00<br>~<br>09:59'},
            {data:'10:00:00',title:'10:00<br>~<br>10:59'},
            {data:'11:00:00',title:'11:00<br>~<br>11:59'},
            {data:'12:00:00',title:'12:00<br>~<br>12:59'},
            {data:'13:00:00',title:'13:00<br>~<br>13:59'},
            {data:'14:00:00',title:'14:00<br>~<br>14:59'},
            {data:'15:00:00',title:'15:00<br>~<br>15:59'},
            {data:'16:00:00',title:'16:00<br>~<br>16:59'},
            {data:'17:00:00',title:'17:00<br>~<br>17:59'},
            {data:'18:00:00',title:'18:00<br>~<br>18:59'},
            {data:'19:00:00',title:'19:00<br>~<br>19:59'},
            {data:'20:00:00',title:'20:00<br>~<br>20:59'},
            {data:'21:00:00',title:'21:00<br>~<br>21:59'},
            {data:'22:00:00',title:'22:00<br>~<br>22:59'},
            {data:'23:00:00',title:'23:00<br>~<br>23:59'},
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
        refreshTable();
    });
});

function refreshTable() {
    dataTable.ajax.reload(function ( d ) {
        var series = new Array();
        var legend = new Array();
        for (var i = 0, res = d.data, n = res.length; i<n; i++){
            legend[i] = res[i].domain;
            delete res[i].domain;
            delete res[i].day;
            var arr = new Array();
            for (e in res[i]){
                arr.push(res[i][e]);
            }
            series[i] = { name: legend[i], type:'line', stack: '总量', data: arr};
        }
        option.series = series;
        option.legend.data = legend;
        myChart.setOption(option);
    });
}

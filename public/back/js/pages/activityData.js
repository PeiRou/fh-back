var dataTable;

$(function () {
    
    $('#menu-activityManage').addClass('nav-show');
    $('#menu-activityManage-data').addClass('active');

    dataTable = $('#capitalDetailsTable').DataTable({
        aLengthMenu: [[50]],
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        destroy: true,
        ajax: {
            url:'/back/datatables/activity/data',
            data:function (d) {
                d.user_account = $('#user_account').val();
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
                d.activity_type = $('#activity_type').val();
            },
            dataSrc:function (json) {
                for ( var i=0, ien=json.data.length ; i<ien ; i++ ) {
                    json.data[i][0] = '<a href="/message/'+json.data[i][0]+'>View message</a>';
                }
                return json.data;
            }
        },
        columns: [
            {data:'day'},
            {data:'user_account'},
            {data:'activity_name'},
            {data:'prize_name'},
            {data:'activity_type'},
            {data:'prize_status_name'},
            {data:'continue_days'},
            {data:'created_at'},
            {data:'updated_at'}
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
        },
    });
    $(document).keyup(function(e){
        var key = e.which;
        if(key == 13 || key == 32){
            dataTable.ajax.reload();
        }
    });
    $('#btn_search').on('click',function () {
        dataTable.ajax.reload();

    });
    $('#reset').on('click',function () {
        $('#status').val('');
        $('#user_account').val('');
        $('#endTime').val('');
        dataTable.ajax.reload();

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
});
function statistics() {
    $.ajax({
        url:'/action/admin/activity/dailyStatistics',
        type:'post',
        dataType:'json',
        success:function (data) {
            if(data.status == true){
                Calert(data.msg,'green');
                $('#capitalDetailsTable').DataTable().ajax.reload(null,false);
            }else{
                Calert(data.msg,'red');
            }
        },
        error:function (e) {
            if(e.status == 403)
            {
                Calert('您没有此项权限！无法继续！','red')
            }
        }
    });
}
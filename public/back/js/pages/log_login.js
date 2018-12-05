$(function () {
    $('#menu-logManage').addClass('nav-show');
    $('#menu-logManage-login').addClass('active');

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

    dataTable = $('#loginLogTable').DataTable({
        searching: false,
        bLengthChange: false,
        ordering:false,
        processing: true,
        serverSide: true,
        aLengthMenu: [[25]],
        ajax: {
            url:'/back/datatables/log/login',
            data:function (d) {
                d.username = $('#username').val();
                d.ip = $('#ip').val();
                d.loginHost = $('#login_host').val();
                d.ipInfo = $('#ip_info').val();
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
            }
        },
        columns: [
            {data:'user_id'},
            {data:'username'},
            {data:'login_time'},
            {data:'ip'},
            {data:'ip_info'},
            {
                data:'type',
                render:function (data, type, row) {
                    if(data == 1){
                        return '电脑';
                    }
                    if(data == 2){
                        return '手机';
                    }
                    if(data == 3){
                        return 'iOS';
                    }
                    if(data == 4){
                        return 'Android';
                    }
                    if(data == 5){
                        return '其他';
                    }
                }
            },
            {data:'login_host'},
            {data:'logout_time'}
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

function refreshIp(id, ip, dom){//loading-gif
    $(dom).addClass('loading-gif ').html('')
    var data = {
        key : 'id',
        value : id,
        table : 'log_login',
        ip : ip,
        upKey : 'ip_info'
    };
    $.ajax({
        url:'/action/admin/refreshIp',
        type:'post',
        dataType:'json',
        data:data,
        success:function (data) {
            if(data.status == true){
                $('#loginLogTable').DataTable().ajax.reload(null,false);
            } else {
                Calert(data.msg,'red')
            }
            $(dom).removeClass('loading-gif ').html('刷新')
        },
        error:function (e) {
            $(dom).removeClass('loading-gif ').html('刷新')
            if(e.status == 403)
            {
                Calert('您没有此项权限！无法继续！','red')
            }
        }
    });
}
$(document).keyup(function(e){
    var key = e.which;
    if(key == 13 || key == 32){
        dataTable.ajax.reload();
    }
});

$('#btn_search').on('click',function () {
    dataTable.ajax.reload();
});
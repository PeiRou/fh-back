$(function () {
    $('#menu-logManage').addClass('nav-show');
    $('#menu-logManage-login').addClass('active');

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

$('#btn_search').on('click',function () {
    dataTable.ajax.reload();
});
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

            }
        },
        columns: [
            {data:'userId'},
            {data:'user'},
            {data:'login_time'},
            {data:'ip'},
            {data:'ip_info'},
            {data:'type'},
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
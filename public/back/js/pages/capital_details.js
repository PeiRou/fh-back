
$(function () {
    $('#menu-financeManage').addClass('nav-show');
    $('#menu-financeManage-capitalDetails').addClass('active');

    $('#capitalDetailsTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: '/back/datatables/capitalDetails',
        columns: [
            {}
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
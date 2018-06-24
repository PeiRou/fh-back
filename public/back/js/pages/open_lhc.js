$(function () {
    $('#menu-openManage').addClass('nav-show');
    $('#menu-openManage-lhc').addClass('active');

    dataTable = $('#lhcHistoryTable').DataTable({
        searching: false,
        bLengthChange: false,
        ordering:false,
        processing: true,
        serverSide: true,
        aLengthMenu: [[25]],
        ajax: {
            url:'/back/datatables/openHistory/lhc',
            data:function (d) {

            }
        },
        columns: [
            {data:'issue'},
            {data:'open_time'},
            {data:'n1'},
            {data:'n2'},
            {data:'n3'},
            {data:'n4'},
            {data:'n5'},
            {data:'n6'},
            {data:'n7'},
            {data:'sx'},
            {data:'total_num'},
            {data:'status'},
            {data:'control'}
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
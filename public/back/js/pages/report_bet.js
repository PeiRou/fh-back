$(function () {
    $('#menu-reportManage').addClass('nav-show');
    $('#menu-reportManage-bet').addClass('active');

    dataTable = $('#reportBetTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: true,
        "order": [],
        aLengthMenu: [[100]],
        ajax: {
            url:'/back/datatables/reportBet',
            data:function (d) {}
        },
        columns: [
            {data:'game_name'},
            {data:'sumMoney'},
            {data:'countBets'},
            {data:'countMember'},
            {data:function () {
                    return 0;
                }},
            {data:'sumWinBunko'},
            {data:'countWinBunkoBet'},
            {data:'countWinBunkoMember'},
            {data:'sumBunko'},
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
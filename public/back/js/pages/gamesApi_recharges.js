/**
 * Created by vincent on 2018/1/23.
 */

var dataTable;

$(function () {
    $('#menu-GamesApi').addClass('nav-show');
    $('#menu-GamesApi-recharges').addClass('active');

    dataTable = $('#tableBox').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering:false,
        aLengthMenu: [[50]],
        ajax: {
            url : '/back/datatables/GamesApiRecharges',
            data : function (d) {
                d.code = $('#code').val();
                d.g_id = $('#g_id').val();
                d.username = $('#username').val();
                d.order_id = $('#order_id').val();
            }
        },
        columns: [
            {data: 'id'},
            {data: 'username'},
            {data: 'g_id'},
            {data: 'game_id'},
            {data: 'order_id'},
            {data: 'type'},
            // {data: 'status'},
            {data: 'code'},
            {data: 'codeMsg'},
            {data: 'money'},
            {data: 'freeze_money'},
            {data: 'unfreeze_money'},
            {data: 'created_at'},
            {data: 'control'},

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
        pid = $('#pid').val();
        dataTable.ajax.reload();

    });

});
/**
 * Created by vincent on 2018/2/14.
 */
$(function () {
    $('.ui.checkbox').checkbox();
    $('#menu-betManage').addClass('nav-show');
    $('#menu-betManage-betRealTime').addClass('active');

    dataTable = $('#betRealTimeTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        aLengthMenu: [[25]],
        ajax: {
            url:'/back/datatables/betRealTime',
            data:function (d) {
                d.games = chk_value;
                d.issue = issue;
                d.username = username;
                d.minMoney = minMoney;
            }
        },
        columns: [
            {data: 'order_id'},
            {data: 'created_at'},
            {data: 'user'},
            {data: 'game'},
            {data: 'issue'},
            {data: 'play'},
            {data: 'bet_rebate'},
            {data: 'bet_money'}
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

chk_value =[];//定义一个数组
timer = $('#time').val();
issue = $('#issue').val();
username = $('#username').val();
minMoney = $('#minMoney').val();

$('#btn_hand_search').on('click',function () {
    timer = $('#time').val();
    issue = $('#issue').val();
    username = $('#username').val();
    minMoney = $('#minMoney').val();
    selectGames = $('input[name="gamesData"]').val();
    chk_value =[];//定义一个数组
    $('input[name="gamesData"]:checked').each(function(){//遍历每一个名字为interest的复选框，其中选中的执行函数
        chk_value.push($(this).val());//将选中的值添加到数组chk_value中
    });
    dataTable.ajax.reload();
});
$('#time').on('change',function () {
    timer = $(this).val();
});
setInterval(function () {
    dataTable.ajax.reload();
},timer);




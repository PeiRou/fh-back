var dataTable;

$(function () {

    $(".button-1").click(function(){
        $(".button-1 button").removeClass("active");
        // $(".button-1").find('input').removeAttr("checked");
        $(this).find('button').addClass("active");
        $(this).find('input').attr('checked', 'checked');
    });

    $('#menu-promotionManage').addClass('nav-show');
    $('#menu-promotionManage-review').addClass('active');

    dataTable = $('#capitalDetailsTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        destroy: true,
        ajax: {
            url:'/back/datatables/promotion/review',
            data:function (d) {
                d.promotion_account = $('#promotion_account').val();
                d.agent_account = $('#agent_account').val();
                d.level = $('#level').val();
                d.status = $('#status').val();
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
            }
        },
        columns: [
            {data:'date'},
            {data:'promotion_account'},
            {data:'bet_money'},
            {data:'fenhong_prop'},
            {data:'commission'},
            {data:'agent_account'},
            {data:'level'},
            {data:'sa_account'},
            {data:'status'},
            {data:'control'},
        ],
        columnDefs: [ {
            "targets": 3,
            "createdCell": function (td, cellData, rowData, row, col) {
                if(cellData == '用户已被删除'){
                    $(td).parent().css('background', '#ffd6d6')
                }
            }
        }],
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

function commit(id,status) {
    $.ajax({
        url:'/action/admin/promotion/submitTurnDown',
        type:'post',
        dataType:'json',
        data:{id:id,status:status},
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

function userHref(promotion) {
    window.location.href = '/back/control/userManage/user?promoter='+promotion;
}
var columns = [
    {data:'id',title:'id'},
    {data:'user_id',title:'操作人id'},
    {data:'username',title:'操作人名称'},
    {data:'type_name',title:'类型'},
    {data:'ip',title:'IP'},
    {data:'create_at',title:'时间'},
    {data:'action',title:'事件'},
];

var text = {
    days: ['日', '一', '二', '三', '四', '五', '六'],
    months: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
    monthsShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
    today: '今天',
    now: '现在',
    am: 'AM',
    pm: 'PM'
};

var dataTable;

function createTable(columns) {
    return $('#capitalDetailsTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        destroy: true,
        aLengthMenu: [[50]],
        ajax: {
            url:'/back/datatables/logHandle',
            data:function (d) {
                d.username = $('#username').val();
                d.type_id = $('#type_id').val();
                d.ip = $('#ip').val();
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
                d.action = $('#action').val();
                d.startHour = $('#startHour').val();
                d.endHour = $('#endHour').val();
            }
        },
        columns: columns,
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

}

$(function () {
    $('#menu-logManage').addClass('nav-show');
    $('#menu-logManage-handle').addClass('active');

    dataTable = createTable(columns);

    $('#btn_search').on('click',function () {
        dataTable.destroy();
        // 列改变了，需要清空table
        $("#capitalDetailsTable").empty();
        dataTable = createTable(columns);
        //dataTable.ajax.reload();
    });

    $(document).keyup(function(e){
        var key = e.which;
        if(key == 13 || key == 32){
            dataTable.destroy();
            // 列改变了，需要清空table
            $("#capitalDetailsTable").empty();
            dataTable = createTable(columns);
            //dataTable.ajax.reload();
        }
    });

    $('#reset').on('click',function () {
        $('#username').val('');
        $('#type_id').val('');
        $('#ip').val('');
        $('#startTime').val('');
        $('#endTime').val('');
        $('#action').val('');

        dataTable.destroy();
        // 列改变了，需要清空table
        $("#capitalDetailsTable").empty();
        dataTable = createTable(columns);
        //dataTable.ajax.reload();
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
        text: text
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
        text: text
    });
    for (var i = 0; i < 24; i++){
        $('#startHour').append('<option value="'+i+'">'+i+'点</option>');
    }
    $('#startHour').change(function(){
        $('#endHour').html('<option value="">时间</option>');
        var startHour = $('#startHour').val();
        if(startHour){
            for (var i = startHour; i < 24; i++){
                $('#endHour').append('<option value="'+i+'">'+i+'点</option>');
            }
        }
    })
});

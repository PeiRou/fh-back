$(function () {
    $('#menu-financeManage').addClass('nav-show');
    $('#menu-financeManage-drawingRecord').addClass('active');

    getTotalDrawing();

    $('#rangestart').calendar({
        type: 'date',
        endCalendar: $('#rangeend'),
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
        startCalendar: $('#rangestart'),
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

    dataTable = $('#drawingRecordTable').DataTable({
        aLengthMenu: [[50]],
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: {
            url:'/back/datatables/drawingRecord',
            data:function (d) {
                d.status = $('#status').val();
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
                d.account_type = $('#account_type').val();
                d.account_param = $('#account_param').val();
                d.rechLevel = $('#rechLevel').val();
                d.killTestUser = $('#killTestUser:checked').val();
            }
        },
        columns: [
            {data:'created_at'},
            {data:'process_date'},
            {data:'username'},
            {data:'rechLevel'},
            {data:'balance'},
            {data:'total_bet'},
            {data:'total_draw'},
            {data:'order_id'},
            {data:'liushui'},
            {data:'amount'},
            {data:'operation_account'},
            {data:'bank_info'},
            {data:'ip_info'},
            {data:'platform'},
            {data:'draw_type'},
            {data:'status'},
            {data:'control'},
        ],
        "columnDefs": [ {
            "targets": 3,
            "createdCell": function (td, cellData, rowData, row, col) {
                if(cellData == '用户已被删除'){
                    $(td).parent().css('background', '#ffd6d6')
                }
                // if ( cellData < 1 ) {
                //     $(td).css('color', 'red')
                // }
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
        }
    });
});

$('#btn_search').on('click',function () {
    dataTable.ajax.reload();
    getTotalDrawing();
});

function showUserInfo(uid) {
    jc = $.confirm({
        theme: 'material',
        title: '会员48小时内资金详情',
        closeIcon:true,
        boxWidth:'35%',
        content: 'url:/back/modal/user48hoursInfo/'+uid,
        buttons: {
            formSubmit: {
                text:'关闭',
                btnClass: 'btn-blue'
            }
        },
        contentLoaded: function(data, status, xhr){
            $('.jconfirm-content').css('overflow','hidden');
            if(xhr == 'Forbidden')
            {
                this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
                $('.jconfirm-buttons').hide();
            }
        }
    });
}

function getTotalDrawing() {
    var status = $('#status').val();
    var startDate = $('#startTime').val();
    var endDate = $('#endTime').val();
    var killTest = $('#killTestUser:checked').val();
    $.ajax({
        url:'/action/drawing/totalDrawing',
        type:'post',
        dataType:'json',
        data:{status:status,startDate:startDate,endDate:endDate,killTest:killTest},
        success:function (data) {
            $('#drawingTotal').html(data.total)
        }
    });
}

function pass(id) {
    jc = $.confirm({
        title: '确定通过此条提款申请吗？',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '请确认你的操作',
        buttons: {
            confirm: {
                text:'确定通过',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/passDrawing',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
                                Calert('提款申请状态已更新','green');
                                $('#drawingRecordTable').DataTable().ajax.reload(null,false)
                            } else {
                                Calert(data.msg,'red')
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
            },
            cancel:{
                text:'取消'
            }
        }
    });
}

function error(id) {
    jc = $.confirm({
        theme: 'material',
        title: '驳回用户提款申请',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/drawingError/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addDrawingErrorForm').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            }
        },
        contentLoaded: function(data, status, xhr){
            $('.jconfirm-content').css('overflow','hidden');
            if(xhr == 'Forbidden')
            {
                this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
                $('.jconfirm-buttons').hide();
            }
        }
    });
}

$('#date_param').on('change',function () {
    var data = $(this).val();
    $.ajax({
        url:'/recharge/selectData/dateChange/'+data,
        type:'get',
        dataType:'json',
        success:function (result) {
            $('#startTime').val(result.start);
            $('#endTime').val(result.end);
        }
    });
});

$('#account_type').on('change',function () {
    var account_type = $(this).val();
    if(account_type == "account"){
        $('#account_param').attr('placeholder','用户账号');
    }
    if(account_type == "orderNum"){
        $('#account_param').attr('placeholder','订单号');
    }
    if(account_type == "amount"){
        $('#account_param').attr('placeholder','交易金额');
    }
    if(account_type == "amount_fw"){
        $('#account_param').attr('placeholder','金额范围');
    }
    if(account_type == "operation_account"){
        $('#account_param').attr('placeholder','操作人账号');
    }
});
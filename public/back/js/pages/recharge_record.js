
$(function () {
    $('#menu-financeManage').addClass('nav-show');
    $('#menu-financeManage-rechargeRecord').addClass('active');

    getTotalRecharge();

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

    dataTable = $('#rechargeRecordTable').DataTable({
        aLengthMenu: [[50]],
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: {
            url:'/back/datatables/rechargeRecord',
            data:function (d) {
                d.isSearch = $('#isSearch').val();
                d.status = $('#status').val();
                d.pay_online_id = $('#pay_online_id').val();
                d.recharge_type = $('#recharge_type').val();
                d.account_type = $('#account_type').val();
                d.account_param = $('#account_param').val();
                d.amount = $('#amount').val();
                d.fullName = $('#fullName').val();
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
                d.killTestUser = $('#killTestUser:checked').val();
            }
        },
        columns: [
            {data:'created_at'},
            {data:'process_date'},
            {data:'user'},
            {data:'trueName'},
            {data:'balance'},
            {data:'orderNum'},
            {data:'payType'},
            {data:'amount'},
            {data:'operation_account'},
            {data:'shou_info'},
            {data:'ru_info'},
            {data:'status'},
            {data:'control'},
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
    if($('#recharge_type').val() == "" && $('#rechargeType').val() == "" && $('#status').val() == "" && $('#account_param').val() == "" && $('#amount').val() == "" && $('#fullName').val() == "" && $('#dateType').val() == "" && $('#startTime').val() == "" && $('#endTime').val() == "" && $('#date_param').val() == ""){
        Calert('请至少填写或选择一项筛选条件','orange');
    } else {
        $('#isSearch').val('yes');
        dataTable.ajax.reload();
    }
    getTotalRecharge();
});

function getTotalRecharge() {
    $('#onlinePayToday').html(" ");
    $('#offlinePayToday').html(" ");
    $('#onlinePayToday').addClass('loading-gif');
    $('#offlinePayToday').addClass('loading-gif');
    var rechType = $('#recharge_type').val();
    var payOnlineId = $('#pay_online_id').val();
    var startDate = $('#startTime').val();
    var endDate = $('#endTime').val();
    var killTest = $('#killTestUser:checked').val();
    $.ajax({
        url:'/action/recharge/totalRecharge',
        type:'post',
        dataType:'json',
        data:{rechType:rechType,payOnlineId:payOnlineId,startDate:startDate,endDate:endDate,killTest:killTest},
        success:function (data) {
            $('#rechargeTotal').html(data.total);
            setTimeout(function () {
                $('#onlinePayToday').removeClass('loading-gif');
                $('#offlinePayToday').removeClass('loading-gif');
                $('#onlinePayToday').html(data.onlinePayToday);
                $('#offlinePayToday').html(data.offlinePayToday);
            },600);
        }
    });
    // console.log(rechType+'==='+payOnlineId+'==='+startDate+'==='+endDate);
}

// $('#reset').on('click',function () {
//     $('#recharge_type').val("");
//     $('#rechargeType').val("");
//     $('#status').val("");
//     $('#account_param').val("");
//     $('#amount').val("");
//     $('#pay_online_id').val("");
//     $('#fullName').val("");
//     $('#dateType').val("");
//     $('#startTime').val("");
//     $('#endTime').val("");
//     $('#date_param').val("");
//     $('#isSearch').val('no');
//     dataTable.ajax.reload();
// });

function pass(id) {
    jc = $.confirm({
        title: '确定通过此条充值记录吗？',
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
                        url:'/action/admin/passRecharge',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
                                Calert('充值状态已更新','green');
                                $('#rechargeRecordTable').DataTable().ajax.reload(null,false)
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
        title: '驳回用户充值申请',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/rechargeError/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addRechargeErrorForm').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            }
        },
        contentLoaded: function(data, status, xhr){
            $('.jconfirm-content').css('overflow','hidden');
            if(data.status == 403)
            {
                this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
                $('.jconfirm-buttons').hide();
            }
        }
    });
}

function errorOnlinePay(id){
    jc = $.confirm({
        title: '驳回在线充值申请',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '此操作用于第三方支付无法回调时，手动添加用户充值的操作，点击【驳回】后，第三方恢复回调后，避免重复给用户添加余额！您确认要驳回吗？',
        buttons: {
            confirm: {
                text:'确定通过',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/passOnlineRecharge',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
                                Calert('充值状态已更新','green');
                                $('#rechargeRecordTable').DataTable().ajax.reload(null,false)
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

$('#recharge_type').on('change',function () {
    var rechargeType = $(this).val();
    if(rechargeType == ""){
        $('#onlineTypeDiv').hide();
        $('#pay_online_id').val('');
    } else if(rechargeType == "adminAddMoney") {
        $('#onlineTypeDiv').hide();
    } else {
        $.ajax({
            url:'/recharge/selectData/payOnline/'+rechargeType,
            type:'get',
            dataType:'json',
            success:function (result) {
                $('#onlineTypeDiv').show();
                $('#pay_online_id').empty();
                var str = '<option value="">全部</option>';
                result.forEach(function(item){
                    // str += $("#pay_online_id").append($("<option/>").text(item.payeeName).attr("value",item.id));
                    str += '<option value="'+item.id+'">'+item.payeeName+'</option>';
                });
                $("#pay_online_id").html(str);
            }
        });
    }
});

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
    if(account_type == "operation_account"){
        $('#account_param').attr('placeholder','操作人账号');
    }
});
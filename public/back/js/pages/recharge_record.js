
$(function () {
    $('#menu-financeManage').addClass('nav-show');
    $('#menu-financeManage-rechargeRecord').addClass('active');

    dataTable = $('#rechargeRecordTable').DataTable({
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
});

$('#reset').on('click',function () {
    $('#recharge_type').val("");
    $('#rechargeType').val("");
    $('#status').val("");
    $('#account_param').val("");
    $('#amount').val("");
    $('#pay_online_id').val("");
    $('#fullName').val("");
    $('#dateType').val("");
    $('#startTime').val("");
    $('#endTime').val("");
    $('#date_param').val("");
    $('#isSearch').val('no');
    dataTable.ajax.reload();
});

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
            if(xhr == 'Forbidden')
            {
                this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
                $('.jconfirm-buttons').hide();
            }
        }
    });
}

$('#recharge_type').on('change',function () {
    var rechargeType = $(this).val();
    if(rechargeType == ""){
        $('#onlineTypeDiv').hide();
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
                result.forEach(function(item){
                    $("#pay_online_id").append($("<option/>").text(item.payeeName).attr("value",item.id));
                });
            }
        });
    }
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
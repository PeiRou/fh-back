$(function () {
    $('#menu-financeManage').addClass('nav-show');
    $('#menu-financeManage-rechargeRecord').addClass('active');

    // var clipboard = new ClipboardJS('.copyUsername');
    // clipboard.on('success', function(e) {
    //     console.log(e)
    // });
    // clipboard.on('error', function(e) {
    //     alert('复制失败')
    // });
    // context.init({preventDoubleContext: false});
    // context.settings({compress: true});
    // context.attach('#rechargeRecordTable', [
    //     {header: '便捷菜单'},
    //     {text: '会员充值', href: '#'},
    //     {text: '会员信息', href: '#'},
    //     {divider: true},
    //     // {text: 'Disable This Menu', action: function(e){
    //     //         e.preventDefault();
    //     //         context.destroy('html');
    //     //         alert('html contextual menu destroyed!');
    //     //     }},
    //     // {text: 'Donate?', action: function(e){
    //     //         e.preventDefault();
    //     //         $('#donate').submit();
    //     //     }}
    // ]);

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
                d.recharges_id = $('#Recharges_id').val();
            }
        },
        columns: [
            {data:'created_at'},
            {data:'process_date'},
            {data:'user'},
            {data:'trueName'},
            {data:'balance'},
            {data:function (data) {
                    if(data.re_sysPayOrder==''||data.re_sysPayOrder==null)
                        return data.re_orderNum;
                    else
                        return data.re_orderNum + '<br><font color="red">商户的系统订单：</font>' + data.re_sysPayOrder;
                }},
            {data:'payType'},
            {data:'amount'},
            {data:'rebate_or_fee'},
            {data:'operation_account'},
            {data:'shou_info'},
            {data:'ru_info'},
            {data:'status'},
            {data:'control'},
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // computing column Total of the complete result
            var chkCount1 = 0;
            var chkCount2 = 0;
            var chkCount3 = 0;
            var chkCount4 = 0;
            var Total7 = api
                .column( 7 )
                .data()
                .reduce( function (a, b,c) {
                    var status = intVal(data[c].re_status);
                    switch (status){
                        case 1:
                            chkCount1 = chkCount1 + intVal(data[c].re_amount);
                            break;
                        case 2:
                            chkCount2 = chkCount2 + intVal(data[c].re_amount);
                            break;
                        case 3:
                            chkCount3 = chkCount3 + intVal(data[c].re_amount);
                            break;
                        case 4:
                            chkCount4 = chkCount4 + intVal(data[c].re_amount);
                            break;
                    }
                    if(chkCount2>0)
                        return (chkCount2).toFixed(2);
                    else if(chkCount1>0)
                        return (chkCount1).toFixed(2);
                    else if(chkCount3>0)
                        return (chkCount3).toFixed(2);
                    else if(chkCount4>0)
                        return (chkCount4).toFixed(2);
                }, 0 );

            var Total8 = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return parseFloat((intVal(a) + intVal(b)).toPrecision(12));
                }, 0 );

            // Update footer by showing the total with the reference of the column index
            $( api.column( 0 ).footer() ).html('总计');
            $( api.column( 7 ).footer() ).html(Total7);
            $( api.column( 8 ).footer() ).html(Total8);
            getTotalRecharge();
        },
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

    $(document).keyup(function(e){
        var key = e.which;
        if(key == 13 || key == 32){
            dataTable.ajax.reload();
        }
    });

    $('#recharge_type').on('change',function () {
        var value = $(this).val();
        if(value === 'adminAddMoney'){
            $('#Recharges_id-Div').show();
        }else{
            $('#Recharges_id-Div').hide();
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

function getTotalRecharge() {
    $('#onlinePayToday').html(" ");
    $('#offlinePayToday').html(" ");
    $('#rechargeTotal').html(" ");
    $('#rechargeGiveTotal').html(" ");
    $('#onlinePayToday').addClass('loading-gif');
    $('#offlinePayToday').addClass('loading-gif');
    $('#rechargeTotal').addClass('loading-gif');
    $('#rechargeGiveTotal').addClass('loading-gif');
    var rechType = $('#recharge_type').val();
    var payOnlineId = $('#pay_online_id').val();
    var startDate = $('#startTime').val();
    var endDate = $('#endTime').val();
    var killTest = $('#killTestUser:checked').val();
    var account = $('#account_param').val();
    $.ajax({
        url:'/action/recharge/totalRecharge',
        type:'post',
        dataType:'json',
        data:{rechType:rechType,payOnlineId:payOnlineId,startDate:startDate,endDate:endDate,killTest:killTest,account:account},
        success:function (data) {
            setTimeout(function () {
                $('#onlinePayToday').removeClass('loading-gif');
                $('#offlinePayToday').removeClass('loading-gif');
                $('#onlineMemberToday').removeClass('loading-gif');
                $('#offlineMemberToday').removeClass('loading-gif');
                $('#rechargeTotal').removeClass('loading-gif');
                $('#rechargeGiveTotal').removeClass('loading-gif');
                $('#onlinePayToday').html(data.onlinePayToday);
                $('#offlinePayToday').html(data.offlinePayToday);
                $('#onlineMemberToday').html(data.onlineMemberToday);
                $('#offlineMemberToday').html(data.offlineMemberToday);
                $('#rechargeTotal').html(data.total);
                $('#rechargeGiveTotal').html(data.rechargeGiveTotal);
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
                keys: ['enter', 'space'],
                action: function(){
                    $.ajax({
                        url:'/action/admin/passRecharge',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
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
                keys: ['enter', 'space'],
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
                text:'确定',
                btnClass: 'btn-red',
                keys: ['enter', 'space'],
                action: function(){
                    $.ajax({
                        url:'/action/admin/addRechargeError',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
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
                    if(item.status == 1){
                        str += '<option value="'+item.id+'">[√] '+item.payeeName+'</option>';
                    } else {
                        str += '<option value="'+item.id+'">[X] '+item.payeeName+'</option>';
                    }
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
    if(account_type == "sysOrderNum"){
    	$('#account_param').attr('placeholder','商户订单号');
    }
});

function excelRecharges() {
    var rechargesType = $('#recharge_type').val();
    var startTime = $('#startTime').val();
    var endTime = $('#endTime').val();
    switch (rechargesType) {
        case 'onlinePayment':
            var rechargesTypeName = '在线充值';
            break;
        case 'bankTransfer':
            var rechargesTypeName = '银行汇款';
            break;
        case 'alipay':
            var rechargesTypeName = '支付宝转账';
            break;
        case 'weixin':
            var rechargesTypeName = '微信转账';
            break;
        case 'cft':
            var rechargesTypeName = '财付通转账';
            break;
        case 'adminAddMoney':
            var rechargesTypeName = '后台加钱';
            break;
    }
    if(rechargesType == ''){
        Calert('请先选择充值类型，再尝试导出数据','red','error');
    } else {
        jc = $.confirm({
            title: '导出充值记录',
            theme: 'material',
            type: 'orange',
            boxWidth:'25%',
            content: '您选择了导出【'+startTime+' - '+endTime+'】范围内的【'+rechargesTypeName+'】数据，确定导出吗？',
            buttons: {
                confirm: {
                    text:'确定',
                    btnClass: 'btn-orange',
                    action: function(){
                        window.location.href = '/action/admin/exportExcel/userRecharges?startTime='+startTime+'&endTime='+endTime+'&rechargesType='+rechargesType;
                        // $.ajax({
                        //     url:'/action/admin/exportExcel/userRecharges',
                        //     type:'post',
                        //     dataType:'json',
                        //     data:{startTime:startTime,endTime:endTime,rechargesType:rechargesType},
                        //     success:function (data) {
                        //         if(data.status == true){
                        //             Calert('充值数据已导出','green');
                        //         } else {
                        //             Calert(data.msg,'red')
                        //         }
                        //     },
                        //     error:function (e) {
                        //         if(e.status == 403)
                        //         {
                        //             Calert('您没有此项权限！无法继续！','red')
                        //         }
                        //     }
                        // });
                    }
                },
                cancel:{
                    text:'取消'
                }
            }
        });
    }

}

function editLevels(uid,nowLevel,rid) {
    jc = $.confirm({
        theme: 'material',
        title: '修改会员层级',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/editUserLevels/'+uid+'/'+nowLevel,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#editUserLevelsForm').data('formValidation').validate().isValid();
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

function copyText(e) {
    $(e).addClass('red');
    copyToClipboard(e);
}

function copyToClipboard(elem) {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
        succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }

    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}
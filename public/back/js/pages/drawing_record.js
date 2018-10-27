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
                d.draw_type = $('#draw_type').val();
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
            "info": "共 _TOTAL_ 条记录,当前显示第 _PAGE_ 页，共 _PAGES_ 页",
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
            if(data.status == 403)
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
    var account_param = $('#account_param').val();
    var killTest = $('#killTestUser:checked').val();
    $.ajax({
        url:'/action/drawing/totalDrawing',
        type:'post',
        dataType:'json',
        data:{status:status,startDate:startDate,endDate:endDate,account_param:account_param,killTest:killTest},
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
                keys: ['enter', 'space'],
                action: function(){
                    $.ajax({
                        url:'/action/admin/passDrawing',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
                                $('#drawingRecordTable').DataTable().ajax.reload(null,false);
                                getTotalDrawing()
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

function passAuto(id) {
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
                keys: ['enter', 'space'],
                action: function(){
                    $.ajax({
                        url:'/action/admin/passDrawingAuto',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
                                $('#drawingRecordTable').DataTable().ajax.reload(null,false);
                                getTotalDrawing()
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
                keys: ['enter', 'space'],
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
            if(data.status == 403)
            {
                this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
                $('.jconfirm-buttons').hide();
            }
        }
    });
}

function errorAuto(id) {
    jc = $.confirm({
        theme: 'material',
        title: '驳回用户提款申请',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/drawingErrorAuto/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                keys: ['enter', 'space'],
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
            if(data.status == 403)
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

function dispensing(id,payId,name) {
    jc = $.confirm({
        title: '确定通过此条提款申请吗？（'+name+')',
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
                        url:'/action/admin/dispensingDrawing',
                        type:'post',
                        dataType:'json',
                        data:{id:id,payId:payId},
                        success:function (data) {
                            if(data.status == true){
                                $('#drawingRecordTable').DataTable().ajax.reload(null,false);
                                getTotalDrawing()
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

function addSubAccount() {
    var status = $('#status').val();
    var statusName = $("#status").find("option:selected").text();
    var draw_type = $('#draw_type').val();
    var account_type = $('#account_type').val();
    var account_param = $('#account_param').val();
    var rechLevel = $('#rechLevel').val();
    var bao_time = $('#bao_time').val();
    var startTime = $('#startTime').val();
    var endTime = $('#endTime').val();
    var killTestUser = $('#killTestUser').val();
    if(status == ''){
        Calert('请先选择提款状态，再尝试导出数据','red','error');
        return false;
    }
    jc = $.confirm({
        title: '导出充值记录',
        theme: 'material',
        type: 'orange',
        boxWidth:'25%',
        content: '您选择了导出【'+startTime+' - '+endTime+'】范围内的【'+statusName+'】数据，确定导出吗？',
        buttons: {
            confirm: {
                text:'确定',
                btnClass: 'btn-orange',
                action: function(){
                    window.location.href = '/action/admin/exportExcel/userDrawing?status='+status+'&draw_type='+draw_type+'&account_type='+account_type+'&account_param='+account_param+'&rechLevel='+rechLevel+'&bao_time='+bao_time+'&startTime='+startTime+'&endTime='+endTime+'&killTestUser='+killTestUser;
                }
            },
            cancel:{
                text:'取消'
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
$(function () {
    $('#menu-reportManage').addClass('nav-show');
    $('#menu-reportManage-CardNew').addClass('active');

    var today = new Date();
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
        },
        minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 99),
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate())
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
        },
        minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 99),
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate())
    });

    dataTable = $('#reportBetTable').DataTable({
        searching: false,
        bLengthChange: false,
        ordering:false,
        processing: true,
        serverSide: true,
        "order": [],
        aLengthMenu: [[100]],
        ajax: {
            url:'/back/datatables/reportCardNew',
            data:function (d) {
                d.startTime = $('#timeStart').val();
                d.endTime = $('#timeEnd').val();
                d.userAccount = $('#user_account').val();
                d.agent_account = $('#agent_account').val();
            }
        },
        columns: column,
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

    footerTotal();
});

$(document).keyup(function(e){
    var key = e.which;
    if(key == 13 || key == 32){
        dataTable.ajax.reload();
        footerTotal()
    }
});

$('#btn_search').on('click',function () {
    dataTable.ajax.reload();
    footerTotal()
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

function footerTotal() {
    $.ajax({
        url:'/back/datatables/reportCardNewTotal',
        type:'get',
        dataType:'json',
        data:{
            startTime : $('#timeStart').val(),
            endTime : $('#timeEnd').val(),
            user_account : $('#user_account').val(),
            agent_account : $('#agent_account').val(),
        },
        success:function (data) {
            for (var i=0;i<data.total.length;i++){
                $('#'+data.total[i].key).html(data.total[i].value);
            }
            $('#betCount').text(data.betCount);
            $('#betMoney').text(data.betMoney);
            $('#betMoney1').text(data.betMoney1);
            $('#betBunko').text(data.betBunko);
            $('#AllServiceMoney').text(data.AllServiceMoney);
        }
    });
}



// function getReport() {
//     jc = $.confirm({
//         theme: 'material',
//         title: '生成报表',
//         closeIcon:true,
//         boxWidth:'30%',
//         content: 'url:/back/modal/addReportCard',
//         buttons: {
//             formSubmit: {
//                 text:'确定提交',
//                 btnClass: 'btn-blue',
//                 action: function () {
//                     var form = this.$content.find('#addAgentForm').data('formValidation').validate().isValid();
//                     if(!form){
//                         return false;
//                     }
//                     return false;
//                 }
//             }
//         },
//         contentLoaded: function(data, status, xhr){
//             $('.jconfirm-content').css('overflow','hidden');
//             if(data.status == 403)
//             {
//                 this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
//                 $('.jconfirm-buttons').hide();
//             }
//         }
//     });
// }

function addSubAccount() {
    var startTime = $('#timeStart').val();
    var endTime = $('#timeEnd').val();
    var user_account = $('#user_account').val();
    jc = $.confirm({
        title: '导出投注记录',
        theme: 'material',
        type: 'orange',
        boxWidth:'25%',
        content: '您选择了导出【'+startTime+' - '+endTime+'】范围内的【投注报表】数据，确定导出吗？',
        buttons: {
            confirm: {
                text:'确定',
                btnClass: 'btn-orange',
                action: function(){
                    window.location.href = '/action/admin/exportExcel/CardNew?startTime='+startTime+'&endTime='+endTime+'&user_account='+user_account;
                }
            },
            cancel:{
                text:'取消'
            }
        }
    });
}

function exportUser() {
    jc = $.confirm({
        theme: 'material',
        title: '导出会员报表',
        closeIcon:true,
        boxWidth:'30%',
        content: 'url:/back/modal/exportReportCart',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addAgentForm').data('formValidation').validate().isValid();
                    if(form){
                        // jc.close();
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
$(function () {
    $('#menu-reportManage').addClass('nav-show');
    $('#menu-reportManage-Card').addClass('active');

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
        processing: true,
        serverSide: true,
        ordering: true,
        "order": [],
        aLengthMenu: [[100]],
        ajax: {
            url:'/back/datatables/reportCard',
            data:function (d) {
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
            },
            dataSrc:function (e) {
                $('#BetCountSum').html(e.totalArr.BetCountSum);
                $('#count_user').html(e.totalArr.count_user);
                $('#betMoney').html(e.totalArr.betMoney);
                $('#betBunko').html(e.totalArr.betBunko);
                $('#upMoney').html(e.totalArr.totalUp || '0.00');
                $('#downMoney').html(e.totalArr.totalDown || '0.00');
                return e.data;
            }
        },
        columns: [
            {data:'game_name'},
            {data:'user_account'},
            {data:'agent_account'},
            {data:'bet_count'},
            {data:'bet_money'},
            {data:'bet_bunko'},
            {data:function(e){
                return e.up_money || '0.00'
                }},
            {data:function(e){
                    return e.down_money || '0.00'
                }},
            {data:'date'}
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

$(document).keyup(function(e){
    var key = e.which;
    if(key == 13 || key == 32){
        dataTable.ajax.reload();
    }
});

$('#btn_search').on('click',function () {
    dataTable.ajax.reload();
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



function getReport() {
    jc = $.confirm({
        theme: 'material',
        title: '生成报表',
        closeIcon:true,
        boxWidth:'30%',
        content: 'url:/back/modal/addReportCard',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addAgentForm').data('formValidation').validate().isValid();
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
//
// function getReport(){
//     $.confirm({
//         title: '确定要重新获取昨日报表吗？',
//         theme: 'material',
//         type: 'orange',
//         boxWidth:'20%',
//         content: '手动获取将重新获取昨日报表',
//         buttons: {
//             confirm: {
//                 text:'确定',
//                 btnClass: 'btn-orange',
//                 action: function(){
//                     $.ajax({
//                         url:'/back/datatables/getReportCard',
//                         type:'get',
//                         data:{},
//                         dataType:'json',
//                         success:function (data) {
//                             if(data.status == true){
//                                 $('#reportBetTable').DataTable().ajax.reload(null,false)
//                             } else {
//                                 Calert(data.msg,'red')
//                             }
//                         }
//                     });
//                 }
//             },
//             cancel:{
//                 text:'取消'
//             }
//         }
//     });
// }


function addSubAccount() {
    var startTime = $('#startTime').val();
    var endTime = $('#endTime').val();
    jc = $.confirm({
        title: '导出充值记录',
        theme: 'material',
        type: 'orange',
        boxWidth:'25%',
        content: '您选择了导出【'+startTime+' - '+endTime+'】范围内的【投注报表】数据，确定导出吗？',
        buttons: {
            confirm: {
                text:'确定',
                btnClass: 'btn-orange',
                action: function(){
                    window.location.href = '/action/admin/exportExcel/Card?startTime='+startTime+'&endTime='+endTime;
                }
            },
            cancel:{
                text:'取消'
            }
        }
    });
}

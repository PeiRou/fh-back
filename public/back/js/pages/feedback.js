/**
 * Created by vincent on 2018/1/23.
 */

var dataTable;

$(function () {
    $('#menu-systemManage').addClass('nav-show');
    $('#menu-systemManage-feedback').addClass('active');

     dataTable = $('#example').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ajax: {
            url : '/back/datatables/feedback',
            data : function (d) {
                d.status = $('#status').val();
                d.type = $('#type').val();
                d.user_account = $('#user_account').val();
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
            }
        },
        columns: [
            {data: 'type'},
            {data: 'content'},
            {data: 'user_account'},
            {data: 'created_at'},
            {data: 'status'},
            {data: 'control'},
        ]
    });

    $('#btn_search').on('click',function () {
        dataTable.ajax.reload();
    });

    $('#reset').on('click',function () {
        $('#status').val('');
        $('#type').val('');
        $('#user_account').val('');
        $('#startTime').val('');
        $('#endTime').val('');
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

function view(id) {
    jc1 = $.confirm({
        theme: 'material',
        title: '查看详情',
        closeIcon:true,
        boxWidth:'50%',
        content: 'url:/back/modal/viewFeedback/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addArticleForm').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            }
        }
    });
}
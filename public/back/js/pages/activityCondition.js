var dataTable;
var layer,laydate;
$(function () {
    layui.use('layer', function(){
        layer = layui.layer;
    });
    layui.use('laydate', function(){
        laydate = layui.laydate;
    });
    $('#menu-activityManage').addClass('nav-show');
    $('#menu-activityManage-condition').addClass('active');

    dataTable = $('#capitalDetailsTable').DataTable({
        aLengthMenu: [[50]],
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        destroy: true,
        ajax: {
            url:'/back/datatables/activity/condition',
            data:function (d) {
                d.activity_id = $('#activity_id').val();
            }
        },
        columns: [
            {data:'name'},
            {data:'day'},
            {data:'money'},
            {data:'bet'},
            {data:'total_money'},
            {data:'control'}
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

function add() {
    jc1 = $.confirm({
        theme: 'material',
        title: '新增活动',
        closeIcon:true,
        boxWidth:'25%',
        content: 'url:/back/modal/addActivityCondition',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#editArticleForm').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            }
        }
    });
}

function edit(id,activity_id) {
    jc1 = $.confirm({
        theme: 'material',
        title: '修改活动',
        closeIcon:true,
        boxWidth:'25%',
        content: 'url:/back/modal/editActivityCondition/'+id+'/'+activity_id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#editArticleForm').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            }
        }
    });
}

function del(id,name,activity_id) {
    jc = $.confirm({
        title: '确定要删除【'+ name +'】吗？',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '请确认您的操作',
        buttons: {
            confirm: {
                text:'确定',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/activity/delCondition',
                        type:'post',
                        dataType:'json',
                        data:{
                            id:id,
                            activity_id:activity_id
                        },
                        success:function (data) {
                            if(data.status == true){
                                $('#capitalDetailsTable').DataTable().ajax.reload(null,false);
                            }else{
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


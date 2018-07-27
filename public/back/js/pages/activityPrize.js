var dataTable;

$(function () {
    
    $('#menu-activityManage').addClass('nav-show');
    $('#menu-activityManage-gift').addClass('active');

    dataTable = $('#capitalDetailsTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        destroy: true,
        ajax: {
            url:'/back/datatables/activity/prize',
            data:function (d) {
            }
        },
        columns: [
            {data:'id'},
            {data:'name'},
            {data:'type'},
            {data:'quantity'},
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
});

function add() {
    jc1 = $.confirm({
        theme: 'material',
        title: '新增奖品',
        closeIcon:true,
        boxWidth:'25%',
        content: 'url:/back/modal/addActivityPrize',
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

function edit(id) {
    jc1 = $.confirm({
        theme: 'material',
        title: '修改活动',
        closeIcon:true,
        boxWidth:'25%',
        content: 'url:/back/modal/editActivityPrize/'+id,
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


function del(id,name) {
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
                        url:'/action/admin/activity/delPrize',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
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
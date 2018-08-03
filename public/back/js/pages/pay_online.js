$(function () {
    $('#menu-payManage').addClass('nav-show');
    $('#menu-payManage-payOnline').addClass('active');

    $('#payOnlineTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        aLengthMenu: [[50]],
        ajax: '/back/datatables/payOnline',
        columns: [
            {data: 'payeeName'},
            {data: 'payType'},
            {data: 'apiId'},
            {data: 'res_url'},
            {data: 'status'},
            {data: 'levels'},
            {data: 'remark2'},
            {data: 'sort'},
            {data: 'control'},
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

function addPayOnline() {
    jc = $.confirm({
        theme: 'material',
        title: '添加在线支付配置',
        closeIcon:true,
        boxWidth:'26%',
        content: 'url:/back/modal/addPayOnline',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addPayOnlineForm').data('formValidation').validate().isValid();
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

function edit(id) {
    jc = $.confirm({
        theme: 'material',
        title: '修改在线支付配置',
        closeIcon:true,
        boxWidth:'26%',
        content: 'url:/back/modal/editPayOnline/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#editPayOnlineForm').data('formValidation').validate().isValid();
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

function status(id,nowStatus,name) {
    if(nowStatus == 1){
        var statusText = "停用"
    } else {
        var statusText = "正常"
    }
    jc = $.confirm({
        title: '确定要变更【'+ name +'】的状态为【' + statusText +'】吗？',
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
                        url:'/action/admin/changeOnlinePayStatus',
                        type:'post',
                        dataType:'json',
                        data:{id:id,status:nowStatus},
                        success:function (data) {
                            if(data.status == true){
                                $('#payOnlineTable').DataTable().ajax.reload(null,false)
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

function del(id,name) {
    jc = $.confirm({
        title: '确定要删除【'+ name +'】的支付配置吗？',
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
                        url:'/action/admin/delOnlinePay',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
                                $('#payOnlineTable').DataTable().ajax.reload(null,false)
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

function setSort() {
    var sort = new Array();
    var sortId = new Array();
    $("input[name='sort[]']").each(function (i,e) {
        sort.push(e.value);
    });
    $("input[name='sortId[]']").each(function (i,e) {
        sortId.push(e.value);
    });
    $.ajax({
        url:'/action/admin/setSort',
        type:'post',
        dataType:'json',
        data:{sort:sort,id:sortId},
        success:function (data) {
            if(data.status == true){
                $('#payOnlineTable').DataTable().ajax.reload(null,false);
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
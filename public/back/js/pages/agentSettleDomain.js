
$(function () {
    $('#menu-agentManage').addClass('nav-show');
    $('#menu-agentManage-domain').addClass('active');


    $('#editArticleForm').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        aLengthMenu: [[50]],
        ajax: '/back/datatables/agentSettle/domain',
        columns: [
            {data:'url'},
            {data:'name'},
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
        }
    });
});
function refreshTable(table) {
    $('#'+table).DataTable().ajax.reload(null,false);
}

function add() {
    jc = $.confirm({
        theme: 'material',
        title: '添加代理域名',
        closeIcon:true,
        boxWidth:'26%',
        content: 'url:/back/modal/addAgentSettleDomain',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addAgentSettleDomain').data('formValidation').validate().isValid();
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
        title: '添加代理地址',
        closeIcon:true,
        boxWidth:'26%',
        content: 'url:/back/modal/editAgentSettleDomain/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#editAgentSettleDomain').data('formValidation').validate().isValid();
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

function del(id,name) {
    jc = $.confirm({
        title: '确定要删除【'+ name +'】的域名吗？',
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
                        url:'/action/admin/agentSettle/delAgentSettleDomain',
                        type:'post',
                        dataType:'json',
                        data:{agent_domain_id:id},
                        success:function (data) {
                            if(data.status == 1){
                                $('#editArticleForm').DataTable().ajax.reload(null,false);
                            } else {
                                Calert(data.msg,'red');
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

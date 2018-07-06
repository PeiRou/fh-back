/**
 * Created by vincent on 2018/1/26.
 */
$(function () {
    $('#menu-userManage').addClass('nav-show');
    $('#menu-userManage-agent').addClass('active');

    $('#agentTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        ordering:false,
        serverSide: true,
        ajax: '/back/datatables/agent',
        columns: [
            {data:'online'},
            {data:'general_agent'},
            {data:'agent'},
            {data:'members'},
            {data:'balance'},
            {data:'status'},
            {data:'editOdds'},
            {data:'created_at'},
            {data:'updated_at'},
            {data:'login'},
            {data:'content'},
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
    })
});

function addAgent() {
    jc = $.confirm({
        theme: 'material',
        title: '添加代理',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/addAgent',
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
            if(xhr.status == 403)
            {
                this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
                $('.jconfirm-buttons').hide();
            }
        }
    });
}

function seeContent(id) {
    jc = $.confirm({
        theme: 'material',
        title: '备注详情',
        closeIcon:true,
        boxWidth:'30%',
        content: 'url:/back/modal/agentContent/'+id,
        buttons: {
            formSubmit: {
                text:'关闭',
                btnClass: 'btn-blue'
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

function viewInfo(id) {
    jc = $.confirm({
        theme: 'material',
        title: '代理资料详情',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/agentInfo/'+id,
        buttons: {
            formSubmit: {
                text:'关闭',
                btnClass: 'btn-blue'
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

function changeAgentMoney(id) {
    jc = $.confirm({
        theme: 'material',
        title: '修改代理金额',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/changeAgentMoney/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#changeAgentMoneyForm').data('formValidation').validate().isValid();
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

function capital(id) {
    jc = $.confirm({
        theme: 'material',
        title: '资金明细',
        closeIcon:true,
        boxWidth:'70%',
        content: 'url:/back/modal/agentCapitalHistory/'+id,
        buttons: {
            formSubmit: {
                text:'关闭'
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

function del(id,agentName) {
    jc = $.confirm({
        title: '确定要删除代理【'+ agentName +'】的信息吗？',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '这是一个需要注意的操作，删除此代理账号后，该代理账号下存在的所有会员，将会自动转到系统默认总代理账号下',
        buttons: {
            confirm: {
                text:'确定删除',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/delAgent/'+id,
                        type:'post',
                        dataType:'json',
                        success:function (data) {
                            if(data.status == true){
                                $('#agentTable').DataTable().ajax.reload(null,false)
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

function edit(id) {
    jc = $.confirm({
        theme: 'material',
        title: '修改代理资料',
        closeIcon:true,
        boxWidth:'30%',
        content: 'url:/back/modal/editAgent/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#editAgentForm').data('formValidation').validate().isValid();
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
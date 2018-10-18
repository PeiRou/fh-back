/**
 * Created by vincent on 2018/1/24.
 */
$(function () {
    $('#menu-userManage').addClass('nav-show');
    $('#menu-userManage-subaccount').addClass('active');

    var data = $('#onlineUserDataInput').val();
    var accountId = $('#accountIdInput').val();

    $('#subAccountTable').DataTable({
        aLengthMenu: [[50]],
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: true,
        "order": [],
        ajax: '/back/datatables/subaccount',
        columns: [
            {data: 'online'},
            {data: 'account'},
            {data: 'name'},
            {data: 'role'},
            {data: 'status'},
            {data: 'created_at'},
            {data: 'updated_at'},
            {data: 'control'}
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
        fnInitComplete:function (o) {
            // $.each(JSON.parse(data),function(index,data) {
            //     $('#user_'+index).html("<span class='tag-online'>在线</span>");
            // });
        }
    });
});



function addSubAccount() {
    jc = $.confirm({
        theme: 'material',
        title: '添加子账号',
        closeIcon:true,
        boxWidth:'25%',
        content: 'url:/back/modal/addSubAccount',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addSubAccountForm').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            }
        },
        contentLoaded: function(data, status, xhr){
            if(data.status == 403)
            {
                this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
                $('.jconfirm-buttons').hide();
            }
        }
    });
}

function edit(id) {
    var url = '/back/modal/editSubAccount/'+id;
    Cmodal('修改子账号','22%',url,true,'editSubAccountForm');
}

function google(id) {
    var url = '/back/modal/googleSubAccount/'+id;
    Cmodal('Google双重验证','22%',url,false,'');
}

function del(id,account) {
    jc= $.confirm({
        title: '确定删除子账号【'+account+'】？',
        theme: 'material',
        type: 'red',
        boxWidth:'20%',
        content: '删除后账号将无法登录，且无法恢复，请谨慎操作！',
        buttons: {
            confirm: {
                text:'确认删除',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/delSubAccount',
                        type:'post',
                        dataType:'json',
                        data:{'id':id},
                        success:function (data) {
                            if(data.status == true)
                            {
                                if(data.msg == 'logout'){
                                    location.href = '/back/control'
                                } else {
                                    refreshTable('subAccountTable');
                                    jc.close();
                                }
                            } else {
                                Calert(data.msg,'red');
                            }
                        }
                    });
                    return false;
                }
            },
            cancel:{
                text:'取消'
            }
        }
    });
}

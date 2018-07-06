/**
 * Created by vincent on 2018/1/29.
 */
$(function () {
    $('#menu-userManage').addClass('nav-show');
    $('#menu-userManage-user').addClass('active');

    $(document).keyup(function(event){
        if(event.keyCode == 13){
            dataTable.ajax.reload();
            getTotalMoney();
        }
    });

    getTotalMoney();

    dataTable = $('#userTable').DataTable({
        searching: false,
        bLengthChange: false,
        ordering:false,
        processing: true,
        serverSide: true,
        aLengthMenu: [[50]],
        ajax: {
            url:'/back/datatables/user',
            data:function (d) {
                d.status = $('#status').val();
                d.rechLevel = $('#rechLevel').val();
                d.agent = $('#agent').val();
                d.account = $('#account').val();
                d.mobile = $('#mobile').val();
                d.qq = $('#qq').val();
                d.minMoney = $('#minMoney').val();
                d.maxMoney = $('#maxMoney').val();
                d.promoter = $('#promoter').val();
                d.noLoginDays = $('#noLoginDays').val();
            }
        },
        columns: [
            {data:'online'},
            {data:'user'},
            {data:'agent'},
            {data:'promoter'},
            {data:'rechLevel'},
            {data:'balance'},
            {data:'status'},
            {data:'created_at'},
            {data:'updated_at'},
            {data:'saveOrDraw'},
            {data:'saveMoneyCount'},
            {data:'drawMoneyCount'},
            {data:'noLoginDays'},
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
    });
    
    $('#btn_search').on('click',function () {
        dataTable.ajax.reload();
        getTotalMoney();
    });
    // $('#reset').on('click',function () {
    //     $('#status').val("");
    //     $('#rechLevel').val("");
    //     $('#account').val("");
    //     $('#mobile').val("");
    //     $('#qq').val("");
    //     $('#minMoney').val("");
    //     $('#maxMoney').val("");
    //     $('#promoter').val("");
    //     $('#noLoginDays').val("");
    //     dataTable.ajax.reload();
    // });
});

function getTotalMoney() {
    $.ajax({
        url:'/action/userMoney/totalUserMoney',
        type:'post',
        dataType:'json',
        data:{},
        success:function (data) {
            $('#moneyTotal').html(data.total)
        }
    });
}

function editLevels(uid,nowLevel) {
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

function addUser() {
    jc = $.confirm({
        theme: 'material',
        title: '添加会员',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/addUser',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addUserForm').data('formValidation').validate().isValid();
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

function delUser(id,username) {
    jc = $.confirm({
        title: '确定要删除会员【'+ username +'】的信息吗？',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '您确定要执行删除操作吗？会员账号删除后，无法恢复，请谨慎操作！',
        buttons: {
            confirm: {
                text:'确定删除',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/delUser/'+id,
                        type:'post',
                        dataType:'json',
                        success:function (data) {
                            if(data.status == true){
                                $('#userTable').DataTable().ajax.reload(null,false)
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

function changeAgent(id,username) {
    jc = $.confirm({
        theme: 'material',
        title: '更换会员【'+username+'】代理',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/userChangeAgent/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#userChangeAgentForm').data('formValidation').validate().isValid();
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

function changeFullName(id) {
    jc = $.confirm({
        theme: 'material',
        title: '修改会员姓名',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/userChangeFullName/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#userChangeFullNameForm').data('formValidation').validate().isValid();
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

function viewInfo(id) {
    jc = $.confirm({
        theme: 'material',
        title: '查看详情',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/viewUserInfo/'+id,
        buttons: {
            formSubmit: {
                text:'关闭'
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

function seeContent(id) {
    var url = '/back/modal/viewUserContent/'+id;
    Cmodal('查看备注','22%',url,false);
}

function changeUserMoney(id) {
    var url = '/back/modal/changeUserMoney/'+id;
    Cmodal('会员余额变更','22%',url,true,'changeUserMoneyForm');
}

function userCapital(id) {
    var url = '/back/modal/userCapitalHistory/'+id;
    Cmodal('资金明细','70%',url,false);
}

function edit(id) {
    var url = '/back/modal/editUserInfo/'+id;
    Cmodal('修改会员资料','30%',url,true,'editUserForm');
}
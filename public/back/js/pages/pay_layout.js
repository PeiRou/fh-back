/**
 * Created by vincent on 2018/3/14.
 */
$(function () {
    $('#menu-payManage').addClass('nav-show');
    $('#menu-payManage-payLayout').addClass('active');

    $('#levelTable').DataTable({
        aLengthMenu: [[50]],
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: '/back/datatables/level',
        columns: [
            {data: 'value'},
            {data: 'name'},
            {data: 'oneRechMoney'},
            {data: 'allRechMoney'},
            {data: 'oneDrawMoney'},
            {data: 'allDrawMoney'},
            {data: 'status'},
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
        }
    });
});

function addLevel() {
    jc = $.confirm({
        theme: 'material',
        title: '添加支付层级',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/addLevel',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addLevelForm').data('formValidation').validate().isValid();
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

function searchExchange(id) {
    jc = $.confirm({
        theme: 'material',
        title: '条件转移',
        closeIcon:true,
        boxWidth:'40%',
        content: 'url:/back/modal/rechargeConditionalTransfer/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addBankForm').data('formValidation').validate().isValid();
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
    var url = '/back/modal/editLevel/'+id;
    Cmodal('修改支付层级','20%',url,true,'editLevelForm');
}

function allExchange(id) {
    var url = '/back/modal/allExchangeLevel/'+id;
    Cmodal('全部转移','20%',url,true,'allExchangeLevelForm');
}

function del(id) {
    $.ajax({
        url:'/action/admin/delLevelCheck',
        type:'post',
        dataType:'json',
        data:{id:id},
        success:function (result) {
            $.confirm({
                title: '删除操作警告？',
                theme: 'material',
                type: 'red',
                boxWidth:'20%',
                content: result.msg,
                buttons: {
                    confirm: {
                        text:'确定删除',
                        btnClass: 'btn-red',
                        action: function(){
                            loader(true);
                            $.ajax({
                                url:'/action/admin/delLevel',
                                type:'post',
                                dataType:'json',
                                data:{id:id},
                                success:function (data) {
                                    if(data.status == true){
                                        loader(false);
                                        $('#levelTable').DataTable().ajax.reload(null,false);
                                    } else {
                                        loader(false);
                                        Calert(data.msg,'red');
                                    }
                                }
                            });
                            return true;
                        }
                    },
                    cancel:{
                        text:'取消操作'
                    }
                }
            });
        }
    })
}

function clearInput() {
    $('#oneRechMoney').val("");
    $('#allRechMoney').val("");
    $('#oneDrawMoney').val("");
    $('#allDrawMoney').val("");
}
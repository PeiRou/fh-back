$(function () {
    $('#menu-payManage').addClass('nav-show');
    $('#menu-payManage-rechargeWay').addClass('active');

    $('#rechargeWayTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: '/back/datatables/rechargeWay',
        columns: [
            {data: 'id'},
            {data: 'type'},
            {data: 'value'},
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

function addRechargeWay() {
    jc = $.confirm({
        theme: 'material',
        title: '添加充值方式',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/addRechargeWay',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addRechargeWayForm').data('formValidation').validate().isValid();
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

function edit(id) {
    var url = '/back/modal/editRechargeWay/'+id;
    Cmodal('修改充值方式','20%',url,true,'editRechargeWayForm');
}

function del(id,name) {
    jc = $.confirm({
        title: '确定要删除【'+ name +'】的充值配置吗？',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '您确定要执行删除操作吗？删除后，无法恢复，请谨慎操作！',
        buttons: {
            confirm: {
                text:'确定删除',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/delRechargeWay',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
                                $('#rechargeWayTable').DataTable().ajax.reload(null,false)
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
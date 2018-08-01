$(function () {
    $('#menu-systemManage').addClass('nav-show');
    $('#menu-systemManage-whitelist').addClass('active');

    $('#articleTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: '/back/datatables/whitelist',
        columns: [
            {data:'ip'},
            {data:'content'},
            {data:'updated_at'},
            {data:'admin_account'},
            {data:'control'},
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

function add() {
    jc = $.confirm({
        theme: 'material',
        title: '添加ip白名单',
        closeIcon:true,
        boxWidth:'28%',
        content: 'url:/back/modal/addWhitelist',
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
    jc1 = $.confirm({
        theme: 'material',
        title: '修改ip白名单',
        closeIcon:true,
        boxWidth:'46%',
        content: 'url:/back/modal/editWhitelist/'+id,
        buttons: {
            formSubmit: {
                text:'确定修改',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#editArticleForm').data('formValidation').validate().isValid();
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

function del(id) {
    jc = $.confirm({
        title: '确定要删除该ip吗？',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '您确定要执行删除操作吗？文章删除后，无法恢复，请谨慎操作！',
        buttons: {
            confirm: {
                text:'确定删除',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/delWhitelist',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
                                $('#articleTable').DataTable().ajax.reload(null,false)
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
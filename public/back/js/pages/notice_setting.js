/**
 * Created by vincent on 2018/3/14.
 */
$(function () {
    $('#menu-noticeManage').addClass('nav-show');
    $('#menu-noticeManage-noticeSetting').addClass('active');

    $('#noticeTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        aLengthMenu: [[50]],
        ajax: '/back/datatables/notice',
        columns: [
            {data: 'id'},
            {data: 'title'},
            {data: 'content'},
            {data: 'type'},
            {data: 'created_at'},
            {data: 'updated_at'},
            {data: 'userLevel'},
            {data: 'sort'},
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

function addNotice() {
    jc = $.confirm({
        theme: 'material',
        title: '添加公告',
        closeIcon:true,
        boxWidth:'30%',
        content: 'url:/back/modal/addNotice',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addNoticeForm').data('formValidation').validate().isValid();
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
    jc= $.confirm({
        title: '确定删除此公告吗？',
        theme: 'material',
        type: 'red',
        boxWidth:'20%',
        content: '删除后无法恢复，请谨慎操作！',
        buttons: {
            confirm: {
                text:'确认删除',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/delNoticeSetting',
                        type:'post',
                        dataType:'json',
                        data:{'id':id},
                        success:function (data) {
                            if(data.status == true)
                            {
                                refreshTable('noticeTable');
                                jc.close();
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

function edit(id) {
    jc = $.confirm({
        theme: 'material',
        title: '修改公告',
        closeIcon:true,
        boxWidth:'30%',
        content: 'url:/back/modal/editNotice/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addNoticeForm').data('formValidation').validate().isValid();
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
        url:'/action/admin/setNoticeOrder',
        type:'post',
        dataType:'json',
        data:{sort:sort,id:sortId},
        success:function (data) {
            if(data.status == true){
                $('#noticeTable').DataTable().ajax.reload(null,false);
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
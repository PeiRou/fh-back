/**
 * Created by vincent on 2018/3/14.
 */
$(function () {
    $('#menu-noticeManage').addClass('nav-show');
    $('#menu-noticeManage-messageSend').addClass('active');
    $('#noticeTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        aLengthMenu: [[30]],
        ajax: '/back/datatables/sendMessage',
        columns: [
            {
                data: function (data) {
                    return '<input data-id="' + data.id + '" type="checkbox" value="' + data.id + '"  />';
                }
            },
            {data: 'id'},
            {data: 'title'},
            {data: 'content'},
            {data: 'user_type'},
            {data: 'message_type'},
            {data: 'user_level'},
            {data: 'user_str'},
            {data: 'created_at'},
            {data: 'updated_at'},
            {data: 'control'}
        ],
        language: {
            "zeroRecords": "暂无数据",
            "info": "当前显示第 _PAGE_ 页，共 _PAGES_ 页",
            "infoEmpty": "没有记录",
            "loadingRecords": "请稍后...",
            "processing": "读取中...",
            "paginate": {
                "first": "首页",
                "last": "尾页",
                "next": "下一页",
                "previous": "上一页"
            }
        }
    });
});
$('#messageCheckbox').click(function () {
    var messageTbody = $('#messageTbody').find(":checkbox");
    var isChecked = $(this).prop("checked");
    if (isChecked) {
        messageTbody.prop('checked', true);
    } else {
        messageTbody.prop('checked', false);
    }
});

/**
 * 批量删除
 */
function batchDelSendMessage() {
    var ids = [];
    $('#messageTbody input[type=checkbox]:checked').each(function (e) {
        var message_ids = $(this).attr('data-id');
        ids.push(message_ids);
    });
    var ids_str =  ids.join(',');
    if(ids_str.length == 0){
        Calert('请选择一个删除项', 'red');
        return false;
    }
    jc = $.confirm({
        title: '确定删除此信息吗？',
        theme: 'material',
        type: 'red',
        boxWidth: '20%',
        content: '删除后无法恢复，请谨慎操作！',
        buttons: {
            confirm: {
                text: '确认删除',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: '/batchDelSendMessage',
                        type: 'get',
                        data: {message_ids:ids_str},
                        dataType: 'json',
                        success: function (data) {
                            if (data.code == 0){
                                refreshTable('noticeTable');
                                jc.close();
                            }else{
                                Calert(data.msg, 'red');
                            }
                        }
                    });
                    return false;
                }
            },
            cancel: {
                text: '取消'
            }
        }
    });
}


function del(id) {
    jc = $.confirm({
        title: '确定删除此信息吗？',
        theme: 'material',
        type: 'red',
        boxWidth: '20%',
        content: '删除后无法恢复，请谨慎操作！',
        buttons: {
            confirm: {
                text: '确认删除',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: '/action/admin/delSendMessage',
                        type: 'post',
                        dataType: 'json',
                        data: {'id': id},
                        success: function (data) {
                            if (data.status == true) {
                                refreshTable('noticeTable');
                                jc.close();
                            } else {
                                Calert(data.msg, 'red');
                            }
                        }
                    });
                    return false;
                }
            },
            cancel: {
                text: '取消'
            }
        }
    });
}


function addSendMessage() {
    jc = $.confirm({
        theme: 'material',
        title: '添加消息',
        closeIcon: true,
        boxWidth: '30%',
        content: 'url:/back/modal/addSendMessage',
        buttons: {
            formSubmit: {
                text: '确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addNoticeForm').data('formValidation').validate().isValid();
                    if (!form) {
                        return false;
                    }
                    return false;
                }
            }
        },
        contentLoaded: function (data, status, xhr) {
            $('.jconfirm-content').css('overflow', 'hidden');
            if (data.status == 403) {
                this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
                $('.jconfirm-buttons').hide();
            }
        }
    });
}



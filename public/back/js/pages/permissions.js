/**
 * Created by vincent on 2018/1/23.
 */
$(function () {
    $('#menu-systemManage').addClass('nav-show');
    $('#menu-systemManage-permissions').addClass('active');

    $('#example').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        aLengthMenu: [[50]],
        ajax: '/back/datatables/premissions',
        columns: [
            {data: 'id'},
            {data: 'name'},
            {data: 'group_name'},
            {data: 'created_at'},
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

function addPermission() {
    jc1 = $.confirm({
        theme: 'material',
        title: '添加权限',
        closeIcon:true,
        boxWidth:'25%',
        content: 'url:/back/modal/addPermission',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addPermissionForm').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            }
        }
    });
}

function edit(id) {
    jc1 = $.confirm({
        theme: 'material',
        title: '修改权限',
        closeIcon:true,
        boxWidth:'25%',
        content: 'url:/back/modal/editPermission/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#editPermissionForm').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            }
        }
    });
}
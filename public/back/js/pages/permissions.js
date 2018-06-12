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
        ajax: '/back/datatables/premissions',
        columns: [
            {data: 'id'},
            {data: 'name'},
            {data: 'group_name'},
            {data: 'created_at'}
        ]
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
                    alert(1);
                    return false;
                }
            }
        }
    });
}
/**
 * Created by vincent on 2018/1/24.
 */
$(function () {
    $('#menu-systemManage').addClass('nav-show');
    $('#menu-systemManage-role').addClass('active');

    $('#roleTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ajax: '/back/datatables/roles',
        columns: [
            {data: 'id'},
            {data: 'name'},
            {data: 'type'},
            {data: 'created_at'}
        ]
    });
});

function addRole() {
    jc2 = $.confirm({
        theme: 'material',
        title: '添加角色',
        closeIcon:true,
        boxWidth:'25%',
        content: 'url:/back/modal/addRole',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addRoleForm').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            }
        }
    });
}
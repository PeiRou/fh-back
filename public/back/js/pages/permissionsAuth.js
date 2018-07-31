/**
 * Created by vincent on 2018/1/23.
 */

var dataTable;
var pid = $('#exampleAuthId').val();

$(function () {
    $('#menu-systemManage').addClass('nav-show');
    $('#menu-systemManage-permissionsAuth').addClass('active');

     dataTable = $('#example').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        aLengthMenu: [[50]],
        ajax: {
            url : '/back/datatables/premissionsAuth',
            data : function (d) {
                d.pid = pid;
                d.route_name = $('#route_name').val();
            }
        },
        columns: [
            {data: 'id'},
            {data: 'auth_name'},
            {data: 'route_name'},
            {data: 'type_name'},
            {data: 'open'},
            {data: 'created_at'},
            {data: 'control'},
        ]
    });

    $('#btn_search').on('click',function () {
        pid = $('#pid').val();
        dataTable.ajax.reload();

    });

    $('#reset').on('click',function () {
        $('#pid').val('');
        pid = 0;
        $('#route_name').val('');
        dataTable.ajax.reload();

    });
});

function addPermission() {
    jc1 = $.confirm({
        theme: 'material',
        title: '添加权限',
        closeIcon:true,
        boxWidth:'25%',
        content: 'url:/back/modal/addPermissionAuth',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addPermissionAuthForm').data('formValidation').validate().isValid();
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
        content: 'url:/back/modal/editPermissionAuth/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#editPermissionAuthForm').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            }
        }
    });
}

function jumpHref(id) {
    pid = id;
    $('#exampleAuthId').val(id);
    dataTable.ajax.reload();
}
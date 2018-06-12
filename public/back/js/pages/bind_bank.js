/**
 * Created by vincent on 2018/1/27.
 */
$(function () {
    $('#menu-payManage').addClass('nav-show');
    $('#menu-payManage-bindBank').addClass('active');

    $('#bankTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ajax: '/back/datatables/bank',
        columns: [
            {data:'bank_id'},
            {data:'bank_icon'},
            {data:'name'},
            {data:'eng_name'},
            {data:'status'},
            {data:'control'}
        ]
    })
});

function addBank() {
    jc = $.confirm({
        theme: 'material',
        title: '添加银行',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/addBank',
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
            if(xhr == 'Forbidden')
            {
                this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
                $('.jconfirm-buttons').hide();
            }
        }
    });
}
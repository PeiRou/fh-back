$(function () {
    $('#menu-financeManage').addClass('nav-show');
    $('#menu-financeManage-drawingRecord').addClass('active');

    $('#drawingRecordTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: '/back/datatables/drawingRecord',
        columns: [
            {data:'created_at'},
            {data:'process_date'},
            {data:'username'},
            {data:'rechLevel'},
            {data:'balance'},
            {data:'total_bet'},
            {data:'order_id'},
            {data:'liushui'},
            {data:'amount'},
            {data:'operation_account'},
            {data:'bank_info'},
            {data:'ip_info'},
            {data:'platform'},
            {data:'draw_type'},
            {data:'status'},
            {data:'control'},
        ],
        "columnDefs": [ {
            "targets": 3,
            "createdCell": function (td, cellData, rowData, row, col) {
                if(cellData == '用户已被删除'){
                    $(td).parent().css('background', '#ffd6d6')
                }
                // if ( cellData < 1 ) {
                //     $(td).css('color', 'red')
                // }
            }
        }],
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

function pass(id) {
    jc = $.confirm({
        title: '确定通过此条提款申请吗？',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '请确认你的操作',
        buttons: {
            confirm: {
                text:'确定通过',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/passDrawing',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
                                Calert('提款申请状态已更新','green');
                                $('#drawingRecordTable').DataTable().ajax.reload(null,false)
                            } else {
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
            },
            cancel:{
                text:'取消'
            }
        }
    });
}

function error(id) {
    jc = $.confirm({
        theme: 'material',
        title: '驳回用户提款申请',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/drawingError/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addDrawingErrorForm').data('formValidation').validate().isValid();
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
/**
 * Created by vincent on 2018/1/23.
 */

var dataTable;

$(function () {
    $('#menu-GamesApi').addClass('nav-show');
    $('#menu-GamesApi-List').addClass('active');

    dataTable = $('#tableBox').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        aLengthMenu: [[50]],
        ajax: {
            url : '/back/datatables/GameApiList',
            data : function (d) {

            }
        },
        columns: [
            {data: 'name'},
            {data: 'type_id'},
            {data: 'alias'},
            {data: 'class_name'},
            {data: 'description'},
            {data: function(e){
                return e.status == 1 ? '开启' : '关闭';
                }},
            {data: 'created_at'},
            {data: function(e){
                return '<span class="edit-link" style="color:#4183c4" onclick="edit('+e.g_id+')">修改</span> | ' +
                    '<span class="edit-link" style="color:#4183c4" onclick="del('+e.g_id+')">删除</span>';
                }},
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

    $(document).keyup(function(e){
        var key = e.which;
        if(key == 13 || key == 32){
            dataTable.ajax.reload();
        }
    });
});

function add() {
    jc = $.confirm({
        theme: 'material',
        title: '添加配置',
        closeIcon:true,
        boxWidth:'40%',
        content: 'url:/back/modal/editGameApi',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#formBox').data('formValidation').validate().isValid();
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
    jc = $.confirm({
        theme: 'material',
        title: '修改配置',
        closeIcon:true,
        boxWidth:'40%',
        content: 'url:/back/modal/editGameApi?g_id='+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#formBox').data('formValidation').validate().isValid();
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
        title: '确定要删除吗？',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '请确认您的操作',
        buttons: {
            confirm: {
                text:'确定',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/gamesApi/del',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.code == 0){
                                dataTable.ajax.reload(null,false)
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
            },
            cancel:{
                text:'取消'
            }
        }
    });
}
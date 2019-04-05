/**
 * Created by vincent on 2018/1/23.
 */

var dataTable;

$(function () {
    $('#menu-GamesApi').addClass('nav-show');
    $('#menu-GamesApi-errorBet').addClass('active');

    dataTable = $('#tableBox').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering:false,
        aLengthMenu: [[50]],
        ajax: {
            url : '/back/datatables/openHistory/errorBet',
            data : function (d) {

            }
        },
        columns: [
            {data: 'g_name'},
            {data: 'code'},
            {data: 'codeMsg'},
            // {data: 'param'},
            {data: 'resNum'},
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

    $(document).keyup(function(e){
        var key = e.which;
        if(key == 13 || key == 32){
            dataTable.ajax.reload();
        }
    });
});
function editStatus(id,status){
    jc = $.confirm({
        title: '确定要改变吗？',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '请确认您的操作',
        buttons: {
            confirm: {
                text:'确定',
                btnClass: 'btn-red',
                action: function(){
                    var data = {
                        id:id,
                        status: status == 1 ? 0 : 1,
                    };
                    $.ajax({
                        url: '/action/admin/gamesApi/editParameter',
                        data:data,
                        type:'post',
                        dataType:'json',
                        success:function(e){
                            if(e.code == 0){
                                // Calert('状态修改成功','green')
                                dataTable.ajax.reload();
                            }else{
                                Calert(e.msg,'red')
                            }
                        }
                    })
                }
            },
            cancel:{
                text:'取消'
            }
        }
    });
}
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
//重新获取失败注单
function reGetBet(id){
    var index = layer.load(1, {
        shade: [0.1, '#ccc'] //0.1透明度的白色背景
    });
    $.ajax({
        url: '/back/GamesApi/reGetBet/'+id,
        type: 'get',
        dataType:'text',
        success: function (data) {
            layer.close(index);
            dataTable.ajax.reload(null, false);
        },
        error:function(){
            layer.close(index);
        }
    });
}
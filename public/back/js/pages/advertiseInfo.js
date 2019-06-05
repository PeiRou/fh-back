/**
 * Created by vincent on 2018/1/23.
 */

var dataTable;

$(function () {
    $('#menu-systemManage').addClass('nav-show');
    $('#menu-systemManage-advertiseInfo').addClass('active');

    dataTable = $('#example').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: true,
        "order": [],
        aLengthMenu: [[50]],
        ajax: {
            url : '/back/datatables/advertiseInfo',
            data : function (d) {
                d.ad_id = $('#ad_id').val();
            }
        },
        columns: [
            {data: 'title'},
            {data: 'js_title'},
            {data: 'type'},
            {data: 'js_key'},
            {data: 'content'},
            {data: 'status'},
            {data: 'sort'},
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

    $('#btn_search').on('click',function () {
        dataTable.ajax.reload();
    });
});

function add() {
    jc = $.confirm({
        theme: 'material',
        title: '添加广告位内容',
        closeIcon:true,
        boxWidth:'80%',
        content: 'url:/back/modal/addAdvertiseInfo',
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
        title: '修改广告位内容',
        closeIcon:true,
        boxWidth:'80%',
        content: 'url:/back/modal/editAdvertiseInfo/'+id,
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
                        url:'/action/admin/delAdvertiseInfo',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
                                dataTable.ajax.reload(null,false)
                            }else{
                                alert(data.msg);
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

function closeAd(id) {
    jc = $.confirm({
        title: '确定要关闭吗？',
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
                        url:'/action/admin/closeAdvertiseInfo',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
                                dataTable.ajax.reload(null,false)
                            }else{
                                alert(data.msg);
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

function openAd(id) {
    jc = $.confirm({
        title: '确定要开启吗？',
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
                        url:'/action/admin/openAdvertiseInfo',
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.status == true){
                                dataTable.ajax.reload(null,false)
                            }else{
                                alert(data.msg);
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

function generate() {
    $.ajax({
        url:'/action/admin/generateAdvertiseInfo',
        type:'post',
        dataType:'json',
        data:{},
        success:function (data) {
            Calert('已生成新的文件','green')
        },
        error:function (e) {
            if(e.status == 403)
            {
                Calert('您没有此项权限！无法继续！','red')
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
        url:'/action/admin/sortAdvertiseInfo',
        type:'post',
        dataType:'json',
        data:{sort:sort,id:sortId},
        success:function (data) {
            if(data.status == true){
                dataTable.ajax.reload(null,false);
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
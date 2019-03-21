/**
 * Created by vincent on 2018/1/23.
 */

var dataTable;
var pid = $('#exampleAuthId').val();

$(function () {
    $('#menu-GamesApi').addClass('nav-show');
    $('#menu-GamesApi-games-list').addClass('active');

     dataTable = $('#example').DataTable({
         ordering: false,
         searching: false, //去掉搜索框
         bLengthChange: false,//去掉每页多少条框体
         processing: true,
         serverSide: true,
        aLengthMenu: [[50]],
        ajax: {
            url : '/back/datatables/GamesApiGamesList',
            data : function (d) {
                d.pid = $('#pid').val();
            }
        },
        columns: [
            {data: 'pid'},
            {data: 'game_id'},
            {data: 'name'},
            // {data: 'type'},
            {data: 'open'},
            {data: 'sort'},
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

function add() {
    jc1 = $.confirm({
        theme: 'material',
        title: '添加权限',
        closeIcon:true,
        boxWidth:'25%',
        content: 'url:/back/modal/addGamesApiList',
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
                        url:'/back/modal/delGamesApiList?id='+id,
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        success:function (data) {
                            if(data.code == 0){
                                dataTable.ajax.reload()
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

function edit(id) {
    jc1 = $.confirm({
        theme: 'material',
        title: '修改权限',
        closeIcon:true,
        boxWidth:'25%',
        content: 'url:/back/modal/addGamesApiList?id='+id,
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

function sort(){
    var data = [];
    $('.sort').each(function(k, i){
        data.push({
            id:$(i).attr('data-id'),
            val:$(i).val()
        });
    });
    $.ajax({
        url:'/back/modal/sortGamesApiList',
        data:{
            sort:data
        },
        dataType:'json',
        type:'get',
        success:function(e){
            if(e.code == 0){
                dataTable.ajax.reload(null,false)
            }else{
                Calert(e.msg,'red')
            }
        }
    })
}

function editSwitch(id,status){
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
                        url: '/back/modal/switchGamesApiList',
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
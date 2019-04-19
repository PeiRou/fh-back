var sort = false;
var sort = true;
var tempDepNames = new Array;

$(function(){
    $('#menu-GamesApi').addClass('nav-show');
    $('#menu-GamesApi-games-list').addClass('active');
    var zTreeObj;
    var setting = {
        check: {
            enable: true,
            autoCheckTrigger: true,
            chkboxType: { "Y": "ps", "N": "ps" }
        },
        data:{
            simpleData: {
                enable: true
            }
        },
        view: {
            expandSpeed: "",
            showIcon: false,
            nameIsHTML: true,
            addDiyDom: addDiyDom,
        },
        callback: {
            onCheck: zTreeOnCheck//复选框选中
        }
    };

    zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes,);
    function zTreeOnCheck(){
        var nodes = zTreeObj.getCheckedNodes(true);
        $(nodes).each(function(index, obj) {
            tempDepNames.push(obj.game_id)
        });
        $('#permission_selected').val(tempDepNames);
    }
    zTreeObj.expandAll(true);
    $('.sort').on('input',function(){
        $(this).val($(this).val().replace(/[^\d]/g,''))
    })
})
function save(){
    if(tempDepNames.length <= 0){
        Calert('没有任何更改','red')
    }
    $.ajax({
        url: '/back/modal/switchGamesApiList',
        data:{
            list:tempDepNames.join(',')
        },
        type:'post',
        dataType:'json',
        success:function(e){
            if(e.code == 0){
                location.href = location.href
            }else{
                Calert(e.msg,'red')
            }
        }
    })
}

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
                                // dataTable.ajax.reload()
                                location.href = location.href
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

function sort1(){
    console.log(sort);
    if(sort == false){
        return $('.sort').show(),sort = true;
    }
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
                // dataTable.ajax.reload(null,false)
                location.href = location.href
            }else{
                Calert(e.msg,'red')
            }
        }
    })
}

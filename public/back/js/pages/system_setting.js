$(function () {
    $('#menu-systemManage').addClass('nav-show');
    $('#menu-systemManage-setting').addClass('active');

});

$('.edit-link').on('click',function () {
    var _this = $(this).attr('data-id');
    var _thisTitle = $(this).attr('data-c');
    var _that = $("input[data-id-input='"+_this+"']").val();
    jc = $.confirm({
        title: '操作提示',
        theme: 'material',
        type: 'orange',
        boxWidth:'25%',
        content: '确定修改配置【'+ _thisTitle +'】的信息吗？',
        buttons: {
            confirm: {
                text:'确定修改',
                btnClass: 'btn-orange',
                action: function(){
                    $.ajax({
                        url:'/action/admin/systemSetting/edit',
                        type:'post',
                        dataType:'json',
                        data:{id:_this,data:_that},
                        success:function (data) {
                            if(data.status == true){
                                setTimeout(function () {
                                    location.reload();
                                },1500)
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
});
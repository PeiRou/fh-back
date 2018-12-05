$(function () {
    $('#menu-userManage').addClass('nav-show');
    $('#menu-userManage-online').addClass('active');

    $('#onlineUserTable').DataTable({
        aLengthMenu: [[50]],
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: '/back/datatables/onlineUser',
        columns: [
            {data: 'online'},
            {data: 'account'},
            {data: 'userType'},
            {data: 'money'},
            {data: 'status'},
            {data: 'created_at'},
            {data: 'lastLoginTime'},
            {data: 'login_ip'},
            {data: 'login_ip_info'},
            {data: 'login_host'},
            {data: 'login_client'},
            {data: 'control'}
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
});

function refreshIp(id, ip, dom){//loading-gif
    $(dom).addClass('loading-gif ').html('')
    var data = {
        key : 'id',
        value : id,
        table : 'users',
        ip : ip,
        upKey : 'login_ip_info'
    };
    $.ajax({
        url:'/action/admin/refreshIp',
        type:'post',
        dataType:'json',
        data:data,
        success:function (data) {
            if(data.status == true){
                $('#onlineUserTable').DataTable().ajax.reload(null,false);
            } else {
                Calert(data.msg,'red')
            }
            $(dom).removeClass('loading-gif ').html('刷新')
        },
        error:function (e) {
            $(dom).removeClass('loading-gif ').html('刷新')
            if(e.status == 403)
            {
                Calert('您没有此项权限！无法继续！','red')
            }
        }
    });
}
function getOut(userid,username) {
    jc = $.confirm({
        title: '确定要让会员【'+username+'】下线吗？',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '请确认您的操作',
        buttons: {
            confirm: {
                text:'确定踢下线',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/getOutUser',
                        type:'post',
                        dataType:'json',
                        data:{id:userid},
                        success:function (data) {
                            if(data.status == true){
                                Calert(data.msg,'green');
                                $('#onlineUserTable').DataTable().ajax.reload(null,false)
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
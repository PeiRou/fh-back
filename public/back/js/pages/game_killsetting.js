/**
 * Created by vincent on 2018/2/1.
 */
$(function () {
    $('#menu-gameManage').addClass('nav-show');
    $('#menu-gameManage-killSetting').addClass('active');

    $('#gamesTable').DataTable({
        aLengthMenu: [[20]],
        searching: false,
        bLengthChange: false,
        processing: true,
        ordering:false,
        serverSide: true,
        ajax: '/back/datatables/gamekillsetting',
        columns: [
            {data:'game_id'},
            {data:'game_name'},
            {data:function(data){
                    switch (parseInt(data.is_open)){
                        case 1:
                            var txt = "开杀中";
                            clsName = 3;      //红色
                            break;
                        case 0:
                            var txt = "已关闭";
                            clsName = 1;      //绿色
                            break;
                    }
                    return '<span class="status-'+clsName+'">'+txt+'</span>';
                }},
            {data:'bet_money'},
            {data:'bet_lose'},
            {data:'bet_win'},
            {data:function (data) {
                    var rate = (data.real_rate * 100).toFixed(2);
                    if(data.real_rate<data.kill_rate)
                        clsName = 3;         //红色
                    else
                        clsName = 6;         //红色
                    var txt = rate+'%';
                    return '<span class="status-'+clsName+'">'+txt+'</span>';
                }},
            {data:function (data) {
                    var rate = (data.kill_rate * 100).toFixed(0);
                    return rate+'%';
                }},
            {data:'updated_at'},
            {data:function (data) {
                    litxt = "";
                    if(data.is_open==1)          //----关闭
                        litxt = litxt + "<li onclick='closeKill("+data.excel_base_idx+")'><span class='status-3'>关闭</span></li>";
                    else if(data.is_open==0)
                        litxt = litxt + "<li onclick='openKill("+data.excel_base_idx+")'><span class='status-1'>开启</span></li>";
                    litxt = litxt + "<li onclick='setKill("+data.excel_base_idx+")'>修改</li>";
                    return "<ul class='control-menu'>" + litxt + "</ul>";
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
    })
});

//修改杀率
function setKill(id) {
    jc = $.confirm({
        theme: 'material',
        title: '修改杀率保留营利比',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/killSetting/'+id,
        buttons: {
            confirm: {
                text: '提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#gameSettingForm').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            },
            cancel: {
                text:'关闭'
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

//关闭杀率
function closeKill(id) {
    jc = $.confirm({
        title: '提示',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '确定要关闭这个彩种的杀率吗?',
        buttons: {
            confirm: {
                text:'确定关闭',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/killStatus',
                        data: {
                            id:id,
                            type:0
                        },
                        type:'post',
                        dataType:'json',
                        success:function (data) {
                            if(data.status == true){
                                $('#gamesTable').DataTable().ajax.reload(null,false)
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

//开启杀率
function openKill(id) {
    jc = $.confirm({
        title: '提示',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '确定要开启这个彩种的杀率吗?',
        buttons: {
            confirm: {
                text:'确定开启',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/killStatus',
                        data: {
                            id:id,
                            type:1
                        },
                        type:'post',
                        dataType:'json',
                        success:function (data) {
                            if(data.status == true){
                                $('#gamesTable').DataTable().ajax.reload(null,false)
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
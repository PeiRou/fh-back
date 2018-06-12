/**
 * Created by vincent on 2018/2/1.
 */
$(function () {
    $('#menu-gameManage').addClass('nav-show');
    $('#menu-gameManage-gameSetting').addClass('active');

    $('#gamesTable').DataTable({
        aLengthMenu: [[20]],
        searching: false,
        bLengthChange: false,
        processing: true,
        ordering:false,
        serverSide: true,
        ajax: '/back/datatables/games',
        columns: [
            {data:'game_id'},
            {data:'game_name'},
            {data:'holiday_start'},
            {data:'holiday_end'},
            {data:'order'},
            {data:'fengpan'},
            {data:'status'},
            {data:'control'}
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

function setting(id) {
    var url = '/back/modal/gameSetting/'+id;
    Cmodal('游戏设置选项','22%',url,true,'gameSettingForm');
}

function fengpan(id,type,title) {
    if(type == 1)
    {
        var AlertTitle = "确定变更游戏【"+title+'】的状态为【开盘】吗？'
    } else {
        var AlertTitle = "确定变更游戏【"+title+'】的状态为【封盘】吗？'
    }
    jc = $.confirm({
        title: AlertTitle,
        theme: 'material',
        type: 'orange',
        boxWidth:'27%',
        content: '请确定你的本次操作！',
        buttons: {
            confirm: {
                text:'变更',
                btnClass: 'btn-orange',
                action: function(){
                    $.ajax({
                        url:'/action/admin/changeGameFengPan',
                        type:'post',
                        dataType:'json',
                        data:{id:id,type:type},
                        success:function (data) {
                            if(data.status == true)
                            {
                                jc.close();
                                $('#gamesTable').DataTable().ajax.reload(null,false);
                            }
                        }
                    });
                    return false;
                }
            },
            cancel:{
                text:'取消'
            }
        }
    });
}

function status(id,type,title) {
    if(type == 1)
    {
        var AlertTitle = "确定变更游戏【"+title+'】的状态为【开启】吗？'
    } else {
        var AlertTitle = "确定变更游戏【"+title+'】的状态为【停用】吗？'
    }
    jc = $.confirm({
        title: AlertTitle,
        theme: 'material',
        type: 'orange',
        boxWidth:'27%',
        content: '请确定你的本次操作！',
        buttons: {
            confirm: {
                text:'变更',
                btnClass: 'btn-orange',
                action: function(){
                    $.ajax({
                        url:'/action/admin/changeGameStatus',
                        type:'post',
                        dataType:'json',
                        data:{id:id,type:type},
                        success:function (data) {
                            if(data.status == true)
                            {
                                jc.close();
                                $('#gamesTable').DataTable().ajax.reload(null,false);
                            }
                        }
                    });
                    return false;
                }
            },
            cancel:{
                text:'取消'
            }
        }
    });
}
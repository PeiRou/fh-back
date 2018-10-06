$(function () {
    $('#menu-payManage').addClass('nav-show');
    $('#menu-payManage-rechType').addClass('active');

    $('#rechargeWayTable').DataTable({
        aLengthMenu: [[50]],
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: '/back/datatables/rechType',
        columns: [
            {data:'id'},
            {data:'name'},
            {data:'rechType'},
            {data:'remark'},
            {data:'sort'},
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
    });
});

function edit(id) {
    var url = '/back/modal/editRechType/'+id;
    Cmodal('修改充值方式','20%',url,true,'editRechargeWayForm');
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
        url:'/action/admin/rechType/setSort',
        type:'post',
        dataType:'json',
        data:{sort:sort,id:sortId},
        success:function (data) {
            if(data.status == true){
                $('#rechargeWayTable').DataTable().ajax.reload(null,false);
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
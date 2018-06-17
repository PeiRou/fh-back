
$(function () {
    $('#menu-financeManage').addClass('nav-show');
    $('#menu-financeManage-capitalDetails').addClass('active');

    $('#btn_search').on('click',function () {
        var type = $('#type').val();
        var search = typeTable(type);

        if(search == true){
            datatables = $('#capitalDetailsTable').DataTable({
                searching: false,
                bLengthChange: false,
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: {
                    url:'/back/datatables/capitalDetails',
                    data:function (d) {
                        d.type = $('#type').val();
                    }
                },
                columns: [
                    {}
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
        }

    })
});

function typeTable(type) {
    var search = true;
    if(type == ""){
        alert('没有选择类型');
        return search;
    }
    if(type == 't01'){
        var th = '<th>用户</th>\n' +
                 '<th>订单号</th>\n' +
                 '<th>交易时间</th>\n' +
                 '<th>交易类型</th>\n' +
                 '<th>交易金额</th>\n' +
                 '<th>余额</th>\n' +
                 '<th>期号</th>\n' +
                 '<th>游戏</th>\n' +
                 '<th>玩法</th>\n' +
                 '<th>操作人</th>\n' +
                 '<th>备注</th>';
    }
    if(type == 't02'){
        var th = '<th>用户</th>\n' +
            '<th>订单号</th>\n' +
            '<th>交易时间</th>\n' +
            '<th>交易类型</th>\n' +
            '<th>交易金额</th>\n';
    }
    $('#capitalDetailsTable thead tr').html(th);
    return search;
}
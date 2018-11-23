/**
 * Created by vincent on 2018/2/13.
 */
$(function () {
    $('#menu-financeManage').addClass('nav-show');
    $('#menu-financeManage-memberReconciliation').addClass('active');

    $('#rangestart').calendar({
        type: 'date',
        endCalendar: $('#rangeend'),
        formatter: {
            date: function (date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                return year+'-'+month+'-'+day;
            }
        },
        text: {
            days: ['日', '一', '二', '三', '四', '五', '六'],
            months: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            monthsShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            today: '今天',
            now: '现在',
            am: 'AM',
            pm: 'PM'
        }
    });

    $('#rangeend').calendar({
        type: 'date',
        startCalendar: $('#rangestart'),
        formatter: {
            date: function (date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                return year+'-'+month+'-'+day;
            }
        },
        text: {
            days: ['日', '一', '二', '三', '四', '五', '六'],
            months: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            monthsShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            today: '今天',
            now: '现在',
            am: 'AM',
            pm: 'PM'
        }
    });
    $('#recharge_type').on('change',function () {
        var value = $(this).val();
        if(value === 'adminAddMoney'){
            $('#Recharges_id-Div').show();
        }else{
            $('#Recharges_id-Div').hide();
        }
    });
    /*
    dataTable = $('#memberReconciliationTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: {
            url:'/back/datatables/memberReconciliation',
            data:function (d) {
                d.isSearch = $('#isSearch').val();
                d.startTime = $('#startTime').val();
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
    */

    // $(document).keyup(function(e){
    //     var key = e.which;
    //     if(key == 13 || key == 32){
    //         dataTable.ajax.reload();
    //     }
    // });

});

$('#btn_search').on('click',function () {
    window.location.href = '/back/control/financeManage/memberReconciliation?daytime='+document.getElementById("startTime").value;
});

function refreshTable(){
    window.location.href = '/back/control/financeManage/memberReconciliation';
}

function refreshExcel() {
    console.log(document.getElementById("user").getAttribute('value'));
    var str = '确定重新执行 '+document.getElementById("startTime").value+' 的会员对帐？\n如果已生成的数据在重新执行期间删除过会员银行卡帐号、会员帐号，新生成的数据会出现与当天不符的情况。\n※注意:重新执行不会更新当天的会员余额。';
    if (confirm(str)) {
        var dialog = document.getElementById("dialog");
        dialog.style.display = "block";
        var url = '/back/datatables/memberReconciliation?dayTime='+document.getElementById("startTime").value+'&user='+document.getElementById("user").getAttribute('value');
        $.get(url, function(result){
            var restr = jQuery.parseJSON(JSON.stringify(result));
            // console.dir(str);
            dialog.style.display = "none";
            alert(restr['msg']);
            document.getElementById("btn_search").click();
        });
    }
    return true;
}

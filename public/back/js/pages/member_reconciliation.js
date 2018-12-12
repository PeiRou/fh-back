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
    window.location.href = '/back/control/financeManage/memberReconciliation?daytime='+document.getElementById("startTime").value+'|'+document.getElementById("endTime").value;
});

function refreshTable(){
    window.location.href = '/back/control/financeManage/memberReconciliation';
}

function refreshExcel(daytime) {
    var str = '确定重新执行 '+daytime+' 的会员对帐？\n如果已生成的数据在重新执行期间删除过会员银行卡帐号、会员帐号，新生成的数据会出现与当天不符的情况。\n※注意:『重新执行』不会更新「昨日会员余额」以及「未结算金额」。';
    if (confirm(str)) {
        var dialog = document.getElementById("dialog");
        dialog.style.display = "block";
        var url = '/back/datatables/memberReconciliation?dayTime='+daytime+'&user='+document.getElementById("user").getAttribute('value');
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

function searchclick(daytime) {
    var arraystr =daytime.split("|");
    var titlestr = '';
    switch(arraystr[1])
    {
        case 'onlinePayment':
            titlestr = arraystr[0]+' 在线支付  总计 '+arraystr[2];
            break;
        case 'bankTransfer':
            titlestr = arraystr[0]+' 银行汇款  总计 '+arraystr[2];
            break;
        case 'alipay':
            titlestr = arraystr[0]+' 支付宝支付  总计 '+arraystr[2];
            break;
        case 'weixin':
            titlestr = arraystr[0]+' 微信支付  总计 '+arraystr[2];
            break;
        case 'cft':
            titlestr = arraystr[0]+' 财付通  总计 '+arraystr[2];
            break;
        case 'adminAddMoney_reissue':
            titlestr = arraystr[0]+' 后台加钱-掉单补发  总计 '+arraystr[2];
            break;
        case 'adminAddMoney_pluscolor':
            titlestr = arraystr[0]+' 后台加钱-加彩金  总计 '+arraystr[2];
            break;
        case 'adminAddMoney_other':
            titlestr = arraystr[0]+' 后台加钱-其他  总计 '+arraystr[2];
            break;
        case 'draw':
            titlestr = arraystr[0]+' 提款  总计 '+arraystr[2];
            break;
        case 'capital':
            titlestr = arraystr[0]+' 资金明细  总计 '+arraystr[2];
            break;
        case 'todayprofitlossitem':
            titlestr = arraystr[0]+' 今日盈亏  总计 '+arraystr[2];
            break;
        default:
            titlestr = '';
    }

    jc = $.confirm({
        theme: 'material',
        title: titlestr,
        closeIcon:true,
        boxWidth:'50%',
        content: 'url:/back/modal/reconciliationInfo/'+daytime,
        buttons: {
            formSubmit: {
                text:'关闭',
                btnClass: 'btn-blue'
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

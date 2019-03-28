/**
 * Created by vincent on 2018/2/14.
 */
$(function () {
    $('#menu-betManage').addClass('nav-show');
    $('#menu-betManage-history').addClass('active');
    var intVal = function ( i ) {
        return typeof i === 'string' ?
            i.replace(/[\$,]/g, '')*1 :
            typeof i === 'number' ?
                i : 0;
    };
    var today = new Date();
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
        },
        minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 99),
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1)
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
        },
        minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 99),
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1)
    });

    dataTable = $('#betHistoryTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        aLengthMenu: [[50]],
        ajax: {
            url: '/back/datatables/betHistory',
            data:function (d) {
                d.startSearch = $('#startSearch').val();
                d.game = $('#game').val();
                d.playCate = $('#playCate').val();
                d.issue = $('#issue').val();
                d.status = $('#status').val();
                d.order = $('#order').val();
                d.username = $('#username').val();
                d.timeStart = $('#timeStart').val();
                d.timeEnd = $('#timeEnd').val();
            }
        },
        columns: [
            {data: 'order_id'},
            {data: 'created_at'},
            {data: 'user'},
            {data: 'game'},
            {data: 'issue'},
            {data: 'play'},
            {data: function (data) {
                    return "<span class='bet-text'>"+(parseFloat(data.bet_bet_money)).toFixed(2)+"</span>";
                }},
            {data: 'agnet_odds'},
            {data: 'agent_rebate'},
            {data: function (data) {
                    if(data.bet_bunko == 0){
                        txt = '<span class=\'tiny-blue-text\'>未结算</span>';
                    }else{
                        if(data.bet_game_id == 91 || data.bet_game_id == 90){
                            if(data.bet_nn_view_money > 0){
                                txt = "<span class='blue-text'><b>"+data.bet_nn_view_money+"</b></span>";
                            }else if(data.bet_nn_view_money == 0){
                                txt = '<span class=\'tiny-blue-text\'>已撤单</span>';
                            } else {
                                txt = "<span class='red-text'><b>"+data.bet_nn_view_money+"</b></span>";
                            }
                        } else {
                            if(data.bet_bunko > 0){
                                var tmpBet_bet_money = intVal(data.bet_bunko)>0?intVal(data.bet_bet_money):0;
                                lastMoney = (parseFloat(intVal(data.bet_bunko) - tmpBet_bet_money)).toFixed(3);
                                if(lastMoney == 0){
                                    txt = '<span class=\'tiny-blue-text\'>已撤单</span>';
                                }else if(lastMoney == 0){
                                    txt = '<span class=\'tiny-blue-text\'>和局</span>';
                                }else {
                                    txt = "<span class='blue-text'><b>" + lastMoney + "</b></span>";
                                }
                            } else {
                                txt = "<span class='red-text'><b>"+data.bet_bunko+"</b></span>";
                            }
                        }
                    }
                    return txt;
                }},
            {data: 'platform'}
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

$(document).keyup(function(e){
    var key = e.which;
    if(key == 13 || key == 32){
        dataTable.ajax.reload();
    }
});

$('#btn_search').on('click',function () {
    // if($('#username').val() == "" || $('#order').val() == ""){
    //     Calert('至少需要选择一个筛选类型进行查询','red')
    // } else {
        $('#startSearch').val(1);
        dataTable.ajax.reload();
    // }
});

$('#game').on('change',function () {
    var gameId = $(this).val();
    $.ajax({
        url:'/today/selectData/playCate/'+gameId,
        type:'get',
        dataType:'json',
        success:function (result) {
            $('#playCate').empty();
            var str = '<option value="">全部</option>';
            result.forEach(function(item){
                str += '<option value="'+item.id+'">'+item.name+'</option>';
            });
            $("#playCate").html(str);
        }
    });
});
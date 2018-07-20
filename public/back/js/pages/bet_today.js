/**
 * Created by vincent on 2018/2/14.
 */
$(function () {
    $('#menu-betManage').addClass('nav-show');
    $('#menu-betManage-today').addClass('active');

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

    dataTable = $('#betTodayTable').DataTable({
        searching: false,
        bLengthChange: false,
        aLengthMenu: [[50]],
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: {
            url:'/back/datatables/betToday',
            data:function (d) {
                d.searchType = $('#searchType').val();
                d.game = $('#game').val();
                d.playCate = $('#playCate').val();
                d.issue = $('#issue').val();
                d.status = $('#status').val();
                d.order = $('#order').val();
                d.username = $('#username').val();
                d.minMoney = $('#minMoney').val();
                d.maxMoney = $('#maxMoney').val();
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
                    return "<span class='bet-text'>"+(parseFloat(data.bet_.bet_bet_money)).toFixed(2)+"</span>";
                }},
            {data: 'agnet_odds'},
            {data: 'agent_rebate'},
            {data: function (data) {
                    if(data.bet_bunko == 0){
                        txt = '<span class=\'tiny-blue-text\'>未结算</span>';
                    }else{
                        if(data.bet_bunko > 0){
                            lastMoney = (parseFloat(intVal(data.bet_bunko) - intVal(data..bet_bet_money))).toFixed(2);
                            txt = "<span class='blue-text'><b>"+lastMoney+"</b></span>";
                        }
                        if(data.bet_bunko < 0){
                            txt = "<span class='red-text'><b>"+data.bet_bunko+"</b></span>";
                        }
                    }
                    return txt;
                }},
            {data: 'platform'},
            {data: 'control'}
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();

            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            var Total6 = api
                .column( 6 )
                .data()
                .reduce( function (a, b,c) {
                    return parseFloat((intVal(a) + intVal(data[c].bet_bet_money)).toFixed(2));
                }, 0 );
            var Total9 = api
                .column( 9 )
                .data()
                .reduce( function (a, b,c) {
                    return parseFloat((intVal(a) + intVal(data[c].bet_bunko)).toFixed(2));
                }, 0 );
            // Update footer by showing the total with the reference of the column index
            $( api.column( 0 ).footer() ).html('总计');
            $( api.column( 6 ).footer() ).html(Total6);
            $( api.column( 9 ).footer() ).html(Total9);
        },
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

$('#btn_search').on('click',function () {
    dataTable.ajax.reload();
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
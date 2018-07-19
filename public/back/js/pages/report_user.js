/**
 * Created by vincent on 2018/2/14.
 */
$(function () {
    $('#menu-reportManage').addClass('nav-show');
    $('#menu-reportManage-user').addClass('active');

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
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate())
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
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate())
    });

    dataTable = $('#reportUserTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: true,
        "order": [],
        aLengthMenu: [[100]],
        ajax: {
            url:'/back/datatables/reportUser',
            data:function (d) {
                d.game = $('#game').val();
                d.account = $('#account').val();
                d.timeStart = $('#timeStart').val();
                d.timeEnd = $('#timeEnd').val();
                d.minBunko = $('#minBunko').val();
                d.maxBunko = $('#maxBunko').val();
                d.chkTest = $('#chkTest').prop('checked')?$('#chkTest').val():'';
                d.chkDouble = $('#chkDouble').prop('checked')?$('#chkDouble').val():'';
                d.ag = $('#ag').val();
            }
        },
        columns: [
            {data:'username'},              //账号
            {data:'fullName'},              //全名
            {data:'agaccount'},             //上级代理
            {data:function () {             //充值金额
                    return 0 ;
                }},
            {data:function () {             //取款金额
                    return 0 ;
                }},
            {data:function (data) {         //笔数
                    return '<a href="/back/control/userManage/userBetList/'+data.id+'">'+data.countBet+'</a>';
                }},
            {data:'sumMoney'},             //投注金额
            {data:'sumWinbet'},             //赢利投注金额
            {data:function () {             //活动金额
                    return 0 ;
                }},
            {data:function () {             //充值优惠/手续费
                    return 0 ;
                }},
            {data:function () {             //代理赔率金额
                    return 0 ;
                }},
            {data:function () {             //代理退水金额
                    return 0 ;
                }},
            {data:'sumBunko'},             //会员输赢（不包括退水）
            {data:function () {             //实际退水
                    return 0 ;
                }},
            {data:'sumBunko'},             //会员输赢（不包括退水）
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();

            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // computing column Total of the complete result
            var monTotal = api
                .column( 1 )
                .data()
                .reduce( function (a, b, c) {
                    return "当前页 "+parseFloat((intVal(c)+1).toPrecision(12))+" 笔";
                }, 0 );
            $.ajax({
                url:'/back/datatables/reportTotal',
                type:'get',
                dataType:'json',
                success:function (data) {
                    $( api.column( 5 ).footer() ).html(data.result.countBet);
                    $( api.column( 6 ).footer() ).html(data.result.sumMoney);
                    $( api.column( 7 ).footer() ).html(data.result.sumWinbet);
                    $( api.column( 12 ).footer() ).html(data.result.sumBunko);
                    $( api.column( 14 ).footer() ).html(data.result.sumBunko);
                }
            })
            // Update footer by showing the total with the reference of the column index
            $( api.column( 0 ).footer() ).html('总计');
            $( api.column( 1 ).footer() ).html(monTotal);
            // $( api.column( 3 ).footer() ).html(wedTotal);
            // $( api.column( 4 ).footer() ).html(thuTotal);
            // $( api.column( 8 ).footer() ).html(Total8);
            // $( api.column( 9 ).footer() ).html(Total9);
            // $( api.column( 10 ).footer() ).html(Total10);
            // $( api.column( 11 ).footer() ).html(Total11);
            // $( api.column( 13 ).footer() ).html(Total13);
        },
        "pagingType": "full_numbers",
        language: {
            "zeroRecords": "暂无数据",
            "info": "当前显示第 _START_ 到 _END_ 笔数，总 _TOTAL_ 笔数，当前显示第 _PAGE_ 页，共 _PAGES_ 页",
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

    $('#btn_search').on('click',function () {
        dataTable.ajax.reload();
    });
    $('#reset').on('click',function () {
        $('#game').val("");
        $('#rechLevel').val("");
        $('#account').val("");
        $('#mobile').val("");
        $('#qq').val("");
        $('#minMoney').val("");
        $('#maxMoney').val("");
        $('#promoter').val("");
        $('#noLoginDays').val("");
        dataTable.ajax.reload();
    });
});
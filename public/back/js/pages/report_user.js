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
            var api = this.api(), data;

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
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var tueTotal = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var wedTotal = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var thuTotal = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var friTotal = api
                .column( 5 )
                .data()
                .reduce( function (a, b,c) {
                    b = data[c].countBet;       //笔数
                    return intVal(a) + intVal(b);
                }, 0 );

            var Total6 = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var Total7 = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var Total8 = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var Total9 = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var Total10 = api
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var Total11 = api
                .column( 11 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var Total12 = api
                .column( 12 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var Total13 = api
                .column( 13 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var Total14 = api
                .column( 14 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer by showing the total with the reference of the column index
            $( api.column( 0 ).footer() ).html('总计');
            $( api.column( 1 ).footer() ).html(monTotal);
            $( api.column( 2 ).footer() ).html(tueTotal);
            $( api.column( 3 ).footer() ).html(wedTotal);
            $( api.column( 4 ).footer() ).html(thuTotal);
            $( api.column( 5 ).footer() ).html(friTotal);
            $( api.column( 6 ).footer() ).html(Total6);
            $( api.column( 7 ).footer() ).html(Total7);
            $( api.column( 8 ).footer() ).html(Total8);
            $( api.column( 9 ).footer() ).html(Total9);
            $( api.column( 10 ).footer() ).html(Total10);
            $( api.column( 11 ).footer() ).html(Total11);
            $( api.column( 12 ).footer() ).html(Total12);
            $( api.column( 13 ).footer() ).html(Total13);
            $( api.column( 14 ).footer() ).html(Total14);
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
    //今天
    $('#btnToday').on('click',function () {
        $('#timeStart').val(GetDateStr(0));
        $('#timeEnd').val(GetDateStr(0));
    });
    //昨天
    $('#btnYesterday').on('click',function () {
        $('#timeStart').val(GetDateStr(-1));
        $('#timeEnd').val(GetDateStr(-1));
    });
    //本周
    $('#btnWeek').on('click',function () {
        var nowDate = new Date();
        var nowDay = nowDate.getDay(); // getDay 方法返回0 表示星期天
        nowDay = nowDay === 0 ? 7 : nowDay;
        // 一天的时间戳(毫秒为单位)
        var timestampOfDay = 1000*60*60*24;
        $('#timeStart').val(getFullDate( +nowDate - (nowDay-1)*timestampOfDay));
        $('#timeEnd').val(GetDateStr(0));
    });
    //本月
    $('#btnMonth').on('click',function () {
        var cloneNowDate = new Date();
        $('#timeStart').val(getFullDate( cloneNowDate.setDate(1) ));
        $('#timeEnd').val(GetDateStr(0));
    });
    //上个月
    $('#btnLastMonth').on('click',function () {
        var lastMonthDate = new Date(); //上月日期
        var lastYear = lastMonthDate.getMonth()==0?lastMonthDate.getFullYear()-1:lastMonthDate.getFullYear();
        var lastMonth = lastMonthDate.getMonth()==0?12:lastMonthDate.getMonth();
        var lastDate = lastMonthDate.getDate();
        $('#timeStart').val(lastYear+"-"+lastMonth+"-"+lastDate);
        $('#timeEnd').val(GetDateStr(0));
    });
    function GetDateStr(AddDayCount) {
        var dd = new Date();
        dd.setDate(dd.getDate()+AddDayCount);//获取AddDayCount天后的日期
        var y = dd.getFullYear();
        var m = dd.getMonth()+1;//获取当前月份的日期
        var d = dd.getDate();
        return y+"-"+m+"-"+d;
    }
    function getFullDate(targetDate) {
        var D, y, m, d;
        if (targetDate) {
            D = new Date(targetDate);
            y = D.getFullYear();
            m = D.getMonth() + 1;
            d = D.getDate();
        } else {
            y = fullYear;
            m = month;
            d = date;
        }
        m = m > 9 ? m : '0' + m;
        d = d > 9 ? d : '0' + d;

        return y + '-' + m + '-' + d;
    }
});
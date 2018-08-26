$(function () {
    $('#menu-reportManage').addClass('nav-show');
    $('#menu-reportManage-bet').addClass('active');

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

    dataTable = $('#reportBetTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: true,
        "order": [],
        aLengthMenu: [[100]],
        ajax: {
            url:'/back/datatables/reportBet',
            data:function (d) {
                d.startTime = $('#startTime').val();
                d.endTime = $('#endTime').val();
                d.killZeroBetGame = $('#killZeroBetGame:checked').val();
                d.killCloseGame = $('#killCloseGame:checked').val();
            }
        },
        columns: [
            {data:'game_name'},
            {data:'sumMoney'},
            {data:'countBets'},
            {data:'countMember'},
            {data:function () {
                    return 0;
                }},
            {data:'sumWinBunko'},
            {data:function (data) {
                    var countWinBunkoBet = data.countWinBunkoBet;
                    var countBets =  data.countBets;
                    var bfb = countWinBunkoBet/countBets * 100;
                    return countWinBunkoBet+' ('+bfb.toFixed(1)+'%)'
                }},
            {data:'countWinBunkoMember'},
            {data:function (data) {
                var sumBunko = data.sumBunko;
                if(sumBunko > 0){
                    return '<span class="green-text">'+sumBunko+'</span>'
                } else {
                    return '<span class="red-text">'+sumBunko+'</span>'
                }
                }},
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
            var Total1 = api
                .column( 1 )
                .data()
                .reduce( function (a, b,c) {
                    return parseFloat((intVal(a) + intVal(data[c].sumMoney)).toFixed(2));
                }, 0 );
            var Total2 = api
                .column( 2 )
                .data()
                .reduce( function (a, b,c) {
                    return parseFloat((intVal(a) + intVal(data[c].countBets)).toFixed(2));
                }, 0 );
            var Total3 = api
                .column( 3 )
                .data()
                .reduce( function (a, b,c) {
                    return parseFloat((intVal(a) + intVal(data[c].countMember)).toFixed(2));
                }, 0 );
            var Total5 = api
                .column( 5 )
                .data()
                .reduce( function (a, b,c) {
                    return parseFloat((intVal(a) + intVal(data[c].sumWinBunko)).toFixed(2));
                }, 0 );
            var Total6 = api
                .column( 6 )
                .data()
                .reduce( function (a, b,c) {
                    return parseFloat((intVal(a) + intVal(data[c].countWinBunkoBet)).toFixed(2));
                }, 0 );
            var Total7 = api
                .column( 7 )
                .data()
                .reduce( function (a, b,c) {
                    return parseFloat((intVal(a) + intVal(data[c].countWinBunkoMember)).toFixed(2));
                }, 0 );
            var Total8 = api
                .column( 8 )
                .data()
                .reduce( function (a, b,c) {
                    return parseFloat((intVal(a) + intVal(data[c].sumBunko)).toFixed(2));
                }, 0 );
            // Update footer by showing the total with the reference of the column index
            $( api.column( 0 ).footer() ).html('总计');
            $( api.column( 1 ).footer() ).html(Total1);
            $( api.column( 2 ).footer() ).html(Total2);
            $( api.column( 3 ).footer() ).html(Total3);
            $( api.column( 4 ).footer() ).html(0);
            $( api.column( 5 ).footer() ).html(Total5);
            $( api.column( 6 ).footer() ).html(Total6);
            $( api.column( 7 ).footer() ).html(Total7);
            $( api.column( 8 ).footer() ).html(Total8);
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

$('#date_param').on('change',function () {
    var data = $(this).val();
    $.ajax({
        url:'/recharge/selectData/dateChange/'+data,
        type:'get',
        dataType:'json',
        success:function (result) {
            $('#startTime').val(result.start);
            $('#endTime').val(result.end);
        }
    });
});
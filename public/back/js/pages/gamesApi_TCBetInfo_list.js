
function createTable() {
    return $('#dataTable1').DataTable({
        searching: false,
        bLengthChange: false,
        ordering:false,
        processing: true,
        serverSide: true,
        aLengthMenu: [[100]],
        ajax: {
            url:'/back/datatables/openHistory/BetInfo',
            data:function (d) {
                d.startTime = $('#startTime').val();//查询时间段
                d.endTime = $('#endTime').val();
                d.username = $('#Accounts').val();//玩家账号
                d.g_id = $('#g_id').val();
                d.GameID = $('#GameID').val();
                d.gameCategory = $('#gameCategory').val();
            },
            dataSrc:function(e){
                $('#BetCountSum').html(e.TotalSum.BetCountSum);
                $('#AllBet').html(e.TotalSum.AllBet);
                $('#bet_money').html(e.TotalSum.bet_money);
                $('#bunkoSum').html(e.TotalSum.bunkoSum);
                return e.data;
            }
        },
        columns: [

            {data: 'GameID',title:'局号'},
            {data: 'GameStartTime',title:'游戏时间'},
            {data: 'username',title:'会员'},
            {data: 'g_id',title:'游戏'},
            {data: 'gameCategory',title:'玩法'},
            {data: 'AllBet',title:'下注金额'},
            {data: 'bet_money',title:'有效投注金额'},
            {data: 'bunko',title:'会员输赢'},
            // {data: 'productType',title:'产品'},
        ],
        footerCallback:function(e,data, c, d){
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
        },

    });

}
$(function(){
    $('#menu-GamesApi').addClass('nav-show');
    $('#menu-GamesApi-TCBetInfo').addClass('active');
    dataTable = createTable();
    var createdDate = {
        type: 'date',
        endCalendar: $('#issuedate'),
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
    };
    $('.timeStart').calendar(createdDate);
    $('.timeEnd').calendar(createdDate);

    $('.btn_search').click(function(){
        dataTable.ajax.reload();
    });

    // $('#g_id').change(function(){
    //     if($('#g_id').val() == 19){
    //
    //     }
    // })
})

// var columns,dataTag='tc',dataId,footerCallback,search;
//
// function createTable() {
//     return $('#dataTable1').DataTable({
//         searching: false,
//         bLengthChange: false,
//         ordering:false,
//         processing: true,
//         serverSide: true,
//         aLengthMenu: [[100]],
//         ajax: {
//             url:'/back/datatables/openHistory/BetInfo',
//             data:function (d) {
//                 // d.startTime = $('#startTime').val();//查询时间段
//                 // d.endTime = $('#endTime').val();
//                 // d.Accounts = $('#Accounts').val();//玩家账号
//                 // d.g_id = $('#g_id').val();
//                 d.dataTag = dataTag;
//                 d.dataId = dataId;
//                 if(typeof search == 'object'){
//                     for(k in search){
//                         d[search[k].name] = search[k].value
//                     }
//                 }
//             },
//             dataSrc:function(e){
//                 if(e.data.length <= 0) return '';
//                 $('#dataTable1 tfoot').remove();
//                 if(dataTag == 'qp'){
//                     $('#dataTable1').append(`<tfoot>
//                     <tr>s
//                     <th>总计</th>
//                     <th>`+(e.TotalSum.BetCountSum|0)+`笔</th>
//                     <th>`+(e.TotalSum.BetSum | 0)+`</th>
//                     <th>`+(e.TotalSum.ProfitSum | 0)+`</th>
//                     <th></th>
//                     <th></th>
//                     </tr>
//                     </tfoot>`);
//                 }else if(dataTag == 'tc'){
//                     $('#dataTable1 ').append(`<tfoot>
//                     <tr>
//                     <th>总计</th>
//                     <th>`+(e.TotalSum.BetCountSum|0)+`笔</th>
//                     <th>`+(e.TotalSum.AllBet||0)+`</th>
//                     <th>`+(e.TotalSum.validBetAmount||0)+`</th>
//                     <th>`+(e.TotalSum.ProfitSum||0)+`</th>
//                     <th></th>
//                     <th></th>
//                     </tr>
//                     </tfoot>`);
//                 }
//
//                 return e.data;
//             }
//         },
//         columns: columns,
//         footerCallback:function(e,data, c, d){
//
//         },
//         language: {
//             "zeroRecords": "暂无数据",
//             "info": "当前显示第 _PAGE_ 页，共 _PAGES_ 页",
//             "infoEmpty": "没有记录",
//             "loadingRecords": "请稍后...",
//             "processing":     "读取中...",
//             "paginate": {
//                 "first":      "首页",
//                 "last":       "尾页",
//                 "next":       "下一页",
//                 "previous":   "上一页"
//             }
//         },
//
//     });
//
// }
// function reload_() {
//     search = $('form[name='+dataTag+']').serializeArray();
//     if(dataTag == 'qp'){
//         columns = qp;
//     }else if(dataTag == 'tc'){
//         columns = tc;
//     }
//     if (typeof dataTable == 'object') {
//         dataTable.destroy();
//     }
//
//     $('#dataTable1').html('');
//     dataTable = createTable(columns);
//
// }
// $(function () {
//     columns = qp;
//     reload_();
//     $('#menu-GamesApi').addClass('nav-show');
//     $('#menu-GamesApi-TCBetInfo').addClass('active');
//     $('.menu .item').tab({
//         context: $('#context1')
//     }).click(function(){
//         dataTag = $(this).attr('data-tab');
//         reload_();
//     });
//
//     $(document).keyup(function(e){
//         var key = e.which;
//         if(key == 13 || key == 32){
//             dataTable.ajax.reload();
//         }
//     });
//     var createdDate = {
//         type: 'date',
//         endCalendar: $('#issuedate'),
//         formatter: {
//             date: function (date, settings) {
//                 if (!date) return '';
//                 var day = date.getDate();
//                 var month = date.getMonth() + 1;
//                 var year = date.getFullYear();
//                 return year+'-'+month+'-'+day;
//             }
//         },
//         text: {
//             days: ['日', '一', '二', '三', '四', '五', '六'],
//             months: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
//             monthsShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
//             today: '今天',
//             now: '现在',
//             am: 'AM',
//             pm: 'PM'
//         }
//     };
//     $('.timeStart').calendar(createdDate);
//     $('.timeEnd').calendar(createdDate);
// });
//
// $('.btn_search').click(function(){
//     reload_();
// });
// var qp = [
//     {data: 'name',title:'游戏名称'},
//     {data: 'Accounts',title:'游戏账号'},
//     {data: 'AllBet',title:'总下注'},
//     {data: 'Profit',title:'盈利'},
//     {data: 'GameStartTime',title:'第一次游戏时间'},
//     {data: 'GameEndTime',title:'最后一次游戏时间'},
// ];
//
// var tc = [
//     {data: 'gameCategory',title:'游戏名称'},
//     {data: 'Accounts',title:'玩家账号'},
//     {data: 'AllBet',title:'投注金额'},
//     {data: 'validBetAmount',title:'有效投注金额'},
//     {data: 'Profit',title:'盈利'},
//     {data: 'productType',title:'产品'},
//     // {data: 'additionalDetails',title:'额外细节',width: "20px"},
//     {data: 'GameStartTime',title:'游戏时间'},
// ];

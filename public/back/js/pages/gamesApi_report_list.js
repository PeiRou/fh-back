var columns,dataTag='qp',dataId,footerCallback,search;

function createTable() {
    return $('#dataTable1').DataTable({
        searching: false,
        bLengthChange: false,
        ordering:false,
        processing: true,
        serverSide: true,
        aLengthMenu: [[20]],
        ajax: {
            url:'/back/datatables/reportGamesApi',
            data:function (d) {
                d.dataTag = dataTag;
                d.dataId = dataId;
                if(typeof search == 'object'){
                    for(k in search){
                        d[search[k].name] = search[k].value
                    }
                }
            },
            dataSrc:function(e){
                if(e.data.length <= 0) return '';
                if(dataTag == 'qp'){
                    $('#dataTable1').append(`<tfoot>
                    <tr>
                    <th>总计</th>
                    <th>`+e.totalArr.count_user+`</th>
                    <th></th>
                    <th>`+e.totalArr.BetCountSum+`</th>
                    <th>`+e.totalArr.betMoney+`</th>
                    <th>`+e.totalArr.betBunko+`</th>
                    <th>`+e.totalArr.totalUp+`</th>
                    <th>`+(e.totalArr.totalDown | e.totalArr.totaldown)+`</th>
                    </tr>
                    </tfoot>`);
                }else if(dataTag == 'tc'){
                    $('#dataTable1').append(`<tfoot>
                    <tr>
                    <th>总计</th>
                    <th>`+e.totalArr.user_count+`</th>
                    <th>`+e.totalArr.bet_count+`</th>
                    <th>`+e.totalArr.AllBet+`</th>
                    <th>`+e.totalArr.validBetAmount+`</th>
                    <th>`+e.totalArr.Profit+`</th>
                    <th>`+e.totalArr.upMoney+`</th>
                    <th>`+e.totalArr.downMoney+`</th>
                    </tr>
                    </tfoot>`);
                }

                return e.data;
            }
        },
        columns: columns,
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
function reload_() {
    search = $('form[name='+dataTag+']').serializeArray();
    if(dataTag == 'qp'){
        columns = qp;
    }else if(dataTag == 'tc'){
        columns = tc;
    }
    if (typeof dataTable == 'object') {
        dataTable.destroy();
    }

    $('#dataTable1').html('');
    dataTable = createTable(columns);

}
$(function () {
    columns = qp;
    reload_();
    $('#menu-reportManage').addClass('nav-show');
    $('#menu-reportManage-GamesApi').addClass('active');
    $('.menu .item').tab({
        context: $('#context1')
    }).click(function(){
        dataTag = $(this).attr('data-tab');
        reload_();
    });

    $(document).keyup(function(e){
        var key = e.which;
        if(key == 13 || key == 32){
            dataTable.ajax.reload();
        }
    });
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
});

$('.btn_search').click(function(){
    reload_();
});
var qp = [
    {data:'game_name',title:'游戏'},
    {data:'user_account',title:'玩家'},
    {data:'agent_account',title:'上级代理'},
    {data:'bet_count',title:'笔数'},
    {data:'bet_money',title:'投注金额'},
    {data:'bet_bunko',title:'盈利'},
    {data:function(e){
            return e.up_money || '0.00'
        },title:'上分'},
    {data:function(e){
            return e.down_money || '0.00'
        },title:'下分'},
    // {data:'date',title:'报表时间'}
];

var tc = [
    {data: 'productType',title:'平台'},
    {data: 'user_count',title:'投注人数'},
    {data: 'bet_count',title:'下注笔数'},
    {data: 'AllBet',title:'投注金额'},
    {data: 'validBetAmount',title:'有效投注额'},
    {data: 'Profit',title:'游戏输赢'},
    {data: 'upMoney',title:'上分'},
    {data: 'downMoney',title:'下分'},
];

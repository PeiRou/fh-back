<script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
<link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
<div class="agent-capital-search-bar">
    <div class="ui mini form">
        <div class="fields">
            <div class="three wide field">
                <label>资金类型</label>
                <select class="ui dropdown" id="capital_type" style='height:32px !important'>
                    <option value="">类型</option>
                    @foreach($capitalTimes as $key => $capitalTime)
                        <option value="{{ $key }}">{{ $capitalTime }}</option>
                    @endforeach
                </select>
            </div>
            <div class="three wide field" id="game_id-div">
                <label>游戏</label>
                <select class="ui dropdown" id="game_id" style='height:32px !important'>
                    <option value="">游戏</option>
                    @foreach($games as $game)
                        <option value="{{ $game->game_id }}">{{ $game->game_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="three wide field" id="recharges_id-div" style="display: none;">
                <label>资金类型</label>
                <select class="ui dropdown" id="recharges_id" style='height:32px !important'>
                    <option value="">资金类型</option>
                    @foreach($aRechargesType as $kRechargesType => $iRechargesType)
                        <option value="{{ $kRechargesType }}">{{ $iRechargesType }}</option>
                    @endforeach
                </select>
            </div>
            <div class="two wide field">
                <label>期号</label>
                <input type="text" id="issue">
            </div>
            <div class="two wide field">
                <label>时间范围-开始</label>
                <div class="ui calendar" id="rangestart">
                    <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" id="timeStart" value="{{date("Y-m-d",time())}}">
                    </div>
                </div>
            </div>
            <div class="two wide field">
                <label>时间范围-结束</label>
                <div class="ui calendar" id="rangeend">
                    <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" id="timeEnd" value="{{date("Y-m-d",time())}}">
                    </div>
                </div>
            </div>
            <div class="two wide field">
                <label>&nbsp;</label>
                <button id="btn_search_user" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 筛选查询 </button>
            </div>
            <div class="two wide field">
                <label>&nbsp;</label>
                <button id="reset_user" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置 </button>
            </div>
        </div>
    </div>
</div>
<div class="pay-total-crumb" style="float: left">
    <div><span>线上支付：</span><span id="payOnline"></span></div>
    <div><span>手动加钱：</span><span id="payManual"></span></div>
    <div><span>线下支付：</span><span id="payOffline"></span></div>
    <div><span>手续费/返利：</span><span id="payFormalities"></span></div>
    <div><span>投注输赢：</span><span id="payBetting"></span></div>
    <div><span>提现金额：</span><span id="payDrawing"></span></div>
</div>
<div class="table-content" style="padding: 0;min-height: 400px;float: left">
    <table id="userCapitalTable" class="ui small table" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>订单号</th>
            <th>交易时间</th>
            <th>交易类型</th>
            <th>交易金额</th>
            <th>余额</th>
            <th>期号</th>
            <th>游戏</th>
            <th>玩法</th>
            <th>操作人</th>
            <th>备注</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </tfoot>
    </table>
</div>
<script>
    var columns = [
        {data:'order_id',title:'订单号'},
        {data:'created_at',title:'交易时间'},
        {data:'type',title:'交易类型'},
        {data:'money',title:'交易金额'},
        {data:'balance',title:'余额'},
        {data:'issue',title:'期号'},
        {data:'game',title:'游戏'},
        {data:'play_type',title:'玩法'},
        {data:'operation',title:'操作人'},
        {data:'content',title:'备注'},
    ];

    $(function () {
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

        dataTable = $('#userCapitalTable').DataTable({
            ordering: false,
            searching: false, //去掉搜索框
            bLengthChange: false,//去掉每页多少条框体
            processing: true,
            serverSide: true,
            aLengthMenu: [[10]],
            ajax: {
                url:'/back/datatables/userCapital/{{ $uid }}',
                data:function (d) {
                    d.capital_type = $('#capital_type').val();
                    d.issue = $('#issue').val();
                    d.startTime = $('#timeStart').val();
                    d.endTime = $('#timeEnd').val();
                    d.game_id = $('#game_id').val();
                    d.recharges_id = $('#recharges_id').val();
                },
                dataSrc:function (json) {
                    payFunds(json.payFunds);
                    for ( var i=0, ien=json.data.length ; i<ien ; i++ ) {
                        json.data[i][0] = '<a href="/message/'+json.data[i][0]+'>View message</a>';
                    }
                    return json.data;
                }
            },
            columns: columns,
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api();

                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var Total3 = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b,c) {
                        return parseFloat((intVal(a) + intVal(data[c].c_money)).toFixed(2));
                    }, 0 );
                // Update footer by showing the total with the reference of the column index
                $( api.column( 0 ).footer() ).html('总计');
                $( api.column( 3 ).footer() ).html(Total3);
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

        $('#btn_search_user').on('click', function () {
            if($('#game_id').val()){
                $('#capital_type').val('t05');
            }
            dataTable.ajax.reload();
        });

        $('#reset_user').on('click', function () {
            $('#game_id').val("");
            $('#capital_type').val("");
            $('#issue').val("");
            $('#timeStart').val("");
            $('#timeEnd').val("");
            dataTable.ajax.reload();
        });

        $('#capital_type').on('change',function () {
            var value = $(this).val();
            if(value === 't18'){
                $('#recharges_id-div').show();
                $('#game_id-div').hide();
            }else{
                $('#recharges_id-div').hide();
                $('#game_id-div').show();
            }
        });
    })
    function payFunds(data) {
        $('#payOnline').text(data.payOnline);
        $('#payManual').text(data.payManual);
        $('#payOffline').text(data.payOffline);
        $('#payFormalities').text(data.payFormalities);
        $('#payBetting').text(data.payBetting);
        $('#payDrawing').text(data.payDrawing);
    }
</script>
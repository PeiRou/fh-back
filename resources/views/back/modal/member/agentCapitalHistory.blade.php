<script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
<link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
<div class="agent-capital-search-bar">
    <div class="ui mini form">
        <div class="fields">
            <div class="three wide field">
                <label>资金类型</label>
                <select class="ui dropdown" id="capital_type" style='height:32px !important'>
                    <option value="">类型</option>
                    @foreach($aData as $kData => $iData)
                        <option value="{{ $kData }}">{{ $iData }}</option>
                    @endforeach
                </select>
            </div>
            <div class="three wide field">
                <label>游戏</label>
                <select class="ui dropdown" style='height:32px !important'></select>
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
                        <input type="text" id="timeStart">
                    </div>
                </div>
            </div>
            <div class="two wide field">
                <label>时间范围-结束</label>
                <div class="ui calendar" id="rangeend">
                    <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" id="timeEnd">
                    </div>
                </div>
            </div>
            <div class="two wide field">
                <label>&nbsp;</label>
                <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 筛选查询 </button>
            </div>
            <div class="two wide field">
                <label>&nbsp;</label>
                <button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置 </button>
            </div>
        </div>
    </div>
</div>

<div class="table-content" style="padding: 0;min-height: 400px;">
    <table id="agentCapitalTable" class="ui small table" cellspacing="0" width="100%">
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
    </table>
</div>
<script>
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

        dataTable = $('#agentCapitalTable').DataTable({
            ordering: false,
            searching: false, //去掉搜索框
            bLengthChange: false,//去掉每页多少条框体
            processing: true,
            serverSide: true,
            ajax: {
                url:'/back/datatables/agentCapital/{{ $a_id }}',
                data:function (d) {
                    d.capital_type = $('#capital_type').val();
                    d.issue = $('#issue').val();
                    d.startTime = $('#timeStart').val();
                    d.endTime = $('#timeEnd').val();
                }
            },
            columns: [
                {data:'order_id'},
                {data:'created_at'},
                {data:'type'},
                {data:'money'},
                {data:'balance'},
                {data:'issue'},
                {data:'game'},
                {data:'play_type'},
                {data:'operation'},
                {data:'content'}
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

        $('#btn_search').on('click', function () {
            dataTable.ajax.reload();
        });

        $('#reset').on('click', function () {
            $('#capital_type').val("");
            $('#issue').val("");
            $('#timeStart').val("");
            $('#timeEnd').val("");
            dataTable.ajax.reload();
        });
    })
</script>
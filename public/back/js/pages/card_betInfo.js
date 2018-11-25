$(function () {
    $('#menu-cardGameManage').addClass('nav-show');
    $('#menu-cardGameManage-cardBetInfo').addClass('active');

    dataTable = $('#datTable').DataTable({
        searching: false,
        bLengthChange: false,
        ordering:false,
        processing: true,
        serverSide: true,
        aLengthMenu: [[20]],
        ajax: {
            url:'/back/datatables/openHistory/card_betInfo',
            data:function (d) {
                d.startTime = $('#startTime').val();//查询时间段
                d.endTime = $('#endTime').val();
                d.Accounts = $('#Accounts').val();//玩家账号
                d.g_id = $('#g_id').val();
            }
        },
        columns: [
            {data: 'name'},
            {data: 'GameID'},
            {data: function(e){
                return e.Accounts.match(/[0-9]*[_](.*)/)[1];
            }},
            {data: 'AllBet'},
            {data: 'Profit'},
            {data: 'GameStartTime'},
            {data: 'GameEndTime'},
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

    $(document).keyup(function(e){
        var key = e.which;
        if(key == 13 || key == 32){
            dataTable.ajax.reload();
        }
    });

    $('#btn_search').on('click',function () {
        dataTable.ajax.reload();

    });

    $('#reset').on('click',function () {
        $('#issue').val('');                      //奖期
        $('#issuedate').val('');              //开奖时间
        dataTable.ajax.reload();
    });
    $('#rangestart').calendar({
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
    });
    $('#rangeend').calendar({
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
    });
});
//豹子
function san(arrayNum){
    arrayNum.sort();
    txt = 'No';
    if(arrayNum[0] == arrayNum[1] && arrayNum[1] == arrayNum[2])
        txt = '豹子';
    return txt;
}

function lhh(a,b){
    if( a>b){
        txt = "<font color='red'>龙</font>";
    }else if( a<b){
        txt = "虎";
    }else{
        txt = "和";
    }
    return txt;
}

function openk3(id) {
    jc = $.confirm({
        theme: 'material',
        title: '安徽快3-手动开奖',
        closeIcon:true,
        boxWidth:'30%',
        content: 'url:/back/modal/openAhk3/'+id,
        buttons: {
            formSubmit: {
                text:'确定',
                btnClass: 'btn-blue',
                action: function () {
                    $('.daterangepicker').hide();
                    var form = this.$content.find('#openK3').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            }
        },
        contentLoaded: function(data, status, xhr){
            if(data.status == 403)
            {
                this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
                $('.jconfirm-buttons').hide();
            }
        }
    });
}

function cancel(issue,type) {
    jc = $.confirm({
        title: '确定要导撤单',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '这是一个需要注意的操作，撤销该期数下所有注单',
        buttons: {
            confirm: {
                text:'确定撤单',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/cancelBetting/'+issue+'/'+type,
                        type:'post',
                        dataType:'json',
                        success:function (data) {
                            if(data.status == true){
                                alert('撤单成功');
                            }else{
                                Calert(data.msg,'red')
                            }
                        },
                        error:function (e) {
                            if(e.status == 403)
                            {
                                Calert('您没有此项权限！无法继续！','red')
                            }
                        }
                    });
                }
            },
            cancel:{
                text:'取消'
            }
        }
    });
}

function canceled(issue,type) {
    jc = $.confirm({
        title: '确定要导撤单',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '这是一个需要注意的操作，撤销该期数下所有注单',
        buttons: {
            confirm: {
                text:'确定撤单',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/Bet/canceled/'+issue+'/'+type,
                        type:'post',
                        dataType:'json',
                        success:function (data) {
                            if(data.status == true){
                                alert('撤单成功');
                            }else{
                                Calert(data.msg,'red')
                            }
                        },
                        error:function (e) {
                            if(e.status == 403)
                            {
                                Calert('您没有此项权限！无法继续！','red')
                            }
                        }
                    });
                }
            },
            cancel:{
                text:'取消'
            }
        }
    });
}
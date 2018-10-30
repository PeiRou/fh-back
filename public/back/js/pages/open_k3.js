$(function () {

    dataTable = $('#datTable').DataTable({
        searching: false,
        bLengthChange: false,
        ordering:false,
        processing: true,
        serverSide: true,
        aLengthMenu: [[50]],
        ajax: {
            url:'/back/datatables/openHistory/k3',
            data:function (d) {
                d.type = gameType;                                //类型
                d.issue = $('#issue').val();                      //奖期
                d.issuedate = $('#issuedate').val();              //开奖时间
            }
        },
        columns: [
            {data: 'issue'},
            {data: 'opentime'},
            {data: function (data) {        //开出号码
                    if(data.opennum == null || data.opennum == '')
                        return "";
                    after = data.opennum.split(",");
                    txt = "";
                    for(var i =0;i<after.length;i++){
                        var num = parseInt(after[i])+0;
                        txt = txt + "<span><b class='b"+num+"'></b></span>";
                    }
                    return "<div class='T_K3' style='width: 111px'>" + txt + "</div>";
                }},
            {data: function (data) {        //总和
                    if(data.opennum == null || data.opennum == '')
                        return "";
                    after = data.opennum.split(",");
                    zh = parseInt(after[0]) + parseInt(after[1]) + parseInt(after[2]);      //总和
                    var txt = san(after);
                    if(txt=='No')
                        txt = zh >= 11?"<font color='red'>大</font>":"小";
                    return "<table height='100%' width='100%' style='table-layout:fixed'><tr>"+ txt +"</tr></table>";
            }},
            {data: function (data) {
                    if(data.is_open==1)
                        txt = "已开奖";
                    else if(data.is_open==5)
                        txt = "已冻结";
                    else if(data.is_open==6)
                        txt = "已撤单";
                    else if(data.is_open==7)
                        txt = "重新开奖中";
                    else
                        txt = "未开奖";
                    return '<span>'+txt+'</span>';
                }},
            {data: function (data) {
                    txt = '';
                    if(data.is_open=="1"){        //已开奖
                        txt = "<li onclick='openk3("+data.id+","+data.issue+",2)'>重新开奖</li>" ;
                        if(testServer == 1){
                            txt += "<li onclick='canceled("+data.issue+")'>撤单</li>";
                            txt += "<li onclick='freeze("+data.issue+")'>冻结</li>";
                        }
                    }else if(data.is_open == "0"){                      //未开奖
                        txt = "<li onclick='cancelAll("+data.id+")'>修改</li>" +
                            "<li onclick='cancel("+data.issue+")'>撤单</li>" +
                            "<li onclick='openk3("+data.id+","+data.issue+",1)'>手动开奖</li>" ;
                    }else if(data.is_open == "5"){
                        txt = "<li onclick='canceled("+data.issue+")'>撤单</li>" +
                            "<li onclick='openk3("+data.id+","+data.issue+",2)'>重新开奖</li>" ;
                    }else if(data.is_open == "7"){
                        "<li onclick='openk3("+data.id+","+data.issue+",2)'>重新开奖</li>" ;
                    }
                    return "<ul class='control-menu'>" + txt + "</ul>";
                }}
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

function openk3(id,issue,type) {
    jc = $.confirm({
        theme: 'material',
        title: title+'-手动开奖',
        closeIcon:true,
        boxWidth:'30%',
        content: 'url:/back/modal/open/'+id+'/'+gameType+'/'+cat+'/'+issue+'/'+type,
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

function cancel(issue) {
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
                        url:'/action/admin/cancelBetting/'+issue+'/'+gameType,
                        type:'post',
                        dataType:'json',
                        success:function (data) {
                            if(data.status == true){
                                dataTable.ajax.reload();
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

function canceled(issue) {
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
                        url:'/action/admin/Bet/canceled/'+issue+'/'+gameType,
                        type:'post',
                        dataType:'json',
                        success:function (data) {
                            if(data.status == true){
                                dataTable.ajax.reload();
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

function freeze(issue) {
    jc = $.confirm({
        title: '确定要冻结',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '这是一个需要注意的操作，冻结该期数下所有注单',
        buttons: {
            confirm: {
                text:'确定撤单',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/freeze/'+issue+'/'+gameType,
                        type:'post',
                        dataType:'json',
                        success:function (data) {
                            if(data.status == true){
                                dataTable.ajax.reload();
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

function changeNumber(issue) {
    jc = $.confirm({
        title: '确定要重新开奖',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '这是一个需要注意的操作，重新开奖该期数下所有注单',
        buttons: {
            confirm: {
                text:'确定撤单',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:'/action/admin/renewLottery/'+issue+'/'+gameType,
                        type:'post',
                        dataType:'json',
                        success:function (data) {
                            if(data.status == true){
                                dataTable.ajax.reload();
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
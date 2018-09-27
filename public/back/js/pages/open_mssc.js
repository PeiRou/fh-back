$(function () {
    $('#menu-openManage').addClass('nav-show');
    $('#menu-openManage-mssc').addClass('active');

    dataTable = $('#datTable').DataTable({
        searching: false,
        bLengthChange: false,
        ordering:false,
        processing: true,
        serverSide: true,
        aLengthMenu: [[50]],
        ajax: {
            url:'/back/datatables/openHistory/mssc',
            data:function (d) {
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
                    return "<div class='T_PK10' style='width: 100%'>" + txt + "</div>";
                }},
            {data: function (data) {        //冠亚军和
                    if(data.opennum == null || data.opennum == '')
                        return "";
                    after = data.opennum.split(",");
                    gyh = parseInt(after[0]) + parseInt(after[1]);
                    gyhds = gyh%2==1 ?"单":"<font color='red'>双</font>";
                    gyhdx = gyh >= 12?"<font color='red'>大</font>":"小";
                    txt = "<td>" + gyh + "</td>"+"<td>" + gyhds + "</td>"+"<td>" + gyhdx + "</td>";
                    return "<table height='100%' width='100%' style='table-layout:fixed'><tr>"+ txt +"</tr></table>";
                }},
            {data: function (data) {        //1~5龙虎
                    if(data.opennum == null || data.opennum == '')
                        return "";
                    after = data.opennum.split(",");
                    lhh1 = lhh(parseInt(after[0]) , parseInt(after[9]));      //龙虎1
                    lhh2 = lhh(parseInt(after[1]) , parseInt(after[8]));      //龙虎2
                    lhh3 = lhh(parseInt(after[2]) , parseInt(after[7]));      //龙虎3
                    lhh4 = lhh(parseInt(after[3]) , parseInt(after[6]));      //龙虎4
                    lhh5 = lhh(parseInt(after[4]) , parseInt(after[5]));      //龙虎5
                    txt = "<td>" + lhh1 + "</td>"+"<td>" + lhh2 + "</td>"+"<td>" + lhh3 + "</td>"+"<td>" + lhh4 + "</td>"+"<td>" + lhh5 + "</td>";
                    return "<table height='100%' width='100%' style='table-layout:fixed'><tr>"+ txt +"</tr></table>";
                }},
            {data: function (data) {
                    if(data.is_open==1)
                        txt = "已开奖";
                    else
                        txt = "未开奖";
                    return '<span>'+txt+'</span>';
                }},
            {data: function (data) {
                    if(data.is_open=="1"){        //已开奖
                        txt = "<li onclick='changeNumber("+data.id+")'>重新开奖</li>" ;
                    }else{                      //未开奖
                        txt = "<li onclick='cancelAll("+data.id+")'>修改</li>" +
                            "<li onclick='cancel("+data.issue+",\"jspk10\")'>撤单</li>" +
                            "<li onclick='openbjpk10("+data.id+")'>手动开奖</li>" ;
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

function openbjpk10(id) {
    jc = $.confirm({
        theme: 'material',
        title: '秒速赛车-手动开奖',
        closeIcon:true,
        boxWidth:'30%',
        content: 'url:/back/modal/openMssc/'+id,
        buttons: {
            formSubmit: {
                text:'确定',
                btnClass: 'btn-blue',
                action: function () {
                    $('.daterangepicker').hide();
                    var form = this.$content.find('#openBjpk10').data('formValidation').validate().isValid();
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
$(function () {
    dataTable = $('#lhcHistoryTable').DataTable({
        searching: false,
        bLengthChange: false,
        ordering:false,
        processing: true,
        serverSide: true,
        aLengthMenu: [[50]],
        ajax: {
            url:'/back/datatables/openHistory/lhc',
            data:function (d) {
                d.issue = $('#issue').val();
                d.issuedate = $('#issuedate').val();              //开奖时间
            }
        },
        columns: [
            {data:'issue'},
            {data:'opentime'},
            {data:'n1'},
            {data:'n2'},
            {data:'n3'},
            {data:'n4'},
            {data:'n5'},
            {data:'n6'},
            {data:'n7'},
            {data:'n7_sx'},
            {data:'total_num'},
            {data:'is_open'},
            {data:'control'}
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

    $('#btn_search').on('click',function () {
        dataTable.ajax.reload();

    });

    $('#reset').on('click',function () {
        $('#issue').val('');                      //奖期
        $('#issuedate').val('');              //开奖时间
        dataTable.ajax.reload();
    });
});

function addNewIssue() {
    jc = $.confirm({
        theme: 'material',
        title: '六合彩-新增期数',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/addLhcNewIssue',
        buttons: {
            formSubmit: {
                text:'确定添加',
                btnClass: 'btn-blue',
                action: function () {
                    $('.daterangepicker').hide();
                    var form = this.$content.find('#addLhcNewIssueForm').data('formValidation').validate().isValid();
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

function edit(id) {
    jc = $.confirm({
        theme: 'material',
        title: '六合彩-修改期数',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/editLhcNewIssue/'+id,
        buttons: {
            formSubmit: {
                text:'确定修改',
                btnClass: 'btn-blue',
                action: function () {
                    $('.daterangepicker').hide();
                    var form = this.$content.find('#editLhcNewIssueForm').data('formValidation').validate().isValid();
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

function openLhc(id) {
    jc = $.confirm({
        theme: 'material',
        title: '六合彩-手动开奖',
        closeIcon:true,
        boxWidth:'30%',
        content: 'url:/back/modal/openLhc/'+id,
        buttons: {
            formSubmit: {
                text:'确定',
                btnClass: 'btn-blue',
                action: function () {
                    $('.daterangepicker').hide();
                    var form = this.$content.find('#openLhc').data('formValidation').validate().isValid();
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

function reOpen(id) {
    jc = $.confirm({
        theme: 'material',
        title: '六合彩-重新开奖',
        closeIcon:true,
        boxWidth:'30%',
        content: 'url:/back/modal/reOpenLhc/'+id,
        buttons: {
            formSubmit: {
                text:'确定',
                btnClass: 'btn-blue',
                action: function () {
                    $('.daterangepicker').hide();
                    var form = this.$content.find('#reOpenLhc').data('formValidation').validate().isValid();
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
                                $('#lhcHistoryTable').DataTable().ajax.reload(null,false)
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
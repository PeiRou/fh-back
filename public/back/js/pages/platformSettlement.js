var dataTable;

$(function () {

    $(".button-1").click(function(){
        $(".button-1 button").removeClass("active");
        // $(".button-1").find('input').removeAttr("checked");
        $(this).find('button').addClass("active");
        $(this).find('input').attr('checked', 'checked');
    });

    $('#menu-platformManage').addClass('nav-show');
    $('#menu-platformManage-settlement').addClass('active');

    dataTable = $('#capitalDetailsTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ordering: false,
        destroy: true,
        aLengthMenu: [[50]],
        ajax: {
            url:'/back/datatables/platform/settlement',
            data:function (d) {
                getParam(d);
            },
            dataSrc:function (e) {
                $('#totalMoney').html(e.totalMoney);
                $('#unpaidMoney').html(e.unpaidMoney);
                return e.data;
            }
        },
        columns: [
            // {data:'id',title:'id'},
            {data:'order_id',title:'订单号'},
            {data:'money',title:'费用'},
            {data:'status',title:'状态'},
            {data:'paystatus',title:'支付状态'},
            {data:'typestr',title:'费用类型'},
            {data:'date',title:'时间'},
            {data:'content',title:'备注'},
            // {data:'created_at',title:'时间'},
            {data:'overstayed',title:'支付到期时间'},
            {data:'control',title:'操作'},
        ],
        columnDefs: [ {
            "targets": 3,
            "createdCell": function (td, cellData, rowData, row, col) {
                if(cellData == '用户已被删除'){
                    $(td).parent().css('background', '#ffd6d6')
                }
            }
        }],
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
    $('#btn_search').on('click',function () {
        dataTable.ajax.reload();

    });

    //开始时间
    $('#rangestart').calendar({
        ampm: false,
        type: 'month',
        formatter: {
            date: function (date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                return year+'-'+month;
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
    //结束时间
    $('#rangeend').calendar({
        ampm: false,
        type: 'month',
        formatter: {
            date: function (date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                return year+'-'+month;
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
function getParam(d){
    d.status = $('#status').val();
    d.startTime = $('#timeStart').val();
    d.endTime = $('#timeEnd').val();
    d.is_delete = $('#is_delete').val();
    d.monthTime = $(".active").siblings("input[name='monthTime']").val();
    return d;
}
function settlement() {
    $.ajax({
        url:'/action/admin/addPlatformSettlement',
        type:'post',
        dataType:'json',
        success:function (data) {
            if(data.status == true){
                Calert(data.msg,'green');
                $('#capitalDetailsTable').DataTable().ajax.reload(null,false);
            }else{
                Calert(data.msg,'red');
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
//统一支付未支付的
function unpaid()
{
    var isRun = false;
    var data = {};
    getParam(data);
    jc = $.confirm({
        theme: 'material',
        title: '确认订单',
        method: 'post',
        closeIcon:true,
        boxWidth:'25%',
        content: function(){
            var self = this;
            return $.ajax({
                url: '/back/modal/payPlatformSettleOfferUnpaid',
                method: 'get',
                data:data
            }).done(function (response) {
                self.setContent(response);
            }).fail(function(){
                self.setContent('error');
            });
        },
        buttons: {
            formSubmit: {
                text:'确定',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#formData').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            }
        },
        contentLoaded: function(data, status, xhr){
            $('.jconfirm-content').css('overflow','hidden');
            if(data.status == 403)
            {
                this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
                $('.jconfirm-buttons').hide();
            }
        }
    });
}

function edit(id,title) {
    jc = $.confirm({
        theme: 'material',
        title: '平台支付费用',
        closeIcon:true,
        boxWidth:'25%',
        content: 'url:/back/modal/payPlatformSettleOffer/'+id,
        buttons: {
            formSubmit: {
                text:'支付',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addBankForm').data('formValidation').validate().isValid();
                    if(!form){
                        return false;
                    }
                    return false;
                }
            }
        },
        contentLoaded: function(data, status, xhr){
            $('.jconfirm-content').css('overflow','hidden');
            if(data.status == 403)
            {
                this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
                $('.jconfirm-buttons').hide();
            }
        }
    });
}

function editReview(id) {
    $.ajax({
        url:'/action/admin/agentSettle/submitReview',
        type:'post',
        dataType:'json',
        data:{agent_report_idx:id},
        success:function (data) {
            if(data.status == true){
                Calert(data.msg,'green');
                $('#capitalDetailsTable').DataTable().ajax.reload(null,false);
            }else{
                Calert(data.msg,'red');
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
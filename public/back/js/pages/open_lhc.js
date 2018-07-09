$(function () {
    $('#menu-openManage').addClass('nav-show');
    $('#menu-openManage-lhc').addClass('active');

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
            {data:'sx'},
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
        boxWidth:'20%',
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
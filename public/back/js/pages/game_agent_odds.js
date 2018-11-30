/**
 * Created by vincent on 2018/2/1.
 */
$(function () {
    $('#menu-gameManage').addClass('nav-show');
    $('#menu-gameManage-agentOdds').addClass('active');

    $('#gamesTable').DataTable({
        aLengthMenu: [[20]],
        searching: false,
        bLengthChange: false,
        processing: true,
        ordering:false,
        serverSide: true,
        ajax: '/back/datatables/agentOdds',
        columns: [
            {data:'id'},
            {data:'level'},
            {data:'odds'},
            {data:'updated_at'},
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
    })
});

function add() {
    jc = $.confirm({
        theme: 'material',
        title: '添加代理赔率',
        closeIcon:true,
        boxWidth:'26%',
        content: 'url:/back/modal/gameAgentOddsAdd',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#gameSettingForm').data('formValidation').validate().isValid();
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

function edit(id) {
    jc = $.confirm({
        theme: 'material',
        title: '修改代理赔率',
        closeIcon:true,
        boxWidth:'26%',
        content: 'url:/back/modal/gameAgentOddsEdit/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#gameSettingForm').data('formValidation').validate().isValid();
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

function look(level) {
       window.location.href = '/back/modal/gameAgentOddsLook/'+level;
}

/**
 * Created by vincent on 2018/1/23.
 */
$(function () {
    $('#menu-userManage').addClass('nav-show');
    $('#menu-userManage-gagent').addClass('active');

    $('#generalAgentTable').DataTable({
        searching: false,
        bLengthChange: false,
        processing: true,
        serverSide: true,
        ajax: '/back/datatables/generalAgent',
        columns: [
            {data:'online'},
            {data:'account'},
            {data:'agent'},
            {data:'members'},
            {data:'balance'},
            {data:'status'},
            {data:'created_at'},
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

function edit(id) {
    jc = $.confirm({
        theme: 'material',
        title: '修改总代理',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/editGeneralAgent/'+id,
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#editGeneralAgentForm').data('formValidation').validate().isValid();
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

function addGeneralAgent() {
    jc = $.confirm({
        theme: 'material',
        title: '添加总代理',
        closeIcon:true,
        boxWidth:'20%',
        content: 'url:/back/modal/addGeneralAgent',
        buttons: {
            formSubmit: {
                text:'确定提交',
                btnClass: 'btn-blue',
                action: function () {
                    var form = this.$content.find('#addGeneralAgentForm').data('formValidation').validate().isValid();
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

function exportMember(id,name) {
    jc = $.confirm({
        title: '确定要导出会员',
        theme: 'material',
        type: 'red',
        boxWidth:'25%',
        content: '这是一个需要注意的操作，导出该总代理下所有会员',
        buttons: {
            confirm: {
                text:'确定导出',
                btnClass: 'btn-red',
                action: function(){
                    window.location.href = '/action/admin/member/exportGAgentMember/'+id+'/'+name;
                }
            },
            cancel:{
                text:'取消'
            }
        }
    });
}
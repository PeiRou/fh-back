$(function () {
    $('#menu-openManage').addClass('nav-show');
    $('#menu-openManage-bjkl8').addClass('active');

    dataTable = $('#datTable').DataTable({
        searching: false,
        bLengthChange: false,
        ordering:false,
        processing: true,
        serverSide: true,
        aLengthMenu: [[50]],
        ajax: {
            url:'/back/datatables/openHistory/bjkl8',
            data:function (d) {

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
                    return "<div class='T_KL8' style='width: 320px'>" + txt + "</div>";
                }},
            {data: function (data) {        //总和
                    if(data.opennum == null || data.opennum == '')
                        return "";
                    after = data.opennum.split(",");
                    zh = 0;
                    for(var i =0;i<after.length;i++){
                        zh = zh + parseInt(after[i])
                    }
                    if(zh > 810)
                        zhdx = "<font color='red'>大</font>";
                    else if(zh < 810)
                        zhdx = "小";
                    else
                        zhdx = 810;
                    zhds = zh%2==1 ?"单":"<font color='red'>双</font>";
                    if(zh >= 210 && zh<=695)
                        zhwh = "金";
                    else if(zh >= 696 && zh<=763)
                        zhwh = "木";
                    else if(zh >= 764 && zh<=855)
                        zhwh = "水";
                    else if(zh >= 856 && zh<=923)
                        zhwh = "火";
                    else if(zh >= 924 && zh<=1410)
                        zhwh = "土";
                    txt = "<td>" + zh + "</td>"+"<td>" + zhdx + "</td>"+"<td>" + zhds + "</td>"+"<td>" + zhwh + "</td>";
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
                        txt = "<li onclick='cancelAll("+data.id+")'>撤单</li>" +
                            "<li onclick='changeNumber("+data.id+")'>重新开奖</li>" ;
                    }else{                      //未开奖
                        txt = "<li onclick='cancelAll("+data.id+")'>修改</li>" +
                            "<li onclick='openbjkl8("+data.id+")'>手动开奖</li>" ;
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
});


function openbjkl8(id) {
    jc = $.confirm({
        theme: 'material',
        title: '北京快乐8-手动开奖',
        closeIcon:true,
        boxWidth:'700px',
        content: 'url:/back/modal/openBjkl8/'+id,
        buttons: {
            formSubmit: {
                text:'确定',
                btnClass: 'btn-blue',
                action: function () {
                    $('.daterangepicker').hide();
                    var form = this.$content.find('#openBjkl8').data('formValidation').validate().isValid();
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
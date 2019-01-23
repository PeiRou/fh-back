<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>编辑活动红包</title>

    <link rel="stylesheet" href="/vendor/Semantic/semantic.min.css">
    <link rel="stylesheet" href="/vendor/confirm/dist/jquery-confirm.min.css">
    <link rel="stylesheet" href="/vendor/dataTables/DataTables-1.10.16/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="/back/css/core.css">

    <script src="/js/jquery.min.js"></script>
    <script src="/vendor/Semantic/semantic.min.js"></script>
    <script src="/vendor/confirm/dist/jquery-confirm.min.js"></script>
    <script src="/vendor/dataTables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/dataTables/DataTables-1.10.16/js/dataTables.semanticui.min.js"></script>
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/vendor/Semantic/semantic.min.js"></script>
    <script src="/vendor/formvalidation/dist/js/formValidation.min.js"></script>
    <script src="/vendor/formvalidation/dist/js/framework/semantic.min.js"></script>
    <script src="/back/js/core.js"></script>

    <style>
        .ui.grid{
            margin: -1px;
        }
        #tableData{
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="user-bet-list">
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>活动条件
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="parent.layer.close(parent.openIndex)">返回</button>
            <span style="margin-left: 50px">同层级概率之和为100%</span>
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="dataTable.ajax.reload(null,false);"><i class="iconfont"></i></span>
            <span onclick="add()">新增红包</span>
        </div>
    </div>
    <table id="tableData" class="ui small celled striped table" cellspacing="0" width="100%">
        <thead>
        </thead>
    </table>
</div>

<script>
    {{--var _id = {{ $id }};--}}
    var activity_id = {{ $id }};
    var dataTable;
    $(function () {
        var columns = [
            {data:'id',title:'id'},
            {data:'is_default',title:'默认'},
            {data:'activity_id',title:'活动名'},
            {data:'level_id',title:'层级'},
            {data:'min_money',title:'最小金额'},
            {data:'max_money',title:'最大金额'},
            {data:'probability',title:'概率'},
            {data:'created_at',title:'添加时间'},
            {data:'control',title:'操作'},
        ];
        function createTable(columns) {
            return $('#tableData').DataTable({
                searching: false,
                bLengthChange: false,
                processing: true,
                serverSide: true,
                ordering: false,
                destroy: true,
                aLengthMenu: [[20]],
                ajax: {
                    url:'/back/datatables/activity/activityHongbaoList',
                    type:'get',
                    data:function (d) {
                        d.activity_id = activity_id
                    }
                },
                columns: columns,
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
        }
        dataTable = createTable(columns);
    });

    function add() {
        jc1 = $.confirm({
            theme: 'material',
            title: '新增红包',
            closeIcon:true,
            boxWidth:'25%',
            content: 'url:/back/modal/addActivityHongbaoProbability',
            buttons: {
                formSubmit: {
                    text:'确定提交',
                    btnClass: 'btn-blue',
                    action: function () {
                        var form = this.$content.find('#formData').data('formValidation').validate().isValid();
                        if(!form){
                            return false;
                        }
                        return false;
                    }
                }
            }
        });
    }
    function edit(id) {
        jc1 = $.confirm({
            theme: 'material',
            title: '新增红包',
            closeIcon:true,
            boxWidth:'25%',
            content: 'url:/back/modal/editActivityHongbaoProbability/'+id,
            buttons: {
                formSubmit: {
                    text:'确定提交',
                    btnClass: 'btn-blue',
                    action: function () {
                        var form = this.$content.find('#formData').data('formValidation').validate().isValid();
                        if(!form){
                            return false;
                        }
                        return false;
                    }
                }
            }
        });
    }

    function del(id) {
        jc = $.confirm({
            title: '确定要删除吗？',
            theme: 'material',
            type: 'red',
            boxWidth:'25%',
            content: '请确认您的操作',
            buttons: {
                confirm: {
                    text:'确定',
                    btnClass: 'btn-red',
                    action: function(){
                        $.ajax({
                            url:'/action/admin/activity/delActivityCondition',
                            type:'post',
                            dataType:'json',
                            data:{
                                activity_id:activity_id
                            },
                            success:function (data) {
                                if(data.status == true){
                                    dataTable.ajax.reload(null,false);
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

</script>
</body>
</html>

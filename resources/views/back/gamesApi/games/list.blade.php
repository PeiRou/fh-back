@extends('back.master')

@section('title','游戏管理')

@section('content')
    <link rel="stylesheet" href="/vendor/zTree_v3/css/metroStyle/metroStyle.css">
    <script type="text/javascript" src="/vendor/zTree_v3/js/jquery.ztree.core.min.js"></script>
    <script type="text/javascript" src="/vendor/zTree_v3/js/jquery.ztree.excheck.js"></script>
    <style>
        .tree {
             min-height: initial;
             max-height: initial;
            overflow: hidden;
            overflow-y: auto;
        }
        .tree ul li {
            margin:5px 0px;
        }
        .sort{
            /*display: none;*/
            margin:0 10px!important;
        }
        .ztree li a {
            width: 100%;
            cursor: default!important;
        }
        .ztree li a span {
            width: 100%;
            cursor: pointer;
        }
        .ztree li a:hover {
             text-decoration: none;
        }
        .control-menu{
        }
        .control-menu span {
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 3px 4px;
            margin:0 4px;
        }
        .control-menu span:hover{
            background: #343434;
            color: #fff;
        }
        .master{
            font-weight: 800;
            font-size: 14px;
        }

    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>游戏管理
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span onclick="save()">保存</span>
            <span onclick="add()">添加</span>
            <span onclick="sort1()">排序</span>
        </div>
    </div>
    {{--{{ p(\App\GamesList::getTreeList(), 1) }}--}}
    <div class="table-content">
        <form action="">
            <div class="tree">
                <ul id="treeDemo" class="ztree"></ul>
            </div>
<<<<<<< HEAD
        </form>
=======
        </div>
        <table id="example" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>父级栏目</th>
                <th>游戏ID</th>
                <th>游戏名称</th>
                <th>预览图(电脑端)</th>
                <th>预览图(手机端)</th>
                <th>使用接口</th>
                {{--<th>类型</th>--}}
                <th>开关</th>
                <th>排序</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
>>>>>>> 89175fa434c6cd516d1b9ffbaf1685cebebccfb7
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/gamesList.js"></script>
    <script>
        var zNodes = [
            @foreach(\App\GamesList::getGamesList() as $k=>$v)
            {
                name: '{!! '<input type="text" class="sort" data-id="'.$v['game_id'].'" style="margin-right:5px; width: 30px; height:20px;" value="'.$v['sort'].'">' !!}'+"<span class='master'>{{ $v['name'] }}</span>",
                id: {{ $v['id'] }},
                pId: {{ $v['pid'] }},
                game_id:'{{ $v['game_id'] }}',
                checked:@if($v['open'] == 1) true @else false @endif,
                children: [
                    @foreach($v['child'] as $kk=>$vv)
                    {
                        name: '{!! '<input type="text" class="sort" data-id="'.$vv['game_id'].'" style="margin-right:5px; width: 30px; height:20px;" value="'.$vv['sort'].'">' !!}' + "{{ $vv['name'] }}",
                        id: {{ $vv['id'] }},
                        pId: {{ $vv['pid'] }},
                        game_id:'{{ $vv['game_id'] }}',
                        checked:@if($vv['open'] == 1) true @else false @endif,
                        children: [
                                @foreach($vv['child'] as $kkk=>$vvv)
                            {
                                name: '{!! '<input type="text" class="sort" data-id="'.$vv['game_id'].'" style="margin-right:5px; width: 30px; height:20px;" value="'.$vvv['sort'].'">' !!}' + "{{ $vvv['name'] }}",
                                id: {{ $vvv['id'] }},
                                pId: {{ $vvv['pid'] }},
                                game_id:'{{ $vvv['game_id'] }}',
                                checked:@if($vvv['open'] == 1) true @else false @endif,
                            },
                            @endforeach
                        ]
                    },
                    @endforeach
                ]
            },
            @endforeach
        ];
        function addDiyDom(treeId, treeNode) {
            var aObj = $("#" + treeNode.tId + "_a");
            var str = '<span class="control-menu"><span onclick="edit('+treeNode.id+')">修改</span><span onclick="del('+treeNode.id+')">删除</span></span>'
            aObj.append(str);
        }
    </script>
@endsection
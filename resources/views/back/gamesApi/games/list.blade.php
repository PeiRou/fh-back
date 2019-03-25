@extends('back.master')

@section('title','游戏管理')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>游戏管理
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span onclick="add()">添加</span>
            <span onclick="sort()">排序</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field" style="width: initial!important;">
                        <select class="ui dropdown" id="pid" style="height:32px !important">
                            <option value="">全部</option>
                            <option value="0" selected = "selected">一级栏目</option>
                            @foreach($p as $v)
                                <option value="{{ $v['id'] }}" @if(isset($data->pid) && $v['id'] == $data->pid) selected = "selected" @endif>{{ '  |'.str_repeat('__', $v['level'] + 1) }}{{ $v['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询</button>
                    </div>
                    <div class="field">
                        <button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置</button>
                    </div>
                </div>
            </div>
        </div>
        <table id="example" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>父级栏目</th>
                <th>游戏ID</th>
                <th>游戏名称</th>
                <th>使用接口</th>
                {{--<th>类型</th>--}}
                <th>开关</th>
                <th>排序</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/gamesList.js"></script>
@endsection
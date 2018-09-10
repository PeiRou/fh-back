@extends('back.master')

@section('title','权限管理')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>权限管理
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span onclick="addPermission()">添加权限</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field" style="width: 9% !important;">
                        <input type="text" id="route_name" placeholder="路由别名">
                    </div>
                    <div class="one wide field">
                        <select class="ui dropdown" id="pid" style='height:32px !important'>
                            <option value="">权限：</option>
                            @foreach($aPermissionsAuths as $aPermissionsAuth)
                                <option value="{{ $aPermissionsAuth->id }}">--{{ $aPermissionsAuth->auth_name }}</option>
                                @if(!empty($aPermissionsAuth->child))
                                    @foreach($aPermissionsAuth->child as $child)
                                        <option value="{{ $child->id }}">  |__{{ $child->auth_name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="one wide field">
                        <button id="btn_search" class="fluid ui mini labeled icon teal button"><i class="search icon"></i> 查询 </button>
                    </div>
                    <div class="one wide field">
                        <button id="reset" class="fluid ui mini labeled icon button"><i class="undo icon"></i> 重置 </button>
                    </div>
                </div>
            </div>
        </div>
        <input id="exampleAuthId" type="hidden" value="{{ $auth_id }}">
        <table id="example" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>权限编号(ID)</th>
                <th>权限名称</th>
                <th>权限别名</th>
                <th>类型</th>
                <th>是否有下级</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/permissionsAuth.js"></script>
@endsection
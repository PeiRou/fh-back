@extends('back.master')

@section('title','广告位内容')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>广告位内容
            <button style="line-height: 20px;border:0;margin-left: 10px;cursor:pointer;" onclick="javascript:history.go(-1)">返回</button>
        </div>
        <div class="content-top-buttons">
            <span onclick="generate()">生成文件</span>
            <span onclick="preview()"><a target="_blank" href="/static/jsFile/generate.json">预览文件</a></span>
            <span onclick="add()">添加广告内容</span>
            <span onclick="setSort()">排序</span>
        </div>
    </div>
    <div class="table-content">
        <div class="table-quick-bar">
            <div class="ui mini form">
                <div class="fields">
                    <div class="one wide field">
                        <select class="ui dropdown" id="ad_id" style='height:32px !important'>
                            <option value="">请选择广告位</option>
                            @foreach($aData as $iData)
                                <option value="{{ $iData->id }}"> {{ $iData->title }}</option>
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
        <table id="example" class="ui small selectable celled striped table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>广告位</th>
                <th>后台备注(这不会显示在前台)</th>
                <th>类型</th>
                <th>键值</th>
                <th style="width: 300px;">内容</th>
                <th>状态</th>
                <th>排序</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/advertiseInfo.js"></script>
@endsection
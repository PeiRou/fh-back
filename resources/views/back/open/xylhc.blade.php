@extends('back.master')

@section('title','历史开奖-幸运六合彩')

@section('content')
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>幸运六合彩
        </div>
        <div class="content-top-buttons">
            <span onclick="addBank()">1</span>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="/back/js/pages/open_xylhc.js"></script>
@endsection
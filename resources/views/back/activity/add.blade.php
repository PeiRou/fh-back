@extends('back.master')

@section('title','资金明细')

@section('content')
    <style>
        .table-content{
            width: 100%;
            min-height: 500px;
            background-color: #f0f0f0;
        }
        .content{
            min-height: 300px;
        }
        .c-left{
            width: 700px;
            float: left;
            border-right: 1px solid #bbb;
        }
        .c-right{
            width: 700px;
            float: left;
        }
        .calendar{
            float: left;
        }
        .left{
            float: left;
        }
        .height40{
            height: 40px;
        }
        .clear{
            clear: both;
        }
        .in-block{
            display: inline-block;
        }
        .huodong{
            border: 1px solid #bbb;
            width: 200px;
            height: 30px;
        }
        .date{
            display: inline-block;
            width: 200px;
            height: 30px;
        }
        .sele{
            display: inline-block;
            width: 200px;
            height: 30px;
            background: #f0f0f0;
        }
        .tab{
            text-align: center;
        }
        .tab th{
            width: 100px;
            height: 20px;
            background-color: #ccc;
        }
        .tab td{
            width: 100px;
            height: 20px;
            background: #fff;
        }
        .txta{
            width: 700px;
            height: 200px;
            text-indent: 0;
        }
        .but{
            width: 100%;
            height: 50px;
            border-top: 1px solid cornflowerblue;
        }
        .but button{
            width: 70px;
            height: 30px;
            background-color: #0c60ee;
            border: none;
            color: #fff;
            border-radius: 3px;
        }
        .but-c{
            width: 200px;
            margin: auto;
            margin-top: 30px;
        }
    </style>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>修改活动
        </div>
    </div>
    <div class="table-content">
        <form>
            <div class="content">
                <div class="c-left">
                    <div class="height40">
                    活动名称 ： <input type="text" name="name" class="huodong" value=""/>
                    </div>
                    <div class="left height40">
                    活动时间 ：
                    </div>
                    <div class="height40 in-block" id="rangestart">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="date" class="date" name="start_time" value=""/>
                        </div>
                    </div>
                    <div class="height40 in-block" id="rangeend">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="date" class="date" name="end_time" value=""/>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <label class="height40">
                    活动类型 ：
                    </label>
                    <select name="status" class="sele">
                        <option value="">请选择</option>
                        <option value="1">123</option>
                    </select>
                    <br><br><br>
                    <label class="height40" style="vertical-align: top;">
                    活动条件 :
                    </label>
                    <table class="in-block tab">
                        <tr>
                            <th>连续天数</th>
                            <th>充值金额</th>
                            <th>打码量</th>
                            <th>操作</th>
                        </tr>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>

                    </table>
                </div>
                <div class="c-right">
                    <div>
                        活动说明
                    </div>
                    <textarea name="content" class="txta">

                    </textarea>
                </div>
            </div>
            <div class="clear"></div>
            <div class="but">
                <div class="but-c">
                <button>提交</button>
                <button>返回</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('page-js')
    <script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
    <link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
    <script src="/back/js/pages/activityList.js"></script>
@endsection
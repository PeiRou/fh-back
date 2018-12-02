<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>实时滚单-管理后台</title>

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
    <style>
        body{
            font-family: '微软雅黑';
            font-size: 9pt;
        }
        .user-bet-list .title{
            border-left: 3px solid red;
            font-size: 14px;
            padding-left: 10px;
            border-bottom: 1px solid #ddd;
            height: 25px;
            line-height: 24px;
        }
        .games{height: auto;overflow: hidden;padding: 4px 0;}
        .games .title{float: left;border: none;}
        .games .list{float: left;font-size: 14px;}
        .show-open{
            border: 1px solid #d6d6d6;
            height: auto;
            width: 300px;
            position: absolute;
            left: 0;
            background: #fff;
            top: -80px;
            display: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.21);
            border-radius: 5px;
            cursor: pointer;
            overflow: hidden;
        }
        .open-float-num span{
            font-size: 12pt;
            font-weight: bold;
            padding: 5px;
            display: block;
            float: left;
            margin-right: 0px;
        }
        .ll-text{
            text-align: center;
            padding: 20px;
            color: #b5b5b5;
        }
        .select_btn{
            font-size: 12px;
            padding: 4px 8px;
        }
        .table-content .title {
            border-left: 3px solid red;
            font-size: 14px;
            padding-left: 10px;
            border-bottom: 1px solid #ddd;
            height: 25px;
            line-height: 24px;
        }
        .table-content {
            padding: 0px 15px 20px 15px;
        }
    </style>
</head>
<body>
<div class="table-content">
    <div class="title">实时滚单</div>
    <div class="table-quick-bar" style="padding-bottom: 10px;">
        @foreach($games as $item)
            <div class="ui checkbox">
                <input type="checkbox" tabindex="0" value="{{ $item->game_id }}" name="gamesData" class="hidden">
                <label>{{ $item->game_name }}</label>
            </div>
        @endforeach
    </div>
    <div class="table-quick-bar">
        <div class="ui mini form">
            <div class="fields">
                <div class="one wide field">
                    <input type="text" id="issue" placeholder="期数">
                </div>
                <div class="one wide field">
                    <input type="text" id="username" placeholder="账号">
                </div>
                <div class="one wide field">
                    <input type="text" id="minMoney" placeholder="下注最小金额">
                </div>

                <div class="one wide field">
                    <select class="ui dropdown" id="time" style='height:32px !important'>
                        <option value="10000">10秒</option>
                        <option value="15000">15秒</option>
                        <option value="20000">20秒</option>
                        <option value="30000">30秒</option>
                        <option value="40000">40秒</option>
                        <option value="60000">60秒</option>
                    </select>
                </div>
                <div class="two wide field" style="width: 8.5%!important;">
                    <button id="btn_hand_search" class="fluid ui mini labeled icon teal button"><i class="history icon"></i> 手动刷新 </button>
                </div>
            </div>
        </div>
    </div>
    <table id="betRealTimeTable" class="ui small selectable celled striped table" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>订单号</th>
            <th>下单时间</th>
            <th>会员</th>
            <th>游戏</th>
            <th>期号</th>
            <th>玩法</th>
            <th>返水</th>
            <th>下注金额</th>
        </tr>
        </thead>
    </table>
</div>

<script>

</script>
<script src="/back/js/pages/bet_realtime.js"></script>

</body>
</html>

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GamesApi extends Model
{
    protected $table = 'games_api';
    protected $primaryKey = 'g_id';
    public $statusArr = [
        '1' => '棋牌游戏',
        '2' => '天成'
    ];
    //获取游戏信息
    public static function getGamesApiInfo($g_id){
        return self::where('g_id', $g_id)->first();
    }
    //获取所有棋牌游戏
    public static function getQpList($param = []){
        return self::where(function($sql) use ($param){
            if(isset($param['g_id']))
                $sql->where('g_id', $param['g_id']);
            else
                $sql->where('type', 1);

            if(isset($param['open']))
                $sql->where('open', $param['open']);

            $sql->where('type_id', 111);
        })->get();
    }
    //获取拉数据的游戏
    public static function getBetList($param = []){
        return self::where(function($sql) use ($param){
            if(isset($param['g_id']))
                $sql->where('g_id', $param['g_id']);
            else
                isset($param['type']) && $sql->where('type', $param['type']);

            if(isset($param['open']))
                $sql->where('open', $param['open']);

            $sql->where('type_id', 111);
        })->get();
    }
    //获取天成的游戏 现在暂时只有一个
    public static function getTcList(){
        return self::where('type', 2)->first();
    }
    //检查游戏是否开启
    public static function getStatus($g_id){
        return self::where('g_id', $g_id)->value('status');
    }
    //获取所有游戏名称
    public static function getGamesNameList(){
        return self::pluck('name', 'g_id');
    }
    //组合sql
    public static function card_betInfoSql1($request, $type_id = 111){
        //获取所有棋牌的游戏
        $gamesList = self::where(function($aSql) use ($request, $type_id){
            $aSql->where('type_id', $type_id);
            $aSql->where('type', 1);
            if(isset($request->g_id) && $g_id = $request->g_id)
                $aSql->where('g_id', $g_id);
        })->get();
        $where = ' 1 ';
        if(($startTime = $request->startTime) && ($endTime = $request->endTime))
            $where .= " AND `GameStartTime` BETWEEN '{$startTime} 00:00:00' AND '{$endTime} 23:59:59' ";
        if(isset($request->Accounts) && $Accounts = $request->Accounts)
            $where .= " AND `Accounts` = '{$Accounts}' ";
        $sqlArr = [];
//        $columnArr = ['id', 'GameID', 'Accounts', 'AllBet', 'Profit', 'GameStartTime', 'GameEndTime'];
        $columnArr = ['id','SUM(AllBet) as AllBet', 'COUNT(*) AS `betCount`', 'Accounts', 'SUM(Profit) AS Profit', ' MIN(GameStartTime) AS GameStartTime', 'MAX(GameEndTime) AS GameEndTime '];

        $column = implode(',', $columnArr);
        foreach ($gamesList as $k=>$v){
            $table = 'jq_'.strtolower($v->alias).'_bet';
            $sqlArr[] = " (SELECT {$column},'{$v->name}' AS `name`,{$v->g_id} AS `g_id`  FROM `{$table}` WHERE {$where} GROUP BY Accounts ) ";
        }
        return $sqlArr;
    }
    //获取棋牌报表的sql
    public static function card_betInfoSql($request, $type_id = 111){
        //获取所有棋牌的游戏
        $gamesList = self::where(function($aSql) use ($request, $type_id){
            $aSql->where('type_id', $type_id);
            $aSql->where('type', 1);
            if(isset($request->g_id) && $g_id = $request->g_id)
                $aSql->where('g_id', $g_id);
        })->get();
        $where = ' 1 ';
        $btwhere = ' 1 ';
        $ltwhere = ' 1 ';

        if(($startTime = $request->startTime) && ($endTime = $request->endTime)) {
            $btwhere .= " AND `GameStartTime` BETWEEN '{$startTime} 00:00:00' AND '{$endTime} 23:59:59' ";
            $ltwhere .= " AND `date` BETWEEN '{$startTime} 00:00:00' AND '{$endTime} 23:59:59' ";
        }
        if(isset($request->Accounts) && $Accounts = $request->Accounts)
            $where .= " AND `Accounts` = '{$Accounts}' ";
        $sqlArr = [];
        $columnArr = [
//            'id',
            'SUM(AllBet) as AllBet',
            'COUNT(AllBet > 0 OR null) AS `betCount`',
            'SUM(Profit) AS Profit',
//            ' MIN(GameStartTime) AS GameStartTime',
//            'MAX(GameEndTime) AS GameEndTime ',
            'GameStartTime',
            'SUM(CASE WHEN `type` = 1 THEN `amount` END) AS upMoney',
            'SUM(CASE WHEN `type` = 2 THEN `amount` END) AS downMoney'
        ];
        $column = implode(',', $columnArr);
        foreach ($gamesList as $k=>$v){
            $table = 'jq_'.strtolower($v->alias).'_bet';
            $listTable = 'jq_'.strtolower($v->alias).'list';

            $sqlArr[] = " ( 
                    SELECT 
                         Accounts,
                        '{$v->name}' AS `name`,{$v->g_id} AS `g_id` ,
                       {$column}
                        FROM (
                        SELECT `Accounts`,`AllBet`,`Profit`, 0 AS `type`, 0 AS `amount`,`GameStartTime` AS `GameStartTime` FROM `{$table}` WHERE {$btwhere}
                        UNION ALL
                        SELECT `username` AS `Accounts`,null AS `AllBet`,null AS `Profit`, `type`, `amount`,`date` AS `GameStartTime` FROM `{$listTable}` WHERE {$ltwhere} AND type != 3
                        ) AS {$table}
                        WHERE $where
                        GROUP BY Accounts 
                    ) ";
        }
        return $sqlArr;
    }
    //获取棋牌下注查询的总计
    public static function card_betInfoTotal1($request, $sqlArr){
        $sql = 'SELECT SUM(`betCount`) AS `BetCountSum`, SUM(`AllBet`) AS `BetSum`, SUM(`Profit`) AS `ProfitSum` FROM ( '.implode(' UNION ALL ', $sqlArr).' ) AS a  ORDER BY `GameStartTime` LIMIT 1 ';
        return DB::select($sql)[0];
    }
    //获取棋牌报表的总计
    public static function card_betInfoTotal($request, $sqlArr){
        $sql = 'SELECT COUNT(distinct `Accounts`) AS `count_user`, SUM(`upMoney`) AS totalUp,SUM(`downMoney`) AS totalDown, SUM(`betCount`) AS `BetCountSum`, SUM(`AllBet`) AS `BetSum`, SUM(`Profit`) AS `ProfitSum` FROM ( '.implode(' UNION ALL ', $sqlArr).' ) AS a  ORDER BY `GameStartTime` LIMIT 1 ';
        return DB::select($sql)[0];
    }
    //获取棋牌的数据
    public static function card_betInfoData($request, $sqlArr){
        $limit = '';
        if(isset($request->start) && isset($request->length))
            $limit = 'LIMIT '.$request->start.','.$request->length;
        $sql = 'SELECT * FROM ( '.implode(' UNION ALL ', $sqlArr).' ) AS a  ORDER BY `GameStartTime` DESC '.$limit;
        return DB::select($sql);
    }

    //获取天成游戏报表的数据
    public static function tc_betInfoData($param)
    {
        return DB::select(static::tc_betInfoSql($param));
    }
    //总数
    public static function tc_betInfoCount($param)
    {
        return DB::select(' SELECT COUNT(*) AS `count` FROM ('.static::tc_betInfoSql($param, 0).') as b ')[0]->count;
    }
    //总记
    public static function tc_betInfoTotal($param)
    {
        $sql =' SELECT SUM(bet_count) AS `bet_count`,
                SUM(user_count) AS user_count,
                SUM(AllBet) AS AllBet,
                SUM(Profit) AS Profit,
                SUM(validBetAmount) AS validBetAmount,
                productType,
                SUM(upMoney) AS upMoney,
                SUM(downMoney) AS downMoney FROM ( '.static::tc_betInfoSql($param, 0).' ) as b ';
        return DB::select($sql)[0];
    }

    public static function tc_betInfoSql($param, $limit = 1, $column = 0, $group = true)
    {
        ($limit &&
        isset($param->start, $param->length) &&
        $limit = " LIMIT {$param->start}, {$param->length} ") ||
        $limit = '';

        $groupInfo = '';

        if($group){
            $groupInfo = 'GROUP BY productType';
            isset($param->isGroupUser) && $groupInfo = 'GROUP BY productType,username';
        }

        $columns = [
            0 => 'COUNT(AllBet > 0 OR null) AS `bet_count`,
                COUNT(distinct username) AS user_count,
                SUM(AllBet) AS AllBet,
                SUM(Profit) AS Profit,
                SUM(validBetAmount) AS validBetAmount,
                productType,
                SUM(upMoney) AS upMoney,
                SUM(downMoney) AS downMoney,
                username',
        ];
        $column = $columns[$column];

        $where_bet = ' 1 ';
        $where_list = ' 1 ';
        if(isset($param->startTime,$param->endTime)){
            $param->startTime = date('Y-m-d', strtotime($param->startTime));
            $param->endTime = date('Y-m-d', strtotime($param->endTime));
            $where_bet .= " AND `GameStartTime` BETWEEN '{$param->startTime} 00:00:00' AND '{$param->endTime} 23:59:59' ";
            $where_list .= " AND `date` BETWEEN '{$param->startTime} 00:00:00' AND '{$param->endTime} 23:59:59' ";
        }
        if(isset($param->username)){
            $where_bet .= " AND `Accounts` = '{$param->username}' ";
            $where_list .= " AND `username` = '{$param->username}' ";
        }
        if(isset($param->productType)){
            $where_bet .= " AND `productType` = '{$param->productType}' ";
            $where_list .= " AND `productType` = '{$param->productType}' ";
        }

        $sql = "select 
                {$column}
                FROM (
                    SELECT 
                    Accounts AS username,
                    AllBet,
                    Profit,
                    GameStartTime AS `date`,
                    validBetAmount,
                    productType,
                    0 AS upMoney,
                    0 AS downMoney
                    FROM jq_wsgj_bet 
                    WHERE {$where_bet}
                    UNION ALL
                    SELECT 
                    username,
                    0 AS AllBet,
                    0 AS Profit,
                    `date`,
                    0 AS validBetAmount,
                    productType,
                    (CASE WHEN `type` = 1 THEN `amount` ELSE 0 END) AS upMoney,
                    (CASE WHEN `type` = 2 THEN `amount` ELSE 0 END) AS downMoney
                    FROM jq_wsgjlist
                    WHERE {$where_list}
                ) AS a
                ".$groupInfo." {$limit} ";
        return $sql;
    }

    public static function report_tc_data($param)
    {
        return DB::select(static::report_tc_sql($param));
    }
    //总数
    public static function report_tc_Count($param)
    {
        return DB::select(' SELECT COUNT(*) AS `count` FROM ('.static::report_tc_sql($param, 0).') as b ')[0]->count;
    }
    //总记
    public static function report_tc_Total($param)
    {
        $sql =' SELECT SUM(bet_count) AS `bet_count`,
                SUM(AllBet) AS AllBet,
                SUM(Profit) AS Profit,
                SUM(validBetAmount) AS validBetAmount FROM ( '.static::report_tc_sql($param, 0).' ) as b ';
        return DB::select($sql)[0];
    }
    public static function report_tc_sql($param, $limit = 1, $column = 0, $group = true)
    {
        ($limit &&
            isset($param->start, $param->length) &&
            $limit = " LIMIT {$param->start}, {$param->length} ") ||
        $limit = '';

        $columns = [
            0 => 'COUNT(*) AS bet_count, 
                SUM(AllBet) AS AllBet,
                SUM(Profit) AS Profit,
                SUM(validBetAmount) AS validBetAmount,
                Accounts AS username, 
                productType, 
                gameCategory ',
        ];
        $column = $columns[$column];

        $where_bet = ' 1 ';
        if(isset($param->startTime,$param->endTime)){
            $param->startTime = date('Y-m-d', strtotime($param->startTime));
            $param->endTime = date('Y-m-d', strtotime($param->endTime));
            $where_bet .= " AND `GameStartTime` BETWEEN '{$param->startTime} 00:00:00' AND '{$param->endTime} 23:59:59' ";
        }

        if (isset($param->productType))
            $where_bet .= " AND productType = {$param->productType} ";
        if (isset($param->username))
            $where_bet .= " AND Accounts = '{$param->username}' ";

        $sql = "SELECT {$column}
                FROM jq_wsgj_bet 
                WHERE {$where_bet}
                 ".($group ? 'GROUP BY productType,gameCategory,Accounts' : '')." {$limit} ";
        return $sql;
    }


}

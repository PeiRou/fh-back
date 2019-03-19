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
}

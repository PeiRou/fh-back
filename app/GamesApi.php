<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GamesApi extends Model
{
    protected $table = 'games_api';
    protected $primaryKey = 'g_id';
    public $statusArr = [
        '111' => '棋牌游戏',
        '112' => '体育赛事'
    ];
    //获取游戏信息
    public static function getGamesApiInfo($g_id){
        return self::where('g_id', $g_id)->first();
    }
    //获取所有棋牌游戏
    public static function getQpList(){
        return self::where('type_id', 111)->get();
    }
    //获取所有体彩游戏
    public static function getTcList(){
        return self::where('type_id', 112)->get();
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
    public static function card_betInfoSql($request, $type_id = 111){
        //获取所有棋牌的游戏
        $gamesList = self::where(function($aSql) use ($request, $type_id){
            $aSql->where('type_id', $type_id);
            if(isset($request->g_id) && $g_id = $request->g_id)
                $aSql->where('g_id', $g_id);
        })->get();
        $where = ' 1 ';
        if(($startTime = $request->startTime) && ($endTime = $request->endTime))
            $where .= " AND `GameStartTime` BETWEEN '{$startTime} 00:00:00' AND '{$endTime} 23:59:59' ";
        if(isset($request->Accounts) && $Accounts = $request->Accounts)
            $where .= " AND `Accounts` IN('{$Accounts}','".(env('KY_AGENT').'_'.$Accounts)."') ";
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
    //获取棋牌游戏的总计
    public static function card_betInfoTotal($request, $sqlArr){
        $sql = 'SELECT SUM(`betCount`) AS `BetCountSum`, SUM(`AllBet`) AS `BetSum`, SUM(`Profit`) AS `ProfitSum` FROM ( '.implode(' UNION ALL ', $sqlArr).' ) AS a  ORDER BY `GameStartTime` LIMIT 1 ';
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

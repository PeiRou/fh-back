<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
class Bets extends Model
{
    protected $table = 'bet';
    protected $primaryKey = 'bet_id';

    public static function pushOpenResultToRedis($code,$openCode,$openIssue,$winer){
        Redis::publish('open-channel',
            json_encode([
                'code'      => $code,
                'opencode'  => $openCode,
                'expect'     => $openIssue,
                'winer'     => $winer  //中奖名单
            ])
        );
    }

    public static function AssemblyFundDetails($param){
        $aSql = Bets::select(DB::raw("users.username,bet.user_id,bet.order_id,bet.created_at,bet.status,bet.bet_money as money,bet.bet_balance as balance,bet.issue,bet.game_id,game.game_name,bet.play_name as play_type,'' as agent,bet.color as agent_id,bet.bet_info as content,'' as content1,bet.freeze_money,bet.unfreeze_money,bet.nn_view_money,bet.bunko as c_money,bet.bet_id,'' as rechargesType"))
            ->where(function ($sql) use ($param) {
                $sql->where('bet.bunko','!=','0');
                if(isset($param['startTime']) && array_key_exists('startTime',$param) && isset($param['endTime']) && array_key_exists('endTime',$param)){
                    $sql->whereBetween('bet.created_at',[date("Y-m-d 00:00:00",strtotime($param['startTime'])),date("Y-m-d 23:59:59",strtotime($param['endTime']))]);
                }else{
                    if (isset($param['time_point']) && array_key_exists('time_point', $param)) {
                        if ($param['time_point'] == 'today') {
                            $time = date('Y-m-d');
                            $sql->whereBetween('bet.created_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        } elseif ($param['time_point'] == 'yesterday') {
                            $time = date('Y-m-d', strtotime('- 1 day', time()));
                            $sql->whereBetween('bet.created_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        } else {
                            $time = date('Y-m-d', strtotime('- 2 day', time()));
                            $sql->where('bet.created_at', '<=', $time . '23:59:59');
                        }
                    }
                }
                if(isset($param['account_id']) && array_key_exists('account_id',$param)){
                    $sql->where('users.id','=',$param['account_id']);
                }
                if (isset($param['account']) && array_key_exists('account', $param)) {
                    $sql->where('users.username', '=', $param['account']);
                }
                if (isset($param['game_id']) && array_key_exists('game_id', $param)) {
                    $sql->where('bet.game_id', '=', $param['game_id']);
                }
                if (isset($param['order_id']) && array_key_exists('order_id', $param)) {
                    $sql->where('bet.order_id', '=', $param['order_id']);
                }
                if (isset($param['issue']) && array_key_exists('issue', $param)) {
                    $sql->where('bet.issue', '=', $param['issue']);
                }
                if (isset($param['amount_min']) && array_key_exists('amount_min', $param)) {
                    $sql->where('bet.bunko', '>=', $param['amount_min']);
                }
                if (isset($param['amount_max']) && array_key_exists('amount_max', $param)) {
                    $sql->where('bet.bunko', '<=', $param['amount_max']);
                }
            })->leftJoin('users', 'users.id', '=', 'bet.user_id')->leftJoin('game', 'game.game_id', '=', 'bet.game_id');
        return $aSql;
    }

    //获取代理结算初步信息
    public static function preliminaryManualSettlement($array){
        $sql = "SELECT count(bet.`bet_id`) AS `betCount`,sum(CASE WHEN bet.`bunko` > 0 THEN bet.`bunko` - bet.`bet_money` ELSE bet.`bunko` END) AS `sumBunko`,sum(bet.`bet_money`) AS `sumBetMoney`,bet.`user_id`,bet.`agent_id` FROM `bet` WHERE bet.`created_at` BETWEEN :startTime AND :endTime GROUP BY bet.`user_id`,bet.`agent_id`";
        $sqlArray = ['startTime'=>$array['start'],'endTime'=>$array['end']];
        return DB::select($sql,$sqlArray);
    }

    //获取平台的盈亏
    public static function platformManualSettlement($array){
        $sql = "SELECT SUM(CASE WHEN bet.`bunko` > 0 THEN bet.`bunko` - bet.`bet_money` ELSE bet.`bunko` END) AS sumMoney FROM `bet` WHERE bet.`created_at` BETWEEN :startTime AND :endTime ";
        $sqlArray = ['startTime'=>$array['start'],'endTime'=>$array['end']];
        $data = DB::select($sql,$sqlArray);
        return empty($data['sumMoney']) ? 0 : $data['sumMoney'];
    }

    function randColor(){
        $rand = rand(1,20);
        switch($rand){
            case 1:
                $color = 'ca2727';
                break;
            case 2:
                $color = '779888';
                break;
            case 3:
                $color = 'bbbbbb';
                break;
            case 4:
                $color = 'f59bca';
                break;
            case 5:
                $color = 'ef429d';
                break;
            case 6:
                $color = 'ca00be';
                break;
            case 7:
                $color = 'f351ea';
                break;
            case 8:
                $color = 'dba1f1';
                break;
            case 9:
                $color = 'bb00ff';
                break;
            case 10:
                $color = '5100ff';
                break;
            case 11:
                $color = '926ae8';
                break;
            case 12:
                $color = '1d3fd0';
                break;
            case 13:
                $color = '43c3fb';
                break;
            case 14:
                $color = '6edccb';
                break;
            case 15:
                $color = '18bfa5';
                break;
            case 16:
                $color = '81d47a';
                break;
            case 17:
                $color = '23dc13';
                break;
            case 18:
                $color = '99bf18';
                break;
            case 19:
                $color = 'dac54c';
                break;
            case 20:
                $color = 'ff9938';
                break;
        }
        return $color;
    }

    public static function getBetAndUserByIssue($issue,$gameId){
        return self::select('users.id','bet.bet_money','bet.order_id','bet.game_id','bet.issue','users.money')
            ->where('bet.issue',$issue)->where('bet.game_id',$gameId)
            ->join('users','users.id','=','bet.user_id')->get()->toArray();
    }

    public static function getDailyStatistics($dayTime){
        return self::select(DB::raw("'user_id','COUNT(bet_id) AS betCount','SUM(bet_money) AS betMoney','SUM(case WHEN game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) AS sumBunko'"))
            ->whereBetween('created_at',[$dayTime,$dayTime.' 23:59:59'])
            ->groupBy('user_id')->get();
    }

    public static function cancelBetting($issue,$gameId){
        return self::where('issue',$issue)->where('game_id',$gameId)->delete();
    }

    public static function betMemberReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`created_at`,10) AS `date`,`user_id`,COUNT(`bet_id`) AS `idCount`,SUM(`bet_money`) AS `betMoneySum`,
                  SUM(CASE WHEN `game_id` IN(90,91) THEN (CASE WHEN `nn_view_money` > 0 THEN `bet_money` ELSE 0 END) ELSE (CASE WHEN `bunko` >0 THEN `bet_money` ELSE 0 END) END) AS `sumWinbet`,
                  SUM(CASE WHEN `game_id` IN(90,91) THEN `nn_view_money` ELSE (CASE WHEN `bunko` >0 THEN `bunko` - `bet_money` ELSE `bunko` END) END) AS `sumBunko`
                  FROM `bet` WHERE 1 AND `testFlag` IN(0,2)";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `created_at` >= :startTime";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `created_at` <= :endTime";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `date`,`user_id` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function betAgentReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`bet`.`created_at`,10) AS `date`,`users`.`agent` AS `agentId`,COUNT(DISTINCT(`users`.`id`)) AS `userIdCount`,COUNT(`bet`.`bet_id`) AS `idCount`,SUM(`bet`.`bet_money`) AS `betMoneySum`, 
                  SUM(CASE WHEN `bet`.`game_id` IN(90,91) THEN (CASE WHEN `bet`.`nn_view_money` > 0 THEN `bet`.`bet_money` ELSE 0 END) ELSE (CASE WHEN `bet`.`bunko` >0 THEN `bet`.`bet_money` ELSE 0 END) END) AS `sumWinbet`,
                  SUM(CASE WHEN `bet`.`game_id` IN(90,91) THEN `bet`.`nn_view_money` ELSE (CASE WHEN `bet`.`bunko` >0 THEN `bet`.`bunko` - `bet`.`bet_money` ELSE `bet`.`bunko` END) END) AS `sumBunko`
                  FROM `bet` 
                  JOIN `users` ON `users`.`id` = `bet`.`user_id`
                  WHERE `bet`.`testFlag` = 0 AND `users`.`testFlag` = 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `bet`.`created_at` >= :startTime";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `bet`.`created_at` <= :endTime";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `date`,`agentId` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function betGeneralReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`bet`.`created_at`,10) AS `date`,`agent`.`gagent_id` AS `generalId`,COUNT(DISTINCT(`users`.`id`)) AS `userIdCount`,
                  COUNT(DISTINCT(`agent`.`a_id`)) AS `agentIdCount`,COUNT(`bet`.`bet_id`) AS `idCount`,SUM(`bet`.`bet_money`) AS `betMoneySum`, 
                  SUM(CASE WHEN `bet`.`game_id` IN(90,91) THEN (CASE WHEN `bet`.`nn_view_money` > 0 THEN `bet`.`bet_money` ELSE 0 END) ELSE (CASE WHEN `bet`.`bunko` >0 THEN `bet`.`bet_money` ELSE 0 END) END) AS `sumWinbet`,
                  SUM(CASE WHEN `bet`.`game_id` IN(90,91) THEN `bet`.`nn_view_money` ELSE (CASE WHEN `bet`.`bunko` >0 THEN `bet`.`bunko` - `bet`.`bet_money` ELSE `bet`.`bunko` END) END) AS `sumBunko`
                  FROM `bet` 
                  JOIN `users` ON `users`.`id` = `bet`.`user_id`
                  JOIN `agent` ON `agent`.`a_id` = `users`.`agent`
                  WHERE `bet`.`testFlag` = 0 AND `users`.`testFlag` = 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `bet`.`created_at` >= :startTime";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `bet`.`created_at` <= :endTime";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `date`,`generalId` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }
}

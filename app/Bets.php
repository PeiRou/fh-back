<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

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
        $aSql = Bets::select(DB::raw("users.username,bet.user_id,bet.order_id,bet.created_at,bet.status,bet.bet_money as money,bet.bet_balance as balance,bet.issue,bet.game_id,game.game_name,concat(bet.playcate_name,concat('-',bet.play_name)) as playcate_name,'' as agent,bet.color as agent_id,bet.bet_info as content,'' as content1,bet.freeze_money,bet.unfreeze_money,bet.nn_view_money,bet.bunko as c_money,bet.bet_id,'' as rechargesType"))
            ->where(function ($sql) use ($param) {
                if(isset($param['startTime']) && array_key_exists('startTime',$param) && isset($param['endTime']) && array_key_exists('endTime',$param)){
                    $sql->whereBetween('bet.updated_at',[date("Y-m-d 00:00:00",strtotime($param['startTime'])),date("Y-m-d 23:59:59",strtotime($param['endTime']))]);
                }else{
                    if (isset($param['time_point']) && array_key_exists('time_point', $param)) {
                        if ($param['time_point'] == 'today') {
                            $time = date('Y-m-d');
                            $sql->whereBetween('bet.updated_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        } elseif ($param['time_point'] == 'yesterday') {
                            $time = date('Y-m-d', strtotime('- 1 day', time()));
                            $sql->whereBetween('bet.updated_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        } else {
                            $time = date('Y-m-d', strtotime('- 2 day', time()));
                            $sql->where('bet.updated_at', '<=', $time . '23:59:59');
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
            })->leftJoin('users', 'users.id', '=', 'bet.user_id')->leftJoin('game', 'game.game_id', '=', 'bet.game_id')
            ->orderBy('bet.bet_id','desc');
        return $aSql;
    }

    //获取代理结算初步信息
    public static function preliminaryManualSettlement($array){
        $sql = "SELECT count(bet.`bet_id`) AS `betCount`,sum(CASE WHEN bet.`bunko` > 0 THEN bet.`bunko` - bet.`bet_money` ELSE bet.`bunko` END) AS `sumBunko`,sum(bet.`bet_money`) AS `sumBetMoney`,bet.`user_id`,bet.`agent_id` FROM `bet` WHERE bet.`updated_at` BETWEEN :startTime AND :endTime GROUP BY bet.`user_id`,bet.`agent_id`";
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
        $aSql = "SELECT `users`.id,SUM(`bet`.bet_money) AS `bet_money`,SUM(`bet`.bunko) AS `bunko`,`bet`.game_id,`bet`.issue,`users`.money FROM `bet` 
                  JOIN `users` ON `users`.id = `bet`.user_id 
                  WHERE `bet`.issue = :issue AND `bet`.game_id = :gameId 
                  GROUP BY `users`.id ";
        $aArray = [
            'issue' => $issue,
            'gameId' => $gameId
        ];
        return json_decode(json_encode(DB::select($aSql,$aArray)),true);
    }

    public static function getBetAndUserByIssueAll($issue,$gameId,$bunko = true){
        $aSql = "SELECT `users`.`id`,SUM(CASE WHEN `bet`.`game_id` IN(90,91) THEN `bet`.`bet_money` + `bet`.`freeze_money` ELSE `bet`.`bet_money` END) AS `bet_money`,SUM(CASE WHEN `bunko` > 0 THEN `bunko` ELSE 0 END) AS `bet_bunko`,`bet`.`game_id`,`bet`.`issue`,`users`.`money`
                    FROM `bet` 
                    JOIN `users` ON `users`.`id` = `bet`.`user_id`
                    WHERE `bet`.`issue` = :issue AND `bet`.`game_id` = :game_id ";
        $aArray = [
            'issue' => $issue,
            'game_id' => $gameId
        ];
        if($bunko)
            $aSql .= " AND `bet`.`bunko` != 0 ";
        $aSql .= " GROUP BY `bet`.`user_id`";
        return DB::select($aSql,$aArray);
    }

    public static function getBetAndUserByIssueLose($issue,$gameId){
        $aSql = "SELECT `users`.`id`,SUM(CASE WHEN `bunko` < 0 THEN `bunko` ELSE 0 END) AS `bet_bunko`,`bet`.`game_id`,`bet`.`issue`,`users`.`money`
                    FROM `bet` 
                    JOIN `users` ON `users`.`id` = `bet`.`user_id`
                    WHERE `bet`.`issue` = :issue AND `bet`.`game_id` = :game_id 
                    GROUP BY `bet`.`user_id`";
        $aArray = [
            'issue' => $issue,
            'game_id' => $gameId
        ];
        return DB::select($aSql,$aArray);
    }

    public static function getBetUserDrawingByIssue($issue,$gameId){
        $aSql = "SELECT `users`.`id`,SUM(`bet`.`bet_money`) AS `bet_money`,SUM(`bunko`) AS `bet_bunko`,`bet`.`game_id`,`bet`.`issue`,`users`.`money`,`dr`.`amount`
                    FROM `bet` 
                    JOIN `users` ON `users`.`id` = `bet`.`user_id`
                    LEFT JOIN (SELECT `user_id`,SUM(`amount`) AS `amount` FROM `drawing` WHERE `status` = 0 GROUP BY `user_id`) AS `dr` ON `dr`.`user_id` = `bet`.`user_id`
                    WHERE `bet`.`issue` = :issue AND `bet`.`game_id` = :game_id 
                    GROUP BY `bet`.`user_id` HAVING `bet_bunko` > 0";
        $aArray = [
            'issue' => $issue,
            'game_id' => $gameId
        ];
        return DB::select($aSql,$aArray);
    }

    public static function getDailyStatistics($dayTime){
        return self::select(DB::raw("'user_id','COUNT(bet_id) AS betCount','SUM(bet_money) AS betMoney','SUM(case WHEN game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) AS sumBunko'"))
            ->whereBetween('created_at',[$dayTime,$dayTime.' 23:59:59'])
            ->groupBy('user_id')->get();
    }

    public static function cancelBetting($issue,$gameId){
        return self::where('issue',$issue)->where('game_id',$gameId)->delete();
    }

    public static function updateBetStatus($issue,$gameId){
        return self::where('issue',$issue)->where('game_id',$gameId)->update(['bunko' => DB::raw('`bet_money`'),'nn_view_money' => 0]);
    }

    public static function updateBetBunkoClear($issue,$gameId){
        return self::where('issue',$issue)->where('game_id',$gameId)->update(['bunko' => 0]);
    }

    public static function betMemberReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`created_at`,10) AS `date`,`user_id`,COUNT(`bet_id`) AS `idCount`,SUM(`bet_money`) AS `betMoneySum`,
                  SUM(CASE WHEN `game_id` IN(90,91) THEN (CASE WHEN `nn_view_money` > 0 THEN `bet_money` ELSE 0 END) ELSE (CASE WHEN `bunko` >0 THEN `bet_money` ELSE 0 END) END) AS `sumWinbet`,
                  SUM(CASE WHEN `game_id` IN(90,91) THEN `nn_view_money` ELSE (CASE WHEN `bunko` >0 THEN `bunko` - `bet_money` ELSE `bunko` END) END) AS `sumBunko`
                  FROM `bet` WHERE 1 AND `testFlag` IN(0,2)";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `updated_at` >= :startTime";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `updated_at` <= :endTime";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `date`,`user_id` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function memberReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`created_at`,10) AS `date`,`user_id`,`game_id`,COUNT(`bet_id`) AS `idCount`,SUM(`bet_money`) AS `betMoneySum`,
                  SUM(CASE WHEN `game_id` IN(90,91) THEN (CASE WHEN `nn_view_money` > 0 THEN `bet_money` ELSE 0 END) ELSE (CASE WHEN `bunko` >0 THEN `bet_money` ELSE 0 END) END) AS `sumWinbet`,
                  SUM(CASE WHEN `game_id` IN(90,91) THEN `nn_view_money` ELSE (CASE WHEN `bunko` >0 THEN `bunko` - `bet_money` ELSE `bunko` END) END) AS `sumBunko`
                  FROM `bet` WHERE 1 AND `testFlag` IN(0,2)";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `updated_at` >= :startTime";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `updated_at` <= :endTime";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `date`,`user_id`,`game_id` ORDER BY `date` ASC";
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
            $aSql .= " AND `bet`.`updated_at` >= :startTime";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `bet`.`updated_at` <= :endTime";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `date`,`agentId` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function agentReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`bet`.`created_at`,10) AS `date`,`users`.`agent` AS `agentId`,`bet`.`game_id` AS `game_id`,COUNT(DISTINCT(`users`.`id`)) AS `userIdCount`,COUNT(`bet`.`bet_id`) AS `idCount`,SUM(`bet`.`bet_money`) AS `betMoneySum`, 
                  SUM(CASE WHEN `bet`.`game_id` IN(90,91) THEN (CASE WHEN `bet`.`nn_view_money` > 0 THEN `bet`.`bet_money` ELSE 0 END) ELSE (CASE WHEN `bet`.`bunko` >0 THEN `bet`.`bet_money` ELSE 0 END) END) AS `sumWinbet`,
                  SUM(CASE WHEN `bet`.`game_id` IN(90,91) THEN `bet`.`nn_view_money` ELSE (CASE WHEN `bet`.`bunko` >0 THEN `bet`.`bunko` - `bet`.`bet_money` ELSE `bet`.`bunko` END) END) AS `sumBunko`
                  FROM `bet` 
                  JOIN `users` ON `users`.`id` = `bet`.`user_id`
                  WHERE `bet`.`testFlag` = 0 AND `users`.`testFlag` = 0 AND `bet`.`bunko` != 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `bet`.`updated_at` >= :startTime";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `bet`.`updated_at` <= :endTime";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `date`,`agentId`,`game_id` ORDER BY `date` ASC";
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
                  WHERE `bet`.`testFlag` = 0 AND `users`.`testFlag` = 0 AND `bet`.`bunko` != 0";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `bet`.`updated_at` >= :startTime";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `bet`.`updated_at` <= :endTime";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `date`,`generalId` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function generalReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`bet`.`created_at`,10) AS `date`,`agent`.`gagent_id` AS `generalId`,`bet`.`game_id` AS `game_id`,COUNT(DISTINCT(`users`.`id`)) AS `userIdCount`,
                  COUNT(DISTINCT(`agent`.`a_id`)) AS `agentIdCount`,COUNT(`bet`.`bet_id`) AS `idCount`,SUM(`bet`.`bet_money`) AS `betMoneySum`, 
                  SUM(CASE WHEN `bet`.`game_id` IN(90,91) THEN (CASE WHEN `bet`.`nn_view_money` > 0 THEN `bet`.`bet_money` ELSE 0 END) ELSE (CASE WHEN `bet`.`bunko` >0 THEN `bet`.`bet_money` ELSE 0 END) END) AS `sumWinbet`,
                  SUM(CASE WHEN `bet`.`game_id` IN(90,91) THEN `bet`.`nn_view_money` ELSE (CASE WHEN `bet`.`bunko` >0 THEN `bet`.`bunko` - `bet`.`bet_money` ELSE `bet`.`bunko` END) END) AS `sumBunko`
                  FROM `bet` 
                  JOIN `users` ON `users`.`id` = `bet`.`user_id`
                  JOIN `agent` ON `agent`.`a_id` = `users`.`agent`
                  WHERE `bet`.`testFlag` = 0 AND `users`.`testFlag` = 0 AND `bet`.`bunko` != 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `bet`.`updated_at` >= :startTime";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `bet`.`updated_at` <= :endTime";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `date`,`generalId`,`game_id` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function GagentToday($aParam){
        $aSql1 = "SELECT zd.ga_id AS general_id,count(DISTINCT(u.id)) as memberCount,sum(b.bet_count) as bet_count,zd.account as general_account, sum(b.bet_money) as bet_money,
sum(bet_amount) as bet_amount,
sum(bet_bunko) as bet_bunko,
sum(fact_bet_bunko) as fact_bet_bunko,
sum(cp.sumActivity) AS activity_money,sum(cp.sumRecharge_fee) AS handling_fee,'0.00' AS odds_amount,'0.00' AS return_amount,'0.00' AS fact_return_amount";
        $where = "";
        $whereB = "";
        $whereU = "";
        $whereCp = "";
        if(isset($aParam['game_id']) && array_key_exists('game_id',$aParam)){
            $whereB .= " and game_id = ".$aParam['game_id'];
        }
        if(isset($aParam['account']) && array_key_exists('account',$aParam)){
            $where .= " and zd.account = '".$aParam['account']."'";
        }
        if(isset($aParam['timeStart']) && array_key_exists('timeStart',$aParam)){
            $whereB .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereCp .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
        }
        if(isset($aParam['timeEnd']) && array_key_exists('timeEnd',$aParam)){
            $whereB .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereCp .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
        }
        $whereB .= " and testFlag = 0";
        $whereU .= " and u.testFlag = 0";
        $aSql = "";
        $aSql .= " FROM (select count(bet_id) AS bet_count,sum(bet_money) as bet_money,user_id,
         sum(case WHEN game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as bet_amount,
         sum(case WHEN game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as bet_bunko,
         sum(case WHEN game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as fact_bet_bunko
         from bet where 1 ".$whereB."  group by user_id) b ";
        $aSql .= " LEFT JOIN `users` u on b.user_id = u.id ".$whereU;
        $aSql .= " LEFT JOIN `agent` ag on u.agent = ag.a_id ";
        $aSql .= " LEFT JOIN `general_agent` zd on ag.gagent_id = zd.ga_id ";
        $aSql .= " LEFT JOIN (select sum(case WHEN type = 't08' then money else 0 end) as sumActivity,sum(case WHEN type = 't04' then money else 0 end) as sumRecharge_fee,to_user,sum(money) as money from `capital` where type in ('t08','t04') ".$whereCp." group by to_user) cp ON cp.to_user = u.id ";
        $aSql .= " WHERE 1 ";
        $aSql .= $where;
        $aSqlCount = "SELECT COUNT(DISTINCT(zd.ga_id)) AS count ".$aSql;
        $aSql = $aSql1.$aSql;
        Session::put('reportSql',$aSql);
        $aSql .= " GROUP BY zd.ga_id ORDER BY fact_bet_bunko ASC LIMIT ".$aParam['start'].','.$aParam['length'];
        $agent = DB::select($aSql);
        $agentCount = DB::select($aSqlCount)[0]->count;
        return [
            'aData' => $agent,
            'aDataCount' => $agentCount,
        ];
    }

    public static function GagentTodaySql($aParam){
        $aSql1 = "SELECT sum(fact_bet_bunko) as fact_bet_bunko,sum(b.bet_count) as bet_count,sum(b.bet_money) as bet_money,
                    '0.00' AS `recharges_money`,'0.00' AS `drawing_money`,sum(cp.sumActivity) AS activity_money,sum(cp.sumRecharge_fee) AS handling_fee,
                    sum(bet_amount) as bet_amount,sum(bet_bunko) as bet_bunko,'0.00' AS odds_amount,'0.00' AS return_amount,
                    '0.00' AS fact_return_amount,zd.account as general_account,zd.ga_id AS general_id,count(DISTINCT(u.id)) as memberCount ";
        $where = "";
        $whereB = "";
        $whereU = "";
        $whereCp = "";
        if(isset($aParam['game_id']) && array_key_exists('game_id',$aParam)){
            $whereB .= " and game_id = ".$aParam['game_id'];
        }
        if(isset($aParam['account']) && array_key_exists('account',$aParam)){
            $where .= " and zd.account = '".$aParam['account']."'";
        }
        if(isset($aParam['timeStart']) && array_key_exists('timeStart',$aParam)){
            $whereB .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereCp .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
        }
        if(isset($aParam['timeEnd']) && array_key_exists('timeEnd',$aParam)){
            $whereB .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereCp .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
        }
        $whereB .= " and testFlag = 0";
        $whereU .= " and u.testFlag = 0";
        $aSql = "";
        $aSql .= " FROM (select count(bet_id) AS bet_count,sum(bet_money) as bet_money,user_id,
         sum(case WHEN game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as bet_amount,
         sum(case WHEN game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as bet_bunko,
         sum(case WHEN game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as fact_bet_bunko
         from bet where 1 ".$whereB."  group by user_id) b ";
        $aSql .= " LEFT JOIN `users` u on b.user_id = u.id ".$whereU;
        $aSql .= " LEFT JOIN `agent` ag on u.agent = ag.a_id ";
        $aSql .= " LEFT JOIN `general_agent` zd on ag.gagent_id = zd.ga_id ";
        $aSql .= " LEFT JOIN (select sum(case WHEN type = 't08' then money else 0 end) as sumActivity,sum(case WHEN type = 't04' then money else 0 end) as sumRecharge_fee,to_user,sum(money) as money from `capital` where type in ('t08','t04') ".$whereCp." group by to_user) cp ON cp.to_user = u.id ";
        $aSql .= " WHERE 1 ";
        $aSql .= $where;
        return $aSql1.$aSql." GROUP BY zd.ga_id";
    }

    public static function GagentTodaySum($aParam){
        $aSql1 = "SELECT count(DISTINCT(u.id)) as member_count,sum(b.bet_count) as bet_count, sum(b.bet_money) as bet_money,
            sum(bet_amount) as bet_amount,
            sum(bet_bunko) as bet_bunko,
            sum(fact_bet_bunko) as fact_bet_bunko,
            sum(cp.sumActivity) AS activity_money,sum(cp.sumRecharge_fee) AS handling_fee,'0.00' AS odds_amount,'0.00' AS return_amount,'0.00' AS fact_return_amount";
        $where = "";
        $whereB = "";
        $whereU = "";
        $whereCp = "";
        if(isset($aParam['game_id']) && array_key_exists('game_id',$aParam)){
            $whereB .= " and game_id = ".$aParam['game_id'];
        }
        if(isset($aParam['account']) && array_key_exists('account',$aParam)){
            $where .= " and zd.account = '".$aParam['account']."'";
        }
        if(isset($aParam['timeStart']) && array_key_exists('timeStart',$aParam)){
            $whereB .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereCp .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
        }
        if(isset($aParam['timeEnd']) && array_key_exists('timeEnd',$aParam)){
            $whereB .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereCp .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
        }
        $whereB .= " and testFlag = 0";
        $whereU .= " and u.testFlag = 0";
        $aSql = "";
        $aSql .= " FROM (select count(bet_id) AS bet_count,sum(bet_money) as bet_money,user_id,
         sum(case WHEN game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as bet_amount,
         sum(case WHEN game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as bet_bunko,
         sum(case WHEN game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as fact_bet_bunko from bet where 1 ".$whereB." group by user_id) b ";
        $aSql .= " LEFT JOIN `users` u on b.user_id = u.id ".$whereU;
        $aSql .= " LEFT JOIN `agent` ag on u.agent = ag.a_id ";
        $aSql .= " LEFT JOIN `general_agent` zd on ag.gagent_id = zd.ga_id ";
        $aSql .= " LEFT JOIN (select sum(case WHEN type = 't08' then money else 0 end) as sumActivity,sum(case WHEN type = 't04' then money else 0 end) as sumRecharge_fee,to_user,sum(money) as money from `capital` where type in ('t08','t04') ".$whereCp." group by to_user) cp ON cp.to_user = u.id ";
        $aSql .= " WHERE 1 ";
        $aSql .= $where;
        $aSql = $aSql1.$aSql;
        return DB::select($aSql)[0];
    }

    public static function AgentToday($aParam){
        $aSql1 = "SELECT ag.a_id AS agent_id,count(DISTINCT(u.id)) as memberCount,sum(b.bet_count) as bet_count,sum(b.bet_money) as bet_money,ag.account as agent_account,ag.name as agent_name, 
                    sum(b.bet_amount) AS bet_amount,sum(b.bet_bunko) AS bet_bunko,sum(b.fact_bet_bunko) AS fact_bet_bunko, 
                    '0.00' AS odds_amount,'0.00' AS return_amount,'0.00' AS fact_return_amount,";
        $where = "";
        $whereB = "";
        $whereU = "";
        $whereCp = "";
        $whereDr = "";
        $whereRe = "";
        if(isset($aParam['game_id']) && array_key_exists('game_id',$aParam)){
            $whereB .= " and game_id = ".$aParam['game_id'];
            $aSql1 .= " '' AS activity_money,'' AS handling_fee,'' as drawing_money,'' as recharges_money ";
        }else{
            $aSql1 .= " SUM(cp.sumActivity) AS activity_money,SUM(cp.sumRecharge_fee) AS handling_fee,sum(dr.amount) as drawing_money,sum(re.amount) as recharges_money ";
        }
        if(isset($aParam['account']) && array_key_exists('account',$aParam)){
            $where .= " and ag.account = '".$aParam['account']."'";
        }
        if(isset($aParam['general_id']) && array_key_exists('general_id',$aParam)){
            $where .= " and ag.gagent_id = ".$aParam['general_id'];
        }
        if(isset($aParam['timeStart']) && array_key_exists('timeStart',$aParam)){
            $whereB .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereCp .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereDr .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereRe .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
        }
        if(isset($aParam['timeEnd']) && array_key_exists('timeEnd',$aParam)){
            $whereB .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereCp .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereDr .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereRe .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
        }
        $whereB .= " and testFlag = 0 ";
        $whereU .= " and u.testFlag = 0 ";
        $aSql = "";
        $aSql .= " FROM (select count(b.bet_id) as bet_count,sum(b.bet_money) as bet_money,user_id,
                    sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as bet_amount,
                    sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as bet_bunko, 
                    sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as fact_bet_bunko  
                    from bet b where 1 ".$whereB." GROUP BY `user_id`) b ";
        $aSql .= " JOIN `users` u on b.user_id = u.id ".$whereU;
        $aSql .= " JOIN `agent` ag on u.agent = ag.a_id ";
        $aSql .= " LEFT JOIN (select user_id,status,sum(amount) as amount from `drawing` where status = 2 AND draw_type IN(0,1) ".$whereDr." group by user_id) dr on dr.user_id = u.id ";
        $aSql .= " LEFT JOIN (select userId,status,sum(amount) as amount from `recharges` where status = 2 AND payType != 'adminAddMoney' ".$whereRe." group by userId) re ON re.userId = u.id ";
        $aSql .= " LEFT JOIN (select sum(case WHEN type = 't08' then money else 0 end) as sumActivity,sum(case WHEN type = 't04' then money else 0 end) as sumRecharge_fee,to_user,sum(money) as money from `capital` where type in ('t08','t04') ".$whereCp." group by to_user) cp ON cp.to_user = u.id ";
        $aSql .= " WHERE 1 ";
        $aSql .= $where;
        $aSqlCount = "SELECT COUNT(DISTINCT(u.agent)) AS count ".$aSql;
        $aSql = $aSql1.$aSql;
        $aSql .= " GROUP BY u.agent ORDER BY fact_bet_bunko ASC LIMIT ".$aParam['start'].','.$aParam['length'];
        $agent = DB::select($aSql);
        $agentCount = DB::select($aSqlCount)[0]->count;
        return [
            'aData' => $agent,
            'aDataCount' => $agentCount,
        ];
    }

    public static function AgentTodaySql($aParam){
        $aSql1 = "SELECT sum(b.fact_bet_bunko) AS fact_bet_bunko,sum(b.bet_count) as bet_count,sum(b.bet_money) as bet_money,
                    sum(b.bet_amount) AS bet_amount,sum(b.bet_bunko) AS bet_bunko,'0.00' AS odds_amount,'0.00' AS return_amount,
                    '0.00' AS fact_return_amount,ag.account as agent_account,ag.name as agent_name, ag.a_id AS agent_id,";
        $where = "";
        $whereB = "";
        $whereU = "";
        $whereCp = "";
        $whereDr = "";
        $whereRe = "";
        if(isset($aParam['game_id']) && array_key_exists('game_id',$aParam)){
            $whereB .= " and game_id = ".$aParam['game_id'];
            $aSql1 .= " '0.00' AS activity_money,'0.00' AS handling_fee,'0.00' as drawing_money,'0.00' as recharges_money ";
        }else{
            $aSql1 .= " SUM(cp.sumActivity) AS activity_money,SUM(cp.sumRecharge_fee) AS handling_fee,sum(dr.amount) as drawing_money,sum(re.amount) as recharges_money ";
        }
        $aSql1 .= ",count(DISTINCT(u.id)) as memberCount ";
        if(isset($aParam['account']) && array_key_exists('account',$aParam)){
            $where .= " and ag.account = '".$aParam['account']."'";
        }
        if(isset($aParam['general_id']) && array_key_exists('general_id',$aParam)){
            $where .= " and ag.gagent_id = ".$aParam['general_id'];
        }
        if(isset($aParam['timeStart']) && array_key_exists('timeStart',$aParam)){
            $whereB .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereCp .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereDr .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereRe .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
        }
        if(isset($aParam['timeEnd']) && array_key_exists('timeEnd',$aParam)){
            $whereB .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereCp .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereDr .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereRe .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
        }
        $whereB .= " and testFlag = 0 ";
        $whereU .= " and u.testFlag = 0 ";
        $aSql = "";
        $aSql .= " FROM (select count(b.bet_id) as bet_count,sum(b.bet_money) as bet_money,user_id,
                    sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as bet_amount,
                    sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as bet_bunko, 
                    sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as fact_bet_bunko  
                    from bet b where 1 ".$whereB." GROUP BY `user_id`) b ";
        $aSql .= " JOIN `users` u on b.user_id = u.id ".$whereU;
        $aSql .= " JOIN `agent` ag on u.agent = ag.a_id ";
        $aSql .= " LEFT JOIN (select user_id,status,sum(amount) as amount from `drawing` where status = 2 ".$whereDr." group by user_id) dr on dr.user_id = u.id ";
        $aSql .= " LEFT JOIN (select userId,status,sum(amount) as amount from `recharges` where status = 2 AND payType != 'adminAddMoney' ".$whereRe." group by userId) re ON re.userId = u.id ";
        $aSql .= " LEFT JOIN (select sum(case WHEN type = 't08' then money else 0 end) as sumActivity,sum(case WHEN type = 't04' then money else 0 end) as sumRecharge_fee,to_user,sum(money) as money from `capital` where type in ('t08','t04') ".$whereCp." group by to_user) cp ON cp.to_user = u.id ";
        $aSql .= " WHERE 1 ";
        $aSql .= $where;
        return $aSql1.$aSql." GROUP BY u.agent";
    }

    public static function AgentTodaySum($aParam){
        $aSql1 = "SELECT count(DISTINCT(u.id)) as member_count,sum(b.bet_count) as bet_count,sum(b.bet_money) as bet_money,
                    sum(b.bet_amount) AS bet_amount,sum(b.bet_bunko) AS bet_bunko,sum(b.fact_bet_bunko) AS fact_bet_bunko, 
                    '0.00' AS odds_amount,'0.00' AS return_amount,'0.00' AS fact_return_amount,";
        $where = "";
        $whereB = "";
        $whereU = "";
        $whereCp = "";
        $whereDr = "";
        $whereRe = "";
        if(isset($aParam['game_id']) && array_key_exists('game_id',$aParam)){
            $whereB .= " and game_id = ".$aParam['game_id'];
            $aSql1 .= " '' AS activity_money,'' AS handling_fee,'' as drawing_money,'' as recharges_money ";
        }else{
            $aSql1 .= " SUM(cp.sumActivity) AS activity_money,SUM(cp.sumRecharge_fee) AS handling_fee,sum(dr.amount) as drawing_money,sum(re.amount) as recharges_money ";
        }
        if(isset($aParam['account']) && array_key_exists('account',$aParam)){
            $where .= " and ag.account = '".$aParam['account']."'";
        }
        if(isset($aParam['general_id']) && array_key_exists('general_id',$aParam)){
            $where .= " and ag.gagent_id = ".$aParam['general_id'];
        }
        if(isset($aParam['timeStart']) && array_key_exists('timeStart',$aParam)){
            $whereB .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereCp .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereDr .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereRe .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
        }
        if(isset($aParam['timeEnd']) && array_key_exists('timeEnd',$aParam)){
            $whereB .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereCp .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereDr .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereRe .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
        }
        $whereB .= " and testFlag = 0 ";
        $whereU .= " and u.testFlag = 0 ";
        $aSql = "";
        $aSql .= " FROM (select count(b.bet_id) as bet_count,sum(b.bet_money) as bet_money,user_id,
                    sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as bet_amount,
                    sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as bet_bunko, 
                    sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as fact_bet_bunko  
                    from bet b where 1 ".$whereB." GROUP BY `user_id`) b ";
        $aSql .= " JOIN `users` u on b.user_id = u.id ".$whereU;
        $aSql .= " JOIN `agent` ag on u.agent = ag.a_id ";
        $aSql .= " LEFT JOIN (select user_id,status,sum(amount) as amount from `drawing` where status = 2 AND draw_type IN(0,1) ".$whereDr." group by user_id) dr on dr.user_id = u.id ";
        $aSql .= " LEFT JOIN (select userId,status,sum(amount) as amount from `recharges` where status = 2 AND payType != 'adminAddMoney' ".$whereRe." group by userId) re ON re.userId = u.id ";
        $aSql .= " LEFT JOIN (select sum(case WHEN type = 't08' then money else 0 end) as sumActivity,sum(case WHEN type = 't04' then money else 0 end) as sumRecharge_fee,to_user,sum(money) as money from `capital` where type in ('t08','t04') ".$whereCp." group by to_user) cp ON cp.to_user = u.id ";
        $aSql .= " WHERE 1 ";
        $aSql .= $where;
        $aSql = $aSql1.$aSql;
        return DB::select($aSql)[0];
    }

    public static function UserToday($aParam){
        $aSql1 = "SELECT u.id AS user_id,u.username AS user_account,u.fullName AS user_name,u.agent AS agent_account,count(b.bet_id) as bet_count,sum(b.bet_money) as bet_money,ag.account as agent_account,
sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as bet_amount,
sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as fact_bet_bunko,
sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as bet_bunko,
'0.00' AS odds_amount,'0.00' AS return_amount,'0.00' AS fact_return_amount, ";
        $where = "";
        $whereB = "";
        $whereU = "";
        $whereCp = "";
        $whereDr = "";
        $whereRe = "";
        if(isset($aParam['game_id']) && array_key_exists('game_id',$aParam)){
            $whereB .= " and game_id = ".$aParam['game_id'];
            $aSql1 .= " '' AS activity_money,'' AS handling_fee,'' as drawing_money,'' as recharges_money ";
        }else{
            $aSql1 .= " cp.sumActivity AS activity_money,cp.sumRecharge_fee AS handling_fee,dr.amount as drawing_money,re.amount as recharges_money ";
        }
        if(isset($aParam['account']) && array_key_exists('account',$aParam)){
            $where .= " and u.username = '".$aParam['account']."'";
        }
        if(isset($aParam['timeStart']) && array_key_exists('timeStart',$aParam)){
            $whereB .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereCp .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereDr .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereRe .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
        }
        if(isset($aParam['timeEnd']) && array_key_exists('timeEnd',$aParam)){
            $whereB .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereCp .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereDr .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereRe .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
        }
        if(isset($aParam['minBunko']) && array_key_exists('minBunko',$aParam)){
            $where .= " and sumBunko >= ".$aParam['minBunko'];
        }
        if(isset($aParam['maxBunko']) && array_key_exists('maxBunko',$aParam)){
            $where .= " and sumBunko <= ".$aParam['maxBunko'];
        }
        if(isset($aParam['chkTest']) && array_key_exists('chkTest',$aParam)){
            $whereB .= " and testFlag = 0 ";
            $whereU .= " and u.testFlag = 0 ";
        }else {
            $whereB .= " and testFlag in (0,2) ";
            $whereU .= " and u.testFlag in (0,2) ";
        }
        if(isset($aParam['agent_id']) && array_key_exists('agent_id',$aParam)){
            $whereU .= " and u.agent = ".$aParam['agent_id'];
        }
        $aSql = "";
        $aSql .= " FROM (select * from bet where 1 ".$whereB.") b ";

        if(isset($chkDouble) && $chkDouble=="on"){      //显示重复姓名会员
            $aUser = "(select * from users WHERE fullName in(select fullName from users group by fullName having count(fullName) >= 2) and ".$whereU.")";
            $aSql .= " JOIN ".$aUser." u on b.user_id = u.id ";
        }else{
            $aUser = "(select * from `users` u where 1 ".$whereU.")";
            $aSql .= " LEFT JOIN ".$aUser." u on b.user_id = u.id ";
        }
        $aSql .= " JOIN `agent` ag on u.agent = ag.a_id ";
        $aSql .= " LEFT JOIN (select user_id,status,sum(amount) as amount from `drawing` where status = 2 AND draw_type IN(0,1) ".$whereDr." group by user_id) dr on dr.user_id = u.id ";
        $aSql .= " LEFT JOIN (select userId,status,sum(amount) as amount from `recharges` where status = 2 AND payType != 'adminAddMoney' ".$whereRe." group by userId) re ON re.userId = u.id ";
        $aSql .= " LEFT JOIN (select sum(case WHEN type = 't08' then money else 0 end) as sumActivity,sum(case WHEN type = 't04' then money else 0 end) as sumRecharge_fee,to_user,sum(money) as money from `capital` where type in ('t08','t04') ".$whereCp." group by to_user) cp ON cp.to_user = u.id ";
        $aSql .= " WHERE 1 ";
        $aSql .= $where;
        $aSqlCount = "SELECT COUNT(DISTINCT(u.id)) AS count ".$aSql;
        $aSql = $aSql1.$aSql;
        $aSql .= " GROUP BY u.id ORDER BY bet_bunko ASC LIMIT ".$aParam['start'].','.$aParam['length'];
        $agent = DB::select($aSql);
        $agentCount = DB::select($aSqlCount)[0]->count;
        return [
            'aData' => $agent,
            'aDataCount' => $agentCount,
        ];
    }

    public static function UserTodaySql($aParam){
        $aSql1 = "SELECT u.id AS user_id,u.username AS user_account,u.fullName AS user_name,u.agent AS agent_account,count(b.bet_id) as bet_count,sum(b.bet_money) as bet_money,ag.account as agent_account,
sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as bet_amount,
sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as fact_bet_bunko,
sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as bet_bunko,
'0.00' AS odds_amount,'0.00' AS return_amount,'0.00' AS fact_return_amount, ";
        $where = "";
        $whereB = "";
        $whereU = "";
        $whereCp = "";
        $whereDr = "";
        $whereRe = "";
        if(isset($aParam['game_id']) && array_key_exists('game_id',$aParam)){
            $whereB .= " and game_id = ".$aParam['game_id'];
            $aSql1 .= " '' AS activity_money,'' AS handling_fee,'' as drawing_money,'' as recharges_money ";
        }else{
            $aSql1 .= " cp.sumActivity AS activity_money,cp.sumRecharge_fee AS handling_fee,dr.amount as drawing_money,re.amount as recharges_money ";
        }
        if(isset($aParam['account']) && array_key_exists('account',$aParam)){
            $where .= " and u.username = '".$aParam['account']."'";
        }
        if(isset($aParam['timeStart']) && array_key_exists('timeStart',$aParam)){
            $whereB .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereCp .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereDr .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereRe .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
        }
        if(isset($aParam['timeEnd']) && array_key_exists('timeEnd',$aParam)){
            $whereB .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereCp .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereDr .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereRe .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
        }
        if(isset($aParam['minBunko']) && array_key_exists('minBunko',$aParam)){
            $where .= " and sumBunko >= ".$aParam['minBunko'];
        }
        if(isset($aParam['maxBunko']) && array_key_exists('maxBunko',$aParam)){
            $where .= " and sumBunko <= ".$aParam['maxBunko'];
        }
        if(isset($aParam['chkTest']) && array_key_exists('chkTest',$aParam)){
            $whereB .= " and testFlag = 0 ";
            $whereU .= " and u.testFlag = 0 ";
        }else {
            $whereB .= " and testFlag in (0,2) ";
            $whereU .= " and u.testFlag in (0,2) ";
        }
        if(isset($aParam['agent_id']) && array_key_exists('agent_id',$aParam)){
            $whereU .= " and u.agent = ".$aParam['agent_id'];
        }
        $aSql = "";
        $aSql .= " FROM (select * from bet where 1 ".$whereB.") b ";

        if(isset($chkDouble) && $chkDouble=="on"){      //显示重复姓名会员
            $aUser = "(select * from users WHERE fullName in(select fullName from users group by fullName having count(fullName) >= 2) and ".$whereU.")";
            $aSql .= " JOIN ".$aUser." u on b.user_id = u.id ";
        }else{
            $aUser = "(select * from `users` u where 1 ".$whereU.")";
            $aSql .= " LEFT JOIN ".$aUser." u on b.user_id = u.id ";
        }
        $aSql .= " JOIN `agent` ag on u.agent = ag.a_id ";
        $aSql .= " LEFT JOIN (select user_id,status,sum(amount) as amount from `drawing` where status = 2 ".$whereDr." group by user_id) dr on dr.user_id = u.id ";
        $aSql .= " LEFT JOIN (select userId,status,sum(amount) as amount from `recharges` where status = 2 AND payType != 'adminAddMoney' ".$whereRe." group by userId) re ON re.userId = u.id ";
        $aSql .= " LEFT JOIN (select sum(case WHEN type = 't08' then money else 0 end) as sumActivity,sum(case WHEN type = 't04' then money else 0 end) as sumRecharge_fee,to_user,sum(money) as money from `capital` where type in ('t08','t04') ".$whereCp." group by to_user) cp ON cp.to_user = u.id ";
        $aSql .= " WHERE 1 ";
        $aSql .= $where;
        return $aSql1.$aSql." GROUP BY u.id";
    }

    public static function UserTodaySum($aParam){
        $aSql1 = "SELECT sum(b.bet_count) as bet_count,sum(b.bet_money) as bet_money,sum(b.bet_amount) as bet_amount,sum(b.fact_bet_bunko) as fact_bet_bunko,sum(b.bet_bunko) as bet_bunko,
                '0.00' AS odds_amount,'0.00' AS return_amount,'0.00' AS fact_return_amount, ";
        $where = "";
        $whereB = "";
        $whereU = "";
        $whereCp = "";
        $whereDr = "";
        $whereRe = "";
        if(isset($aParam['game_id']) && array_key_exists('game_id',$aParam)){
            $whereB .= " and game_id = ".$aParam['game_id'];
            $aSql1 .= " '' AS activity_money,'' AS handling_fee,'' as drawing_money,'' as recharges_money ";
        }else{
            $aSql1 .= " sum(cp.sumActivity) AS activity_money,sum(cp.sumRecharge_fee) AS handling_fee,sum(dr.amount) as drawing_money,sum(re.amount) as recharges_money ";
        }
        if(isset($aParam['account']) && array_key_exists('account',$aParam)){
            $where .= " and u.username = '".$aParam['account']."'";
        }
        if(isset($aParam['timeStart']) && array_key_exists('timeStart',$aParam)){
            $whereB .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereCp .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereDr .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
            $whereRe .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($aParam['timeStart']))."'";
        }
        if(isset($aParam['timeEnd']) && array_key_exists('timeEnd',$aParam)){
            $whereB .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereCp .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereDr .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
            $whereRe .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($aParam['timeEnd']))."'";
        }
        if(isset($aParam['minBunko']) && array_key_exists('minBunko',$aParam)){
            $where .= " and sumBunko >= ".$aParam['minBunko'];
        }
        if(isset($aParam['maxBunko']) && array_key_exists('maxBunko',$aParam)){
            $where .= " and sumBunko <= ".$aParam['maxBunko'];
        }
        if(isset($aParam['chkTest']) && array_key_exists('chkTest',$aParam)){
            $whereB .= " and testFlag = 0 ";
            $whereU .= " and u.testFlag = 0 ";
        }else {
            $whereB .= " and testFlag in (0,2) ";
            $whereU .= " and u.testFlag in (0,2) ";
        }
        if(isset($aParam['agent_id']) && array_key_exists('agent_id',$aParam)){
            $whereU .= " and u.agent = ".$aParam['agent_id'];
        }
        $aSql = "";
        $aSql .= " FROM (select count(bet_id) as bet_count,sum(bet_money) as bet_money,user_id,
                sum(case WHEN game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as bet_amount,
                sum(case WHEN game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as fact_bet_bunko,
                sum(case WHEN game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as bet_bunko 
                from bet where 1 ".$whereB." group by user_id) b ";
        if(isset($chkDouble) && $chkDouble=="on"){      //显示重复姓名会员
            $aUser = "(select * from users WHERE fullName in(select fullName from users group by fullName having count(fullName) >= 2) and ".$whereU.")";
            $aSql .= " JOIN ".$aUser." u on b.user_id = u.id ";
        }else{
            $aUser = "(select * from `users` u where 1 ".$whereU.")";
            $aSql .= " LEFT JOIN ".$aUser." u on b.user_id = u.id ";
        }
        $aSql .= " JOIN `agent` ag on u.agent = ag.a_id ";
        $aSql .= " LEFT JOIN (select user_id,status,sum(amount) as amount from `drawing` where status = 2 AND draw_type IN(0,1) ".$whereDr." group by user_id) dr on dr.user_id = u.id ";
        $aSql .= " LEFT JOIN (select userId,status,sum(amount) as amount from `recharges` where status = 2 AND payType != 'adminAddMoney' ".$whereRe." group by userId) re ON re.userId = u.id ";
        $aSql .= " LEFT JOIN (select sum(case WHEN type = 't08' then money else 0 end) as sumActivity,sum(case WHEN type = 't04' then money else 0 end) as sumRecharge_fee,to_user,sum(money) as money from `capital` where type in ('t08','t04') ".$whereCp." group by to_user) cp ON cp.to_user = u.id ";
        $aSql .= " WHERE 1 ";
        $aSql .= $where;
        $aSql = $aSql1.$aSql;
        return DB::select($aSql)[0];
    }
}

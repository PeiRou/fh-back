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
        $aSql = Bets::select(DB::raw("users.username,bet.user_id,bet.order_id,bet.created_at,bet.status,bet.bunko as money,bet.bet_balance as balance,bet.issue,bet.game_id,game.game_name,bet.play_name as play_type,'' as agent,bet.color as agent_id,bet.bet_info as content,'' as content1,bet.freeze_money,bet.unfreeze_money,bet.nn_view_money"))
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

    //获取结算初步信息
    public static function preliminaryManualSettlement($array){
        $sql = "SELECT count(bet.`bet_id`) AS `betCount`,sum(CASE WHEN bet.`bunko` > 0 THEN bet.`bunko` - bet.`bet_money` ELSE bet.`bunko` END) AS `sumBunko`,sum(bet.`bet_money`) AS `sumBetMoney`,bet.`user_id`,bet.`agent_id` FROM `bet` WHERE bet.`created_at` BETWEEN :startTime AND :endTime GROUP BY bet.`user_id`,bet.`agent_id`";
        $sqlArray = ['startTime'=>$array['start'],'endTime'=>$array['end']];
        return DB::select($sql,$sqlArray);
    }

}

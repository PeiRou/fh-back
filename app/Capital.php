<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Capital extends Model
{
    protected $table = 'capital';
    protected $primaryKey = 'capital_id';

    //类型选项
    public static $playTypeOption = [
        't01' => '充值',
        //'t02' => '撤单[中奖金额]',
        //'t03' => '撤单[退水金额]',
        //'t04' => '返利/手续费',
        't05' => '下注',
        //'t06' => '重新开奖[中奖金额]',
        //'t07' => '重新开奖[退水金额]',
        't08' => '活动',
        //'t09' => '奖金',
        't10' => '代理结算佣金',
        't11' => '代理佣金提现',
        't12' => '代理佣金提现失败退回',
        't13' => '抢到红包',
        't14' => '退水',
        't15' => '提现',
        't16' => '撤单',
        't17' => '提现失败',
        't18' => '后台加钱',
        't19' => '后台扣钱',
//        't20' => '游戏未结算',
//        't21' => '游戏已结算',
//        't22' => '游戏撤销',
    ];

    //游戏类型选项包括
    public static $includePlayTypeOption = [
        't05'
    ];

    //明细时间
    public static function getCapitalTimeOption(){
        $capitalTimeOption = [
            'today' => '今日明细',
            'yesterday' => '昨日明细',
            'history' => '历史明细',
        ];
        return $capitalTimeOption;
    }

    //资金明细组装
    public static function AssemblyFundDetails($param){
        $aSql = Capital::select('users.username','capital.to_user','capital.order_id','capital.created_at','capital.type','capital.money','capital.balance as balance','capital.issue','capital.game_id','game.game_name','capital.play_type','capital.operation_id','sub_account.account','capital.content',DB::raw("'' as freeze_money,'' as unfreeze_money,'' as nn_view_money"))
            ->where(function ($sql) use($param){
                if(isset($param['startTime']) && array_key_exists('startTime',$param) && isset($param['endTime']) && array_key_exists('endTime',$param)){
                    $sql->whereBetween('capital.created_at',[$param['startTime'] .' 00:00:00',$param['endTime'] .' 23:59:59']);
                }else{
                    if(isset($param['time_point']) && array_key_exists('time_point',$param)) {
                        if($param['time_point'] == 'today'){
                            $time = date('Y-m-d');
                            $sql->whereBetween('capital.created_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        }elseif($param['time_point'] == 'yesterday'){
                            $time = date('Y-m-d',strtotime('- 1 day',time()));
                            $sql->whereBetween('capital.created_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        }else{
                            $time = date('Y-m-d',strtotime('- 2 day',time()));
                            $sql->where('capital.created_at','<=',$time . '23:59:59');
                        }
                    }
                }
                if(isset($param['account_id']) && array_key_exists('account_id',$param)){
                    $sql->where('users.id','=',$param['account_id']);
                }
                if(isset($param['account']) && array_key_exists('account',$param)){
                    $sql->where('users.username','=',$param['account']);
                }
                if(isset($param['game_id']) && array_key_exists('game_id',$param)){
                    $sql->where('capital.game_id','=',$param['game_id']);
                }
                if(isset($param['order_id']) && array_key_exists('order_id',$param)){
                    $sql->where('capital.order_id','=',$param['order_id']);
                }
                if(isset($param['issue']) && array_key_exists('issue',$param)){
                    $sql->where('capital.issue','=',$param['issue']);
                }
                if(isset($param['type']) && array_key_exists('type',$param)){
                    $sql->where('capital.type','=',$param['type']);
                }
                if(isset($param['amount_min']) && array_key_exists('amount_min',$param)){
                    $sql->where('capital.money','>=',$param['amount_min']);
                }
                if(isset($param['amount_max']) && array_key_exists('amount_max',$param)){
                    $sql->where('capital.money','<=',$param['amount_max']);
                }
            })->leftJoin('game','game.game_id','=','capital.game_id')->leftJoin('users','users.id','=','capital.to_user')->leftJoin('sub_account','sub_account.sa_id','=','capital.operation_id')
            ->orderBy('capital.created_at','desc');
        return $aSql;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capital extends Model
{
    protected $table = 'capital';
    protected $primaryKey = 'capital_id';

    //类型选项
    public static $playTypeOption = [
        't01' => '充值',
        't02' => '撤单[中奖金额]',
        't03' => '撤单[退水金额]',
        't04' => '返利/手续费',
        't05' => '下注',
        't06' => '重新开奖[中奖金额]',
        't07' => '重新开奖[退水金额]',
        't08' => '活动',
        't09' => '奖金',
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
}

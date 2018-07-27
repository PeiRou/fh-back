<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentReport extends Model
{
    protected $table = 'agent_report';
    protected $primaryKey = 'agent_report_idx';

    public static $reportStatus = [
        '0' => '未结算',
        '1' => '已结算',
        '2' => '审核中',
        '3' => '驳回',
        '4' => '结算过期',
    ];

    public static $reportMonth = [
        'lastLastMonth' => '上上月',
        'lastMonth' => '上月',
        'month' => '本月',
        'lastTwoMonth' => '近两月',
    ];

    //根据时间获取结算数据
    public static function getAccordingDateData($date){
        return self::select('a_id','year_month','fee_bunko','commission','ach_member')->whereBetween('created_at',[$date['start'],$date['end']])->orderBy('created_at','asc')->get();
    }

}

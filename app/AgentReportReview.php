<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentReportReview extends Model
{
    protected $table = 'agent_report_review';
    protected $primaryKey = 'agent_report_idx';

    public static $reportStatus = [
        '0' => '未结算',
        '1' => '已结算',
        '2' => '未审核',
        '3' => '驳回',
        '4' => '结算过期',
    ];

    public static $reportMonth = [
        'lastLastMonth' => '上上月',
        'lastMonth' => '上月',
        'month' => '本月',
        'lastTwoMonth' => '近两月',
    ];

}

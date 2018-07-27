<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentDrawDetails extends Model
{
    protected $table = 'agent_draw_details';
    protected $primaryKey = 'id';

    public static $reportStatus = [
        '0' => '未受理',
        '1' => '处理中',
        '2' => '通过',
        '3' => '不通过',
        '4' => '锁定',
    ];

    public static $reportMonth = [
        'lastMonth' => '上月',
        'month' => '本月',
    ];

}

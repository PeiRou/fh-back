<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AgentBackwater extends Model
{
    protected $table = 'agent_backwater';

    public static $agentBackwaterStatus = [
        1 => '成功',
        2 => '取消',
    ];

    public static function getAgentBackwaterMoney($gameId,$issue){
        return self::where('game_id',$gameId)->where('issue',$issue)->where('status',1)->get();
    }
}

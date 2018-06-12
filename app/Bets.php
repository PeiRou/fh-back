<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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




}

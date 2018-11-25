<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JqBet extends Model
{
    protected $table = 'jq_bet';
    protected $primaryKey = 'id';

    public static function getOnly($g_id){
        return self::where('g_id', $g_id)
            ->pluck('GameID');
    }
}

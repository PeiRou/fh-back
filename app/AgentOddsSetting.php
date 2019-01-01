<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AgentOddsSetting extends Model
{
    protected $table = 'agent_odds_setting';

    public static function getArrayIdData(){
        $aData = self::all();
        $aArray = [];
        foreach ($aData as $iData){
            $aArray[$iData->id] = $iData;
        }
        return $aArray;
    }
}

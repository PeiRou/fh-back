<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameOddsCategory extends Model
{
    protected $table = 'game_odds_category';

    public static function getAgentOddsId(){
        return self::select('agent_odds_setting.id as set_id','game_odds_category.id')->where('agent_odds_setting.odds',0)
            ->join('agent_odds_setting','agent_odds_setting.odds_category_id','=','game_odds_category.id')->get();
    }
}

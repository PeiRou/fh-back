<?php

namespace App\Http\Controllers\Back\GameTables;

use App\Games;
use App\Play;
use App\PlayCates;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SaveGameOddsController extends Controller
{
    public function bjpk10(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,50);
    }

    public function cqssc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,1);
    }

    public function xjssc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,4);
    }

    public function tjssc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,5);
    }

    public function gdklsf(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,60);
    }

    public function jsk3(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,10);
    }

    public function cqxync(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,61);
    }

    public function bjkl8(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,65);
    }

    public function gd11x5(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,21);
    }

    public function fc3d(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,30);
    }

    public function pcdd(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,66);
    }

    public function lhc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,70);
    }

    public function xylhc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,85);
    }

    public function mssc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,80);
    }

    public function msft(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,82);
    }

    public function msssc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,81);
    }

    public function paoma(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,99);
    }

    function updateBatch($data,$id){
        $sqlOdds = "UPDATE play SET odds = CASE ";
        $sqlRebate = "";
        $error = "no";
        foreach ($data as $key => $value) {
            if($value == ""){
                $error = "yes";
                break;
            }
            $sqlOdds .= "WHEN `odds_tag` = '$key' THEN $value ";
            $sqlRebate .= "WHEN `rebate_tag` = '$key' THEN $value ";
        }
        if($error == "yes"){
            return response()->json([
                'status'=>false
            ]);
        } else {
            $sqlOdds .= "END, rebate = CASE ";
            $sqlRebate .= "END WHERE `gameId` = $id";
            $run = DB::statement($sqlOdds.$sqlRebate);
            if($run == 1){
                $write = Storage::disk('static')->put('gamedatas.js','');
                $game = Games::select('game_id as id','game_name as name','mode','code','order as sort','cate','maxReward','status as open','iconUrl','pageUrl','holiday_start as restStartDate','holiday_end as restEndDate','amount','isBan')->orderBy('order','ASC')->get();
                $playCate = PlayCates::all();
                $plays = Play::select('name','id','gameId','playCateId','alias','code','odds','rebate','minMoney','maxMoney','maxTurnMoney')->get();
                foreach ($plays as $item){
                    $collect = collect($item);
                    $newID = $item->gameId.$item->playCateId.$item->id;
                    $newCollect[] = $collect->put('id',(int)$newID);
                }
                $gameMap_txt = "var gameMap = ".$game->keyBy('id').";";
                $next_row = "\n";
                $game_txt = "var games = [".$game->pluck('id')->implode(',')."];";
                $playCate_txt = "var playCates = ".$playCate->keyBy('id').";";
                $plays_txt = "var plays = ".collect($newCollect)->keyBy('id').";";
                $animalsYear = "var animalsYear = ".json_encode(Config::get('website.animalsYear')).";";
                $write = Storage::disk('static')->put('gamedatas.js',$game_txt.$next_row.$gameMap_txt.$next_row.$playCate_txt.$next_row.$plays_txt.$next_row.$animalsYear);
                if($write == 1){
                    return response()->json([
                        'status'=>true
                    ]);
                }
            }
        }
    }
}

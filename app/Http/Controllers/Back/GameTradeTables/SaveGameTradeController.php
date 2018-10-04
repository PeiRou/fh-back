<?php

namespace App\Http\Controllers\Back\GameTradeTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SaveGameTradeController extends Controller
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


    function updateBatch($data,$id){
        $sqlMinMoney = "UPDATE play SET minMoney = CASE ";
        $sqlMaxMoney = "";
        $sqlTurnMaxMoney = "";
        $error = "no";
        foreach ($data as $key => $value) {
            if($value == ""){
                $error = "yes";
                break;
            }
            $sqlMinMoney .= "WHEN `min_tag` = '$key' THEN $value ";
            $sqlMaxMoney .= "WHEN `max_tag` = '$key' THEN $value ";
            $sqlTurnMaxMoney .= "WHEN `turnMax_tag` = '$key' THEN $value ";
        }
        if($error == "yes"){
            return response()->json([
                'status'=>false
            ]);
        } else {
            $sqlMinMoney .= "END, maxMoney = CASE ";
            $sqlMaxMoney .= "END, maxTurnMoney = CASE ";
            $sqlTurnMaxMoney .= "END WHERE `gameId` = $id";
            $run = DB::statement($sqlMinMoney.$sqlMaxMoney.$sqlTurnMaxMoney);
            if($run == 1){
                return response()->json([
                    'status'=>true
                ]);
            }
        }
    }
}

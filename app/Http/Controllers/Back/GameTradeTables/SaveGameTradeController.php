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

    public function ahk3(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,11);
    }

    public function gxk3(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,12);
    }

    public function hbk3(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,13);
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

    public function pcdd(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,66);
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

    public function msk3(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,86);
    }

    public function xykl8(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,83);
    }

    public function xydd(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,84);
    }

    public function xylhc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,85);
    }

    public function xyft(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,55);
    }

    public function lhc(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,70);
    }

    public function fc3d(Request $request)
    {
        $data = $request->all();
        return $this->updateBatch($data,30);
    }

    public function qqffc(Request $request){
        $data = $request->all();
        return $this->updateBatch($data,113);
    }

    public function kssc(Request $request){
        $data = $request->all();
        return $this->updateBatch($data,801);
    }

    public function ksft(Request $request){
        $data = $request->all();
        return $this->updateBatch($data,802);
    }

    public function ksssc(Request $request){
        $data = $request->all();
        return $this->updateBatch($data,803);
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

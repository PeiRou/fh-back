<?php

namespace App\Http\Controllers\Back\GameTradeTables;

use App\PlayUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SaveGameTradeController extends Controller
{
    public function bjpk10(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,50);
        else
            return $this->updateUserPlay($data,50,$data['userId']);
    }

    public function cqssc(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,1);
        else
            return $this->updateUserPlay($data,1,$data['userId']);
    }

    public function xjssc(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,4);
        else
            return $this->updateUserPlay($data,4,$data['userId']);
    }

    public function tjssc(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,5);
        else
            return $this->updateUserPlay($data,5,$data['userId']);
    }

    public function gdklsf(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,60);
        else
            return $this->updateUserPlay($data,60,$data['userId']);
    }

    public function jsk3(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,10);
        else
            return $this->updateUserPlay($data,10,$data['userId']);
    }

    public function ahk3(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,11);
        else
            return $this->updateUserPlay($data,11,$data['userId']);
    }

    public function gxk3(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,12);
        else
            return $this->updateUserPlay($data,12,$data['userId']);
    }

    public function hbk3(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,13);
        else
            return $this->updateUserPlay($data,13,$data['userId']);
    }

    public function cqxync(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,61);
        else
            return $this->updateUserPlay($data,61,$data['userId']);
    }

    public function bjkl8(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,65);
        else
            return $this->updateUserPlay($data,65,$data['userId']);
    }

    public function gd11x5(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,21);
        else
            return $this->updateUserPlay($data,21,$data['userId']);
    }

    public function pcdd(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,66);
        else
            return $this->updateUserPlay($data,66,$data['userId']);
    }

    public function mssc(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,80);
        else
            return $this->updateUserPlay($data,80,$data['userId']);
    }

    public function msft(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,82);
        else
            return $this->updateUserPlay($data,82,$data['userId']);
    }

    public function msssc(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,81);
        else
            return $this->updateUserPlay($data,81,$data['userId']);
    }

    public function paoma(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,99);
        else
            return $this->updateUserPlay($data,99,$data['userId']);
    }

    public function msk3(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,86);
        else
            return $this->updateUserPlay($data,86,$data['userId']);
    }

    public function xykl8(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,83);
        else
            return $this->updateUserPlay($data,83,$data['userId']);
    }

    public function xydd(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,84);
        else
            return $this->updateUserPlay($data,84,$data['userId']);
    }

    public function xylhc(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,85);
        else
            return $this->updateUserPlay($data,85,$data['userId']);
    }

    public function xyft(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,55);
        else
            return $this->updateUserPlay($data,55,$data['userId']);
    }

    public function twxyft(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,804);
        else
            return $this->updateUserPlay($data,804,$data['userId']);
    }

    public function lhc(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,70);
        else
            return $this->updateUserPlay($data,70,$data['userId']);
    }

    public function fc3d(Request $request)
    {
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,30);
        else
            return $this->updateUserPlay($data,30,$data['userId']);
    }

    public function qqffc(Request $request){
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,113);
        else
            return $this->updateUserPlay($data,113,$data['userId']);
    }

    public function kssc(Request $request){
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,801);
        else
            return $this->updateUserPlay($data,801,$data['userId']);
    }

    public function ksft(Request $request){
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,802);
        else
            return $this->updateUserPlay($data,802,$data['userId']);
    }

    public function ksssc(Request $request){
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,803);
        else
            return $this->updateUserPlay($data,803,$data['userId']);
    }

    public function sfsc(Request $request){
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,901);
        else
            return $this->updateUserPlay($data,901,$data['userId']);
    }

    public function sfssc(Request $request){
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,902);
        else
            return $this->updateUserPlay($data,902,$data['userId']);
    }

    public function jslhc(Request $request){
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,903);
        else
            return $this->updateUserPlay($data,903,$data['userId']);
    }

    public function sflhc(Request $request){
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,904);
        else
            return $this->updateUserPlay($data,904,$data['userId']);
    }

    public function xylsc(Request $request){
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,905);
        else
            return $this->updateUserPlay($data,905,$data['userId']);
    }

    public function xylft(Request $request){
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,906);
        else
            return $this->updateUserPlay($data,906,$data['userId']);
    }

    public function xylssc(Request $request){
        $data = $request->all();
        if(empty($data['userId']))
            return $this->updateBatch($data,907);
        else
            return $this->updateUserPlay($data,907,$data['userId']);
    }


    function updateBatch($data,$id){
        unset($data['userId']);
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

    function updateUserPlay($data,$id,$userId){
        unset($data['userId']);
        $aArray = [];
        foreach ($data as $key => $value){
            if($length = strpos($key,'_min')) {
                $aArray[] = [
                    'min_tag' => $key,
                    'minMoney' => empty($value)?0:$value,
                    'tag' => substr($key,0,$length),
                    'user_id' => $userId,
                    'game_id' => $id,
                ];
                unset($data[$key]);
            }
        }
        foreach ($data as $key => $value) {
            foreach ($aArray as $kArray => $iArray) {
                if (substr($key, 0, strpos($key, '_max')) === $iArray['tag'])
                    $aArray[$kArray]['maxMoney'] = empty($value) ? 0 : $value;
                if (substr($key, 0, strpos($key, '_turnMax')) === $iArray['tag'])
                    $aArray[$kArray]['maxTurnMoney'] = empty($value) ? 0 : $value;
            }
        }
        PlayUser::where('user_id',$userId)->where('game_id',$id)->delete();
        PlayUser::insert($aArray);
        return response()->json([
            'status'=>true
        ]);
    }
}

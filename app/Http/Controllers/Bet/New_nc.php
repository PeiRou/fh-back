<?php

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryNC;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class New_nc extends Excel
{
    public $arrPlay_id = array();
    public $arrPlayCate = array();
    public $arrPlayId = array();

    protected function exc_play($openCode,$gameId)
    {
        $win = collect([]);
        $ids_he = collect([]);
        $NC = new ExcelLotteryNC();
        $NC->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $NC->LM($gameId,$win,$ids_he);
        $NC->ZM($openCode,$gameId,$win);
        return array('win'=>$win,'ids_he'=>$ids_he,'NC'=>$NC);
    }
    public function all($openCode,$issue,$id,$excel,$code,$lotterys)
    {
        $gameId = $lotterys['gameId'];
        $table = $lotterys['table'];
        $gameName = $lotterys['lottery'];

        $game = Config::get('game.'.$table);
        $this->arrPlay_id = $game['arrPlay_id'];
        $this->arrPlayCate = $game['arrPlayCate'];
        $this->arrPlayId = $game['arrPlayId'];
        $betCount = DB::table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $bunko = 0;
            $resData = $this->exc_play($openCode,$gameId);
            $win = @$resData['win'];
            $he = isset($resData['ids_he'])?$resData['ids_he']:array();
            $NC = isset($resData['NC'])?$resData['NC']:null;
            try{
                $bunko = $this->bunko_nc($win,$gameId,$issue,$openCode,$he,$NC);
            }catch (\exception $exception){
                writeLog('New_Bet', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->update(['status' => 0,'bunko' => 0]);
            }
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id,true);
                if($updateUserMoney == 1){
                    writeLog('New_Bet', $gameName . $issue . "结算出错");
                }
            }
        }
        $this->updateTableFinished($table,$id,$gameName,$issue,$gameId,$code);
    }
}

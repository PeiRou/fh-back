<?php
/**
 * 棋牌报表处理
 */

namespace App\Repository\GamesApi\Card;

use App\GamesApi;
use Illuminate\Support\Facades\DB;


class TcReport{
    public $param;
    private $iData = [];
    private $res;
    public $sqlArr;
    public function __construct($aTime = null){
        if(is_null($aTime))
            $aTime = date('Y-m-d');
        $this->param = (object)[
            'aTime' => $aTime,
            'startTime' => $aTime,
            'endTime' => $aTime
        ];
    }

    public function getRes(){
        $GamesApi = new GamesApi();
        $this->res = $GamesApi->tc_betInfoData($this->param);
    }

    public function createData()
    {
        foreach ($this->res as $k=>$v){
            $this->iData[] = [
                'bet_count' =>  $v->bet_count,
                'user_count' =>  $v->user_count,
                'AllBet' =>  $v->AllBet,
                'Profit' =>  $v->Profit,
                'validBetAmount' =>  $v->validBetAmount,
                'productType' =>  $v->productType,
                'upMoney' =>  $v->upMoney,
                'downMoney' =>  $v->downMoney,
                'validBetAmount' =>  $v->validBetAmount,
                'date' =>  $this->param->aTime ?? date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }
    }

    public function insertData()
    {
        DB::table('jq_report_tc')->where('date', $this->param->aTime)->delete();
        DB::table('jq_report_tc')->insert($this->iData);
    }

    public function __call($name, $arguments){
        return call_user_func_array([$this,$name],$arguments);
    }
}
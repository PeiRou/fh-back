<?php
/**
 * 棋牌报表处理
 */

namespace App\Repository\GamesApi\Card;

use App\GamesApi;
use Illuminate\Support\Facades\DB;


class TcReport extends ReportBase
{
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
        $this->param->isGroupUser = 1;
        $GamesApi = new GamesApi();
        $this->res = $GamesApi->tc_betInfoData($this->param);
    }

    public static function getData($param)
    {
        $instance = new static();
        $instance->param = $param;
        $instance->getRes();
        $instance->createData();
        return $instance->iData;
    }

    public function createData()
    {
        foreach ($this->res as $k=>$v){
            $user = $this->getUserInfo($v->username);
            $agent = $this->getAgent($user->agent ?? 0);

            $this->iData[] = [
                'bet_count' =>  $v->bet_count,
                'username' =>  $v->username,
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
                'agent_account' => $agent->account ?? '',
                'agent_name' => $agent->name ?? '',
                'agent_id' => $agent->a_id ?? '',
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
<?php
/**
 * 棋牌报表处理
 */

namespace App\Repository\GamesApi\Card;

use App\GamesApi;
use Illuminate\Support\Facades\DB;

class TcBetReport extends ReportBase
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
        $GamesApi = new GamesApi();
        $this->res = $GamesApi->report_tc_data($this->param);
    }

    public function createData()
    {
        foreach ($this->res as $k=>$v){
            $user = $this->getUserInfo($v->username);
            $agent = $this->getAgent($user->agent ?? 0);

            $this->iData[] = [
                'bet_count' =>  $v->bet_count,
                'AllBet' =>  $v->AllBet,
                'Profit' =>  $v->Profit,
                'validBetAmount' =>  $v->validBetAmount,
                'username' =>  $v->username,
                'productType' =>  $v->productType,
                'gameCategory' =>  $v->gameCategory,
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
        DB::table('jq_report_tc_bet')->where('date', $this->param->aTime)->delete();
        DB::table('jq_report_tc_bet')->insert($this->iData);
    }

    public function __call($name, $arguments){
        return call_user_func_array([$this,$name],$arguments);
    }
}
<?php
/**
 * 棋牌报表处理
 */

namespace App\Repository\GamesApi\Card;

use App\Agent;
use App\GamesApi;
use App\GamesApiConfig;
use App\Users;
use Illuminate\Support\Facades\DB;


class Report{
    public $param;
    private $iData = [];
    private $res;
    public $sqlArr;
    public $UsersArr;

    public function __construct($aTime = null){
        if(is_null($aTime))
            $aTime = date('Y-m-d');
        $this->param = (object)[
            'aTime' => $aTime,
            'startTime' => $aTime,
            'endTime' => $aTime
        ];
        $this->UsersArr = collect([]);
        $this->agents = collect([]);
    }
    public function getData(){
        return $this->iData;
    }
    public function getRes(){
        $GamesApi = new GamesApi();
        $this->sqlArr = $GamesApi->card_betInfoSql($this->param);//组成的数组
        $this->res = $GamesApi->card_betInfoData($this->param, $this->sqlArr);
    }
    private function insertData(){
        $table = DB::table('jq_report_card');
        if(count($this->iData)){
            $table->where('date', $this->param->aTime)->delete();
            if($table->insert($this->iData))
                return true;
        }
        return false;
    }
    //
    private function createData(){
        foreach ($this->res as $k=>$v){
            $user  = $this->getUserInfo($v->Accounts);
            $agent = $this->getAgent($user->agent ?? 0);
            $GeneralAgent = $this->getGeneralAgent($agent->gagent_id ?? 0);
            $this->iData[] = [
                'g_id' => $v->g_id,
                'game_name' => $v->name,
                'user_account' => $user->username ?? '',
                'user_name' => $user->fullName ?? '',
                'user_id' => $user->id ?? '',
                'agent_account' => $agent->account ?? '',
                'agent_name' => $agent->name ?? '',
                'agent_id' => $agent->a_id ?? '',
                'general_account' => $GeneralAgent->account ?? '',
                'general_name' => $GeneralAgent->name ?? '',
                'general_id' => $GeneralAgent->ga_id ?? '',
                'bet_count' => $v->betCount ?? '',
                'bet_money' => $v->AllBet ?? '',
                'bet_bunko' => $v->Profit ?? '',
                'up_money' => $v->upMoney ?? 0,
                'down_money' => $v->downMoney ?? 0,
                'date' => $this->param->aTime,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
    }
    //获取代理
    private function getAgent($a_id){
        if(empty($this->agents->get($a_id)))
            $this->agents->put($a_id, Agent::select('a_id', 'name', 'account', 'gagent_id')->where('a_id', $a_id)->first());
        return $this->agents->get($a_id);
//        if(empty($this->agents))
//            $this->agent = Agent::select('a_id', 'name', 'account', 'gagent_id')->get()->keyBy('a_id');
//        return $this->agent->get($a_id);
    }
    //获取用户
    private function getUserInfo(&$username){
        if(empty($this->Users))
            $this->Users = Users::whereIn('username', $this->createUserName())->get()->keyBy('username');
        return $this->Users->get($username);
    }
    //获取用户
    private function getUser($username){
        if(empty($this->UsersArr->get($username)))
            $this->UsersArr->put($username, Users::where('username',$username)->first());
        return $this->UsersArr->get($username);
    }

    //获取总代理
    private function getGeneralAgent($gagent_id){
        if(empty($this->GeneralAgent))
            $this->GeneralAgent = DB::table('general_agent')->get()->keyBy('ga_id');
        return $this->GeneralAgent->get($gagent_id);
    }
    private function createUserName(){
        $ky = GamesApiConfig::getConfig(15);
        $lc = GamesApiConfig::getConfig(16);
        $nameArr = [];
        foreach ($this->res as $k=>&$v){
            if($v->g_id == 15)
                $v->Accounts = str_replace($ky['agent'].'_' ?? '', '', $v->Accounts);
            if($v->g_id == 16)
                $v->Accounts = str_replace($lc['agent'].'_' ?? '', '', $v->Accounts);
            $nameArr[] = $v->Accounts;
        }
        return $nameArr;
    }
    public function __call($name, $arguments){
        return call_user_func_array([$this,$name],$arguments);
    }
}
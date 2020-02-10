<?php

namespace App\Console\Commands;

use App\Agent;
use App\AgentOddsLevel;
use App\Bets;
use App\CapitalAgent;
use App\SystemSetup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SameClass\Config\LotteryGames\Games;

class AgentBackwaterCp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AgentOdds:AgentBackwaterCp {code} {issue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '代理模式彩票返水';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit','2048M');
        $code = $this->argument('code');
        $issue = $this->argument('issue');
        if(empty($code) || empty($issue)){
            $this->info('缺少必要参数');
            return false;
        }
        //获取彩票分类
        $aGamesConfig = new Games();
        $aGames = $aGamesConfig->games;
        if(empty($aGames[$code])){
            $this->info('该游戏分类不存在');
            return false;
        }
        $iGame = $aGames[$code];
        $gameId = $iGame['gameId'];
        //获取用户打码量
        $aBet = Bets::getAgentUserData($gameId,$issue);
        if(empty($aBet)){
            $this->info('无下注打码量');
            //层层代理反水结束后将状态改成已反水完
            $this->setFinished($iGame['table'],$issue,$iGame['lottery']);
            return false;
        }
        //获取需要返点的代理id
        $aAgentId = [];
        foreach ($aBet as $iBet){
            $aAgentId[] = $iBet->agent_id;
            if(!empty($iBet->superior_agent)){
                $aAgentId = array_merge($aAgentId,explode(',',$iBet->superior_agent));
            }
        }
        $aAgentId = array_unique($aAgentId);
        //获取代理赔率
//        $aAgentOdds = $this->agentOddsSort(AgentOddsLevel::getAgentOdds($iGame['type'],$aAgentId));
        $aAgentOdds = $this->agentOddsSort(AgentOddsLevel::getAgentOdds($gameId,$aAgentId));
        if(empty($aAgentOdds)){
            $this->info('代理赔率为空');
            writeLog('New_Bet', $iGame['lottery'] . $issue . "层层代理反水-代理赔率为空！");
            //层层代理反水结束后将状态改成已反水完
            $this->setFinished($iGame['table'],$issue,$iGame['lottery']);
            return false;
        }
        //获取代理返水层级数
        $iLevelNum = SystemSetup::getValueByCode('agent_backwater_level_num');
        //获取参数返水代理
        $aAgentBackwater = [];
        //获取代理增加金额
        $aAgentMoney = [];
        //资金明细
        $aCapitalAgent = [];
        $iTime = date('Y-m-d H:i:s');
        foreach ($aBet as  $iBet){
            if(empty($aAgentOdds[$iBet->agent_id])){
                $this->info('代理id为'.$iBet->agent_id.',赔率不存在');
                writeLog('New_Bet', $iGame['lottery'] . $issue .'--agent_id:'. $iBet->agent_id ."层层代理反水-赔率不存在！");
                continue;
            }
            $iAgent = $aAgentOdds[$iBet->agent_id];
            $preRebate = $iAgent->rebate;
            if(!empty($iBet->superior_agent)){
                $aAgentId = array_slice(array_reverse(explode(',',$iBet->superior_agent),false),0,$iLevelNum);
                $i = 1;
                foreach ($aAgentId as $iAgentId){
                    if(empty($aAgentOdds[$iAgentId])){
                        $this->info('代理id为'.$iBet->agent_id.',赔率不存在');
                        writeLog('New_Bet', $iGame['lottery'] . $issue .'--agent_id:'. "层层代理反水-赔率不存在！");
                        continue;
                    }
                    $iAgent = $aAgentOdds[$iAgentId];
                    $iCommission = $this->getCommission($preRebate,$iAgent->rebate);
                    $iMoney = $this->getMoney($iBet->betMoney,$iCommission);
                    if($iMoney > 0){
                        if(array_key_exists($iAgentId,$aAgentMoney))
                            $aAgentMoney[$iAgentId]['balance'] += $iMoney;
                        else
                            $aAgentMoney[$iAgentId] = [
                                'a_id' => $iAgentId,
                                'balance' => $iMoney
                            ];
                        $aAgentBackwater[] = [
                            'agent_id' => $iAgentId,
                            'to_agent' => $iBet->agent_id,
                            'user_id' => $iBet->user_id,
                            'status' => 1,
                            'money' => $iMoney,
                            'game_id' => $gameId,
                            'game_name' => $iGame['lottery'],
                            'issue' => $issue,
                            'level' => $i,
                            'rebate' => $iAgent->rebate,
                            'commission' => $iCommission,
                            'bet_money' => $iBet->betMoney,
                            'category_id' => 1,
                            'created_at' => $iTime,
                            'updated_at' => $iTime,
                        ];
                        $aCapitalAgent[] = [
                            'agent_id' => $iAgentId,
                            'order_id' => "ABWC" . date('YmdHis') . rand(10000000, 99999999),
                            'type' => 't01',
                            'money' => $iMoney,
                            'balance' => round($aAgentMoney[$iAgentId]['balance'] + $iBet->balance,2),
                            'content' => '',
                            'expan1' => $gameId,
                            'expan2' => $issue,
                            'expan3' => $iGame['lottery'],
                            'expan4' => '',
                            'created_at' => $iTime,
                            'updated_at' => $iTime,
                        ];
                        $preRebate = $iAgent->rebate;
                    }
                    $i++;
                }
            }
        }
        foreach ($aAgentMoney as &$v){
            $v['balance'] = '0\' + balance + '.$v['balance'].' + \'0';
        }
        //获取资金明细
        DB::beginTransaction();
        try{
            \App\AgentBackwater::insert($aAgentBackwater);
            if(count($aAgentMoney) > 0)
                DB::update(Agent::updateFiledBatchStitching($aAgentMoney,['balance'],'a_id'));
            CapitalAgent::insert($aCapitalAgent);
            DB::commit();
            //层层代理反水结束后将状态改成已反水完
            $this->setFinished($iGame['table'],$issue,$iGame['lottery']);
            $this->info('ok');
        }catch (\Exception $exception){
            writeLog('error',$exception->getFile(). '-> Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            writeLog('error','$aAgentBackwater:'.json_encode($aAgentBackwater));
            writeLog('error','$aCapitalAgent:'.json_encode($aCapitalAgent));
            DB::rollback();
            writeLog('New_Bet', $iGame['lottery'] . $issue . "层层代理反水前失败！");
            $this->info('保存失败');
        }
    }

    //按代理id为键名排序
    public function agentOddsSort($aAgentOdds){
        $aArray = [];
        foreach ($aAgentOdds as $iAgentOdds){
            $aArray[$iAgentOdds->agent_id] = $iAgentOdds;
        }
        return $aArray;
    }

    //获取提成比例
    public function getCommission($preRebate,$curRebate){
        $commission = round($curRebate - $preRebate,2);
        return $commission < 0 ? 0 : $commission;
    }

    //获取金额
    public function getMoney($betMoney,$commission){
        return round($betMoney * $commission / 100,2);
    }
    //层层代理反水结束后将状态改成已反水完
    private function setFinished($table,$issue,$gameName){
        $res = DB::table($table)->where('issue',$issue)->where('backwater',2)->update(['backwater' => 1]);
        if(empty($res)){
            writeLog('New_Bet',$gameName.$issue.'层层代理反水中失败！');
        }
    }
}

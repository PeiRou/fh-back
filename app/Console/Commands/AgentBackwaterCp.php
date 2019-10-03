<?php

namespace App\Console\Commands;

use App\Agent;
use App\AgentOddsLevel;
use App\Bets;
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
    protected $signature = 'AgentOdds:AgentBackwaterCp {gameId} {issue}';

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
        $gameId = $this->argument('gameId');
        $issue = $this->argument('issue');
        if(empty($gameId) || empty($issue)){
            $this->info('缺少必要参数');
            return false;
        }
        //获取用户打码量
        $aBet = Bets::getAgentUserData($gameId,$issue);
        if(empty($aBet)){
            $this->info('无下注打码量');
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
        //获取彩票分类
        $aGamesConfig = new Games();
        $aGames = $aGamesConfig->games;
        $iGame = [];
        foreach ($aGames as $iGames){
            if($iGames['gameId'] == $gameId)    $iGame = $iGames;
        }
        if(empty($iGame)){
            $this->info('该游戏分类不存在');
            return false;
        }
        //获取代理赔率
        $aAgentOdds = $this->agentOddsSort(AgentOddsLevel::getAgentOdds($iGame['type'],$aAgentId));
        if(empty($aAgentOdds)){
            $this->info('代理赔率为空');
            return false;
        }
        //获取代理返水层级数
        $iLevelNum = SystemSetup::getValueByCode('agent_backwater_level_num');
        //获取参数返水代理
        $aAgentBackwater = [];
        //获取代理增加金额
        $aAgentMoney = [];
        $iTime = date('Y-m-d H:i:s');
        foreach ($aBet as  $iBet){
            if(empty($aAgentOdds[$iBet->agent_id])){
                $this->info('代理id为'.$iBet->agent_id.',赔率不存在');
                continue;
            }
            $iAgent = $aAgentOdds[$iBet->agent_id];
            $preRebate = $iAgent->rebate;
            if(!empty($iBet->superior_agent)){
                $aAgentId = array_slice(array_reverse(explode(',',$iBet->superior_agent),false),0,$iLevelNum);
                foreach ($aAgentId as $iAgentId){
                    if(empty($aAgentOdds[$iAgentId])){
                        $this->info('代理id为'.$iBet->agent_id.',赔率不存在');
                        continue;
                    }
                    $iAgent = $aAgentOdds[$iAgentId];
                    $iCommission = $this->getCommission($preRebate,$iAgent->rebate);
                    $iMoney = $this->getMoney($iBet->betMoney,$iCommission);
                    if($iMoney > 0){
                        $aAgentBackwater[] = [
                            'agent_id' => $iAgentId,
                            'to_agent' => $iBet->agent_id,
                            'user_id' => $iBet->user_id,
                            'status' => 1,
                            'money' => $iMoney,
                            'game_id' => $gameId,
                            'game_name' => $iGame['lottery'],
                            'issue' => $issue,
                            'rebate' => $iAgent->rebate,
                            'commission' => $iCommission,
                            'bet_money' => $iBet->betMoney,
                            'category_id' => 1,
                            'created_at' => $iTime,
                            'updated_at' => $iTime,
                        ];
                        if(array_key_exists($iAgentId,$aAgentMoney))
                            $aAgentMoney[$iAgentId]['balance'] += $iMoney;
                        else
                            $aAgentMoney[$iAgentId] = [
                                'a_id' => $iAgentId,
                                'balance' => $iMoney
                            ];
                        $preRebate = $iAgent->rebate;
                    }
                }
            }
        }
        //获取资金明细
        DB::beginTransaction();
        try{
            \App\AgentBackwater::insert($aAgentBackwater);
            DB::update(Agent::updateFiledBatchStitching($aAgentMoney,['balance'],'a_id'));
            DB::commit();
            $this->info('ok');
        }catch (\Exception $exception){
            DB::rollback();
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
}

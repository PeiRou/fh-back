<?php

namespace App\Jobs;

use App\Agent;
use App\Helpers\Common;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class AgentBackwaterSettlement implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $gameId;

    private $issue;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($gameId,$issue)
    {
        $this->gameId = $gameId;

        $this->issue = $issue;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $aData = $this->getBackwaterMoneyGroupUser(DB::connection('mysql::write')->table('bet')->select('bet.play_odds','bet.bet_money','bet.agnet_odds','bet.user_id')->where('bet.game_id',$this->gameId)->where('bet.issue',$this->issue)->where('bet.agnet_odds','!=',0)->where('bet.bunko','!=',0)->get());
        $time = date('Y-m-d H:i:s');

        $aAgentBackwater = [];
        foreach ($aData as $kData => $iData){
            $aAgentBackwater[] = [
                'agent_id' => $iData['agent_id'],
                'user_id' => $iData['user_id'],
                'status' => 1,
                'money' => $iData['money'],
                'game_id' => $this->gameId,
                'issue' => $this->issue,
                'created_at' =>$time,
                'updated_at' =>$time,
            ];
        }

        $aData = $this->getBackwaterMoney($aData);
        $aCapitalAgent = [];
        $aAgent = DB::connection('mysql::write')->table('agent')->select('balance','a_id')->get();
        $gameName = DB::table('game')->where('game_id',$this->gameId)->value('game_name');
        foreach ($aAgent as $kAgent => $iAgent) {
            foreach ($aData as $kData => $iData) {
                if($iAgent->a_id == $iData['agent_id']) {
                    $aCapitalAgent[] = [
                        'agent_id' => $iData['a_id'],
                        'user_type' => 'agent',
                        'type' => 't28',
                        'game_id' => $this->gameId,
                        'issue' => $this->issue,
                        'money' => $iData['money'],
                        'balance' => $iAgent->balance,
                        'game_name' =>$gameName,
                        'created_at' =>$time,
                        'updated_at' =>$time,
                    ];
                }
            }
        }

        $aAgentSql = Agent::updateBatchStitching($aData,['money'],'a_id');

        $Common = new Common();
        DB::beginTransaction();
        try{
            DB::table('agent_backwater')->insert($aAgentBackwater);
            DB::table('capital_agent')->insert($aCapitalAgent);
            DB::update($aAgentSql);
            DB::commit();
            $Common->customWriteLog('agentBackwater','success.游戏id：'.$this->gameId.' 期号：'.$this->issue);
        }catch (\Exception $e){
            DB::rollback();
            $Common->customWriteLog('agentBackwater','failure.游戏id：'.$this->gameId.' 期号：'.$this->issue);
        }
    }

    public function getBackwaterMoneyGroupUser($aData){
        $aArray = [];

        foreach ($aData as $kData => $iData){
            if(!empty($iData->agent_odds)){
                foreach (unserialize($iData->agent_odds) as $key => $value){
                    if(isset($aArray[$iData->user_id.$key]) && array_key_exists($iData->user_id.$key,$aArray))
                        $aArray[$iData->user_id.$key]['money'] += $iData->bet_money * $value;
                    else
                        $aArray[$iData->user_id.$key] = [
                            'money' => $iData->bet_money * $value,
                            'agent_id' => $key,
                            'user_id' => $iData->user_id,
                        ];
                }
            }
        }

        return $aArray;
    }

    public function getBackwaterMoney($aData){
        $aArray = [];

        foreach ($aData as $kData => $iData){
            if(isset($aArray[$iData['agent_id']]) && array_key_exists($iData['agent_id'],$aArray))
                $aArray[$iData['agent_id']]['money'] += $iData['money'];
            else
                $aArray[$iData['agent_id']] = [
                    'money' => $iData['money'],
                    'a_id' => $iData['agent_id'],
                ];
        }

        return $aArray;
    }
}

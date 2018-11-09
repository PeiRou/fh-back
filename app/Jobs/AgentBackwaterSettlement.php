<?php

namespace App\Jobs;

use App\Agent;
use App\Games;
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
        $table = Games::$aTableByGameId[$this->gameId];
        $Common = new Common();

        if(empty($table)){
            $Common->customWriteLog('agentBackwater','该游戏表不存在..游戏id：'.$this->gameId.' 期号：'.$this->issue);
            return false;
        }

        $table = 'game_'.$table;
        if(in_array($this->gameId,[91]))
           $backwater = DB::connection('mysql::write')->table($table)->where('issue',$this->issue)->value('nn_backwater');
        else
            $backwater = DB::connection('mysql::write')->table($table)->where('issue',$this->issue)->value('backwater');
        if($backwater == 2){
            $Common->customWriteLog('agentBackwater','已返水..游戏id：'.$this->gameId.' 期号：'.$this->issue);
            return false;
        }

        $aData = DB::connection('mysql::write')->table('bet')->select('play_odds','bet_money','agnet_odds','user_id')->where('game_id',$this->gameId)->where('issue',$this->issue)->where('agnet_odds','!=',0)->where('bunko','!=',0)->get();
        $Common->customWriteLog('agentBackwater',$aData->toArray());
        $aData = $this->getBackwaterMoneyGroupUser($aData);
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

        DB::beginTransaction();
        try{
            if(!empty($aData)) {
                DB::table('agent_backwater')->insert($aAgentBackwater);
                DB::table('capital_agent')->insert($aCapitalAgent);
                DB::update($aAgentSql);
            }
            if(in_array($this->gameId,[91]))
                DB::table($table)->where('issue',$this->issue)->update(['nn_backwater' => 2]);
            else
                DB::table($table)->where('issue',$this->issue)->update(['backwater' => 2]);

            DB::commit();
            $Common->customWriteLog('agentBackwater','success..游戏id：'.$this->gameId.' 期号：'.$this->issue);
        }catch (\Exception $e){
            DB::rollback();
            $Common->customWriteLog('agentBackwater','failure..游戏id：'.$this->gameId.' 期号：'.$this->issue);
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

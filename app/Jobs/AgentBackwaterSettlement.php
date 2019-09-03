<?php

namespace App\Jobs;

use App\Agent;
use App\Games;
use App\Helpers\Common;
use App\PromotionConfig;
use App\SystemSetting;
use App\Users;
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

        if(empty($table)){
            return false;
        }

        $table = 'game_'.$table;
        if(in_array($this->gameId,[91]))
           $backwater = DB::connection('mysql::write')->table($table)->where('issue',$this->issue)->value('nn_backwater');
        else
            $backwater = DB::connection('mysql::write')->table($table)->where('issue',$this->issue)->value('backwater');
        if($backwater == 2){
            return false;
        }

        $aData = DB::connection('mysql::write')->table('bet')
            ->select('bet.play_odds','bet.bet_money','bet.agnet_odds','bet.user_id','users.username','game.game_name')
            ->where('bet.game_id',$this->gameId)
            ->where('bet.issue',$this->issue)
            ->where('bet.status',1)
            ->join('users','bet.user_id','=','users.id')
            ->join('game','bet.game_id','=','game.game_id')->get();

        $aArray = [];
        $aUserArray = [];
        $promotionLevel = SystemSetting::where('id',1)->value('promotion_level');
        $promotionConfig = PromotionConfig::getPromotionList();
        $time = date('Y-m-d H:i:s');
        foreach ($aData as $kData => $iData) {
            if (!empty($iData->agnet_odds)) {
                $promotionArray = explode(',', $iData->agnet_odds);
                $promotionCount = count($promotionArray);
                if ($promotionLevel > $promotionCount)
                    $iCount = $promotionCount;
                else
                    $iCount = $promotionLevel;
                for ($i = 1; $i <= $iCount; $i++) {
                    if (isset($aArray[$promotionArray[$promotionCount - $i]]) && array_key_exists($promotionArray[$promotionCount - $i], $aArray))
                        $aArray[$promotionArray[$promotionCount - $i]]['money'] += $iData->bet_money * $promotionConfig[$i] / 100;
                    else
                        $aArray[$promotionArray[$promotionCount - $i]] = [
                            'money' => $iData->bet_money * $promotionConfig[$i] / 100,
                            'to_user' => $promotionArray[$promotionCount - $i],
                            'user_type' => 'user',
                            'order_id' => 'P' . time() . rand(100000, 999999),
                            'type' => 't28',
                            'game_id' => $this->gameId,
                            'issue' => $this->issue,
                            'created_at' => $time,
                            'updated_at' => $time,
                            'content' => '会员('.$iData->username.')->'.$iData->game_name.'的第'.$this->issue.'期'
                        ];
                    if (!in_array($promotionArray[$promotionCount - $i], $aUserArray))
                        $aUserArray[] = $promotionArray[$promotionCount - $i];
                }
            }
        }
        $aUser = Users::select('id','money')->whereIn('id',$aUserArray)->get()->toArray();
        foreach ($aArray as $kArray => $iArray){
            foreach ($aUser as $iUser){
                if($iArray['to_user'] == $iUser['id']){
                    $aArray[$kArray]['balance'] = $iArray['money'] + $iUser['money'];
                }
            }
        }


        $aUserSql = Users::updateUserBatchStitching('users',$aArray);
        DB::beginTransaction();
        try{
            if(!empty($aData)) {
                DB::table('capital')->insert($aArray);
                DB::update($aUserSql);
            }
            if(in_array($this->gameId,[91]))
                DB::table($table)->where('issue',$this->issue)->update(['nn_backwater' => 2]);
            else
                DB::table($table)->where('issue',$this->issue)->update(['backwater' => 2]);

            DB::commit();
//            $Common->customWriteLog('agentBackwater','success..游戏id：'.$this->gameId.' 期号：'.$this->issue);
        }catch (\Exception $e){
            DB::rollback();
//            $Common->customWriteLog('agentBackwater','failure..游戏id：'.$this->gameId.' 期号：'.$this->issue);
        }
    }
}

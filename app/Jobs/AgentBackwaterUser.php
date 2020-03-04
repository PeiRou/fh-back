<?php

namespace App\Jobs;


use App\AgentBackwater;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AgentBackwaterUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $aDateTime;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($aDateTime)
    {
        $this->aDateTime = $aDateTime;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $aData = AgentBackwater::getBackwaterUser($this->aDateTime,$this->aDateTime.' 23:59:59');
        $aArray = [];
        $iTime = date('Y-m-d H:i:s');
        foreach ($aData as $iData){
            $aArray[] = [
                'user_id' => $iData->user_id,
                'user_account' => $iData->username,
                'category_id' => $iData->category_id,
                'game_id' => $iData->game_id,
                'game_name' => $iData->game_name,
                'issue' => $iData->issue,
                'bet_money' => $iData->bet_money,
                'money' => $iData->money,
                'date' => $this->aDateTime,
                'created_at' => $iTime,
                'updated_at' => $iTime,
            ];
        }
        \App\AgentBackwaterUser::where('date',$this->aDateTime)->delete();
        \App\AgentBackwaterUser::insert($aArray);
    }
}

<?php

namespace App\Console\Commands;

use App\AgentBackwater;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AgentBackwaterReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AgentOdds:AgentBackwaterReport {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '代理返水报表定时任务';

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
        $iDate = $this->argument('date');
        $iTime = strtotime($iDate);
        $curTime = date('Y-m-d H:i:s');
        //获取代理返佣报表
        $aBackwater = AgentBackwater::getAgentDate($iDate);
        $aArray = [];
        foreach ($aBackwater as $iBackwater){
            $aArray[] = [
                'agent_id' => $iBackwater->agent_id,
                'agent_account' => $iBackwater->account,
                'agent_name' => $iBackwater->name,
                'pre_agent' => $iBackwater->p_agent_id,
                'count' => $iBackwater->count,
                'bet_money' => $iBackwater->bet_money,
                'money' => $iBackwater->money,
                'date' => $iDate,
                'dateTime' => $iTime,
                'created_at' => $curTime,
                'updated_at' => $curTime,
            ];
        }
        \App\AgentBackwaterReport::where('date',$iDate)->delete();
        $aArray = array_chunk($aArray,5000);
        foreach ($aArray as $iArray){
            \App\AgentBackwaterReport::insert($iArray);
        }
        $this->info('ok');
    }
}

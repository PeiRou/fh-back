<?php

namespace App\Console\Commands;

use App\Activity;
use App\ActivitySend;
use App\ActivityStatistics;
use Illuminate\Console\Command;

class ActivityDailyStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Activity:DailyStatistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        ini_set('memory_limit','1024M');
        $activitySendModel = new ActivitySend();
        $aData = $activitySendModel->getDataByTime(date('Y-m-d',strtotime('-1 day')));
        $aArray = [];
        $dayTime = date('Y-m-d',strtotime('-2 day'));
        foreach ($aData as $kData => $iData){
            $aArray[$kData] = [
                'day' => empty($iData->day)?$dayTime:$iData->day,
                'user_id' => $iData->user_id,
                'user_name' => $iData->user_name,
                'user_account' => $iData->user_account,
                'activity_id' => $iData->activity_id,
                'activity_name' => $iData->activity_name,
                'activity_type' => $iData->type,
                'activity_type_name' => Activity::$activityType[$iData->type],
                'prize_id' => $iData->prize_id,
                'prize_name' => $iData->prize_name,
                'prize_status' => $iData->status,
                'prize_status_name' => ActivitySend::$activityStatus[$iData->status],
                'continue_days' => empty($iData->continue_days)?1:$iData->continue_days,
                'created_at' => $iData->created_at,
                'updated_at' => $iData->updated_at,
            ];
        }
        $activityStatistics = new ActivityStatistics();
        if($activityStatistics->batchInsert($aArray,$dayTime))
            $this->info('Console activity daily statistics successfully.');
        else
            $this->info('Console activity daily statistics failure.');
    }
}

<?php

namespace App\Console\Commands;

use App\Bets;
use App\Drawing;
use App\Recharges;
use App\StatisticsData;
use App\Users;
use Illuminate\Console\Command;

class StatisticsDailyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'StatisticsData:Daily';

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
        $aUser = Users::select('id','name','username','created_at')->get();
        $dayTime = date('Y-m-d',strtotime('-1 day'));
        $aRecharges = Recharges::getDailyStatistics($dayTime);
        $aBet = Bets::getDailyStatistics($dayTime);
        $aDrawing = Drawing::getDailyStatistics($dayTime);
        $aArray = [];
        $todayTime = date('Y-m-d H:i:s');
        foreach ($aUser as $kUser => $iUser){
            $aArray[$kUser] = [
                'date' => $dayTime,
                'user_id' => $iUser->id,
                'user_name' => $iUser->name,
                'user_account' => $iUser->username,
                'user_time' => $iUser->created_at,
                'recharges_count' => 0,
                'recharges_money' => 0,
                'drawing_count' => 0,
                'drawing_money' => 0,
                'bet_count' => 0,
                'bet_money' => 0,
                'bet_bunko' => 0,
                'created_at' => $todayTime,
                'updated_at' => $todayTime,
            ];
            foreach ($aRecharges as $kRecharges => $iRecharges){
                if($iUser->id === $iRecharges->userId){
                    $aArray[$kUser]['recharges_count'] = $iRecharges->idCount;
                    $aArray[$kUser]['recharges_money'] = $iRecharges->amountSum;
                }
            }
            foreach ($aBet as $kBet => $iBet){
                if($iUser->id === $iBet->user_id){
                    $aArray[$kUser]['bet_count'] = $iBet->betCount;
                    $aArray[$kUser]['bet_money'] = $iBet->betMoney;
                    $aArray[$kUser]['bet_bunko'] = $iBet->sumBunko;
                }
            }
            foreach ($aDrawing as $kDrawing => $iDrawing){
                if($iUser->id === $iDrawing->user_id){
                    $aArray[$kUser]['drawing_count'] = $iDrawing->idCount;
                    $aArray[$kUser]['drawing_money'] = $iDrawing->amountSum;
                }
            }
        }
        StatisticsData::where('date',$dayTime)->delete();
        if(StatisticsData::insert($aArray))
            $this->info('Console activity daily statistics successfully.');
        else
            $this->info('Console activity daily statistics failure.');
    }
}

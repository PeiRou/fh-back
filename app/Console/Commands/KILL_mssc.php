<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunMssc;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class KILL_mssc extends Command
{
    protected $gameId = 80;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'KILL_mssc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速赛车-定时杀率';

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
        $table = 'game_mssc';
        $excel = new Excel();
        $get = $excel->getNeedKillIssue($table);
        $exeBase = $excel->getKillBase($this->gameId);
        if(isset($get) && $get && !empty($exeBase)){
            //开奖号码
            $opennum = $excel->opennum($table);
            if(isset($get->excel_num) && $get->excel_num == 0){
//                \Log::Info('秒速赛车 杀率:'.$get->issue.'=='.$get->id);
                $update = DB::table($table)->where('id',$get->id)->update([
                    'excel_num' => 2
                ]);
                if($update)
                    event(new RunMssc($opennum,$get->issue,$this->gameId,$get->id,true)); //新--结算
            }
        }
    }
}
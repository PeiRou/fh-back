<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunMsssc;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class KILL_msssc extends Command
{
    protected $gameId = 81;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'KILL_msssc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速时时彩-定时杀率';

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
        $table = 'game_msssc';
        $excel = new Excel();
        $get = $excel->getNeedKillIssue($table);
        $exeBase = $excel->getKillBase($this->gameId);
        if(isset($get) && $get && !empty($exeBase)){
            //开奖号码
            $opennum = $excel->opennum($table);
            if(isset($get->excel_num) && $get->excel_num == 0){
//                \Log::Info('秒速时时彩 杀率:'.$get->issue.'=='.$get->id);
                $update = DB::table($table)->where('id',$get->id)->update([
                    'excel_num' => 2
                ]);
                if($update)
                    event(new RunMsssc($opennum,$get->issue,$this->gameId,$get->id,true)); //新--结算
            }
        }
    }
}


<?php

namespace App\Console\Commands;

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
        $tmp = DB::select('SELECT id,issue,excel_num FROM `game_msssc` WHERE id = (SELECT MIN(id) FROM `game_msssc` WHERE opentime <=now()+5 and is_open=0 and excel_num=0)');
        foreach ($tmp as&$value)
            $get = $value;
        if(isset($get) && $get){
            $opennum = rand(0,9).','.rand(0,9).','.rand(0,9).','.rand(0,9).','.rand(0,9);
            if($get->excel_num !== 1){
                \Log::Info('秒速时时彩 杀率:'.$get->issue);
                event(new RunMsssc($opennum,$get->issue,$this->gameId,true)); //新--结算
                $update = DB::table('game_msssc')->where('id',$get->id)->update([
                    'excel_num' => 1
                ]);
                if($update !== 1){
                    \Log::info("秒速时时彩".$get->issue."杀率计算出错");
                }
            }
        }
    }
}


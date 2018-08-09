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
        $tmp = DB::select("SELECT id,issue,excel_num FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <=now()+10 and is_open=0 and excel_num=0) and is_open=0 and bunko=0 and excel_num=0");
        $exeBase = DB::table('excel_base')->select('excel_num')->where('is_open',1)->where('game_id',$this->gameId)->first();
        foreach ($tmp as&$value)
            $get = $value;
        if(isset($get) && $get && !empty($exeBase)){
            $update = DB::table($table)->where('id',$get->id)->update([
                'excel_num' => 2
            ]);
            //开奖号码
            $excel = new Excel();
            $opennum = $excel->opennum($table);
            if(isset($get->excel_num) && $get->excel_num == 0){
                \Log::Info('秒速时时彩 杀率:'.$get->issue.'=='.$get->id);
                event(new RunMsssc($opennum,$get->issue,$this->gameId,true)); //新--结算
                $update = DB::table($table)->where('id',$get->id)->update([
                    'excel_num' => 1
                ]);
                if($update !== 1){
                    \Log::info("秒速时时彩".$get->issue."杀率计算出错");
                }
            }
        }
    }
}


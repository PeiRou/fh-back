<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunMSJSK3;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class KILL_msjsk3 extends Command
{
    protected $gameId = 86;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'KILL_msjsk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速江苏快3-定时杀率';

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
        $table = 'game_msjsk3';
        $today = date('Y-m-d H:i:s',time()+9);
        $tmp = DB::select("SELECT id,issue,excel_num FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='{$today}' and is_open=0 and excel_num=0) and is_open=0 and bunko=0 and excel_num=0");
        $exeBase = DB::table('excel_base')->select('excel_num')->where('is_open',1)->where('game_id',$this->gameId)->first();
        foreach ($tmp as&$value)
            $get = $value;
        if(isset($get) && $get && !empty($exeBase)){
            //开奖号码
            $excel = new Excel();
            $opennum = $excel->opennum($table);
            if(isset($get->excel_num) && $get->excel_num == 0){
                \Log::Info('秒速江苏快3 杀率:'.$get->issue.'=='.$get->id);
                $update = DB::table($table)->where('id',$get->id)->update([
                    'excel_num' => 2
                ]);
                event(new RunMSJSK3($opennum,$get->issue,$this->gameId,true)); //新--结算
                $update = DB::table($table)->where('id',$get->id)->update([
                    'excel_num' => 1
                ]);
                if($update !== 1){
                    \Log::info("秒速江苏快3".$get->issue."杀率计算出错");
                }
            }
        }
    }
}
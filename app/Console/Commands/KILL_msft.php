<?php

namespace App\Console\Commands;

use App\Events\RunMstf;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class KILL_msft extends Command
{
    protected $gameId = 82;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'KILL_msft';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速飞艇-定时杀率';

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
        $table = 'game_msft';
        $today = date('Y-m-d H:i:s',time()+10);
        $tmp = DB::select("SELECT id,issue,excel_num FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='{$today}' and is_open=0 and excel_num=0) and is_open=0 and bunko=0 and excel_num=0");
        $exeBase = DB::table('excel_base')->select('excel_num')->where('is_open',1)->where('game_id',$this->gameId)->first();
        foreach ($tmp as&$value)
            $get = $value;
        if(isset($get) && $get && !empty($exeBase)){
            $opennum = $this->opennum();
            if(isset($get->excel_num) && $get->excel_num == 0){
                \Log::Info('秒速飞艇 杀率:'.$get->issue.'=='.$get->id);
                $update = DB::table($table)->where('id',$get->id)->update([
                    'excel_num' => 2
                ]);
                event(new RunMstf($opennum,$get->issue,$this->gameId,true)); //新--结算
                $update = DB::table($table)->where('id',$get->id)->update([
                    'excel_num' => 1
                ]);
                if($update !== 1){
                    \Log::info("秒速飞艇".$get->issue."杀率计算出错");
                }
            }
        }
    }
    private function opennum(){
        $tmpArray = [0=>1,1=>2,2=>3,3=>4,4=>5,5=>6,6=>7,7=>8,8=>9,9=>10];
        for ($i=0;$i<10;$i++){
            $tmpLegth = count($tmpArray);
            $tmpRand = rand(0,$tmpLegth-1);
            $res[] = $tmpArray[$tmpRand];
            unset($tmpArray[$tmpRand]);
            $tmpArray2 = [];
            foreach ($tmpArray as&$value)
                $tmpArray2[] = $value;
            $tmpArray = $tmpArray2;
        }
        return implode(',',$res);
    }
}
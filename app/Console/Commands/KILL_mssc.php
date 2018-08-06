<?php

namespace App\Console\Commands;

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
        $tmp = DB::select('SELECT id,issue,excel_num FROM `game_mssc` WHERE id = (SELECT MIN(id) FROM `game_mssc` WHERE opentime <=now()+10 and is_open=0 and excel_num=0) and is_open=0 and bunko=0 and excel_num=0');
        foreach ($tmp as&$value)
            $get = $value;
        if(isset($get) && $get){
            $opennum = $this->opennum();
            if($get->excel_num !== 1){
                \Log::Info('秒速赛车 杀率:'.$get->issue);
                event(new RunMssc($opennum,$get->issue,$this->gameId,true)); //新--结算
                $update = DB::table('game_mssc')->where('id',$get->id)->update([
                    'excel_num' => 1
                ]);
                if($update !== 1){
                    \Log::info("秒速赛车".$get->issue."杀率计算出错");
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
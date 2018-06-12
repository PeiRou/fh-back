<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class OPEN_FILE_CQSSC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'OPEN_FILE_CQSSC';

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
        $timeUp_Lingcheng = date('Y-m-d 00:00:00');
        $timeUp_baitian = date('Y-m-d 09:50:00');
        $timeUp_yejian = date('Y-m-d 21:55:00');
        $str = "";
        for($i=1;$i<=23;$i++){
            $timeUp_Lingcheng = Carbon::parse($timeUp_Lingcheng)->addMinutes(5);
            if(strlen($i) == 1){
                $i = '00'.$i;
            }
            if(strlen($i) == 2){
                $i = '0'.$i;
            }
            $str .= '"'.(string)$i.'":{"time":"'.$timeUp_Lingcheng->toTimeString().'","issue":"'.(string)$i.'"},';
        }
        for($i=1;$i<=72;$i++){
            $timeUp_baitian = Carbon::parse($timeUp_baitian)->addMinutes(10);
            $num = 23 + $i;
            if(strlen($num) == 2){
                $num = '0'.$num;
            }
            $str .= '"'.(string)$num.'":{"time":"'.$timeUp_baitian->toTimeString().'","issue":"'.(string)$num.'"},';
        }
        for($i=1;$i<=24;$i++){
            $timeUp_yejian = Carbon::parse($timeUp_yejian)->addMinutes(5);
            $num = 95 + $i;
            if(strlen($num) == 2){
                $num = '0'.$num;
            }
            $str .= '"'.(string)$num.'":{"time":"'.$timeUp_yejian->toTimeString().'","issue":"'.(string)$num.'"},';
        }
        $str .= '"120":{"time":"23:59:59","issue":"120"},';

        Storage::disk('gameTime')->put('cqssc.json',"{".rtrim($str,',')."}");
    }
}

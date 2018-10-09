<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class OPEN_FILE_CQXYNC extends Command
{
    protected $signature = 'OPEN_FILE_CQXYNC';
    protected $description = '重庆幸运农场开奖时间表';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $timeUp = date('23:52:20');
        $timeUp2 = date('09:52:20');
        $str = "";
        for($i=1;$i<=13;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(10);
            if(strlen($i) == 1){
                $i = '00'.$i;
            }
            if(strlen($i) == 2){
                $i = '0'.$i;
            }
            $str .= '"'.(string)$i.'":{"time":"'.$timeUp->toTimeString().'","issue":"'.(string)$i.'"},';
        }
        for($i=1;$i<=84;$i++){
            $timeUp2 = Carbon::parse($timeUp2)->addMinutes(10);
            $num = 13 + $i;
            if(strlen($num) == 2){
                $num = '0'.$num;
            }
            $str .= '"'.(string)$num.'":{"time":"'.$timeUp2->toTimeString().'","issue":"'.(string)$num.'"},';
        }
        Storage::disk('gameTime')->put('cqxync.json',"{".rtrim($str,',')."}");
    }
}

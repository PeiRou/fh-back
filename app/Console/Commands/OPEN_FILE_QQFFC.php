<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class OPEN_FILE_QQFFC extends Command
{
    protected $signature = 'OPEN_FILE_QQFFC';
    protected $description = 'QQ分分彩-开奖时间文件';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $timeUp = date('23:59:00');
        $str = "";
        for($i=1;$i<=1440;$i++){
            $timeUp = Carbon::parse($timeUp)->addSeconds(60);
            if(strlen($i) == 1){
                $i = '000'.$i;
            }
            if(strlen($i) == 2){
                $i = '00'.$i;
            }
            if(strlen($i) == 3){
                $i = '0'.$i;
            }
            $str .= '"'.(string)$i.'":{"time":"'.$timeUp->toTimeString().'","issue":"'.(string)$i.'"},';
        }
        Storage::disk('gameTime')->put('qqffc.json',"{".rtrim($str,',')."}");
    }
}

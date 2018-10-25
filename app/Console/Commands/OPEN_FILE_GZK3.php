<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class OPEN_FILE_GZK3 extends Command
{
    protected $signature = 'OPEN_FILE_GZK3';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $timeUp = date('09:00:00');
        $str = "";
        for($i=1;$i<=78;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(10);
            if(strlen($i) == 1){
                $i = '00'.$i;
            }
            if(strlen($i) == 2){
                $i = '0'.$i;
            }
            $str .= '"'.(string)$i.'":{"time":"'.$timeUp->toTimeString().'","issue":"'.(string)$i.'"},';
        }
        Storage::disk('gameTime')->put('gzk3.json',"{".rtrim($str,',')."}");
    }
}

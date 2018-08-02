<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class OPEN_FILE_MSJSK3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'OPEN_FILE_MSJSK3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速江苏快3-开奖时间文件';

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
        Storage::disk('gameTime')->put('msjsk3.json',"{".rtrim($str,',')."}");
    }
}

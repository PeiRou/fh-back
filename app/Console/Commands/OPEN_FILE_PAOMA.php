<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class OPEN_FILE_PAOMA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'OPEN_FILE_PAOMA';

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
        $timeUp = date('07:28:45');
        $str = "";
        for($i=1;$i<=985;$i++){
            $timeUp = Carbon::parse($timeUp)->addSeconds(75);
            if(strlen($i) == 1){
                $i = '00'.$i;
            }
            if(strlen($i) == 2){
                $i = '0'.$i;
            }
            $str .= '"'.(string)$i.'":{"time":"'.$timeUp->toTimeString().'","issue":"'.(string)$i.'"},';
        }
        Storage::disk('gameTime')->put('paoma.json',"{".rtrim($str,',')."}");
    }
}

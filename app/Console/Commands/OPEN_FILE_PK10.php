<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class OPEN_FILE_PK10 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'OPEN_FILE_PK10';

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
        $timeUp = date('09:02:30');
        $str = "";
        for($i=1;$i<=179;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(5);
            $str .= '"'.(string)$i.'":{"time":"'.$timeUp->toTimeString().'"},';
        }
        Storage::disk('gameTime')->put('bjpk10.json',"{".rtrim($str,',')."}");
    }
}

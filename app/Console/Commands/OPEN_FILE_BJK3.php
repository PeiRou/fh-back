<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class OPEN_FILE_BJK3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'OPEN_FILE_BJK3';

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
        $timeUp = date('09:00:00');
        $str = "";
        for($i=1;$i<=89;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(10);
            $str .= '"'.(string)$i.'":{"time":"'.$timeUp->toTimeString().'"},';
        }
        Storage::disk('gameTime')->put('bjk3.json',"{".rtrim($str,',')."}");
    }
}

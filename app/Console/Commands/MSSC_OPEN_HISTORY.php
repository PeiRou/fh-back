<?php

namespace App\Console\Commands;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MSSC_OPEN_HISTORY extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MSSC_OPEN_HISTORY';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '定时保存-秒速赛车历史记录';

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
        $beginTime = date('Y-m-d 07:30:00');
        $addOneDay = Carbon::parse(date('Y-m-d'))->addDay(1);
        $endTime = date('Y-m-d 04:00:00',strtotime($addOneDay));

        $get = DB::table('game_mssc')->where('opentime','>=',$beginTime)->where('opentime','<=',$endTime)->get();
        $data = [];
        foreach ($get as $item){
            array_push($data,[
                'gameId' => 80,
                'id' => $item->id,
                'openNum' => $item->opennum,
                'openTime' => $item->opentime,
                'issue' => $item->issue
            ]);
        }

        Storage::disk('static')->put('openHistory/mssc/80_'.date('Y-m-d').'.json',json_encode($data));
    }
}

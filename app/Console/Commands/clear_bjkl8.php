<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class clear_bjkl8 extends Command
{

    protected $signature = 'clear_bjkl8';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每日清除';

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

        $res = DB::table('game_bjkl8')->whereBetween('updated_at', ['2018-12-30 00:00:00', '2018-12-31 23:59:59'])->get();
        foreach ($res as $k =>$v){
            $len = strlen($v->opennum);
            if($len>=60)
                continue;
            $tmp = substr($v->opennum,0,59);
            DB::table('game_bjkl8')->where('id',$v->id)->update(['opennum'=>$tmp]);
        }
        return '';
    }
}

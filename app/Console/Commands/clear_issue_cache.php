<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class clear_issue_cache extends Command
{

    protected $signature = 'clear_issue_cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清除缓存';

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
        $redis = Redis::connection();
        $redis->select(0);
        $redis->flushdb();        //清除所有开奖相关redis
        if(Storage::disk('thread')->exists('thread')){
            Storage::disk('thread')->delete('thread');
        }
        return 'Ok';
    }
}

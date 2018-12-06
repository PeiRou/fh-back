<?php

namespace App\Console\Commands;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class next_open_msjsk3 extends Command
{
    protected  $code = 'msjsk3';
    protected  $gameId = 86;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_open_msjsk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速快三-定時開號';

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
        $table = 'game_msjsk3';

        $redis = Redis::connection();
        $redis->select(0);
        $redis_issue = $redis->get('msjsk3:issue');
        $redis_needopen = $redis->exists($this->code.':needopen')?$redis->get($this->code.':needopen'):'';
        $redis_next_issue = $redis->get('msjsk3:nextIssue');
        //在redis上的差距
        $redis_gapnum = $redis->get('msjsk3:gapnum');
        //在現在實際的差距
        $gapnum = $redis_next_issue-$redis_issue;

        //如果實際差距與redis上不一樣代表已經開新的一盤了，就有需要開號
        if($gapnum == $redis_gapnum && $redis_needopen=='on')
            return 'no need';

        $excel = new Excel();
        $res = $excel->getNextIssue($table);
        //如果數據庫已經查不到需要追朔的獎期，則停止追朔
        if(empty($res)){
            $redis->set($this->code.':needopen','on');
            $redis->set('msjsk3:gapnum',$gapnum);
            return 'Fail';
        }else{
            //阻止進行中
            $key = $this->code.'ing:'.$res->issue;
            if($redis->exists($key)){
                return 'ing';
            }
            $redis->setex($key,60,'ing');
            $redis->set($this->code.':needopen','');
        }
        //當期獎期
        $needOpenIssue = $res->issue;
        $openTime = $res->opentime;
        $issuenum = substr($needOpenIssue,-4);
        $res->opencode = $excel->opennum($table);

        //---kill start
        $opennum = $excel->kill_count($table,$needOpenIssue,$this->gameId,$res->opencode);
        //---kill end
        $opencode = empty($opennum)?$res->opencode:$opennum;

        try {
            if ($redis_issue !== $needOpenIssue) {
                try {
                    $up = DB::table($table)->where('issue', $needOpenIssue)
                        ->update([
                            'is_open' => 1,
                            'year' => date('Y',strtotime($openTime)),
                            'month' => date('m',strtotime($openTime)),
                            'day' => date('d',strtotime($openTime)),
                            'opennum'=> $opencode
                        ]);
                    if ($up == 1 && $needOpenIssue == ($redis_next_issue-1)) {
                        $key = 'msjsk3:issue';
                        $redis->set($key, $needOpenIssue);
                        $redis->set('msjsk3:gapnum',$gapnum);
                    }
                } catch (\Exception $exception) {
                    \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                }
            }
        } catch (\Exception $exception) {
            \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Events\RunMsssc;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Bet\Clong;

class new_msssc extends Command
{
    protected  $code    = 'msssc';
    protected  $gameId  = 81;
    protected  $clong;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_msssc {action?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新-秒速时时彩';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Clong $clong)
    {
        $this->clong = $clong;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');

        Redis::select(0); //杀-专用redis库
        Redis::setex('sha:msssc',60,$action);

        $this->go();
    }

    public function go()
    {
        $getFile    = Storage::disk('gameTime')->get('msssc.json');
        $data       = json_decode($getFile,true);
        $nowTime    = date('H:i:s');
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime) {
//            if(strtotime($value['time']) === strtotime($nowTime)){
//                return $value;
//            }
            $timeDiff = Carbon::now()->diffInSeconds(Carbon::parse($value['time']));
            if($timeDiff == 0 || $timeDiff == 1 || $timeDiff == 2 || $timeDiff == 3){
                return $value;
            }
        });
        if($filtered!=null){
            $sha = Redis::get('sha:msssc');
            if($filtered['issue'] >= 793 && $filtered['issue'] <= 985){
                $date = Carbon::parse(date('Y-m-d'))->addDays(-1);
                $params =  [
                    'issue' => date('ymd',strtotime($date)).$filtered['issue'],
                    'openTime' => date('Y-m-d ').$filtered['time'],
                    'sha' => $sha
                ];
            } else {
                $params =  [
                    'issue' => date('ymd').$filtered['issue'],
                    'openTime' => date('Y-m-d ').$filtered['time'],
                    'sha' => $sha
                ];
            }
            $res = curl(Config::get('website.openServerUrl').$this->code,$params,1);
            $res = json_decode($res);

            $nextIssue = $res->expect;
            $nextIssueEndTime = Carbon::parse($res->opentime)->addSeconds(60)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($res->opentime)->addSeconds(75)->toDateTimeString();
            Redis::set('msssc:nextIssue',(int)$nextIssue+1);
            Redis::set('msssc:nextIssueEndTime',strtotime($nextIssueEndTime));
            Redis::set('msssc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            Redis::del('sha:msssc');

            try{
                DB::table('game_msssc')->where('issue',$res->expect)->update([
                    'is_open' => 1,
                    'year'=> date('Y'),
                    'month'=> date('m'),
                    'day'=>  date('d'),
                    'opennum'=> $res->opencode
                ]);
                $this->clong->setKaijian('msssc',1,$res->opencode);
                $this->clong->setKaijian('msssc',2,$res->opencode);
            } catch (\Exception $exception){
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}

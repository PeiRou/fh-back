<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunMsssc;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class new_msqxc extends Command
{
    protected  $code    = 'msqxc';
    protected  $gameId  = 114;

    protected $signature = 'new_msqxc';
    protected $description = '新-秒速七星彩';

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
        $getFile = Storage::disk('gameTime')->get('msqxc.json');
        $data = json_decode($getFile,true);
        $nowTime    = date('H:i:s');
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime) {
            $timeDiff = Carbon::now()->diffInSeconds(Carbon::parse($value['time']));
            if($timeDiff == 0 || $timeDiff == 1 || $timeDiff == 2 || $timeDiff == 3 || $timeDiff == 4 || $timeDiff == 5){
                return $value;
            }
        });
        if($filtered!=null){
            if($filtered['issue'] >= 792 && $filtered['issue'] <= 1105){
                $date = Carbon::parse(date('Y-m-d'))->addDays(-1);
                $params =  [
                    'issue' => date('ymd',strtotime($date)).$filtered['issue'],
                    'openTime' => date('Y-m-d ').$filtered['time']
                ];
            } else {
                $params =  [
                    'issue' => date('ymd').$filtered['issue'],
                    'openTime' => date('Y-m-d ').$filtered['time']
                ];
            }
            $res = curl(Config::get('website.openServerUrl').$this->code,$params,1);
            $res = json_decode($res);
            $nextIssue = $res->expect;
            $nextIssueEndTime = Carbon::parse($res->opentime)->addSeconds(60)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($res->opentime)->addSeconds(75)->toDateTimeString();
            $New_nextIssue = $nextIssue+1;
            if(substr($New_nextIssue,-4)=='1106'){
                $dateIssue = substr($nextIssue,strlen($nextIssue)-4);
                $New_nextIssue = date("Ymd",strtotime($dateIssue)+86400).'0001';
            }
            Redis::set('msqxc:nextIssue',(int)$New_nextIssue);
            Redis::set('msqxc:nextIssueEndTime',strtotime($nextIssueEndTime));
            Redis::set('msqxc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            $table = 'game_msqxc';
            $excel = new Excel();
            $opennum = $excel->kill_count($table,$res->expect,$this->gameId,$res->opencode);
            //---kill end
            $opencode = empty($opennum)?$res->opencode:$opennum;
            try{
                DB::table('game_msqxc')->where('issue',$res->expect)->update([
                    'is_open' => 1,
                    'year'=> date('Y'),
                    'month'=> date('m'),
                    'day'=>  date('d'),
                    'opennum'=> $opencode
                ]);
            } catch (\Exception $exception){
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}

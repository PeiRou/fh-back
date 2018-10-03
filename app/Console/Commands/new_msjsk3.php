<?php

namespace App\Console\Commands;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class new_msjsk3 extends Command
{
    protected  $code = 'msjsk3';
    protected  $gameId = 86;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_msjsk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新-秒速江苏快3';

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
        $getFile    = Storage::disk('gameTime')->get('msjsk3.json');
        $data       = json_decode($getFile,true);
        $nowTime    = date('H:i:s');
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime) {
            $timeDiff = Carbon::now()->diffInSeconds(Carbon::parse($value['time']));
            if($timeDiff == 0 || $timeDiff == 1 || $timeDiff == 2 || $timeDiff == 3 || $timeDiff == 4 || $timeDiff == 5){
                return $value;
            }
        });
        if($filtered!=null){
            $params =  [
                'issue' => date('Ymd').$filtered['issue'],
                'openTime' => date('Y-m-d ').$filtered['time'],
                'shareData' => env('SHARE_OPEN_DATA')
            ];
            $res = curl(Config::get('website.openServerUrl').$this->code,$params,1);
            $res = json_decode($res);
            $nextIssue = $res->expect;
            $nextIssueEndTime = Carbon::parse($res->opentime)->addSeconds(50)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($res->opentime)->addSeconds(60)->toDateTimeString();
            $New_nextIssue = $nextIssue+1;
            if(substr($nextIssue,-4)==1441){
                $dateIssue = substr($nextIssue,strlen($nextIssue)-4);
                $New_nextIssue = date("Ymd",strtotime($dateIssue)+3600).'0001';
            }

            Redis::set('msjsk3:nextIssue',(int)$New_nextIssue);
            Redis::set('msjsk3:nextIssueEndTime',strtotime($nextIssueEndTime));
            Redis::set('msjsk3:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            
            $table = 'game_msjsk3';
            $excel = new Excel();
            //---kill start
            $opennum = $excel->kill_count($table,$res->expect,$this->gameId,$res->opencode);
            //---kill end
            $opencode = empty($opennum)?$res->opencode:$opennum;
            try{
                DB::table('game_msjsk3')->where('issue',$res->expect)->update([
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

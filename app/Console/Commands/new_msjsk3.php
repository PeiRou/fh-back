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
            if($timeDiff == 0 || $timeDiff == 1 || $timeDiff == 2 || $timeDiff == 3 || $timeDiff == 4){
                return $value;
            }
        });
        if($filtered!=null){
            $params =  [
                'issue' => date('Ymd').$filtered['issue'],
                'openTime' => date('Y-m-d ').$filtered['time']
            ];
            $res = curl(Config::get('website.openServerUrl').$this->code,$params,1);
            $res = json_decode($res);
            $nextIssue = $res->expect;
            $nextIssueEndTime = Carbon::parse($res->opentime)->addSeconds(50)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($res->opentime)->addSeconds(60)->toDateTimeString();
            Redis::set('msjsk3:nextIssue',(int)$nextIssue+1);
            Redis::set('msjsk3:nextIssueEndTime',strtotime($nextIssueEndTime));
            Redis::set('msjsk3:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            //---kill start
            $table = 'game_msjsk3';
            $killopennum = DB::table($table)->select('excel_opennum')->where('issue',$res->expect)->first();
            $opennum = isset($killopennum->excel_opennum)?$killopennum->excel_opennum:'';
            \Log::info('秒速江苏快3 获取KILL开奖'.$res->issue.'--'.$opennum);
            \Log::info('秒速江苏快3 获取origin开奖'.$res->issue.'--'.$res->opencode);
            //---kill end
            try{
                DB::table('game_msjsk3')->where('issue',$res->expect)->update([
                    'is_open' => 1,
                    'year'=> date('Y'),
                    'month'=> date('m'),
                    'day'=>  date('d'),
                    'opennum'=> $res->opencode
                ]);
            } catch (\Exception $exception){
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}

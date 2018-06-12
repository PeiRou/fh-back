<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class msft extends Command
{

    protected  $code    = 'msft';
    protected  $gameId  = '82';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'msft';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速飞艇';

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
        $getFile    = Storage::disk('gameTime')->get('msft.json');
        $data       = json_decode($getFile,true);
        $nowTime    = date('H:i:s');
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime) {
            if(strtotime($value['openTime']) === strtotime($nowTime)){
                return $value;
            }
        });
        if($filtered!=null){
            $params =  [
                'issue' => date('ymd').$filtered['issue'],
                'openTime' => date('Y-m-d ').$filtered['openTime']
            ];
            $res = curl(Config::get('website.openServerUrl').$this->code,$params,1);
            $res = json_decode($res);
            if(!DB::table('game_msft')->where('issue',$res->expect)->first()){
                try{
                    DB::table('game_msft')->insert([
                        'issue'=> $res->expect,
                        'is_open'=> 1,
                        'year'=> date('Y'),
                        'month'=> date('m'),
                        'day'=>  date('d'),
                        'opentime'=> $res->opentime,
                        'opennum'=> $res->opencode
                    ]);
                    event(new \App\Events\OpenMsscEvent($res->opencode,$res->expect,$this->gameId,$res->code));   //fire  结算
                }catch (\Exception $exception){
                    \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                }
            }
        }
    }
}

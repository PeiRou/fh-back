<?php

namespace App\Console\Commands;

//use App\Http\Proxy\SettleMssc;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class mspk10 extends Command
{
    protected  $code    = 'mssc';
    protected  $gameId  = '80';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mspk10';
//    protected $settle;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速赛车';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() //SettleMssc $settleMssc
    {
        parent::__construct();
//        $this->settle = $settleMssc;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $getFile    = Storage::disk('gameTime')->get('mspk10.json');
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
            if(!DB::table('game_mssc')->where('issue',$res->expect)->first()){
                try{
                    DB::table('game_mssc')->insert([
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

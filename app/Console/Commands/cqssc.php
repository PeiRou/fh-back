<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class cqssc extends Command
{
    protected  $code = 'cqssc';
    protected  $gameId = 1;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cqssc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '重庆时时彩';

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

        $getFile    = Storage::disk('gameTime')->get('cqssc.json');
        $data       = json_decode($getFile,true);
        $nowTime    = date('H:i');
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime) {
            if(strtotime($value['openTime']) === strtotime($nowTime)){
                return $value;
            }
        });
        if($filtered!=null){
            $params =  [
//                'issue'     => date('ymd').$filtered['issue'],
//                'openTime'  => date('Y-m-d ').$filtered['openTime'],
                'token'     => config('website.openApi.token'),
                'code'      =>  $this->code,
                'format'    => config('website.openApi.format'),
                'rows'      => config('website.openApi.rows'),
            ];
            $res = curl(config('website.openApi.url'),$params);
            $res = json_decode($res);
            if(isset($res) && !DB::table('game_cqssc')->where('issue',reset($res->data)->expect)->first()){
                try{
                    $_data = reset($res->data);
                    DB::table('game_cqssc')->insert([
                        'issue'=> $_data->expect,
                        'is_open'=> 1,
                        'year'=> date('Y'),
                        'month'=> date('m'),
                        'day'=>  date('d'),
                        'apiopentime'=> $_data->opentime,
                        'opentime'  => date('Y-m-d H:i:s',strtotime($nowTime)),
                        'opennum'   => $_data->opencode
                    ]);
                    event(new \App\Events\OpenMssscEvent($_data->opencode,$_data->expect,$this->gameId,$res->code));   //fire  结算
                }catch (\Exception $exception){
                    \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                }
            }
        }
    }
}

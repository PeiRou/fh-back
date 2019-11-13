<?php

namespace App\Console\Commands;

use App\GamesApi;
use App\User;
use Illuminate\Console\Command;
use App\Http\Controllers\GamesApi\Card\PrivodeController;
use SameClass\Model\UsersModel;

class GameApiGetBet extends Command
{
    protected $signature = 'GameApiGetBet {g_id?} {endTime?} {--clear=0} {--issue=1}';
    protected $description = '对接游戏注单定时获取';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $param = [];
        if($g_id = $this->argument('g_id'))
            $param['g_id'] = $g_id;
        if($endTime = $this->argument('endTime'))
            $param['toTime'] = strtotime($endTime);
        $param['clear'] = $this->option('clear');
        $param['issue'] = $this->option('issue');

        //------------------------------------------------------
        (new PrivodeController())->getBet($param);
        // 有些游戏需要单独拿出来
        if(!isset($param['g_id'])){
            foreach (GamesApi::bet_excludes as $v){
                (new PrivodeController())->getBet(array_merge($param, ['g_id' => $v]));
            }

            try{
                sleep(10);
                $http = new \GuzzleHttp\Client();
                $url = 'http://0.0.0.0:9500?thread=JqGetBetTime:ListenJqIssue&GamesApiArtisan=1';
                $http->request('GET',$url,['connect_timeout' => 0.1, 'timeout' => 0.1]);
            }catch (\Throwable $e){
//                writeLog('error', $e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
            }
        }
    }
}

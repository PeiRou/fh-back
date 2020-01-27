<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SameClass\Config\LotteryGames\Games;

class AgentOddsLevelAddDatas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AgentOddsLevel:AddDatas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'agent_odds_level 层层代理数据添加';

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
        $aOddsType = $this->aOddsType;
        $aOddsTypeCodeArray = array_column($aOddsType,'code');
        $aOddsTypeCodeStr = "'".implode("','", $aOddsTypeCodeArray)."'";

        $aArray=[];
        $aSql = "SELECT agent_id,type,level_id FROM agent_odds_level WHERE type in(".$aOddsTypeCodeStr.") AND game_id = 0 GROUP BY agent_id,type";
        $ares = DB::select($aSql,$aArray);

        $bSql = "SELECT agent_id,type,level_id,game_id FROM agent_odds_level WHERE type in(".$aOddsTypeCodeStr.")";
        $bres = DB::select($bSql);

        $aGamesConfig = new Games();
        $aGames = $aGamesConfig->games;
        $newGameCode = [];
//        $newGameType = [];
        $insertData = [];
        $allGameId = [];
        foreach ($aGames as $k=>$v){
            $newGameCode[]=[
              "gameCode" =>  $k,
              "gameType" =>  $v["type"],
              "gameId" =>  $v["gameId"],
            ];
            if(!in_array($v["gameId"],[90,91]))
                $allGameId[] = $v["gameId"];
//            $newGameType[$v["type"]][]=$v["gameId"];
        }

        //
        $newares=[];
        foreach ($ares as $aresk =>$aresv){
            foreach ($newGameCode as $ngck=>$ngcv){
                if($aresv->type == $ngcv["gameType"])
                    $newares[]=[
                        "agent_id" =>$aresv->agent_id,
                        "type" =>$aresv->type,
                        "level_id" =>$aresv->level_id,
                        "gameId" =>$ngcv["gameId"],
                    ];
            }
        }


        $agDataId = [];
        foreach ($bres as $brk => $brv){
            $agDataId[$brv->agent_id][]=$brv->game_id;
        }
        $arrayDiff=[];
        foreach ($agDataId as $agdk => $agdv){
            $arrayDiff[$agdk] = array_diff($allGameId,$agdv);
        }
        $diffuse=[];
        $nednum = 0;
        foreach ($arrayDiff as $ardk => $ardv){
            foreach ($ardv as $ardvk=>$ardvv){
                $diffuse[]=[
                    "agent_id"=>$ardk,
                    "game_id"=>$ardvv,
                ];
                $nednum +=1;
            }
        }


        $count = 0;
        foreach ($diffuse as $dfuk => $dfuv){
            foreach ($newares as $nark => $narv){
                if($dfuv["agent_id"] == $narv["agent_id"]  && $dfuv["game_id"] == $narv["gameId"]){
                    $insertData[] = "  INSERT INTO `agent_odds_level`(`agent_id`, `level_id`, `category_id`, `type`, `game_id`, `admin_id`, `admin_account`, `created_at`, `updated_at`) VALUES  (".$dfuv["agent_id"].", ".$narv["level_id"].", 1, '".$narv["type"]."', ".$dfuv["game_id"].", 0, '系统',now(), now()); ";
                    $count +=1;
                }
            }
        }

        try{
            foreach ($insertData as $kin => $vin){
                DB::select($vin);
            }
            $this->info('需增加 '.$nednum.' 笔，新增成功 '.$count);
        }catch (\Exception $e){
            writeLog('AgentOddsLevelAddDatas',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $e->getLine() . ' ' . $e->getMessage());
            $this->info('新增失败 ');
        }
    }

    public $aOddsType = [
        ['code' => 'k3','name' => '快3类'],
        ['code' => 'kl8','name' => '快乐8类'],
        ['code' => 'car','name' => '赛车类'],
        ['code' => 'ssc','name' => '时时彩类'],
        ['code' => 'nc','name' => '快乐十分类'],
        ['code' => 'lhc','name' => '六合彩'],
        ['code' => '11x5','name' => '11选5类'],
        ['code' => 'dd','name' => '宾果类'],
        ['code' => 'fc','name' => '福彩类'],
        ['code' => 'qxc','name' => '七星彩类'],
    ];
}

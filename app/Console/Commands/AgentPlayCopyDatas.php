<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AgentPlayCopyDatas extends Command
{
    /**
     * 此功能复制代理赔率层级中的游戏赔率
     * type => 复制模式 1:添加新彩种 2:添加新玩法
     * oldId => 被复制的彩种(或玩法)id
     * newId => 新添加的彩种(或玩法)id
     *
     * @var string
     */
    protected $signature = 'AgentPlay:CopyDatas {type?} {oldId?} {newId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'play_agent 代理赔率游戏赔率数据复制';

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
     *
     * @return mixed
     */
    public function handle()
    {
        if(empty($type = $this->argument('type')) || !in_array($type,[1,2]))
            return $this->info('请选择模式 1:添加新彩种 2:添加新玩法');
        if(empty($oldId = $this->argument('oldId'))){
            $res = $type==1?'请填写要复制的彩种id':'请填写要复制的玩法id';
            return $this->info($res);
        }
        if(empty($newId = $this->argument('newId'))){
            $res = $type==1?'请填写要添加的彩种id':'请填写要添加的玩法id';
            return $this->info($res);
        }

        if($type == 1){
            $checkNewpl =  DB::select("SELECT * FROM play_agent WHERE game_id =".$newId);
            if($checkNewpl)
                return $this->info('彩种id '.$newId.' 已经在 play_agent 添加过');
            $checkcountSql = "SELECT SUM(CASE WHEN gameId =".$oldId." THEN 1 ELSE 0 END) AS oldcount ,SUM(CASE WHEN gameId =".$newId." THEN 1 ELSE 0 END) AS newcount FROM play";
            $checkcount = DB::select($checkcountSql);
            if($checkcount[0]->oldcount != $checkcount[0]->newcount)
                return $this->info('复制的彩种 与 要添加的彩种，在paly表的总数不一致，请确认彩种类型一致再添加！');

            //根据 play 数据添加 play_agent 数据
            $noplSql = "SELECT id AS oldplId,N.newplId FROM play
                    LEFT JOIN (select id AS newplId,ucode AS newUc FROM play WHERE gameId= ".$newId.") N
                    ON play.ucode = N.newUc
                    WHERE gameId=".$oldId;
            $noplRes = DB::select($noplSql);
            $plArray = [];
            foreach ($noplRes as $noplk=>$noplv){
                if(empty($noplv))
                    return $this->info('复制的彩种 与 要添加的彩种，在paly表的数据有误，请确认彩种数据再添加！');
                $plArray[$noplv->oldplId]=$noplv->newplId;
            }

            $oldplagSql = "SELECT * FROM play_agent WHERE game_id =".$oldId;
            $oldplagRes = DB::select($oldplagSql);
            $oldplagArray = [];
            $count = 0;
            foreach ($oldplagRes as $oldplagk => $oldplagv){
                $oldplagArray[]=[
                    "odds_tag" => $oldplagv->odds_tag,
                    "game_id" => $newId,
                    "level_id" => $oldplagv->level_id,
                    "play_id" => $plArray[$oldplagv->play_id],
                    "odds" => $oldplagv->odds,
                ];
                $count +=1;
            }

            //添加 play_agent 数据
            $ncount = 0;
            foreach ($oldplagArray as $oldplagAk => $oldplagAv){
                $insertPLAGData[] = "  INSERT INTO `play_agent`(`odds_tag`, `game_id`, `level_id`, `play_id`, `odds`, `admin_id`, `admin_account`, `created_at`, `updated_at`) VALUES ('".$oldplagAv["odds_tag"]."', '".$oldplagAv["game_id"]."','".$oldplagAv["level_id"]."', '".$oldplagAv["play_id"]."', '".$oldplagAv["odds"]."','0','系统',now(),now()); ";
                $ncount +=1;
            }
            try{
                foreach ($insertPLAGData as $kin => $vin){
                    DB::select($vin);
                }
                $this->info('play_agent 需添加 '.$count.' 笔，已新增成功 '.$ncount.' 笔');
            }catch (\Exception $e){
                writeLog('AgentPlayCopyDatas',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $e->getLine() . ' ' . $e->getMessage());
                $this->info('处理 添加 play_agent 数据 失败 ');
            }
        }else{
            $checkNewpl =  DB::select("SELECT * FROM play_agent WHERE play_id =".$newId);
            if($checkNewpl)
                return $this->info('玩法id '.$newId.' 已经在 play_agent 添加过');
            $getGameIdSql = "select gameId as oldGameId ,(select gameId from play where id=".$newId.") as newGameId from play where id=".$oldId;
            $getGameId = DB::select($getGameIdSql);
            $checkcountSql = "SELECT SUM(CASE WHEN gameId =".$getGameId[0]->oldGameId." THEN 1 ELSE 0 END) AS oldcount ,SUM(CASE WHEN gameId =".$getGameId[0]->newGameId." THEN 1 ELSE 0 END) AS newcount FROM play";
            $checkcount = DB::select($checkcountSql);
            if($checkcount[0]->oldcount != $checkcount[0]->newcount)
                return $this->info('复制的玩法 与 要添加的玩法，在paly表的总数不一致，请确认玩法类型一致再添加！');

            //根据 play 数据添加 play_agent 数据
            $noplSql = "SELECT id AS oldplId,N.newplId FROM play
                    LEFT JOIN (select id AS newplId,ucode AS newUc FROM play WHERE gameId= ".$getGameId[0]->newGameId.") N
                    ON play.ucode = N.newUc
                    WHERE gameId=".$getGameId[0]->oldGameId;
            $noplRes = DB::select($noplSql);
            $plArray = [];
            foreach ($noplRes as $noplk=>$noplv){
                $plArray[$noplv->oldplId]=$noplv->newplId;
            }
            $oldplagSql = "SELECT * FROM play_agent WHERE play_id =".$oldId;
            $oldplagRes = DB::select($oldplagSql);
            $oldplagArray = [];
            $count = 0;
            foreach ($oldplagRes as $oldplagk => $oldplagv){
                $oldplagArray[]=[
                    "odds_tag" => $oldplagv->odds_tag,
                    "game_id" => $getGameId[0]->newGameId,
                    "level_id" => $oldplagv->level_id,
                    "play_id" => $plArray[$oldplagv->play_id],
                    "odds" => $oldplagv->odds,
                ];
                $count +=1;
            }

            //添加 play_agent 数据
            $ncount = 0;
            foreach ($oldplagArray as $oldplagAk => $oldplagAv){
                $insertPLAGData[] = "  INSERT INTO `play_agent`(`odds_tag`, `game_id`, `level_id`, `play_id`, `odds`, `admin_id`, `admin_account`, `created_at`, `updated_at`) VALUES ('".$oldplagAv["odds_tag"]."', '".$oldplagAv["game_id"]."','".$oldplagAv["level_id"]."', '".$oldplagAv["play_id"]."', '".$oldplagAv["odds"]."','0','系统',now(),now()); ";
                $ncount +=1;
            }
            try{
                foreach ($insertPLAGData as $kin => $vin){
                    DB::select($vin);
                }
                $this->info('play_agent 需添加 '.$count.' 笔，已新增成功 '.$ncount.' 笔');
            }catch (\Exception $e){
                writeLog('AgentPlayCopyDatas',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $e->getLine() . ' ' . $e->getMessage());
                $this->info('处理 添加 play_agent 数据 失败 ');
            }
       }
       $this->info('处理完毕!');
       return true;
    }
}

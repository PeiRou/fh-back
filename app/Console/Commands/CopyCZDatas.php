<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CopyCZDatas extends Command
{
    /**
     * 此功能复制彩种 paly_cate & play
     * oldId => 被复制的彩种id
     * newId => 新添加的彩种id
     *
     * @var string
     */
    protected $signature = 'CopyCZDatas:run {oldId?} {newId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '复制彩种 paly_cate & play Data';

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
        if(empty($oldId = $this->argument('oldId')))
            return $this->info('请填写要复制的彩种id');
        if(empty($newId = $this->argument('newId')))
            return $this->info('请填写要添加的彩种id');

        $checkNewpc =  DB::select("SELECT * FROM play_cate WHERE gameId =".$newId);
        if($checkNewpc){    //确认 play_cate 是否已经添加新彩种
            $this->info('彩种id '.$newId.' 已经在 play_cate 添加过');
        }else{
            $oldpcSql = "SELECT * FROM play_cate WHERE gameId =".$oldId;
            $oldpcRes = DB::select($oldpcSql);

            $count = 0;
            $oldpcArray = [];
            foreach ($oldpcRes as $k=>$v){
                $oldpcArray[]=[
                    "name" => $v->name,
                    "gameId" => $newId,
                    "code" => $v->code,
                    "ucode" => $v->ucode,
                    "isShow" => $v->isShow,
                    "isBan" => $v->isBan,
                ];
                $count +=1;
            }

            //判断id位数是否超出
            $yid = "";
            $nid = "";
            $statement = DB::select("SHOW TABLE STATUS LIKE 'play_cate'");
            $nextId = $statement[0]->Auto_increment;
            if(strlen($nextId) != strlen($nextId+$count)){
                $nid = 1;
                for ($x = 1; $x <= (strlen($nextId+$count)-1); $x++){
                    $nid *= 10;
                }
            }
            $maxpcidSql = "SELECT MAX(id) AS maxid FROM play_cate ";
            $maxpcidRes = DB::select($maxpcidSql);
            if(strlen($maxpcidRes[0]->maxid) != strlen($maxpcidRes[0]->maxid+$count)){
                $yid = 1;
                for ($x = 1; $x <= (strlen($maxpcidRes[0]->maxid+$count)-1); $x++){
                    $yid *= 10;
                }
            }
            if(empty($nid) && empty($yid))
                $id = $maxpcidRes[0]->maxid;
            else if(($nextId == $maxpcidRes[0]->maxid+1) && !empty($nid))
                $id = $yid;
            else if(!empty($nid) && empty($yid))
                $id = $maxpcidRes[0]->maxid;
            else if(empty($nid) && !empty($yid))
                $id = $yid;

            //添加 play_cate 数据
            $ncount = 0;
            foreach ($oldpcArray as $oldpck => $oldpcv){
                $id +=1;
                $insertPCData[] = "  INSERT INTO `play_cate`(`id`,`name`, `gameId`, `code`,  `ucode`, `isShow`, `isBan`) VALUES ('".$id."','".$oldpcv["name"]."','".$oldpcv["gameId"]."','".$oldpcv["code"]."', '".$oldpcv["ucode"]."', '".$oldpcv["isShow"]."', '".$oldpcv["isBan"]."'); ";
                $ncount +=1;
            }

            try{
                foreach ($insertPCData as $kin => $vin){
                    DB::select($vin);
                }
                $this->info('play_cate 需添加 '.$count.' 笔，已新增成功 '.$ncount.' 笔');
            }catch (\Exception $e){
                writeLog('CopyCZDatas',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $e->getLine() . ' ' . $e->getMessage());
                $this->info('处理 添加 play_cate 数据 失败 ');
            }
        }

        unset($ncount);
        unset($count);

        $checkNewpl =  DB::select("SELECT * FROM play WHERE gameId =".$newId);
        if($checkNewpl){
            $this->info('彩种id '.$newId.' 已经在 play 添加过');
        }else{
            //根据 play_cate 数据添加 play 数据
            $nopcSql = "SELECT id AS oldId,N.newId FROM play_cate
                    LEFT JOIN (select id AS newId,ucode AS newUc FROM play_cate WHERE gameId= ".$newId.") N
                    ON play_cate.ucode = N.newUc
                    WHERE gameId=".$oldId;
            $nopcRes = DB::select($nopcSql);
            $pcArray = [];
            foreach ($nopcRes as $nopck=>$nopcv){
                $pcArray[$nopcv->oldId]=$nopcv->newId;
            }

            $oldplSql = "SELECT * FROM play WHERE gameId=".$oldId;
            $oldplRes = DB::select($oldplSql);
            $oldplArray = [];
            $count = 0;
            foreach ($oldplRes as $oldplk => $oldplv){
                $min_tag_tmp = explode('_',$oldplv->min_tag);
                $min_tag_tmp[0] = "GAME".$newId;
                $max_tag_tmp = explode('_',$oldplv->max_tag);
                $max_tag_tmp[0] = "GAME".$newId;
                $turnMax_tag_tmp = explode('_',$oldplv->turnMax_tag);
                $turnMax_tag_tmp[0] = "GAME".$newId;
                $oldplArray[]=[
                    "name" => $oldplv->name,
                    "alias" => $oldplv->alias,
                    "odds_tag" => $oldplv->odds_tag,
                    "rebate_tag" => $oldplv->rebate_tag,
                    "min_tag" => implode("_",$min_tag_tmp),
                    "max_tag" => implode("_",$max_tag_tmp),
                    "turnMax_tag" => implode("_",$turnMax_tag_tmp),
                    "code" => $oldplv->code,
                    "ucode" => $oldplv->ucode,
                    "gameId" => $newId,
                    "playCateId" => $pcArray[$oldplv->playCateId],
                    "odds" => $oldplv->odds,
                    "rebate" => $oldplv->rebate,
                    "minMoney" => $oldplv->minMoney,
                    "maxMoney" => $oldplv->maxMoney,
                    "maxTurnMoney" => $oldplv->maxTurnMoney,
                    "molecule" => $oldplv->molecule,
                    "denominator" => $oldplv->denominator,
                ];
                $count +=1;
            }

            //判断id位数是否超出
            $yid = "";
            $nid = "";
            $statement = DB::select("SHOW TABLE STATUS LIKE 'play'");
            $nextId = $statement[0]->Auto_increment;
            if(strlen($nextId) != strlen($nextId+$count)){
                $nid = 1;
                for ($x = 1; $x <= (strlen($nextId+$count)-1); $x++){
                    $nid *= 10;
                }
            }
            $maxpcidSql = "SELECT MAX(id) AS maxid FROM play ";
            $maxpcidRes = DB::select($maxpcidSql);
            if(strlen($maxpcidRes[0]->maxid) != strlen($maxpcidRes[0]->maxid+$count)){
                $yid = 1;
                for ($x = 1; $x <= (strlen($maxpcidRes[0]->maxid+$count)-1); $x++){
                    $yid *= 10;
                }
            }
            if(empty($nid) && empty($yid))
                $id = $maxpcidRes[0]->maxid;
            else if(($nextId == $maxpcidRes[0]->maxid+1) && !empty($nid))
                $id = $yid;
            else if(!empty($nid) && empty($yid))
                $id = $maxpcidRes[0]->maxid;
            else if(empty($nid) && !empty($yid))
                $id = $yid;

            //添加 play 数据
            $ncount = 0;
            foreach ($oldplArray as $oldplk => $oldplv){
                $id +=1;
                $insertPLData[] = "  INSERT INTO `play`(`id`,`name`, `alias`, `odds_tag`, `rebate_tag`, `min_tag`, `max_tag`, `turnMax_tag`, `code`, `ucode`, `gameId`, `playCateId`, `odds`, `rebate`, `minMoney`, `maxMoney`, `maxTurnMoney`, `molecule`, `denominator`) VALUES (".$id.",'".$oldplv["name"]."', '".$oldplv["alias"]."','".$oldplv["odds_tag"]."', '".$oldplv["rebate_tag"]."', '".$oldplv["min_tag"]."','".$oldplv["max_tag"]."','".$oldplv["turnMax_tag"]."','".$oldplv["code"]."','".$oldplv["ucode"]."','".$oldplv["gameId"]."','".$oldplv["playCateId"]."','".$oldplv["odds"]."','".$oldplv["rebate"]."','".$oldplv["minMoney"]."','".$oldplv["maxMoney"]."','".$oldplv["maxTurnMoney"]."','".$oldplv["molecule"]."','".$oldplv["denominator"]."'); ";
                $ncount +=1;
            }
            try{
                foreach ($insertPLData as $kin => $vin){
                    DB::select($vin);
                }
                $this->info('play 需添加 '.$count.' 笔，已新增成功 '.$ncount.' 笔');
            }catch (\Exception $e){
                writeLog('CopyCZDatas',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $e->getLine() . ' ' . $e->getMessage());
                $this->info('处理 添加 play 数据 失败 ');
            }
        }
        $this->info('处理完毕!');
        return true;
    }
}

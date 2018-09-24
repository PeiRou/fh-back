<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/4/4
 * Time: 下午11:57
 */

namespace App\Http\Controllers\Bet;


use App\Bets;
use App\Excel;
use Illuminate\Support\Facades\DB;

class New_Msssc
{
    private function exc_play($openCode,$gameId){
        $win = collect([]);
        $this->NUM1($openCode,$gameId,$win);
        $this->NUM2($openCode,$gameId,$win);
        $this->NUM3($openCode,$gameId,$win);
        $this->NUM4($openCode,$gameId,$win);
        $this->NUM5($openCode,$gameId,$win);
        $this->NUM1_DXDS($openCode,$gameId,$win);
        $this->NUM2_DXDS($openCode,$gameId,$win);
        $this->NUM3_DXDS($openCode,$gameId,$win);
        $this->NUM4_DXDS($openCode,$gameId,$win);
        $this->NUM5_DXDS($openCode,$gameId,$win);
        $this->ZHDXDS($openCode,$gameId,$win);
        $this->QIANSAN($openCode,$gameId,$win);
        $this->ZHONGSAN($openCode,$gameId,$win);
        $this->HOUSAN($openCode,$gameId,$win);
        return $win; 
    }
    public function all($openCode,$issue,$gameId,$id,$excel)
    {
        $table = 'game_msssc';
        $gameName = '秒速时时彩';
        $betCount = DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $excelModel = new Excel();
            $exeIssue = $excelModel->getNeedKillIssue($table,2);
            $exeBase = $excelModel->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    \Log::Info('msssc killing...');
                    $this->excel($openCode, $exeBase, $issue, $gameId, $table);
                }
            }
            if(!$excel){
                $win = $this->exc_play($openCode,$gameId);
                $bunko = $this->bunko($win,$gameId,$issue,$excel);
                $excelModel->bet_total($issue,$gameId);
                if($bunko == 1){
                    $updateUserMoney = $excelModel->updateUserMoney($gameId,$issue,$gameName);
                    if($updateUserMoney == 1){
                        \Log::info($gameName . $issue . "结算出错");
                    }
                }
            }
        }
        if($excel){
            $update = DB::table($table)->where('id',$id)->update([
                'excel_num' => 1
            ]);
            if ($update !== 1) {
                \Log::info($gameName . $issue . "杀率not Finshed");
            }
        }else{
            $update = DB::table($table)->where('id',$id)->update([
                'bunko' => 1
            ]);
            if ($update !== 1) {
                \Log::info($gameName . $issue . "结算not Finshed");
            }
        }
    }

    private function excel($openCode,$exeBase,$issue,$gameId,$table = ''){
        if(empty($table))
            return false;
        for($i=0;$i< (int)$exeBase->excel_num;$i++){
            if($i==0){
                $exeBet = DB::table('excel_bet')->where('issue','=',$issue)->where('game_id',$gameId)->first();
                if(empty($exeBet))
                    DB::connection('mysql::write')->select("INSERT INTO excel_bet  SELECT * FROM bet WHERE bet.issue = '{$issue}' and bet.game_id = '{$gameId}' and bet.testFlag = 0");
            }else{
                $excel = new Excel();
                $openCode = $excel->opennum($table);
                DB::connection('mysql::write')->table("excel_bet")->where('issue',$issue)->where('game_id',$gameId)->update(["bunko"=>0]);
            }
            $win = $this->exc_play($openCode,$gameId);
            $bunko = $this->bunko($win,$gameId,$issue,true);
            if($bunko == 1){
                $tmp = DB::connection('mysql::write')->select("SELECT sum(case when bunko >0 then bunko-bet_money else bunko end) as sumBunko FROM excel_bet WHERE issue = '{$issue}' and game_id = '{$gameId}'");
                foreach ($tmp as&$value)
                    $excBunko = $value->sumBunko;
                \Log::info('秒速时时彩 :'.$excBunko);
                $dataExcGame['game_id'] = $gameId;
                $dataExcGame['issue'] = $issue;
                $dataExcGame['opennum'] = $openCode;
                $dataExcGame['bunko'] = $excBunko;
                $dataExcGame['excel_num'] = $i;
                $dataExcGame['excel_num']++;
                $dataExcGame['created_at'] = date('Y-m-d H:i:s');
                $dataExcGame['updated_at'] = date('Y-m-d H:i:s');
                DB::table('excel_game')->insert([$dataExcGame]);
            }
        }
        $aSql = "SELECT opennum FROM excel_game WHERE bunko = (SELECT min(bunko) FROM excel_game WHERE game_id = ".$gameId." AND issue ='{$issue}') and game_id = ".$gameId." AND issue ='{$issue}' LIMIT 1";
        $tmp = DB::select($aSql);
        foreach ($tmp as&$value)
            $openCode = $value->opennum;
        \Log::Info($table.':'.$openCode);
        DB::table($table)->where('issue',$issue)->update(["excel_opennum"=>$openCode]);
        DB::table("excel_bet")->where('issue',$issue)->where('game_id',$gameId)->delete();
        DB::table("excel_game")->where('created_at','<=',date('Y-m-d H:i:s',time()-600))->where('game_id',$gameId)->delete();
    }

    private function QIANSAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 129;
        $zaliu = 0;
        $num1 = $arrOpenCode[0];
        $num2 = $arrOpenCode[1];
        $num3 = $arrOpenCode[2];
        $num4 = $arrOpenCode[3];
        $num5 = $arrOpenCode[4];
        if($num1 == $num2 && $num2 == $num3){ //豹子
            $zaliu = 1;
            $playId = 2411;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$num1,$num2,$num3];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 2412;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 2412;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 2412;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 2414;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = 2413;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = 2414;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = 2414;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = 2414;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = 2414;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = 2414;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = 2414;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = 2415;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function ZHONGSAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 130;
        $zaliu = 0;
        $num1 = $arrOpenCode[1];
        $num2 = $arrOpenCode[2];
        $num3 = $arrOpenCode[3];
        if($num1 == $num2 && $num2 == $num3){ //豹子
            $zaliu = 1;
            $playId = 2416;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$num1,$num2,$num3];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 2417;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 2417;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 2417;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 2419;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = 2418;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = 2419;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = 2419;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = 2419;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = 2419;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = 2419;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = 2419;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = 2420;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function HOUSAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 131;
        $zaliu = 0;
        $num1 = $arrOpenCode[2];
        $num2 = $arrOpenCode[3];
        $num3 = $arrOpenCode[4];
        if($num1 == $num2 && $num2 == $num3){ //豹子
            $zaliu = 1;
            $playId = 2421;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$num1,$num2,$num3];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 2422;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 2422;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 2422;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 2424;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = 2423;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = 2424;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = 2424;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = 2424;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = 2424;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = 2424;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = 2424;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = 2425;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function ZHDXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 123;
        $num1 = $arrOpenCode[0];
        $num2 = $arrOpenCode[1];
        $num3 = $arrOpenCode[2];
        $num4 = $arrOpenCode[3];
        $num5 = $arrOpenCode[4];
        $num_total = $num1+$num2+$num3+$num4+$num5;
        if($num_total >= 23){ //总和大
            $playId = 2334;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num_total <= 22){ //总和小
            $playId = 2335;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num_total%2 == 0){ //总和双
            $playId = 2337;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //总和单
            $playId = 2336;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num1 > $num5){ //龙
            $playId = 2338;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = 2339;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num1 == $num5) { //和
            $playId = 2340;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM1_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 124;
        $num = $arrOpenCode[0];
        //大小
        if($num >= 5){
            $playId = 2351;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 2352;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 2354;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2353;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM2_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 125;
        $num = $arrOpenCode[1];
        //大小
        if($num >= 5){
            $playId = 2365;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 2366;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 2368;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2367;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM3_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 126;
        $num = $arrOpenCode[2];
        //大小
        if($num >= 5){
            $playId = 2379;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 2380;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 2382;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2381;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM4_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 127;
        $num = $arrOpenCode[3];
        //大小
        if($num >= 5){
            $playId = 2393;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 2394;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 2396;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2395;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM5_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 128;
        $num = $arrOpenCode[4];
        //大小
        if($num >= 5){
            $playId = 2407;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 2408;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 2410;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2409;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM1($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 124;
        $num = $arrOpenCode[0];
        switch ($num){
            case 0:
                $play_id = 2341;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 2342;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 2343;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 2344;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 2345;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 2346;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 2347;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 2348;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 2349;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 2350;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function NUM2($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 125;
        $num = $arrOpenCode[1];
        switch ($num){
            case 0:
                $play_id = 2355;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 2356;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 2357;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 2358;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 2359;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 2360;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 2361;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 2362;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 2363;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 2364;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function NUM3($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 126;
        $num = $arrOpenCode[2];
        switch ($num){
            case 0:
                $play_id = 2369;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 2370;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 2371;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 2372;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 2373;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 2374;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 2375;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 2376;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 2377;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 2378;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function NUM4($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 127;
        $num = $arrOpenCode[3];
        switch ($num){
            case 0:
                $play_id = 2383;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 2384;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 2385;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 2386;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 2387;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 2388;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 2389;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 2390;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 2391;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 2392;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function NUM5($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 128;
        $num = $arrOpenCode[4];
        switch ($num){
            case 0:
                $play_id = 2397;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 2398;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 2399;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 2400;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 2401;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 2402;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 2403;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 2404;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 2405;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 2406;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function bunko($win,$gameId,$issue,$excel=false){
        if($excel) {
            $table = 'excel_bet';
            $getUserBets = DB::connection('mysql::write')->table('excel_bet')->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        }else{
            $table = 'bet';
            $getUserBets = Bets::where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        }
        $id = [];
        foreach ($win as $k=>$v){
            $id[] = $v;
        }
        if($getUserBets){
            $sql = "UPDATE ".$table." SET bunko = CASE ";
            $sql_lose = "UPDATE ".$table." SET bunko = CASE ";
            $ids = implode(',', $id);
            if($ids && isset($ids)){
                foreach ($getUserBets as $item){
                    $bunko = $item->bet_money * $item->play_odds;
                    $bunko_lose = 0-$item->bet_money;
                    $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                    $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
                }
                $sql .= "END WHERE `play_id` IN ($ids) AND `issue` = $issue AND `game_id` = $gameId";
                $sql_lose .= "END WHERE `play_id` NOT IN ($ids) AND `issue` = $issue AND `game_id` = $gameId";
                if(!isset($bunko) || empty($bunko))
                    return 0;
                $run = DB::statement($sql);
                if($run == 1){
                    $run2 = DB::statement($sql_lose);
                    if($run2 == 1){
                        return 1;
                    }
                }
            }
        }
    }
}
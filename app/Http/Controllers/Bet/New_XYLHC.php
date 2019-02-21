<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/7/14
 * Time: 下午4:57
 */

namespace App\Http\Controllers\Bet;

use App\Bets;
use App\Excel;
use App\Helpers\LHC_SX;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_XYLHC
{
    protected $LHC_SX;

    /**
     * New_LHC constructor.
     * @param $LHC_SX
     */
    public function __construct(LHC_SX $LHC_SX)
    {
        $this->LHC_SX = $LHC_SX;
    }
    private function exc_play($openCode,$gameId){
        $win = collect([]);
        $ids_he = collect([]);
        $this->TM($openCode,$gameId,$win);
        $this->LM($openCode,$gameId,$win,$ids_he);
        $this->SB($openCode,$gameId,$win);
        $this->TX($openCode,$gameId,$win);
        $this->TMTWS($openCode,$gameId,$win);
        $this->ZM($openCode,$gameId,$win);
        $this->WX($openCode,$gameId,$win);
        $this->QSB($openCode,$gameId,$win,$ids_he);
        $this->PTYXWS($openCode,$gameId,$win);
        $this->ZONGXIAO($openCode,$gameId,$win);
        $this->ZMT($openCode,$gameId,$win);
        return array('win'=>$win,'ids_he'=>$ids_he);
    }

    public function all($openCode,$issue,$gameId,$id,$excel)
    {
        $table = 'game_xylhc';
        $gameName = '幸运六合彩';
        $betCount = DB::connection('mysql::write')->table('bet')->where('issue',$issue)->where('game_id',$gameId)->where('bunko','=',0.00)->count();

        if($betCount > 0){
            $excelModel = new Excel();
            $exeIssue = $excelModel->getNeedKillIssue($table,2);
            $exeBase = $excelModel->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                writeLog('New_Bet', 'excel_num:'.$update);
                if($update == 1) {
                    writeLog('New_Bet', 'xylhc killing...');
                    $this->excel($openCode, $exeBase, $issue, $gameId, $table);
                }
            }
            if(!$excel){
                $resData = $this->exc_play($openCode,$gameId);
                $win = @$resData['win'];
                $he = isset($resData['ids_he'])?$resData['ids_he']:array();
                try {
                    $bunko = $this->BUNKO($openCode, $win, $gameId, $issue, $he, $excel);
                }catch (\exception $exception){
                    writeLog('New_Bet', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                    DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->update(['bunko' => 0]);
                }
                $excelModel->bet_total($issue,$gameId);
                if(isset($bunko) && $bunko == 1){
                    $updateUserMoney = $excelModel->updateUserMoney($gameId,$issue,$gameName);
                    if($updateUserMoney == 1){
                        writeLog('New_Bet', $gameName . $issue . "结算出错");
                    }
                }
            }
        }
        if($excel){
            $update = DB::table($table)->where('id',$id)->whereIn('excel_num',[2,3])->update([
                'excel_num' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Bet', $gameName . $issue . "杀率not Finshed");
            }
        }else{
            $update = DB::table($table)->where('id',$id)->update([
                'bunko' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Bet', $gameName . $issue . "结算not Finshed");
            }else{
                $agentJob = new AgentBackwaterJob($gameId,$issue);
                $agentJob->addQueue();
            }
        }
    }

    private function excel($openCode,$exeBase,$issue,$gameId,$table = ''){
        if(empty($table))
            return false;
        $excel = new Excel();
        for($i=1;$i<= (int)$exeBase->excel_num;$i++){
            $openCode = $excel->opennum($table,$exeBase->is_user,$issue,$i);
            if($i==1){
                $exeBet = DB::table('excel_bet')->where('issue','=',$issue)->where('game_id',$gameId)->first();
                if(empty($exeBet))
                    DB::connection('mysql::write')->select("INSERT INTO excel_bet  SELECT * FROM bet WHERE bet.issue = '{$issue}' and bet.game_id = '{$gameId}' and bet.testFlag = 0");
            }else{
                DB::connection('mysql::write')->table("excel_bet")->where('issue',$issue)->where('game_id',$gameId)->update(["bunko"=>0]);
            }
            $win = $this->exc_play($openCode,$gameId);
            $bunko = $excel->bunko($win,$gameId,$issue,true);
            if($bunko == 1){
                $tmp = DB::connection('mysql::write')->select("SELECT sum(bunko) as sumBunko FROM excel_bet WHERE issue = '{$issue}' and game_id = '{$gameId}'");
                foreach ($tmp as&$value)
                    $excBunko = $value->sumBunko;
                writeLog('New_Bet', $table.' :'.$openCode.' => '.$excBunko);
                $dataExcGame['game_id'] = $gameId;
                $dataExcGame['issue'] = $issue;
                $dataExcGame['opennum'] = $openCode;
                $dataExcGame['bunko'] = $excBunko;
                $dataExcGame['excel_num'] = $i;
                $dataExcGame['created_at'] = date('Y-m-d H:i:s');
                $dataExcGame['updated_at'] = date('Y-m-d H:i:s');
                DB::table('excel_game')->insert([$dataExcGame]);
                if($exeBase->is_user==0)
                    $excel->setKillIssueNum($table,$issue,$dataExcGame['excel_num'],$openCode,$excBunko);
            }
        }
        $aSql = "SELECT opennum FROM excel_game WHERE bunko = (SELECT min(bunko) FROM excel_game WHERE game_id = ".$gameId." AND issue ='{$issue}') and game_id = ".$gameId." AND issue ='{$issue}' LIMIT 1";
        $tmp = DB::select($aSql);
        foreach ($tmp as&$value)
            $openCode = $value->opennum;
        writeLog('New_Bet', $table.' :'.$openCode);
        DB::table($table)->where('issue',$issue)->update(["excel_opennum"=>$openCode]);
        DB::table("excel_bet")->where('issue',$issue)->where('game_id',$gameId)->delete();
        DB::table("excel_game")->where('created_at','<=',date('Y-m-d H:i:s',time()-600))->where('game_id',$gameId)->delete();
    }

    //特码A-B
    public function TM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tm_playCate = 162; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        switch ($tm){
            case 1:
                $playId_B = 3516;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3467;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 2:
                $playId_B = 3517;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3468;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 3:
                $playId_B = 3518;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3469;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 4:
                $playId_B = 3519;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3470;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 5:
                $playId_B = 3520;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3471;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 6:
                $playId_B = 3521;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3472;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 7:
                $playId_B = 3522;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3473;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 8:
                $playId_B = 3523;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3474;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 9:
                $playId_B = 3524;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3475;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 10:
                $playId_B = 3525;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3476;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 11:
                $playId_B = 3526;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3477;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 12:
                $playId_B = 3527;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3478;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 13:
                $playId_B = 3528;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3479;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 14:
                $playId_B = 3529;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3480;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 15:
                $playId_B = 3530;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3481;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 16:
                $playId_B = 3531;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3482;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 17:
                $playId_B = 3532;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3483;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 18:
                $playId_B = 3533;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3484;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 19:
                $playId_B = 3534;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3485;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 20:
                $playId_B = 3535;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3486;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 21:
                $playId_B = 3536;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3487;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 22:
                $playId_B = 3537;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3488;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 23:
                $playId_B = 3538;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3489;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 24:
                $playId_B = 3539;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3490;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 25:
                $playId_B = 3540;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3491;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 26:
                $playId_B = 3541;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3492;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 27:
                $playId_B = 3542;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3493;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 28:
                $playId_B = 3543;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3494;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 29:
                $playId_B = 3544;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3495;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 30:
                $playId_B = 3545;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3496;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 31:
                $playId_B = 3546;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3497;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 32:
                $playId_B = 3547;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3498;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 33:
                $playId_B = 3548;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3499;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 34:
                $playId_B = 3549;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3500;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 35:
                $playId_B = 3550;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3501;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 36:
                $playId_B = 3551;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3502;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 37:
                $playId_B = 3552;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3503;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 38:
                $playId_B = 3553;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3504;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 39:
                $playId_B = 3554;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3505;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 40:
                $playId_B = 3555;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3506;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 41:
                $playId_B = 3556;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3507;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 42:
                $playId_B = 3557;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3508;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 43:
                $playId_B = 3558;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3509;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 44:
                $playId_B = 3559;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3510;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 45:
                $playId_B = 3560;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3511;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 46:
                $playId_B = 3561;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3512;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 47:
                $playId_B = 3562;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3513;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 48:
                $playId_B = 3563;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3514;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 49:
                $playId_B = 3564;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3515;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
        }
    }

    //两面
    public function LM($openCode,$gameId,$win,$ids_he)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $lm_playCate = 163; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        $ZH = (int)$arrOpenCode[0]+(int)$arrOpenCode[1]+(int)$arrOpenCode[2]+(int)$arrOpenCode[3]+(int)$arrOpenCode[4]+(int)$arrOpenCode[5]+(int)$arrOpenCode[6];
        //特码大小
        if($tm >= 25 && $tm <= 48){ //大
            $playId = 3565;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
            if($tm%2 == 0){ //特大双
                $playId = 3576;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            } else { //特大单
                $playId = 3575;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
        }else if($tm <= 24){
            $playId = 3566;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
            if($tm%2 == 0){ //特小双
                $playId = 3578;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            } else { //特小单
                $playId = 3577;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
        }else{  //和局退本金
            $playId = 3565;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 3566;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //特码单双
        if($tm%2 == 0){ // 双
            $playId = 3568;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($tm%2 != 0 && $tm != 49){
            $playId = 3567;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 3567;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 3568;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //特码合数大小
        $tmBL = str_pad($tm,2,"0",STR_PAD_LEFT); //十位补零
        $chaiTM = str_split($tmBL); //拆分个位 十位
        $TMHS = (int)$chaiTM[0]+(int)$chaiTM[1];
        if($TMHS >= 7 && $tmBL != 49){ //特合大
            $playId = 3569;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($TMHS <= 6 && $tmBL != 49){ //特合小
            $playId = 3570;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 3569;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 3570;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        if($TMHS%2 == 0){ // 双
            $playId = 3572;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($TMHS%2 != 0 && $tmBL != 49){
            $playId = 3571;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 3571;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 3572;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //特天肖 地肖
        $TTX = $this->LHC_SX->shengxiao($tm);
        if($TTX == '兔' || $TTX == '马' || $TTX == '猴' || $TTX == '猪' || $TTX == '牛' || $TTX == '龙'){ //天肖
            $playId = 3579;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TTX == '蛇' || $TTX == '羊' || $TTX == '鸡' || $TTX == '狗' || $TTX == '鼠' || $TTX == '虎'){ //地肖
            $playId = 3580;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特前肖 后肖
        $TQH = $this->LHC_SX->shengxiao($tm);
        if($TQH == '鼠' || $TQH == '牛' || $TQH == '虎' || $TQH == '兔' || $TQH == '龙' || $TQH == '蛇'){ //前肖
            $playId = 3581;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TQH == '马' || $TQH == '羊' || $TQH == '猴' || $TQH == '鸡' || $TQH == '狗' || $TQH == '猪'){ //后肖
            $playId = 3582;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特家肖 野肖
        $TJX = $this->LHC_SX->shengxiao($tm);
        if($TJX == '牛' || $TJX == '马' || $TJX == '羊' || $TJX == '鸡' || $TJX == '狗' || $TJX == '猪'){ //家肖
            $playId = 3583;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TJX == '鼠' || $TJX == '虎' || $TJX == '兔' || $TJX == '龙' || $TJX == '蛇' || $TJX == '猴'){ //野肖
            $playId = 3584;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特尾大 特尾小
        $TW = $chaiTM[1];
        if($TW >= 5 && $tmBL != 49){ //尾大
            $playId = 3573;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($TW <= 4 && $tmBL != 49){
            $playId = 3574;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 3573;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 3574;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //总和大小
        if($ZH >= 175){ //大
            $playId = 3587;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        } else { //小
            $playId = 3588;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //总和单双
        if($ZH%2 == 0){ //双
            $playId = 3586;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 3585;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
    }

    //色波
    public function SB($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $sb_playCate = 164; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        //色波
        if($tm == 1 || $tm == 2 || $tm == 7 || $tm == 8 || $tm == 12 || $tm == 13 || $tm == 18 || $tm == 19 || $tm == 23 || $tm == 24 || $tm == 29 || $tm == 30 || $tm == 34 || $tm == 35 || $tm == 40 || $tm == 45 || $tm == 46){ //红波
            $playId = 3589;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //红双
                $playId = 3593;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //红单
                $playId = 3592;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //红大
                $playId = 3594;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //红大双
                    $playId = 3605;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 红大单
                    $playId = 3604;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //红小
                $playId = 3595;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //红小双
                    $playId = 3607;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 红小单
                    $playId = 3606;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if($tm == 3 || $tm == 4 || $tm == 9 || $tm == 10 || $tm == 14 || $tm == 15 || $tm == 20 || $tm == 25 || $tm == 26 || $tm == 31 || $tm == 36 || $tm == 37 || $tm == 41 || $tm == 42 || $tm == 47 || $tm == 48){ //蓝波
            $playId = 3590;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //蓝双
                $playId = 3597;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //蓝单
                $playId = 3596;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //蓝大
                $playId = 3598;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //蓝大双
                    $playId = 3609;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 蓝大单
                    $playId = 3608;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //蓝小
                $playId = 3599;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //蓝小双
                    $playId = 3611;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 蓝小单
                    $playId = 3610;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if($tm == 5 || $tm == 6 || $tm == 11 || $tm == 16 || $tm == 17 || $tm == 21 || $tm == 22 || $tm == 27 || $tm == 28 || $tm == 32 || $tm == 33 || $tm == 38 || $tm == 39 || $tm == 43 || $tm == 44 || $tm == 49){ //绿波
            $playId = 3591;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //绿双
                $playId = 3601;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //绿单
                $playId = 3600;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //绿大
                $playId = 3602;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //绿大双
                    $playId = 3613;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 绿大单
                    $playId = 3612;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //绿小
                $playId = 3603;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //绿小双
                    $playId = 3615;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 绿小单
                    $playId = 3614;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
    }

    //特肖
    public function TX($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tx_playCate = 165; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        if($tm == 7 || $tm == 19 || $tm == 31 || $tm == 43){ //蛇
            $playId = 3621;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 6 || $tm == 18 || $tm == 30 || $tm == 42){ //马
            $playId = 3622;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 5 || $tm == 17 || $tm == 29 || $tm == 41){ //羊
            $playId = 3623;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 4 || $tm == 16 || $tm == 28 || $tm == 40){ //猴
            $playId = 3624;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 3 || $tm == 15 || $tm == 27 || $tm == 39){ //鸡
            $playId = 3625;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 2 || $tm == 14 || $tm == 26 || $tm == 38){ //狗
            $playId = 3626;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 1 || $tm == 13 || $tm == 25 || $tm == 37 || $tm == 49){ //猪
            $playId = 3627;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 12 || $tm == 24 || $tm == 36 || $tm == 48){ // 鼠
            $playId = 3616;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 11 || $tm == 23 || $tm == 35 || $tm == 47){ //牛
            $playId = 3617;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 10 || $tm == 22 || $tm == 34 || $tm == 46){ //虎
            $playId = 3618;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 9 || $tm == 21 || $tm == 33 || $tm == 45){ //兔
            $playId = 3619;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 8 || $tm == 20 || $tm == 32 || $tm == 44){ //龙
            $playId = 3620;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
    }

    //特码头尾数
    public function TMTWS($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tmtws_playCate = 167; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        $tmBL = str_pad($tm,2,"0",STR_PAD_LEFT); //十位补零
        $chaiTM = str_split($tmBL); //拆分个位 十位
        $tou = (int)$chaiTM[0];
        $wei = (int)$chaiTM[1];
        if($tou == 0){
            $playId = 3638;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 1){
            $playId = 3639;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 2){
            $playId = 3640;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 3){
            $playId = 3641;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 4){
            $playId = 3642;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 0){
            $playId = 3652;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 1){
            $playId = 3643;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 2){
            $playId = 3644;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 3){
            $playId = 3645;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 4){
            $playId = 3646;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 5){
            $playId = 3647;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 6){
            $playId = 3648;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 7){
            $playId = 3649;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 8){
            $playId = 3650;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 9){
            $playId = 3651;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
    }

    //正码
    public function ZM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $zm_playCate = 168; //正码分类ID
        $ZM1 = $arrOpenCode[0];
        $ZM2 = $arrOpenCode[1];
        $ZM3 = $arrOpenCode[2];
        $ZM4 = $arrOpenCode[3];
        $ZM5 = $arrOpenCode[4];
        $ZM6 = $arrOpenCode[5];
        $nums = ['1'=>'3653','2'=>'3654','3'=>'3655','4'=>'3656','5'=>'3657','6'=>'3658','7'=>'3659','8'=>'3660','9'=>'3661','10'=>'3662','11'=>'3663','12'=>'3664','13'=>'3665','14'=>'3666','15'=>'3667','16'=>'3668','17'=>'3669','18'=>'3670','19'=>'3671','20'=>'3672','21'=>'3673','22'=>'3674','23'=>'3675','24'=>'3676','25'=>'3677','26'=>'3678','27'=>'3679','28'=>'3680','29'=>'3681','30'=>'3682','31'=>'3683','32'=>'3684','33'=>'3685','34'=>'3686','35'=>'3687','36'=>'3688','37'=>'3689','38'=>'3690','39'=>'3691','40'=>'3692','41'=>'3693','42'=>'3694','43'=>'3695','44'=>'3696','45'=>'3697','46'=>'3698','47'=>'3699','48'=>'3700','49'=>'3701'];
        foreach ($nums as $k => $v){
            if($ZM1 == $k){
                $playId = $v;
                $winCode = $gameId.$zm_playCate.$playId;
                $win->push($winCode);
            }
            if($ZM2 == $k){
                $playId = $v;
                $winCode = $gameId.$zm_playCate.$playId;
                $win->push($winCode);
            }
            if($ZM3 == $k){
                $playId = $v;
                $winCode = $gameId.$zm_playCate.$playId;
                $win->push($winCode);
            }
            if($ZM4 == $k){
                $playId = $v;
                $winCode = $gameId.$zm_playCate.$playId;
                $win->push($winCode);
            }
            if($ZM5 == $k){
                $playId = $v;
                $winCode = $gameId.$zm_playCate.$playId;
                $win->push($winCode);
            }
            if($ZM6 == $k){
                $playId = $v;
                $winCode = $gameId.$zm_playCate.$playId;
                $win->push($winCode);
            }
        }
    }

    //五行
    public function WX($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $wx_playCate = 170; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        if($tm == 5 || $tm == 6 || $tm == 19 || $tm == 20 || $tm == 27 || $tm == 28 || $tm == 35 || $tm == 36 || $tm == 49){ //金
            $playId = 3702;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 1 || $tm == 2 || $tm == 9 || $tm == 10 || $tm == 17 || $tm == 18 || $tm == 31 || $tm == 32 || $tm == 39 || $tm == 40 || $tm == 47 || $tm == 48){ //木
            $playId = 3703;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 7 || $tm == 8 || $tm == 15 || $tm == 16 || $tm == 23 || $tm == 24 || $tm == 37 || $tm == 38 || $tm == 45 || $tm == 46){ //水
            $playId = 3704;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 3 || $tm == 4 || $tm == 11 || $tm == 12 || $tm == 25 || $tm == 26 || $tm == 33 || $tm == 34 || $tm == 41 || $tm == 42){ //火
            $playId = 3705;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 13 || $tm == 14 || $tm == 21 || $tm == 22 || $tm == 29 || $tm == 30 || $tm == 43 || $tm == 44){ //土
            $playId = 3706;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
    }

    //七色波
    public function QSB($openCode,$gameId,$win,$ids_he)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $qsb_playCate = 173; //特码分类ID
        $zm1 = $arrOpenCode[0];
        $zm2 = $arrOpenCode[1];
        $zm3 = $arrOpenCode[2];
        $zm4 = $arrOpenCode[3];
        $zm5 = $arrOpenCode[4];
        $zm6 = $arrOpenCode[5];
        $tm = $arrOpenCode[6]; //特码号码
        $tmsb = $this->SB_Color($tm); //特码色波
        //七个号码色波
        $s = [
            $this->SB_Color($zm1),
            $this->SB_Color($zm2),
            $this->SB_Color($zm3),
            $this->SB_Color($zm4),
            $this->SB_Color($zm5),
            $this->SB_Color($zm6),
            $this->SB_Color($tm),
        ];
        //正码颜色
        $zmys = [
            $this->SB_Color($zm1),
            $this->SB_Color($zm2),
            $this->SB_Color($zm3),
            $this->SB_Color($zm4),
            $this->SB_Color($zm5),
            $this->SB_Color($zm6),
        ];
        $zmys_array = array_count_values($zmys);
        if(isset($zmys_array['R'])){
            $zmys_red = $zmys_array['R'];
        } else {
            $zmys_red = 0;
        }
        if(isset($zmys_array['B'])){
            $zmys_blue = $zmys_array['B'];
        } else {
            $zmys_blue = 0;
        }
        if(isset($zmys_array['G'])){
            $zmys_green = $zmys_array['G'];
        } else {
            $zmys_green = 0;
        }
        $ac = array_count_values($s);
        $redBall = 0;
        $blueBall = 0;
        $greenBall = 0;
        $red = 0;
        $green = 0;
        $blue = 0;
        foreach($ac as $k => $v){
            if($tmsb == $k && $k == 'G'){
                $green .= $greenBall+0.5;
            }
            if($tmsb == $k && $k == 'R'){
                $red .= $redBall+0.5;
            }
            if($tmsb == $k && $k == 'B'){
                $blue .= $blueBall+0.5;
            }
        }
        if(isset($ac['R'])){
            $redTotal = $red + $ac['R'];
        } else {
            $redTotal = 0;
        }
        if(isset($ac['B'])){
            $blueTotal = $blue + $ac['B'];
        } else {
            $blueTotal = 0;
        }
        if(isset($ac['G'])){
            $greenTotal = $green + $ac['G'];
        } else {
            $greenTotal = 0;
        }
        if(($zmys_blue == 3 && $zmys_green == 3 && $tmsb == 'R') || ($zmys_blue == 3 && $zmys_red == 3 && $tmsb == 'G') ||($zmys_green == 3 && $zmys_red == 3 && $tmsb == 'B')){ //和局
            $playId = 3744;
            $winCode = $gameId.$qsb_playCate.$playId;
            $win->push($winCode);
            //和局退本金
            $playId = 3741;
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 3742;
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 3743;
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
        } else {
            if ($redTotal>$blueTotal&$redTotal>$greenTotal){ //红
                $playId = 3741;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            }else if ($blueTotal>$greenTotal) { //蓝
                $playId = 3742;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            } else { //绿
                $playId = 3743;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            }
        }
    }

    //平特一肖尾数
    public function PTYXWS($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $ptyxws_playCate = 171; //特码分类ID
        $m1 = $arrOpenCode[0];
        $m2 = $arrOpenCode[1];
        $m3 = $arrOpenCode[2];
        $m4 = $arrOpenCode[3];
        $m5 = $arrOpenCode[4];
        $m6 = $arrOpenCode[5];
        $m7 = $arrOpenCode[6];
        $shu = [12,24,36,48];
        $niu = [11,23,35,47];
        $hu = [10,22,34,46];
        $tu = [9,21,33,45];
        $long = [8,20,32,44];
        $she = [7,19,31,43];
        $ma = [6,18,30,42];
        $yang = [5,17,29,41];
        $hou = [4,16,28,40];
        $ji = [3,15,27,39];
        $gou = [2,14,26,38];
        $zhu = [1,13,25,37,49];
        $w0 = [10,20,30,40];
        $w1 = [1,11,21,31,41];
        $w2 = [2,12,22,32,42];
        $w3 = [3,13,23,33,43];
        $w4 = [4,14,24,34,44];
        $w5 = [5,15,25,35,45];
        $w6 = [6,16,26,36,46];
        $w7 = [7,17,27,37,47];
        $w8 = [8,18,28,38,48];
        $w9 = [9,19,29,39,49];
        if(in_array($m1,$shu) || in_array($m2,$shu) || in_array($m3,$shu) || in_array($m4,$shu) || in_array($m5,$shu) || in_array($m6,$shu) || in_array($m7,$shu)){
            $playId = 3707;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$niu) || in_array($m2,$niu) || in_array($m3,$niu) || in_array($m4,$niu) || in_array($m5,$niu) || in_array($m6,$niu) || in_array($m7,$niu)){
            $playId = 3708;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$hu) || in_array($m2,$hu) || in_array($m3,$hu) || in_array($m4,$hu) || in_array($m5,$hu) || in_array($m6,$hu) || in_array($m7,$hu)){
            $playId = 3709;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$tu) || in_array($m2,$tu) || in_array($m3,$tu) || in_array($m4,$tu) || in_array($m5,$tu) || in_array($m6,$tu) || in_array($m7,$tu)){
            $playId = 3710;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$long) || in_array($m2,$long) || in_array($m3,$long) || in_array($m4,$long) || in_array($m5,$long) || in_array($m6,$long) || in_array($m7,$long)){
            $playId = 3711;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$she) || in_array($m2,$she) || in_array($m3,$she) || in_array($m4,$she) || in_array($m5,$she) || in_array($m6,$she) || in_array($m7,$she)){
            $playId = 3712;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$ma) || in_array($m2,$ma) || in_array($m3,$ma) || in_array($m4,$ma) || in_array($m5,$ma) || in_array($m6,$ma) || in_array($m7,$ma)){
            $playId = 3713;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$yang) || in_array($m2,$yang) || in_array($m3,$yang) || in_array($m4,$yang) || in_array($m5,$yang) || in_array($m6,$yang) || in_array($m7,$yang)){
            $playId = 3714;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$hou) || in_array($m2,$hou) || in_array($m3,$hou) || in_array($m4,$hou) || in_array($m5,$hou) || in_array($m6,$hou) || in_array($m7,$hou)){
            $playId = 3715;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$ji) || in_array($m2,$ji) || in_array($m3,$ji) || in_array($m4,$ji) || in_array($m5,$ji) || in_array($m6,$ji) || in_array($m7,$ji)){
            $playId = 3716;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$gou) || in_array($m2,$gou) || in_array($m3,$gou) || in_array($m4,$gou) || in_array($m5,$gou) || in_array($m6,$gou) || in_array($m7,$gou)){
            $playId = 3717;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$zhu) || in_array($m2,$zhu) || in_array($m3,$zhu) || in_array($m4,$zhu) || in_array($m5,$zhu) || in_array($m6,$zhu) || in_array($m7,$zhu)){
            $playId = 3718;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        //尾数
        if(in_array($m1,$w0) || in_array($m2,$w0) || in_array($m3,$w0) || in_array($m4,$w0) || in_array($m5,$w0) || in_array($m6,$w0) || in_array($m7,$w0)){
            $playId = 3719;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w1) || in_array($m2,$w1) || in_array($m3,$w1) || in_array($m4,$w1) || in_array($m5,$w1) || in_array($m6,$w1) || in_array($m7,$w1)){
            $playId = 3720;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w2) || in_array($m2,$w2) || in_array($m3,$w2) || in_array($m4,$w2) || in_array($m5,$w2) || in_array($m6,$w2) || in_array($m7,$w2)){
            $playId = 3721;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w3) || in_array($m2,$w3) || in_array($m3,$w3) || in_array($m4,$w3) || in_array($m5,$w3) || in_array($m6,$w3) || in_array($m7,$w3)){
            $playId = 3722;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w4) || in_array($m2,$w4) || in_array($m3,$w4) || in_array($m4,$w4) || in_array($m5,$w4) || in_array($m6,$w4) || in_array($m7,$w4)){
            $playId = 3723;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w5) || in_array($m2,$w5) || in_array($m3,$w5) || in_array($m4,$w5) || in_array($m5,$w5) || in_array($m6,$w5) || in_array($m7,$w5)){
            $playId = 3724;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w6) || in_array($m2,$w6) || in_array($m3,$w6) || in_array($m4,$w6) || in_array($m5,$w6) || in_array($m6,$w6) || in_array($m7,$w6)){
            $playId = 3725;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w7) || in_array($m2,$w7) || in_array($m3,$w7) || in_array($m4,$w7) || in_array($m5,$w7) || in_array($m6,$w7) || in_array($m7,$w7)){
            $playId = 3726;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w8) || in_array($m2,$w8) || in_array($m3,$w8) || in_array($m4,$w8) || in_array($m5,$w8) || in_array($m6,$w8) || in_array($m7,$w8)){
            $playId = 3727;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w9) || in_array($m2,$w9) || in_array($m3,$w9) || in_array($m4,$w9) || in_array($m5,$w9) || in_array($m6,$w9) || in_array($m7,$w9)){
            $playId = 3728;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
    }

    //总肖
    public function ZONGXIAO($openCode,$gameId,$win)
    {
        $playCate = 174;
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $sx1 = $this->LHC_SX->shengxiao($arrOpenCode[0]);
        $sx2 = $this->LHC_SX->shengxiao($arrOpenCode[1]);
        $sx3 = $this->LHC_SX->shengxiao($arrOpenCode[2]);
        $sx4 = $this->LHC_SX->shengxiao($arrOpenCode[3]);
        $sx5 = $this->LHC_SX->shengxiao($arrOpenCode[4]);
        $sx6 = $this->LHC_SX->shengxiao($arrOpenCode[5]);
        $sx7 = $this->LHC_SX->shengxiao($arrOpenCode[6]);
        $openSX = [$sx1,$sx2,$sx3,$sx4,$sx5,$sx6,$sx7];
        $countOpen = array_count_values($openSX);
        $count = count($countOpen);
        if($count == 2){
            $playId = 3745;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 3){
            $playId = 3746;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 4){
            $playId = 3747;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 5){
            $playId = 3748;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 6){
            $playId = 3749;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 7){
            $playId = 3750;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count%2 == 0){
            $playId = 3752;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 3751;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    //正码特
    public function ZMT($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 169;
        $zm1 = (int)$arrOpenCode[0];
        $zm2 = (int)$arrOpenCode[1];
        $zm3 = (int)$arrOpenCode[2];
        $zm4 = (int)$arrOpenCode[3];
        $zm5 = (int)$arrOpenCode[4];
        $zm6 = (int)$arrOpenCode[5];

        $zm1_add_zero = str_pad($zm1,2,"0",STR_PAD_LEFT); //十位补零
        $zm1_over = str_split($zm1_add_zero); //拆分个位 十位
        $zm1_tou = (int)$zm1_over[0];
        $zm1_wei = (int)$zm1_over[1];
        $zm1_heshu = $zm1_tou+$zm1_wei;

        $zm2_add_zero = str_pad($zm2,2,"0",STR_PAD_LEFT); //十位补零
        $zm2_over = str_split($zm2_add_zero); //拆分个位 十位
        $zm2_tou = (int)$zm2_over[0];
        $zm2_wei = (int)$zm2_over[1];
        $zm2_heshu = $zm2_tou+$zm2_wei;

        $zm3_add_zero = str_pad($zm3,2,"0",STR_PAD_LEFT); //十位补零
        $zm3_over = str_split($zm3_add_zero); //拆分个位 十位
        $zm3_tou = (int)$zm3_over[0];
        $zm3_wei = (int)$zm3_over[1];
        $zm3_heshu = $zm3_tou+$zm3_wei;

        $zm4_add_zero = str_pad($zm4,2,"0",STR_PAD_LEFT); //十位补零
        $zm4_over = str_split($zm4_add_zero); //拆分个位 十位
        $zm4_tou = (int)$zm4_over[0];
        $zm4_wei = (int)$zm4_over[1];
        $zm4_heshu = $zm4_tou+$zm4_wei;

        $zm5_add_zero = str_pad($zm5,2,"0",STR_PAD_LEFT); //十位补零
        $zm5_over = str_split($zm5_add_zero); //拆分个位 十位
        $zm5_tou = (int)$zm5_over[0];
        $zm5_wei = (int)$zm5_over[1];
        $zm5_heshu = $zm5_tou+$zm5_wei;

        $zm6_add_zero = str_pad($zm6,2,"0",STR_PAD_LEFT); //十位补零
        $zm6_over = str_split($zm6_add_zero); //拆分个位 十位
        $zm6_tou = (int)$zm6_over[0];
        $zm6_wei = (int)$zm6_over[1];
        $zm6_heshu = $zm6_tou+$zm6_wei;

        $zm1_nums = [1=>3857,2=>3858,3=>3859,4=>3860,5=>3861,6=>3862,7=>3863,8=>3864,9=>3865,10=>3866,11=>3867,12=>3868,13=>3869,14=>3870,15=>3871,16=>3872,17=>3873,18=>3874,19=>3875,20=>3876,21=>3877,22=>3878,23=>3879,24=>3880,25=>3881,26=>3882,27=>3883,28=>3884,29=>3885,30=>3886,31=>3887,32=>3888,33=>3889,34=>3890,35=>3891,36=>3892,37=>3893,38=>3894,39=>3895,40=>3896,41=>3897,42=>3898,43=>3899,44=>3900,45=>3901,46=>3902,47=>3903,48=>3904,49=>3905];
        $zm2_nums = [1=>3919,2=>3920,3=>3921,4=>3922,5=>3923,6=>3924,7=>3925,8=>3926,9=>3927,10=>3928,11=>3929,12=>3930,13=>3931,14=>3932,15=>3933,16=>3934,17=>3935,18=>3936,19=>3937,20=>3938,21=>3939,22=>3940,23=>3941,24=>3942,25=>3943,26=>3944,27=>3945,28=>3946,29=>3947,30=>3948,31=>3949,32=>3950,33=>3951,34=>3952,35=>3953,36=>3954,37=>3955,38=>3956,39=>3957,40=>3958,41=>3959,42=>3960,43=>3961,44=>3962,45=>3963,46=>3964,47=>3965,48=>3966,49=>3967];
        $zm3_nums = [1=>3981,2=>3982,3=>3983,4=>3984,5=>3985,6=>3986,7=>3987,8=>3988,9=>3989,10=>3990,11=>3991,12=>3992,13=>3993,14=>3994,15=>3995,16=>3996,17=>3997,18=>3998,19=>3999,20=>4000,21=>4001,22=>4002,23=>4003,24=>4004,25=>4005,26=>4006,27=>4007,28=>4008,29=>4009,30=>4010,31=>4011,32=>4012,33=>4013,34=>4014,35=>4015,36=>4016,37=>4017,38=>4018,39=>4019,40=>4020,41=>4021,42=>4022,43=>4023,44=>4024,45=>4025,46=>4026,47=>4027,48=>4028,49=>4029];
        $zm4_nums = [1=>4043,2=>4044,3=>4045,4=>4046,5=>4047,6=>4048,7=>4049,8=>4050,9=>4051,10=>4052,11=>4053,12=>4054,13=>4055,14=>4056,15=>4057,16=>4058,17=>4059,18=>4060,19=>4061,20=>4062,21=>4063,22=>4064,23=>4065,24=>4066,25=>4067,26=>4068,27=>4069,28=>4070,29=>4071,30=>4072,31=>4073,32=>4074,33=>4075,34=>4076,35=>4077,36=>4078,37=>4079,38=>4080,39=>4081,40=>4082,41=>4083,42=>4084,43=>4085,44=>4086,45=>4087,46=>4088,47=>4089,48=>4090,49=>4091];
        $zm5_nums = [1=>4105,2=>4106,3=>4107,4=>4108,5=>4109,6=>4110,7=>4111,8=>4112,9=>4113,10=>4114,11=>4115,12=>4116,13=>4117,14=>4118,15=>4119,16=>4120,17=>4121,18=>4122,19=>4123,20=>4124,21=>4125,22=>4126,23=>4127,24=>4128,25=>4129,26=>4130,27=>4131,28=>4132,29=>4133,30=>4134,31=>4135,32=>4136,33=>4137,34=>4138,35=>4139,36=>4140,37=>4141,38=>4142,39=>4143,40=>4144,41=>4145,42=>4146,43=>4147,44=>4148,45=>4149,46=>4150,47=>4151,48=>4152,49=>4153];
        $zm6_nums = [1=>4167,2=>4168,3=>4169,4=>4170,5=>4171,6=>4172,7=>4173,8=>4174,9=>4175,10=>4176,11=>4177,12=>4178,13=>4179,14=>4180,15=>4181,16=>4182,17=>4183,18=>4184,19=>4185,20=>4186,21=>4187,22=>4188,23=>4189,24=>4190,25=>4191,26=>4192,27=>4193,28=>4194,29=>4195,30=>4196,31=>4197,32=>4198,33=>4199,34=>4200,35=>4201,36=>4202,37=>4203,38=>4204,39=>4205,40=>4206,41=>4207,42=>4208,43=>4209,44=>4210,45=>4211,46=>4212,47=>4213,48=>4214,49=>4215];
        foreach ($zm1_nums as $k => $v){
            if($zm1 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        foreach ($zm2_nums as $k => $v){
            if($zm2 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        foreach ($zm3_nums as $k => $v){
            if($zm3 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        foreach ($zm4_nums as $k => $v){
            if($zm4 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        foreach ($zm5_nums as $k => $v){
            if($zm5 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        foreach ($zm6_nums as $k => $v){
            if($zm6 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        //正1====两面====开始
        if($zm1%2 == 0){ //双
            $playId = 3907;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 3906;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1 <= 24){ //小
            $playId = 3909;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //大
            $playId = 3908;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_heshu%2 == 0){//合双
            $playId = 3911;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //合单
            $playId = 3910;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_heshu >= 7){ //合大
            $playId = 3912;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_heshu <= 6){ //合小
            $playId = 3913;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_wei == 5 || $zm1_wei == 6 || $zm1_wei == 7 || $zm1_wei == 8 || $zm1_wei == 9){ //尾大
            $playId = 3917;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_wei == 0 || $zm1_wei == 1 || $zm1_wei == 2 || $zm1_wei == 3 || $zm1_wei == 4){ //尾小
            $playId = 3918;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'R'){
            $playId = 3914;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'B'){
            $playId = 3915;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'G'){
            $playId = 3916;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正1====两面====结束
        //正2====两面====开始
        if($zm2%2 == 0){ //双
            $playId = 3969;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 3968;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2 <= 24){ //小
            $playId = 3971;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 3970;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_heshu%2 == 0){//合双
            $playId = 3973;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 3972;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_heshu >= 7){ //合大
            $playId = 3974;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_heshu <= 6){ //合小
            $playId = 3975;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_wei == 5 || $zm2_wei == 6 || $zm2_wei == 7 || $zm2_wei == 8 || $zm2_wei == 9){ //尾大
            $playId = 3979;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_wei == 0 || $zm2_wei == 1 || $zm2_wei == 2 || $zm2_wei == 3 || $zm2_wei == 4){ //尾小
            $playId = 3980;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'R'){
            $playId = 3976;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'B'){
            $playId = 3977;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'G'){
            $playId = 3978;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正2====两面====结束
        //正3====两面====开始
        if($zm3%2 == 0){ //双
            $playId = 4031;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4030;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3 <= 24){ //小
            $playId = 4033;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4032;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_heshu%2 == 0){//合双
            $playId = 4035;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4034;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_heshu >= 7){ //合大
            $playId = 4036;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_heshu <= 6){ //合小
            $playId = 4037;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_wei == 5 || $zm3_wei == 6 || $zm3_wei == 7 || $zm3_wei == 8 || $zm3_wei == 9){ //尾大
            $playId = 4041;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_wei == 0 || $zm3_wei == 1 || $zm3_wei == 2 || $zm3_wei == 3 || $zm3_wei == 4){ //尾小
            $playId = 4042;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'R'){
            $playId = 4038;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'B'){
            $playId = 4039;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'G'){
            $playId = 4040;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正3====两面====结束
        //正4====两面====开始
        if($zm4%2 == 0){ //双
            $playId = 4093;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4092;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4 <= 24){ //小
            $playId = 4095;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4094;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_heshu%2 == 0){//合双
            $playId = 4097;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4096;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_heshu >= 7){ //合大
            $playId = 4098;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_heshu <= 6){ //合小
            $playId = 4099;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_wei == 5 || $zm4_wei == 6 || $zm4_wei == 7 || $zm4_wei == 8 || $zm4_wei == 9){ //尾大
            $playId = 4103;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_wei == 0 || $zm4_wei == 1 || $zm4_wei == 2 || $zm4_wei == 3 || $zm4_wei == 4){ //尾小
            $playId = 4104;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'R'){
            $playId = 4100;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'B'){
            $playId = 4101;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'G'){
            $playId = 4102;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正4====两面====结束
        //正5====两面====开始
        if($zm5%2 == 0){ //双
            $playId = 4155;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4154;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5 <= 24){ //小
            $playId = 4157;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4156;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_heshu%2 == 0){//合双
            $playId = 4159;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4158;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_heshu >= 7){ //合大
            $playId = 4160;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_heshu <= 6){ //合小
            $playId = 4161;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_wei == 5 || $zm5_wei == 6 || $zm5_wei == 7 || $zm5_wei == 8 || $zm5_wei == 9){ //尾大
            $playId = 4165;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_wei == 0 || $zm5_wei == 1 || $zm5_wei == 2 || $zm5_wei == 3 || $zm5_wei == 4){ //尾小
            $playId = 4166;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'R'){
            $playId = 4162;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'B'){
            $playId = 4163;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'G'){
            $playId = 4164;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正5====两面====结束
        //正6====两面====开始
        if($zm6%2 == 0){ //双
            $playId = 4217;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4216;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6 <= 24){ //小
            $playId = 4219;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4218;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_heshu%2 == 0){//合双
            $playId = 4221;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4220;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_heshu >= 7){ //合大
            $playId = 4222;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_heshu <= 6){ //合小
            $playId = 4223;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_wei == 5 || $zm6_wei == 6 || $zm6_wei == 7 || $zm6_wei == 8 || $zm6_wei == 9){ //尾大
            $playId = 4227;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_wei == 0 || $zm6_wei == 1 || $zm6_wei == 2 || $zm6_wei == 3 || $zm6_wei == 4){ //尾小
            $playId = 4228;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'R'){
            $playId = 4224;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'B'){
            $playId = 4225;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'G'){
            $playId = 4226;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正6====两面====结束
    }

    function SB_Color($num){
        //红色
        if($num == 1 || $num == 2 || $num == 7 || $num == 8 || $num == 12 || $num == 13 || $num == 18 || $num == 19 || $num == 23 || $num == 24 || $num == 29 || $num == 30 || $num == 34 || $num == 35 || $num == 40 || $num == 45 || $num == 46){
            return 'R';
        }
        //蓝色
        if($num == 3 || $num == 4 || $num == 9 || $num == 10 || $num == 14 || $num == 15 || $num == 20 || $num == 25 || $num == 26 || $num == 31 || $num == 36 || $num == 37 || $num == 41 || $num == 42 || $num == 47 || $num == 48) { //蓝波
            return 'B';
        }
        //绿色
        if($num == 5 || $num == 6 || $num == 11 || $num == 16 || $num == 17 || $num == 21 || $num == 22 || $num == 27 || $num == 28 || $num == 32 || $num == 33 || $num == 38 || $num == 39 || $num == 43 || $num == 44 || $num == 49) { //绿波
            return 'G';
        }
    }

    //投注结算
    private function BUNKO($openCode,$win,$gameId,$issue,$he,$excel=false)
    {
        $bunko_index = 0;

        $openCodeArr = explode(',',$openCode);
        $tema = $openCodeArr[6]; //特码号码
        $tema_SX = $this->LHC_SX->shengxiao($tema); //特码生肖

        $id = [];
        foreach ($win as $k=>$v){
            $id[] = $v;
        }

        if($excel) {
            $table = 'excel_bet';
            $getUserBets = DB::connection('mysql::write')->table('excel_bet')->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        }else{
            $table = 'bet';
            $getUserBets = Bets::where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        }

        if($getUserBets){
            $sql = "UPDATE ".$table." SET bunko = CASE "; //中奖的SQL语句
            $sql_lose = "UPDATE ".$table." SET bunko = CASE "; //未中奖的SQL语句
            $sql_he = "UPDATE ".$table." SET bunko = CASE "; //和局的SQL语句

            $ids = implode(',', $id);
            $ids_lose = $ids;
            $sql_bets = '';
            $sql_bets_lose = '';
            $sql_bets_he = '';
            foreach ($getUserBets as $item){
                $bunko = ($item->bet_money * $item->play_odds) + ($item->bet_money * $item->play_rebate);
                $bunko_lose = (0-$item->bet_money) + ($item->bet_money * $item->play_rebate);
                $bunko_he = $item->bet_money * 1;
                $sql_bets .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                $sql_bets_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
                $sql_bets_he .= "WHEN `bet_id` = $item->bet_id THEN $bunko_he ";
            }
            if(count($he)>0) {
                $ids_he = [];
                $tmpids = explode(',',$ids);
                $tmpids_lose = $tmpids;
                foreach ($he as $k=>$v){
                    $ids_he[] = $v;
                    unset($tmpids[$v]);
                    $tmpids_lose[] = $v;
                }
                $ids = implode(',', $tmpids);
                $ids_lose = implode(',', $tmpids_lose);
                $ids_he = implode(',', $ids_he);
                $sql_he .= $sql_bets_he . "END, status = 1 , updated_at ='" . date('Y-m-d H:i:s') . "' WHERE `play_id` IN ($ids_he) AND `issue` = $issue AND `game_id` = $gameId";
            }else
                $sql_he = '';
            $sql .= $sql_bets . "END, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `play_id` IN ($ids) AND `issue` = $issue AND `game_id` = $gameId";
            $sql_lose .= $sql_bets_lose . "END, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `play_id` NOT IN ($ids_lose) AND `issue` = $issue AND `game_id` = $gameId";
            if(!empty($sql_bets))
                $run = DB::statement($sql);

            if(isset($run) && $run == 1){
                //自选不中------开始
                $zxbz_playCate = 175; //特码分类ID
                $zxbz_ids = [];
                $zxbz_lose_ids = [];
                $get = DB::table($table)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$zxbz_playCate)->where('bunko','=',0.00)->get();
                foreach ($get as $item) {
                    $open = explode(',', $openCode);
                    $user = explode(',', $item->bet_info);
                    $bi = array_intersect($open, $user);
                    if (empty($bi)) {
                        $zxbz_ids[] = $item->bet_id;
                    } else {
                        $zxbz_lose_ids[] = $item->bet_id;
                    }
                }
                $ids_zxbz = implode(',', $zxbz_ids);
                if($ids_zxbz){
                    $sql_zxb = "UPDATE ".$table." SET bunko = bet_money * play_odds, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `bet_id` IN ($ids_zxbz)"; //中奖的SQL语句
                } else {
                    $sql_zxb = 0;
                }
                //自选不中------结束
                //合肖-----开始
                $hexiao_playCate = 166; //分类ID
                $hexiao_ids = [];
                $getHexiao = DB::table($table)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$hexiao_playCate)->where('bunko','=',0.00)->get();
                foreach ($getHexiao as $item) {
                    $hexiao_open = explode(',', $tema_SX);
                    $hexiao_user = explode(',', $item->bet_info);
                    $hexiao_bi = array_intersect($hexiao_open, $hexiao_user);
                    if ($hexiao_bi) {
                        $hexiao_ids[] = $item->bet_id;
                    }
                }
                $ids_hexiao = implode(',', $hexiao_ids);
                if($ids_hexiao){
                    $sql_hexiao = "UPDATE ".$table." SET bunko = bet_money * play_odds, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `bet_id` IN ($ids_hexiao)"; //中奖的SQL语句
                } else {
                    $sql_hexiao = 0;
                }
                //合肖-----结束
                //正肖-----开始
                $zx_playCate = 172; //分类ID
                $zx_id = [];
                $zx_plays = ['鼠'=>3729,'牛'=>3730,'虎'=>3731,'兔'=>3732,'龙'=>3733,'蛇'=>3734,'马'=>3735,'羊'=>3736,'猴'=>3737,'鸡'=>3738,'狗'=>3739,'猪'=>3740];
                $arrOpenCode = explode(',',$openCode); // 分割开奖号码
                $sx1 = $this->LHC_SX->shengxiao($arrOpenCode[0]);
                $sx2 = $this->LHC_SX->shengxiao($arrOpenCode[1]);
                $sx3 = $this->LHC_SX->shengxiao($arrOpenCode[2]);
                $sx4 = $this->LHC_SX->shengxiao($arrOpenCode[3]);
                $sx5 = $this->LHC_SX->shengxiao($arrOpenCode[4]);
                $sx6 = $this->LHC_SX->shengxiao($arrOpenCode[5]);
                $sx7 = $this->LHC_SX->shengxiao($arrOpenCode[6]);
                $openSX = [$sx1,$sx2,$sx3,$sx4,$sx5,$sx6];
                $countOpen = array_count_values($openSX);
                $zx_sql = "UPDATE ".$table." SET bunko = CASE play_id ";
                foreach ($countOpen as $kk => $vv){
                    foreach ($zx_plays as $k => $v){
                        if ($kk == $k){
                            $zx_id[] = $gameId.$zx_playCate.$v;
                            $playId = $gameId.$zx_playCate.$v;
                            $zx_sql .= sprintf("WHEN %d THEN (bet_money * play_odds) * %d ", $playId, $vv);
                        }
                    }
                }
                $zx_ids = implode(',',$zx_id);
                if($zx_ids && isset($zx_ids)){
                    $zx_sql .= "END, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE play_id IN ($zx_ids) AND `issue` = $issue AND `game_id` = $gameId";
                } else {
                    $zx_sql = 0;
                }
                //正肖-----结束

                //连肖连尾-----开始
                $lxlw_playCate = 176; //分类ID
                $uniqueSX = array_unique([$sx1,$sx2,$sx3,$sx4,$sx5,$sx6,$sx7]);
                //二连肖
                $lx_ids = [];
                $get2LX = DB::table($table)->where('game_id',$gameId)->where('playcate_id',$lxlw_playCate)->where('issue',$issue)->where('play_name','like','%二连肖%')->where('bunko','=',0.00)->get();
                foreach ($get2LX as $item) {
                    $userBetInfoSX = explode(',',$item->bet_info);
                    $bi = array_intersect($uniqueSX, $userBetInfoSX);
                    if(count($bi) == 2){
                        $lx_ids[] = $item->bet_id;
                    }
                }
                //三连肖
                $get3LX = DB::table($table)->where('game_id',$gameId)->where('playcate_id',$lxlw_playCate)->where('issue',$issue)->where('play_name','like','%三连肖%')->where('bunko','=',0.00)->get();
                foreach ($get3LX as $item) {
                    $userBetInfoSX_3 = explode(',',$item->bet_info);
                    $bi = array_intersect($uniqueSX, $userBetInfoSX_3);
                    if(count($bi) == 3){
                        $lx_ids[] = $item->bet_id;
                    }
                }
                //四连肖
                $get4LX = DB::table($table)->where('game_id',$gameId)->where('playcate_id',$lxlw_playCate)->where('issue',$issue)->where('play_name','like','%四连肖%')->where('bunko','=',0.00)->get();
                foreach ($get4LX as $item) {
                    $userBetInfoSX_4 = explode(',',$item->bet_info);
                    $bi = array_intersect($uniqueSX, $userBetInfoSX_4);
                    if(count($bi) == 4){
                        $lx_ids[] = $item->bet_id;
                    }
                }
                //五连肖
                $get5LX = DB::table($table)->where('game_id',$gameId)->where('playcate_id',$lxlw_playCate)->where('issue',$issue)->where('play_name','like','%五连肖%')->where('bunko','=',0.00)->get();
                foreach ($get5LX as $item) {
                    $userBetInfoSX_5 = explode(',',$item->bet_info);
                    $bi = array_intersect($uniqueSX, $userBetInfoSX_5);
                    if(count($bi) == 5){
                        $lx_ids[] = $item->bet_id;
                    }
                }
                $ids_lx = implode(',', $lx_ids);
                if($ids_lx){
                    $sql_lx = "UPDATE ".$table." SET bunko = bet_money * play_odds, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `bet_id` IN ($ids_lx)"; //中奖的SQL语句
                } else {
                    $sql_lx = 0;
                }

                //连尾
                $wei1 = $this->LHC_SX->wei($arrOpenCode[0]);
                $wei2 = $this->LHC_SX->wei($arrOpenCode[1]);
                $wei3 = $this->LHC_SX->wei($arrOpenCode[2]);
                $wei4 = $this->LHC_SX->wei($arrOpenCode[3]);
                $wei5 = $this->LHC_SX->wei($arrOpenCode[4]);
                $wei6 = $this->LHC_SX->wei($arrOpenCode[5]);
                $wei7 = $this->LHC_SX->wei($arrOpenCode[6]);
                $uniqueWei = array_unique([$wei1,$wei2,$wei3,$wei4,$wei5,$wei6,$wei7]);
                $lw_ids = [];
                //二连尾
                $get2LW = DB::table($table)->where('game_id',$gameId)->where('playcate_id',$lxlw_playCate)->where('issue',$issue)->where('play_name','like','%二连尾%')->where('bunko','=',0.00)->get();
                foreach ($get2LW as $item) {
                    $userBetInfoWei = explode(',',$item->bet_info);
                    $bi = array_intersect($uniqueWei, $userBetInfoWei);
                    if(count($bi) == 2){
                        $lw_ids[] = $item->bet_id;
                    }
                }
                //三连尾
                $get3LW = DB::table($table)->where('game_id',$gameId)->where('playcate_id',$lxlw_playCate)->where('issue',$issue)->where('play_name','like','%三连尾%')->where('bunko','=',0.00)->get();
                foreach ($get3LW as $item) {
                    $userBetInfoWei_3 = explode(',',$item->bet_info);
                    $bi = array_intersect($uniqueWei, $userBetInfoWei_3);
                    if(count($bi) == 3){
                        $lw_ids[] = $item->bet_id;
                    }
                }
                //四连尾
                $get4LW = DB::table($table)->where('game_id',$gameId)->where('playcate_id',$lxlw_playCate)->where('issue',$issue)->where('play_name','like','%四连尾%')->where('bunko','=',0.00)->get();
                foreach ($get4LW as $item) {
                    $userBetInfoWei_4 = explode(',',$item->bet_info);
                    $bi = array_intersect($uniqueWei, $userBetInfoWei_4);
                    if(count($bi) == 4){
                        $lw_ids[] = $item->bet_id;
                    }
                }
                //五连尾
                $get5LW = DB::table($table)->where('game_id',$gameId)->where('playcate_id',$lxlw_playCate)->where('issue',$issue)->where('play_name','like','%五连尾%')->where('bunko','=',0.00)->get();
                foreach ($get5LW as $item) {
                    $userBetInfoWei_5 = explode(',',$item->bet_info);
                    $bi = array_intersect($uniqueWei, $userBetInfoWei_5);
                    if(count($bi) == 5){
                        $lw_ids[] = $item->bet_id;
                    }
                }

                $ids_lw = implode(',', $lw_ids);
                if($ids_lw){
                    $sql_lw = "UPDATE ".$table." SET bunko = bet_money * play_odds, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `bet_id` IN ($ids_lw)"; //中奖的SQL语句
                } else {
                    $sql_lw = 0;
                }
                //连肖连尾-----结束

                //连码-----开始
                $lm_playCate = 177; //分类ID
                //连码-----结束


                if(!empty($sql_he)){
                    $runhe = DB::connection('mysql::write')->statement($sql_he);
                    if($runhe == 1)
                        $bunko_index++;
                }
                if(!empty($sql_bets_lose)){
                    $run2 = DB::connection('mysql::write')->statement($sql_lose);
                    if($run2 == 1){
                        $bunko_index++;
                        if($sql_zxb !== 0){
                            $run3 = DB::connection('mysql::write')->statement($sql_zxb);
                            if($run3 == 1){
                                $bunko_index++;
                            }
                        } else {
                            $bunko_index++;
                        }

                        if($sql_hexiao !== 0){
                            $run4 = DB::connection('mysql::write')->statement($sql_hexiao);
                            if($run4 == 1){
                                $bunko_index++;
                            }
                        } else {
                            $bunko_index++;
                        }

                        if($zx_sql !== 0){
                            $run5 = DB::connection('mysql::write')->statement($zx_sql);
                            if($run5 == 1){
                                $bunko_index++;
                            }
                        } else {
                            $bunko_index++;
                        }

                        if($sql_lx !== 0){
                            $run6 = DB::connection('mysql::write')->statement($sql_lx);
                            if($run6 == 1){
                                $bunko_index++;
                            }
                        } else {
                            $bunko_index++;
                        }

                        if($sql_lw !== 0){
                            $run7 = DB::connection('mysql::write')->statement($sql_lw);
                            if($run7 == 1){
                                $bunko_index++;
                            }
                        } else {
                            $bunko_index++;
                        }
                    }
                }
            }
        }

        if($bunko_index !== 0){
            return 1;
        }
    }
}
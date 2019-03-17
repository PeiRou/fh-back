<?php
/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 2019/3/14
 * Time: 下午20:01
 */

namespace App\Http\Controllers\Bet;

use App\Bets;
use App\Excel;
use App\Helpers\LHC_SX;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Jslhc
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
        $table = 'game_jslhc';
        $gameName = '急速六合彩';
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
                    writeLog('New_Bet', 'jslhc killing...');
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
            if($i==1){
                $exeBet = DB::table('excel_bet')->where('issue','=',$issue)->where('game_id',$gameId)->first();
                if(empty($exeBet))
                    DB::connection('mysql::write')->select("INSERT INTO excel_bet  SELECT * FROM bet WHERE bet.issue = '{$issue}' and bet.game_id = '{$gameId}' and bet.testFlag = 0");
            }else{
                DB::connection('mysql::write')->table("excel_bet")->where('issue',$issue)->where('game_id',$gameId)->update(["bunko"=>0]);
            }
            $openCode = $excel->opennum($table,$exeBase->is_user,$issue,$i);
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
        $tm_playCate = 377; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        switch ($tm){
            case 1:
                $playId_B = 6077;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6028;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 2:
                $playId_B = 6078;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6029;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 3:
                $playId_B = 6079;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6030;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 4:
                $playId_B = 6080;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6031;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 5:
                $playId_B = 6081;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6032;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 6:
                $playId_B = 6082;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6033;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 7:
                $playId_B = 6083;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6034;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 8:
                $playId_B = 6084;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6035;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 9:
                $playId_B = 6085;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6036;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 10:
                $playId_B = 6086;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6037;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 11:
                $playId_B = 6087;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6038;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 12:
                $playId_B = 6088;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6039;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 13:
                $playId_B = 6089;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6040;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 14:
                $playId_B = 6090;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6041;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 15:
                $playId_B = 6091;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6042;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 16:
                $playId_B = 6092;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6043;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 17:
                $playId_B = 6093;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6044;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 18:
                $playId_B = 6094;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6045;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 19:
                $playId_B = 6095;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6046;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 20:
                $playId_B = 6096;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6047;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 21:
                $playId_B = 6097;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6048;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 22:
                $playId_B = 6098;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6049;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 23:
                $playId_B = 6099;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6050;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 24:
                $playId_B = 6100;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6051;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 25:
                $playId_B = 6101;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6052;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 26:
                $playId_B = 6102;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6053;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 27:
                $playId_B = 6103;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6054;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 28:
                $playId_B = 6104;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6055;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 29:
                $playId_B = 6105;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6056;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 30:
                $playId_B = 6106;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6057;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 31:
                $playId_B = 6107;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6058;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 32:
                $playId_B = 6108;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6059;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 33:
                $playId_B = 6109;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6060;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 34:
                $playId_B = 6110;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6061;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 35:
                $playId_B = 6111;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6062;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 36:
                $playId_B = 6112;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6063;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 37:
                $playId_B = 6113;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6064;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 38:
                $playId_B = 6114;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6065;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 39:
                $playId_B = 6115;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6066;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 40:
                $playId_B = 6116;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6067;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 41:
                $playId_B = 6117;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6068;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 42:
                $playId_B = 6118;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6069;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 43:
                $playId_B = 6119;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6070;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 44:
                $playId_B = 6120;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6071;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 45:
                $playId_B = 6121;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6072;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 46:
                $playId_B = 6122;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6073;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 47:
                $playId_B = 6123;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6074;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 48:
                $playId_B = 6124;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6075;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 49:
                $playId_B = 6125;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6076;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
        }
    }

    //两面
    public function LM($openCode,$gameId,$win,$ids_he)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $lm_playCate = 378; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        $ZH = (int)$arrOpenCode[0]+(int)$arrOpenCode[1]+(int)$arrOpenCode[2]+(int)$arrOpenCode[3]+(int)$arrOpenCode[4]+(int)$arrOpenCode[5]+(int)$arrOpenCode[6];
        //特码大小
        if($tm >= 25 && $tm <= 48){ //大
            $playId = 6126;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
            if($tm%2 == 0){ //特大双
                $playId = 6137;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            } else { //特大单
                $playId = 6136;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
        }else if($tm <= 24){
            $playId = 6127;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
            if($tm%2 == 0){ //特小双
                $playId = 6139;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            } else { //特小单
                $playId = 6138;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
        }else{  //和局退本金
            $playId = 6126;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 6127;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //特码单双
        if($tm%2 == 0){ // 双
            $playId = 6129;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($tm%2 != 0 && $tm != 49){
            $playId = 6128;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 6128;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 6129;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //特码合数大小
        $tmBL = str_pad($tm,2,"0",STR_PAD_LEFT); //十位补零
        $chaiTM = str_split($tmBL); //拆分个位 十位
        $TMHS = (int)$chaiTM[0]+(int)$chaiTM[1];
        if($TMHS >= 7 && $tmBL != 49){ //特合大
            $playId = 6130;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($TMHS <= 6 && $tmBL != 49){ //特合小
            $playId = 6131;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 6130;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 6131;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        if($TMHS%2 == 0){ // 双
            $playId = 6133;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($TMHS%2 != 0 && $tmBL != 49){
            $playId = 6132;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 6132;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 6133;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //特天肖 地肖
        $TTX = $this->LHC_SX->shengxiao($tm);
        if($TTX == '兔' || $TTX == '马' || $TTX == '猴' || $TTX == '猪' || $TTX == '牛' || $TTX == '龙'){ //天肖
            $playId = 6140;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TTX == '蛇' || $TTX == '羊' || $TTX == '鸡' || $TTX == '狗' || $TTX == '鼠' || $TTX == '虎'){ //地肖
            $playId = 6141;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特前肖 后肖
        $TQH = $this->LHC_SX->shengxiao($tm);
        if($TQH == '鼠' || $TQH == '牛' || $TQH == '虎' || $TQH == '兔' || $TQH == '龙' || $TQH == '蛇'){ //前肖
            $playId = 6142;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TQH == '马' || $TQH == '羊' || $TQH == '猴' || $TQH == '鸡' || $TQH == '狗' || $TQH == '猪'){ //后肖
            $playId = 6143;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特家肖 野肖
        $TJX = $this->LHC_SX->shengxiao($tm);
        if($TJX == '牛' || $TJX == '马' || $TJX == '羊' || $TJX == '鸡' || $TJX == '狗' || $TJX == '猪'){ //家肖
            $playId = 6144;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TJX == '鼠' || $TJX == '虎' || $TJX == '兔' || $TJX == '龙' || $TJX == '蛇' || $TJX == '猴'){ //野肖
            $playId = 6145;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特尾大 特尾小
        $TW = $chaiTM[1];
        if($TW >= 5 && $tmBL != 49){ //尾大
            $playId = 6134;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($TW <= 4 && $tmBL != 49){
            $playId = 6135;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 6134;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 6135;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //总和大小
        if($ZH >= 175){ //大
            $playId = 6148;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        } else { //小
            $playId = 6149;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //总和单双
        if($ZH%2 == 0){ //双
            $playId = 6147;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6146;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
    }

    //色波
    public function SB($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $sb_playCate = 379; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        //色波
        if($tm == 1 || $tm == 2 || $tm == 7 || $tm == 8 || $tm == 12 || $tm == 13 || $tm == 18 || $tm == 19 || $tm == 23 || $tm == 24 || $tm == 29 || $tm == 30 || $tm == 34 || $tm == 35 || $tm == 40 || $tm == 45 || $tm == 46){ //红波
            $playId = 6150;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //红双
                $playId = 6154;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //红单
                $playId = 6153;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //红大
                $playId = 6155;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //红大双
                    $playId = 6166;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 红大单
                    $playId = 6165;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //红小
                $playId = 6156;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //红小双
                    $playId = 6168;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 红小单
                    $playId = 6167;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if($tm == 3 || $tm == 4 || $tm == 9 || $tm == 10 || $tm == 14 || $tm == 15 || $tm == 20 || $tm == 25 || $tm == 26 || $tm == 31 || $tm == 36 || $tm == 37 || $tm == 41 || $tm == 42 || $tm == 47 || $tm == 48){ //蓝波
            $playId = 6151;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //蓝双
                $playId = 6158;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //蓝单
                $playId = 6157;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //蓝大
                $playId = 6159;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //蓝大双
                    $playId = 6170;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 蓝大单
                    $playId = 6169;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //蓝小
                $playId = 6160;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //蓝小双
                    $playId = 6172;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 蓝小单
                    $playId = 6171;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if($tm == 5 || $tm == 6 || $tm == 11 || $tm == 16 || $tm == 17 || $tm == 21 || $tm == 22 || $tm == 27 || $tm == 28 || $tm == 32 || $tm == 33 || $tm == 38 || $tm == 39 || $tm == 43 || $tm == 44 || $tm == 49){ //绿波
            $playId = 6152;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //绿双
                $playId = 6162;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //绿单
                $playId = 6161;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //绿大
                $playId = 6163;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //绿大双
                    $playId = 6174;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 绿大单
                    $playId = 6173;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //绿小
                $playId = 6164;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //绿小双
                    $playId = 6176;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 绿小单
                    $playId = 6175;
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
        $tx_playCate = 380; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        if($tm == 7 || $tm == 19 || $tm == 31 || $tm == 43){ //蛇
            $playId = 6182;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 6 || $tm == 18 || $tm == 30 || $tm == 42){ //马
            $playId = 6183;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 5 || $tm == 17 || $tm == 29 || $tm == 41){ //羊
            $playId = 6184;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 4 || $tm == 16 || $tm == 28 || $tm == 40){ //猴
            $playId = 6185;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 3 || $tm == 15 || $tm == 27 || $tm == 39){ //鸡
            $playId = 6186;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 2 || $tm == 14 || $tm == 26 || $tm == 38){ //狗
            $playId = 6187;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 1 || $tm == 13 || $tm == 25 || $tm == 37 || $tm == 49){ //猪
            $playId = 6188;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 12 || $tm == 24 || $tm == 36 || $tm == 48){ // 鼠
            $playId = 6177;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 11 || $tm == 23 || $tm == 35 || $tm == 47){ //牛
            $playId = 6178;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 10 || $tm == 22 || $tm == 34 || $tm == 46){ //虎
            $playId = 6179;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 9 || $tm == 21 || $tm == 33 || $tm == 45){ //兔
            $playId = 6180;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 8 || $tm == 20 || $tm == 32 || $tm == 44){ //龙
            $playId = 6181;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
    }

    //特码头尾数
    public function TMTWS($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tmtws_playCate = 382; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        $tmBL = str_pad($tm,2,"0",STR_PAD_LEFT); //十位补零
        $chaiTM = str_split($tmBL); //拆分个位 十位
        $tou = (int)$chaiTM[0];
        $wei = (int)$chaiTM[1];
        if($tou == 0){
            $playId = 6199;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 1){
            $playId = 6200;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 2){
            $playId = 6201;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 3){
            $playId = 6202;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 4){
            $playId = 6203;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 0){
            $playId = 6213;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 1){
            $playId = 6204;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 2){
            $playId = 6205;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 3){
            $playId = 6206;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 4){
            $playId = 6207;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 5){
            $playId = 6208;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 6){
            $playId = 6209;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 7){
            $playId = 6210;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 8){
            $playId = 6211;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 9){
            $playId = 6212;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
    }

    //正码
    public function ZM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $zm_playCate = 383; //正码分类ID
        $ZM1 = $arrOpenCode[0];
        $ZM2 = $arrOpenCode[1];
        $ZM3 = $arrOpenCode[2];
        $ZM4 = $arrOpenCode[3];
        $ZM5 = $arrOpenCode[4];
        $ZM6 = $arrOpenCode[5];
        $nums = ['1'=>'6214','2'=>'6215','3'=>'6216','4'=>'6217','5'=>'6218','6'=>'6219','7'=>'6220','8'=>'6221','9'=>'6222','10'=>'6223','11'=>'6224','12'=>'6225','13'=>'6226','14'=>'6227','15'=>'6228','16'=>'6229','17'=>'6230','18'=>'6231','19'=>'6232','20'=>'6233','21'=>'6234','22'=>'6235','23'=>'6236','24'=>'6237','25'=>'6238','26'=>'6239','27'=>'6240','28'=>'6241','29'=>'6242','30'=>'6243','31'=>'6244','32'=>'6245','33'=>'6246','34'=>'6247','35'=>'6248','36'=>'6249','37'=>'6250','38'=>'6251','39'=>'6252','40'=>'6253','41'=>'6254','42'=>'6255','43'=>'6256','44'=>'6257','45'=>'6258','46'=>'6259','47'=>'6260','48'=>'6261','49'=>'6262'];
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
        $wx_playCate = 385; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        if($tm == 5 || $tm == 6 || $tm == 19 || $tm == 20 || $tm == 27 || $tm == 28 || $tm == 35 || $tm == 36 || $tm == 49){ //金
            $playId = 6263;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 1 || $tm == 2 || $tm == 9 || $tm == 10 || $tm == 17 || $tm == 18 || $tm == 31 || $tm == 32 || $tm == 39 || $tm == 40 || $tm == 47 || $tm == 48){ //木
            $playId = 6264;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 7 || $tm == 8 || $tm == 15 || $tm == 16 || $tm == 23 || $tm == 24 || $tm == 37 || $tm == 38 || $tm == 45 || $tm == 46){ //水
            $playId = 6265;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 3 || $tm == 4 || $tm == 11 || $tm == 12 || $tm == 25 || $tm == 26 || $tm == 33 || $tm == 34 || $tm == 41 || $tm == 42){ //火
            $playId = 6266;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 13 || $tm == 14 || $tm == 21 || $tm == 22 || $tm == 29 || $tm == 30 || $tm == 43 || $tm == 44){ //土
            $playId = 6267;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
    }

    //七色波
    public function QSB($openCode,$gameId,$win,$ids_he)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $qsb_playCate = 388; //特码分类ID
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
            $playId = 6305;
            $winCode = $gameId.$qsb_playCate.$playId;
            $win->push($winCode);
            //和局退本金
            $playId = 6302;
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 6303;
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 6304;
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
        } else {
            if ($redTotal>$blueTotal&$redTotal>$greenTotal){ //红
                $playId = 6302;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            }else if ($blueTotal>$greenTotal) { //蓝
                $playId = 6303;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            } else { //绿
                $playId = 6304;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            }
        }
    }

    //平特一肖尾数
    public function PTYXWS($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $ptyxws_playCate = 386; //特码分类ID
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
            $playId = 6268;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$niu) || in_array($m2,$niu) || in_array($m3,$niu) || in_array($m4,$niu) || in_array($m5,$niu) || in_array($m6,$niu) || in_array($m7,$niu)){
            $playId = 6269;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$hu) || in_array($m2,$hu) || in_array($m3,$hu) || in_array($m4,$hu) || in_array($m5,$hu) || in_array($m6,$hu) || in_array($m7,$hu)){
            $playId = 6270;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$tu) || in_array($m2,$tu) || in_array($m3,$tu) || in_array($m4,$tu) || in_array($m5,$tu) || in_array($m6,$tu) || in_array($m7,$tu)){
            $playId = 6271;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$long) || in_array($m2,$long) || in_array($m3,$long) || in_array($m4,$long) || in_array($m5,$long) || in_array($m6,$long) || in_array($m7,$long)){
            $playId = 6272;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$she) || in_array($m2,$she) || in_array($m3,$she) || in_array($m4,$she) || in_array($m5,$she) || in_array($m6,$she) || in_array($m7,$she)){
            $playId = 6273;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$ma) || in_array($m2,$ma) || in_array($m3,$ma) || in_array($m4,$ma) || in_array($m5,$ma) || in_array($m6,$ma) || in_array($m7,$ma)){
            $playId = 6274;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$yang) || in_array($m2,$yang) || in_array($m3,$yang) || in_array($m4,$yang) || in_array($m5,$yang) || in_array($m6,$yang) || in_array($m7,$yang)){
            $playId = 6275;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$hou) || in_array($m2,$hou) || in_array($m3,$hou) || in_array($m4,$hou) || in_array($m5,$hou) || in_array($m6,$hou) || in_array($m7,$hou)){
            $playId = 6276;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$ji) || in_array($m2,$ji) || in_array($m3,$ji) || in_array($m4,$ji) || in_array($m5,$ji) || in_array($m6,$ji) || in_array($m7,$ji)){
            $playId = 6277;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$gou) || in_array($m2,$gou) || in_array($m3,$gou) || in_array($m4,$gou) || in_array($m5,$gou) || in_array($m6,$gou) || in_array($m7,$gou)){
            $playId = 6278;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$zhu) || in_array($m2,$zhu) || in_array($m3,$zhu) || in_array($m4,$zhu) || in_array($m5,$zhu) || in_array($m6,$zhu) || in_array($m7,$zhu)){
            $playId = 6279;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        //尾数
        if(in_array($m1,$w0) || in_array($m2,$w0) || in_array($m3,$w0) || in_array($m4,$w0) || in_array($m5,$w0) || in_array($m6,$w0) || in_array($m7,$w0)){
            $playId = 6280;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w1) || in_array($m2,$w1) || in_array($m3,$w1) || in_array($m4,$w1) || in_array($m5,$w1) || in_array($m6,$w1) || in_array($m7,$w1)){
            $playId = 6281;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w2) || in_array($m2,$w2) || in_array($m3,$w2) || in_array($m4,$w2) || in_array($m5,$w2) || in_array($m6,$w2) || in_array($m7,$w2)){
            $playId = 6282;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w3) || in_array($m2,$w3) || in_array($m3,$w3) || in_array($m4,$w3) || in_array($m5,$w3) || in_array($m6,$w3) || in_array($m7,$w3)){
            $playId = 6283;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w4) || in_array($m2,$w4) || in_array($m3,$w4) || in_array($m4,$w4) || in_array($m5,$w4) || in_array($m6,$w4) || in_array($m7,$w4)){
            $playId = 6284;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w5) || in_array($m2,$w5) || in_array($m3,$w5) || in_array($m4,$w5) || in_array($m5,$w5) || in_array($m6,$w5) || in_array($m7,$w5)){
            $playId = 6285;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w6) || in_array($m2,$w6) || in_array($m3,$w6) || in_array($m4,$w6) || in_array($m5,$w6) || in_array($m6,$w6) || in_array($m7,$w6)){
            $playId = 6286;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w7) || in_array($m2,$w7) || in_array($m3,$w7) || in_array($m4,$w7) || in_array($m5,$w7) || in_array($m6,$w7) || in_array($m7,$w7)){
            $playId = 6287;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w8) || in_array($m2,$w8) || in_array($m3,$w8) || in_array($m4,$w8) || in_array($m5,$w8) || in_array($m6,$w8) || in_array($m7,$w8)){
            $playId = 6288;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w9) || in_array($m2,$w9) || in_array($m3,$w9) || in_array($m4,$w9) || in_array($m5,$w9) || in_array($m6,$w9) || in_array($m7,$w9)){
            $playId = 6289;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
    }

    //总肖
    public function ZONGXIAO($openCode,$gameId,$win)
    {
        $playCate = 389;
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
            $playId = 6306;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 3){
            $playId = 6307;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 4){
            $playId = 6308;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 5){
            $playId = 6309;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 6){
            $playId = 6310;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 7){
            $playId = 6311;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count%2 == 0){
            $playId = 6313;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6312;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    //正码特
    public function ZMT($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 384;
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

        $zm1_nums = [1=>6418,2=>6419,3=>6420,4=>6421,5=>6422,6=>6423,7=>6424,8=>6425,9=>6426,10=>6427,11=>6428,12=>6429,13=>6430,14=>6431,15=>6432,16=>6433,17=>6434,18=>6435,19=>6436,20=>6437,21=>6438,22=>6439,23=>6440,24=>6441,25=>6442,26=>6443,27=>6444,28=>6445,29=>6446,30=>6447,31=>6448,32=>6449,33=>6450,34=>6451,35=>6452,36=>6453,37=>6454,38=>6455,39=>6456,40=>6457,41=>6458,42=>6459,43=>6460,44=>6461,45=>6462,46=>6463,47=>6464,48=>6465,49=>6466];
        $zm2_nums = [1=>6480,2=>6481,3=>6482,4=>6483,5=>6484,6=>6485,7=>6486,8=>6487,9=>6488,10=>6489,11=>6490,12=>6491,13=>6492,14=>6493,15=>6494,16=>6495,17=>6496,18=>6497,19=>6498,20=>6499,21=>6500,22=>6501,23=>6502,24=>6503,25=>6504,26=>6505,27=>6506,28=>6507,29=>6508,30=>6509,31=>6510,32=>6511,33=>6512,34=>6513,35=>6514,36=>6515,37=>6516,38=>6517,39=>6518,40=>6519,41=>6520,42=>6521,43=>6522,44=>6523,45=>6524,46=>6525,47=>6526,48=>6527,49=>6528];
        $zm3_nums = [1=>6542,2=>6543,3=>6544,4=>6545,5=>6546,6=>6547,7=>6548,8=>6549,9=>6550,10=>6551,11=>6552,12=>6553,13=>6554,14=>6555,15=>6556,16=>6557,17=>6558,18=>6559,19=>6560,20=>6561,21=>6562,22=>6563,23=>6564,24=>6565,25=>6566,26=>6567,27=>6568,28=>6569,29=>6570,30=>6571,31=>6572,32=>6573,33=>6574,34=>6575,35=>6576,36=>6577,37=>6578,38=>6579,39=>6580,40=>6581,41=>6582,42=>6583,43=>6584,44=>6585,45=>6586,46=>6587,47=>6588,48=>6589,49=>6590];
        $zm4_nums = [1=>6604,2=>6605,3=>6606,4=>6607,5=>6608,6=>6609,7=>6610,8=>6611,9=>6612,10=>6613,11=>6614,12=>6615,13=>6616,14=>6617,15=>6618,16=>6619,17=>6620,18=>6621,19=>6622,20=>6623,21=>6624,22=>6625,23=>6626,24=>6627,25=>6628,26=>6629,27=>6630,28=>6631,29=>6632,30=>6633,31=>6634,32=>6635,33=>6636,34=>6637,35=>6638,36=>6639,37=>6640,38=>6641,39=>6642,40=>6643,41=>6644,42=>6645,43=>6646,44=>6647,45=>6648,46=>6649,47=>6650,48=>6651,49=>6652];
        $zm5_nums = [1=>6666,2=>6667,3=>6668,4=>6669,5=>6670,6=>6671,7=>6672,8=>6673,9=>6674,10=>6675,11=>6676,12=>6677,13=>6678,14=>6679,15=>6680,16=>6681,17=>6682,18=>6683,19=>6684,20=>6685,21=>6686,22=>6687,23=>6688,24=>6689,25=>6690,26=>6691,27=>6692,28=>6693,29=>6694,30=>6695,31=>6696,32=>6697,33=>6698,34=>6699,35=>6700,36=>6701,37=>6702,38=>6703,39=>6704,40=>6705,41=>6706,42=>6707,43=>6708,44=>6709,45=>6710,46=>6711,47=>6712,48=>6713,49=>6714];
        $zm6_nums = [1=>6728,2=>6729,3=>6730,4=>6731,5=>6732,6=>6733,7=>6734,8=>6735,9=>6736,10=>6737,11=>6738,12=>6739,13=>6740,14=>6741,15=>6742,16=>6743,17=>6744,18=>6745,19=>6746,20=>6747,21=>6748,22=>6749,23=>6750,24=>6751,25=>6752,26=>6753,27=>6754,28=>6755,29=>6756,30=>6757,31=>6758,32=>6759,33=>6760,34=>6761,35=>6762,36=>6763,37=>6764,38=>6765,39=>6766,40=>6767,41=>6768,42=>6769,43=>6770,44=>6771,45=>6772,46=>6773,47=>6774,48=>6775,49=>6776];
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
            $playId = 6468;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 6467;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1 <= 24){ //小
            $playId = 6470;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //大
            $playId = 6469;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_heshu%2 == 0){//合双
            $playId = 6472;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //合单
            $playId = 6471;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_heshu >= 7){ //合大
            $playId = 6473;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_heshu <= 6){ //合小
            $playId = 6474;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_wei == 5 || $zm1_wei == 6 || $zm1_wei == 7 || $zm1_wei == 8 || $zm1_wei == 9){ //尾大
            $playId = 6478;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_wei == 0 || $zm1_wei == 1 || $zm1_wei == 2 || $zm1_wei == 3 || $zm1_wei == 4){ //尾小
            $playId = 6479;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'R'){
            $playId = 6475;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'B'){
            $playId = 6476;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'G'){
            $playId = 6477;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正1====两面====结束
        //正2====两面====开始
        if($zm2%2 == 0){ //双
            $playId = 6530;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6529;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2 <= 24){ //小
            $playId = 6532;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6531;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_heshu%2 == 0){//合双
            $playId = 6534;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6533;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_heshu >= 7){ //合大
            $playId = 6535;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_heshu <= 6){ //合小
            $playId = 6536;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_wei == 5 || $zm2_wei == 6 || $zm2_wei == 7 || $zm2_wei == 8 || $zm2_wei == 9){ //尾大
            $playId = 6540;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_wei == 0 || $zm2_wei == 1 || $zm2_wei == 2 || $zm2_wei == 3 || $zm2_wei == 4){ //尾小
            $playId = 6541;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'R'){
            $playId = 6537;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'B'){
            $playId = 6538;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'G'){
            $playId = 6539;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正2====两面====结束
        //正3====两面====开始
        if($zm3%2 == 0){ //双
            $playId = 6592;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6591;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3 <= 24){ //小
            $playId = 6594;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6593;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_heshu%2 == 0){//合双
            $playId = 6596;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6595;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_heshu >= 7){ //合大
            $playId = 6597;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_heshu <= 6){ //合小
            $playId = 6598;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_wei == 5 || $zm3_wei == 6 || $zm3_wei == 7 || $zm3_wei == 8 || $zm3_wei == 9){ //尾大
            $playId = 6602;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_wei == 0 || $zm3_wei == 1 || $zm3_wei == 2 || $zm3_wei == 3 || $zm3_wei == 4){ //尾小
            $playId = 6603;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'R'){
            $playId = 6599;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'B'){
            $playId = 6600;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'G'){
            $playId = 6601;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正3====两面====结束
        //正4====两面====开始
        if($zm4%2 == 0){ //双
            $playId = 6654;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6653;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4 <= 24){ //小
            $playId = 6656;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6655;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_heshu%2 == 0){//合双
            $playId = 6658;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6657;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_heshu >= 7){ //合大
            $playId = 6659;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_heshu <= 6){ //合小
            $playId = 6660;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_wei == 5 || $zm4_wei == 6 || $zm4_wei == 7 || $zm4_wei == 8 || $zm4_wei == 9){ //尾大
            $playId = 6664;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_wei == 0 || $zm4_wei == 1 || $zm4_wei == 2 || $zm4_wei == 3 || $zm4_wei == 4){ //尾小
            $playId = 6665;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'R'){
            $playId = 6661;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'B'){
            $playId = 6662;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'G'){
            $playId = 6663;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正4====两面====结束
        //正5====两面====开始
        if($zm5%2 == 0){ //双
            $playId = 6716;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6715;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5 <= 24){ //小
            $playId = 6718;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6717;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_heshu%2 == 0){//合双
            $playId = 6720;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6719;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_heshu >= 7){ //合大
            $playId = 6721;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_heshu <= 6){ //合小
            $playId = 6722;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_wei == 5 || $zm5_wei == 6 || $zm5_wei == 7 || $zm5_wei == 8 || $zm5_wei == 9){ //尾大
            $playId = 6726;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_wei == 0 || $zm5_wei == 1 || $zm5_wei == 2 || $zm5_wei == 3 || $zm5_wei == 4){ //尾小
            $playId = 6727;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'R'){
            $playId = 6723;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'B'){
            $playId = 6724;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'G'){
            $playId = 6725;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正5====两面====结束
        //正6====两面====开始
        if($zm6%2 == 0){ //双
            $playId = 6778;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6777;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6 <= 24){ //小
            $playId = 6780;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6779;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_heshu%2 == 0){//合双
            $playId = 6782;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6781;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_heshu >= 7){ //合大
            $playId = 6783;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_heshu <= 6){ //合小
            $playId = 6784;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_wei == 5 || $zm6_wei == 6 || $zm6_wei == 7 || $zm6_wei == 8 || $zm6_wei == 9){ //尾大
            $playId = 6788;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_wei == 0 || $zm6_wei == 1 || $zm6_wei == 2 || $zm6_wei == 3 || $zm6_wei == 4){ //尾小
            $playId = 6789;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'R'){
            $playId = 6785;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'B'){
            $playId = 6786;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'G'){
            $playId = 6787;
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
                $bunko = ($item->bet_money * $item->play_odds);
                $bunko_lose = (0-$item->bet_money);
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
                $zxbz_playCate = 390; //特码分类ID
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
                $hexiao_playCate = 381; //分类ID
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
                $zx_playCate = 387; //分类ID
                $zx_id = [];
                $zx_plays = ['鼠'=>6290,'牛'=>6291,'虎'=>6292,'兔'=>6293,'龙'=>6294,'蛇'=>6295,'马'=>6296,'羊'=>6297,'猴'=>6298,'鸡'=>6299,'狗'=>6300,'猪'=>6301];
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
                $lxlw_playCate = 391; //分类ID
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
                $lm_playCate = 392; //分类ID
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
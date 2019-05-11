<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/4/4
 * Time: 下午11:57
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySSC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Qqffc extends Excel
{
    protected $arrPlay_id = array(1132874963,1132874964,1132874965,1132874966,1132874967,1132874968,1132874969,1132884970,1132884971,1132884972,1132884973,1132884974,1132884975,1132884976,1132884977,1132884978,1132884979,1132884980,1132884981,1132884982,1132884983,1132894984,1132894985,1132894986,1132894987,1132894988,1132894989,1132894990,1132894991,1132894992,1132894993,1132894994,1132894995,1132894996,1132894997,1132904998,1132904999,1132905000,1132905001,1132905002,1132905003,1132905004,1132905005,1132905006,1132905007,1132905008,1132905009,1132905010,1132905011,1132915012,1132915013,1132915014,1132915015,1132915016,1132915017,1132915018,1132915019,1132915020,1132915021,1132915022,1132915023,1132915024,1132915025,1132925026,1132925027,1132925028,1132925029,1132925030,1132925031,1132925032,1132925033,1132925034,1132925035,1132925036,1132925037,1132925038,1132925039,1132935040,1132935041,1132935042,1132935043,1132935044,1132945045,1132945046,1132945047,1132945048,1132945049,1132955050,1132955051,1132955052,1132955053,1132955054);
    protected $arrPlayCate = array(
        'ZONGHELONGHUHE' =>287,
        'DIYIQIU' =>288,
        'DIERQIU' =>289,
        'DISANQIU' =>290,
        'DISIQIU' =>291,
        'DIWUQIU' =>292,
        'QIANSAN' =>293,
        'ZHONGSAN' =>294,
        'HOUSAN' =>295
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 4963,
        'ZONGHEXIAO' => 4964,
        'ZONGHEDAN' => 4965,
        'ZONGHESHUANG' => 4966,
        'LONG' => 4967,
        'HU' => 4968,
        'HE' => 4969,
        'DIYIQIU0' => 4970,
        'DIYIQIU1' => 4971,
        'DIYIQIU2' => 4972,
        'DIYIQIU3' => 4973,
        'DIYIQIU4' => 4974,
        'DIYIQIU5' => 4975,
        'DIYIQIU6' => 4976,
        'DIYIQIU7' => 4977,
        'DIYIQIU8' => 4978,
        'DIYIQIU9' => 4979,
        'DIYIQIUDA' => 4980,
        'DIYIQIUXIAO' => 4981,
        'DIYIQIUDAN' => 4982,
        'DIYIQIUSHUANG' => 4983,
        'DIERQIU0' => 4984,
        'DIERQIU1' => 4985,
        'DIERQIU2' => 4986,
        'DIERQIU3' => 4987,
        'DIERQIU4' => 4988,
        'DIERQIU5' => 4989,
        'DIERQIU6' => 4990,
        'DIERQIU7' => 4991,
        'DIERQIU8' => 4992,
        'DIERQIU9' => 4993,
        'DIERQIUDA' => 4994,
        'DIERQIUXIAO' => 4995,
        'DIERQIUDAN' => 4996,
        'DIERQIUSHUANG' => 4997,
        'DISANQIU0' => 4998,
        'DISANQIU1' => 4999,
        'DISANQIU2' => 5000,
        'DISANQIU3' => 5001,
        'DISANQIU4' => 5002,
        'DISANQIU5' => 5003,
        'DISANQIU6' => 5004,
        'DISANQIU7' => 5005,
        'DISANQIU8' => 5006,
        'DISANQIU9' => 5007,
        'DISANQIUDA' => 5008,
        'DISANQIUXIAO' => 5009,
        'DISANQIUDAN' => 5010,
        'DISANQIUSHUANG' => 5011,
        'DISIQIU0' => 5012,
        'DISIQIU1' => 5013,
        'DISIQIU2' => 5014,
        'DISIQIU3' => 5015,
        'DISIQIU4' => 5016,
        'DISIQIU5' => 5017,
        'DISIQIU6' => 5018,
        'DISIQIU7' => 5019,
        'DISIQIU8' => 5020,
        'DISIQIU9' => 5021,
        'DISIQIUDA' => 5022,
        'DISIQIUXIAO' => 5023,
        'DISIQIUDAN' => 5024,
        'DISIQIUSHUANG' => 5025,
        'DIWUQIU0' => 5026,
        'DIWUQIU1' => 5027,
        'DIWUQIU2' => 5028,
        'DIWUQIU3' => 5029,
        'DIWUQIU4' => 5030,
        'DIWUQIU5' => 5031,
        'DIWUQIU6' => 5032,
        'DIWUQIU7' => 5033,
        'DIWUQIU8' => 5034,
        'DIWUQIU9' => 5035,
        'DIWUQIUDA' => 5036,
        'DIWUQIUXIAO' => 5037,
        'DIWUQIUDAN' => 5038,
        'DIWUQIUSHUANG' => 5039,
        'QIANSANBAOZI' => 5040,
        'QIANSANSHUNZI' => 5041,
        'QIANSANDUIZI' => 5042,
        'QIANSANBANSHUN' => 5043,
        'QIANSANZALIU' => 5044,
        'ZHONGSANBAOZI' => 5045,
        'ZHONGSANSHUNZI' => 5046,
        'ZHONGSANDUIZI' => 5047,
        'ZHONGSANBANSHUN' => 5048,
        'ZHONGSANZALIU' => 5049,
        'HOUSANBAOZI' => 5050,
        'HOUSANSHUNZI' => 5051,
        'HOUSANDUIZI' => 5052,
        'HOUSANBANSHUN' => 5053,
        'HOUSANZALIU' => 5054,
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $SSC = new ExcelLotterySSC();
        $SSC->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $SSC->NUM1($gameId,$win);
        $SSC->NUM2($gameId,$win);
        $SSC->NUM3($gameId,$win);
        $SSC->NUM4($gameId,$win);
        $SSC->NUM5($gameId,$win);
        $SSC->NUM1_DXDS($gameId,$win);
        $SSC->NUM2_DXDS($gameId,$win);
        $SSC->NUM3_DXDS($gameId,$win);
        $SSC->NUM4_DXDS($gameId,$win);
        $SSC->NUM5_DXDS($gameId,$win);
        $SSC->ZHDXDS($gameId,$win);
        $SSC->QIANSAN($gameId,$win);
        $SSC->ZHONGSAN($gameId,$win);
        $SSC->HOUSAN($gameId,$win);
        return $win;
    }
    public function all($openCode,$issue,$gameId,$id,$excel)
    {
        $table = 'game_qqffc';
        $gameName = 'QQ分分彩';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'qqffc killing...');
                    $this->excel($openCode, $exeBase, $issue, $gameId, $table);
                }
            }
            if(!$excel){
                $win = $this->exc_play($openCode,$gameId);
                $bunko = $this->bunko($win,$gameId,$issue,$excel,$this->arrPlay_id,true);
                $this->bet_total($issue,$gameId);
                if($bunko == 1){
                    $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id,true);
                    if($updateUserMoney == 1){
                        writeLog('New_Bet', $gameName . $issue . "结算出错");
                    }
                }
            }
        }
        if($excel){
            $update = DB::table($table)->where('id',$id)->update([
                'excel_num' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Kill', $gameName . $issue . "杀率not Finshed");
            }else
                $this->stopBunko($gameId,1,'Kill');
        }else{
            $update = DB::table($table)->where('id',$id)->update([
                'bunko' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Bet', $gameName . $issue . "结算not Finshed");
            }else{
                $this->stopBunko($gameId,1);
                //玩法退水
                if(env('AGENT_MODEL',1) == 1) {
                    $res = DB::table($table)->where('id',$id)->where('returnwater',0)->update(['returnwater' => 2]);
                    if(!$res){
                        writeLog('New_Bet', $gameName . $issue . "退水前失败！");
                        return 0;
                    }
                    //退水
                    $res = $this->reBackUser($gameId, $issue, $gameName);
                    if(!$res){
                        $res = DB::table($table)->where('id',$id)->where('returnwater',2)->update(['returnwater' => 1]);
                        if(empty($res)){
                            \Log::info($gameName.$issue.'退水中失败！');
                            return 0;
                        }
                    }else
                        writeLog('New_Bet', $gameName . $issue . "退水前失败！");
                }else{//代理退水
                    $agentJob = new AgentBackwaterJob($gameId,$issue);
                    $agentJob->addQueue();
                }
            }
        }
    }
}

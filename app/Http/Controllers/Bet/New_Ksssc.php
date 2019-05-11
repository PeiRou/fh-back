<?php
/**
 * Created by PhpStorm.
 * User: zoe
 * Date: 2019/2/12
 * Time: 22:50
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySSC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Ksssc extends Excel
{
    protected $arrPlay_id = array(8033375502,8033375503,8033375504,8033375505,8033375506,8033375507,8033375508,8033385509,8033385510,8033385511,8033385512,8033385513,8033385514,8033385515,8033385516,8033385517,8033385518,8033385519,8033385520,8033385521,8033385522,8033395523,8033395524,8033395525,8033395526,8033395527,8033395528,8033395529,8033395530,8033395531,8033395532,8033395533,8033395534,8033395535,8033395536,8033405537,8033405538,8033405539,8033405540,8033405541,8033405542,8033405543,8033405544,8033405545,8033405546,8033405547,8033405548,8033405549,8033405550,8033415551,8033415552,8033415553,8033415554,8033415555,8033415556,8033415557,8033415558,8033415559,8033415560,8033415561,8033415562,8033415563,8033415564,8033425565,8033425566,8033425567,8033425568,8033425569,8033425570,8033425571,8033425572,8033425573,8033425574,8033425575,8033425576,8033425577,8033425578,8033435579,8033435580,8033435581,8033435582,8033435583,8033445584,8033445585,8033445586,8033445587,8033445588,8033455589,8033455590,8033455591,8033455592,8033455593);
    protected $arrPlayCate = array(
        'ZONGHELONGHUHE' =>337,
        'DIYIQIU' =>338,
        'DIERQIU' =>339,
        'DISANQIU' =>340,
        'DISIQIU' =>341,
        'DIWUQIU' =>342,
        'QIANSAN' =>343,
        'ZHONGSAN' =>344,
        'HOUSAN' =>345
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 5502,
        'ZONGHEXIAO' => 5503,
        'ZONGHEDAN' => 5504,
        'ZONGHESHUANG' => 5505,
        'LONG' => 5506,
        'HU' => 5507,
        'HE' => 5508,
        'DIYIQIU0' => 5509,
        'DIYIQIU1' => 5510,
        'DIYIQIU2' => 5511,
        'DIYIQIU3' => 5512,
        'DIYIQIU4' => 5513,
        'DIYIQIU5' => 5514,
        'DIYIQIU6' => 5515,
        'DIYIQIU7' => 5516,
        'DIYIQIU8' => 5517,
        'DIYIQIU9' => 5518,
        'DIYIQIUDA' => 5519,
        'DIYIQIUXIAO' => 5520,
        'DIYIQIUDAN' => 5521,
        'DIYIQIUSHUANG' => 5522,
        'DIERQIU0' => 5523,
        'DIERQIU1' => 5524,
        'DIERQIU2' => 5525,
        'DIERQIU3' => 5526,
        'DIERQIU4' => 5527,
        'DIERQIU5' => 5528,
        'DIERQIU6' => 5529,
        'DIERQIU7' => 5530,
        'DIERQIU8' => 5531,
        'DIERQIU9' => 5532,
        'DIERQIUDA' => 5533,
        'DIERQIUXIAO' => 5534,
        'DIERQIUDAN' => 5535,
        'DIERQIUSHUANG' => 5536,
        'DISANQIU0' => 5537,
        'DISANQIU1' => 5538,
        'DISANQIU2' => 5539,
        'DISANQIU3' => 5540,
        'DISANQIU4' => 5541,
        'DISANQIU5' => 5542,
        'DISANQIU6' => 5543,
        'DISANQIU7' => 5544,
        'DISANQIU8' => 5545,
        'DISANQIU9' => 5546,
        'DISANQIUDA' => 5547,
        'DISANQIUXIAO' => 5548,
        'DISANQIUDAN' => 5549,
        'DISANQIUSHUANG' => 5550,
        'DISIQIU0' => 5551,
        'DISIQIU1' => 5552,
        'DISIQIU2' => 5553,
        'DISIQIU3' => 5554,
        'DISIQIU4' => 5555,
        'DISIQIU5' => 5556,
        'DISIQIU6' => 5557,
        'DISIQIU7' => 5558,
        'DISIQIU8' => 5559,
        'DISIQIU9' => 5560,
        'DISIQIUDA' => 5561,
        'DISIQIUXIAO' => 5562,
        'DISIQIUDAN' => 5563,
        'DISIQIUSHUANG' => 5564,
        'DIWUQIU0' => 5565,
        'DIWUQIU1' => 5566,
        'DIWUQIU2' => 5567,
        'DIWUQIU3' => 5568,
        'DIWUQIU4' => 5569,
        'DIWUQIU5' => 5570,
        'DIWUQIU6' => 5571,
        'DIWUQIU7' => 5572,
        'DIWUQIU8' => 5573,
        'DIWUQIU9' => 5574,
        'DIWUQIUDA' => 5575,
        'DIWUQIUXIAO' => 5576,
        'DIWUQIUDAN' => 5577,
        'DIWUQIUSHUANG' => 5578,
        'QIANSANBAOZI' => 5579,
        'QIANSANSHUNZI' => 5580,
        'QIANSANDUIZI' => 5581,
        'QIANSANBANSHUN' => 5582,
        'QIANSANZALIU' => 5583,
        'ZHONGSANBAOZI' => 5584,
        'ZHONGSANSHUNZI' => 5585,
        'ZHONGSANDUIZI' => 5586,
        'ZHONGSANBANSHUN' => 5587,
        'ZHONGSANZALIU' => 5588,
        'HOUSANBAOZI' => 5589,
        'HOUSANSHUNZI' => 5590,
        'HOUSANDUIZI' => 5591,
        'HOUSANBANSHUN' => 5592,
        'HOUSANZALIU' => 5593
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
        $table = 'game_ksssc';
        $gameName = '快速时时彩';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'ksssc killing...');
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

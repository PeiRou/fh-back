<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/5/20
 * Time: 下午4:43
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryKL8;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Xykl8 extends Excel
{
    protected $arrPlay_id = array(8341110000,8341110001,8341110002,8341110003,8341110004,8341110005,8341110006,8341110007,8341110008,8341210009,8341210010,8341210011,8341310012,8341310013,8341310014,8341410015,8341410016,8341410017,8341410018,8341410019,8341510020,8341510021,8341510022,8341510023,8341510024,8341510025,8341510026,8341510027,8341510028,8341510029,8341510030,8341510031,8341510032,8341510033,8341510034,8341510035,8341510036,8341510037,8341510038,8341510039,8341510040,8341510041,8341510042,8341510043,8341510044,8341510045,8341510046,8341510047,8341510048,8341510049,8341510050,8341510051,8341510052,8341510053,8341510054,8341510055,8341510056,8341510057,8341510058,8341510059,8341510060,8341510061,8341510062,8341510063,8341510064,8341510065,8341510066,8341510067,8341510068,8341510069,8341510070,8341510071,8341510072,8341510073,8341510074,8341510075,8341510076,8341510077,8341510078,8341510079,8341510080,8341510081,8341510082,8341510083,8341510084,8341510085,8341510086,8341510087,8341510088,8341510089,8341510090,8341510091,8341510092,8341510093,8341510094,8341510095,8341510096,8341510097,8341510098,8341510099);
    protected $arrPlayCate = array(
        'ZH' => 411,
        'QHH' => 412,
        'DSH' => 413,
        'WX' => 414,
        'ZM' => 415,
    );
    protected $arrPlayId = array(
        'ZONGHEDA' =>10000,
        'ZONGHEXIAO' =>10001,
        'ZONGHEDAN' =>10002,
        'ZONGHESHUANG' =>10003,
        'ZONGHE810' =>10004,
        'ZONGDADAN' =>10005,
        'ZONGDASHUANG' =>10006,
        'ZONGXIAODAN' =>10007,
        'ZONGXIAOSHUANG' =>10008,
        'QIAN_DUO' =>10009,
        'HOU_DUO' =>10010,
        'QIANHOUHE' =>10011,
        'DAN_DUO' =>10012,
        'SHUANG_DUO' =>10013,
        'DANSHUANG_HE' =>10014,
        'JIN' =>10015,
        'MU' =>10016,
        'SHUI' =>10017,
        'HUO' =>10018,
        'TU' =>10019,
        'ZHENGMA1' =>10020,
        'ZHENGMA2' =>10021,
        'ZHENGMA3' =>10022,
        'ZHENGMA4' =>10023,
        'ZHENGMA5' =>10024,
        'ZHENGMA6' =>10025,
        'ZHENGMA7' =>10026,
        'ZHENGMA8' =>10027,
        'ZHENGMA9' =>10028,
        'ZHENGMA10' =>10029,
        'ZHENGMA11' =>10030,
        'ZHENGMA12' =>10031,
        'ZHENGMA13' =>10032,
        'ZHENGMA14' =>10033,
        'ZHENGMA15' =>10034,
        'ZHENGMA16' =>10035,
        'ZHENGMA17' =>10036,
        'ZHENGMA18' =>10037,
        'ZHENGMA19' =>10038,
        'ZHENGMA20' =>10039,
        'ZHENGMA21' =>10040,
        'ZHENGMA22' =>10041,
        'ZHENGMA23' =>10042,
        'ZHENGMA24' =>10043,
        'ZHENGMA25' =>10044,
        'ZHENGMA26' =>10045,
        'ZHENGMA27' =>10046,
        'ZHENGMA28' =>10047,
        'ZHENGMA29' =>10048,
        'ZHENGMA30' =>10049,
        'ZHENGMA31' =>10050,
        'ZHENGMA32' =>10051,
        'ZHENGMA33' =>10052,
        'ZHENGMA34' =>10053,
        'ZHENGMA35' =>10054,
        'ZHENGMA36' =>10055,
        'ZHENGMA37' =>10056,
        'ZHENGMA38' =>10057,
        'ZHENGMA39' =>10058,
        'ZHENGMA40' =>10059,
        'ZHENGMA41' =>10060,
        'ZHENGMA42' =>10061,
        'ZHENGMA43' =>10062,
        'ZHENGMA44' =>10063,
        'ZHENGMA45' =>10064,
        'ZHENGMA46' =>10065,
        'ZHENGMA47' =>10066,
        'ZHENGMA48' =>10067,
        'ZHENGMA49' =>10068,
        'ZHENGMA50' =>10069,
        'ZHENGMA51' =>10070,
        'ZHENGMA52' =>10071,
        'ZHENGMA53' =>10072,
        'ZHENGMA54' =>10073,
        'ZHENGMA55' =>10074,
        'ZHENGMA56' =>10075,
        'ZHENGMA57' =>10076,
        'ZHENGMA58' =>10077,
        'ZHENGMA59' =>10078,
        'ZHENGMA60' =>10079,
        'ZHENGMA61' =>10080,
        'ZHENGMA62' =>10081,
        'ZHENGMA63' =>10082,
        'ZHENGMA64' =>10083,
        'ZHENGMA65' =>10084,
        'ZHENGMA66' =>10085,
        'ZHENGMA67' =>10086,
        'ZHENGMA68' =>10087,
        'ZHENGMA69' =>10088,
        'ZHENGMA70' =>10089,
        'ZHENGMA71' =>10090,
        'ZHENGMA72' =>10091,
        'ZHENGMA73' =>10092,
        'ZHENGMA74' =>10093,
        'ZHENGMA75' =>10094,
        'ZHENGMA76' =>10095,
        'ZHENGMA77' =>10096,
        'ZHENGMA78' =>10097,
        'ZHENGMA79' =>10098,
        'ZHENGMA80' =>10099,
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $KL8 = new ExcelLotteryKL8();
        $KL8->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $KL8->ZM($openCode,$gameId,$win);
        $KL8->ZH($openCode,$gameId,$win);
        $KL8->QHH($openCode,$gameId,$win);
        $KL8->DSH($openCode,$gameId,$win);
        $KL8->WX($openCode,$gameId,$win);
        return $win;
    }
    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_xykl8';
        $gameName = '幸运快乐八';
        $betCount = DB::table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $win = $this->exc_play($openCode,$gameId);
            $bunko = $this->bunko($win,$gameId,$issue,false,$this->arrPlay_id,true);
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id,true);
                if($updateUserMoney == 1){
                    writeLog('New_Bet', $gameName . $issue . "结算出错");
                }
            }
        }
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
                        writeLog('New_Bet',$gameName.$issue.'退水中失败！');
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
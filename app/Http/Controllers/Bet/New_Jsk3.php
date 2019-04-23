<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/7/27
 * Time: 下午9:48
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryK3;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Jsk3 extends Excel
{
    protected $arrPlay_id = array(102144279,102144280,102144281,102144282,102144283,102144284,102144285,102144286,102144287,102144288,102144289,102144290,102144291,102144292,102144293,102144294,102144295,102144296,102144297,102144298,102154299,102154300,102154301,102154302,102154303,102164304,102164305,102164306,102164307,102164308,102164309,102164310,102174311,102174312,102174313,102174314,102174315,102174316,102184317,102184318,102184319,102184320,102184321,102184322,102184323,102184324,102184325,102184326,102194327,102194328,102194329,102194330,102194331,102194332,102194333,102194334,102194335,102194336,102194337,102194338,102194339,102194340,102204341,102204342,102204343,102204344,102204345,102204346,102214347,102214348,102214349,102214350,102214351,102214352);
    protected $arrPlayCate = array(
        'HZ' =>214,
        'SLH' =>215,
        'STH' =>216,
        'ETH' =>217,
        'KD' =>218,
        'PD' =>219,
        'BUCHM' =>220,
        'BICHM' =>221,
    );
    protected $arrPlayId = array(
        'HEZHI3' => 4279,
        'HEZHI4' => 4280,
        'HEZHI5' => 4281,
        'HEZHI6' => 4282,
        'HEZHI7' => 4283,
        'HEZHI8' => 4284,
        'HEZHI9' => 4285,
        'HEZHI10' => 4286,
        'HEZHI11' => 4287,
        'HEZHI12' => 4288,
        'HEZHI13' => 4289,
        'HEZHI14' => 4290,
        'HEZHI15' => 4291,
        'HEZHI16' => 4292,
        'HEZHI17' => 4293,
        'HEZHI18' => 4294,
        'HEZHIDA' => 4295,
        'HEZHIXIAO' => 4296,
        'HEZHIDAN' => 4297,
        'HEZHISHUANG' => 4298,
        'SANLIANHAO123' => 4299,
        'SANLIANHAO234' => 4300,
        'SANLIANHAO345' => 4301,
        'SANLIANHAO456' => 4302,
        'SANLIANTONGXUAN' => 4303,
        'SANTONGHAO111' => 4304,
        'SANTONGHAO222' => 4305,
        'SANTONGHAO333' => 4306,
        'SANTONGHAO444' => 4307,
        'SANTONGHAO555' => 4308,
        'SANTONGHAO666' => 4309,
        'SANTONGTONGXUAN' => 4310,
        'ERTONGHAO11' => 4311,
        'ERTONGHAO22' => 4312,
        'ERTONGHAO33' => 4313,
        'ERTONGHAO44' => 4314,
        'ERTONGHAO55' => 4315,
        'ERTONGHAO66' => 4316,
        'KUADU0' => 4317,
        'KUADU1' => 4318,
        'KUADU2' => 4319,
        'KUADU3' => 4320,
        'KUADU4' => 4321,
        'KUADU5' => 4322,
        'KUADUDA' => 4323,
        'KUADUXIAO' => 4324,
        'KUADUDAN' => 4325,
        'KUADUSHUANG' => 4326,
        'PAIDIAN1' => 4327,
        'PAIDIAN2' => 4328,
        'PAIDIAN3' => 4329,
        'PAIDIAN4' => 4330,
        'PAIDIAN5' => 4331,
        'PAIDIAN6' => 4332,
        'PAIDIAN7' => 4333,
        'PAIDIAN8' => 4334,
        'PAIDIAN9' => 4335,
        'PAIDIAN10' => 4336,
        'PAIDIANDA' => 4337,
        'PAIDIANXIAO' => 4338,
        'PAIDIANDAN' => 4339,
        'PAIDIANSHUANG' => 4340,
        'BUCHUHAOMA1' => 4341,
        'BUCHUHAOMA2' => 4342,
        'BUCHUHAOMA3' => 4343,
        'BUCHUHAOMA4' => 4344,
        'BUCHUHAOMA5' => 4345,
        'BUCHUHAOMA6' => 4346,
        'BICHUHAOMA1' => 4347,
        'BICHUHAOMA2' => 4348,
        'BICHUHAOMA3' => 4349,
        'BICHUHAOMA4' => 4350,
        'BICHUHAOMA5' => 4351,
        'BICHUHAOMA6' => 4352,
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $K3 = new ExcelLotteryK3();
        $K3->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $K3->HZ($gameId,$win); //和值
        $K3->SLH($gameId,$win); //三连号
        $K3->STH($gameId,$win); //三同号
        $K3->ETH($gameId,$win); //二同号
        $K3->KD($gameId,$win); //跨度
        $K3->PD($gameId,$win); //牌点
        $K3->BUCHU($openCode,$gameId,$win); //不出号码
        $K3->BICHU($openCode,$gameId,$win); //必出号码
        return $win;
    }
    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_jsk3';
        $gameName = '江苏快3';
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
                    \Log::info($gameName.$issue.'退水前失败！');
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
                    \Log::info($gameName.$issue.'退水前失败！');
            }else{//代理退水
                $agentJob = new AgentBackwaterJob($gameId,$issue);
                $agentJob->addQueue();
            }
        }
    }
}
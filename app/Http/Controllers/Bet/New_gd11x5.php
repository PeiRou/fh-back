<?php

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLottery11X5;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_gd11x5 extends Excel
{
    protected $arrPlay_id = array(2126143,2126144,2126145,2126146,2126147,2126148,2126149,2126150,2127151,2127152,2127153,2127154,2127155,2127156,2127157,2127158,2127159,2127160,2127161,2127162,2127163,2127164,2127165,2128166,2128167,2128168,2128169,2128170,2128171,2128172,2128173,2128174,2128175,2128176,2128177,2128178,2128179,2128180,2129181,2129182,2129183,2129184,2129185,2129186,2129187,2129188,2129189,2129190,2129191,2129192,2129193,2129194,2129195,2130196,2130197,2130198,2130199,2130200,2130201,2130202,2130203,2130204,2130205,2130206,2130207,2130208,2130209,2130210,2131211,2131212,2131213,2131214,2131215,2131216,2131217,2131218,2131219,2131220,2131221,2131222,2131223,2131224,2131225,2132226,2132227,2132228,2132229,2132230,2132231,2132232,2132233,2132234,2132235,2132236,2133237,2133238,2133239,2133240,2133241,2133242,2133243,2133244,2133245,2134246,2134247);
    protected $arrPlayCate = array(
        'ZH' => 26,
        'QIU1' => 27,
        'QIU2' => 28,
        'QIU3' => 29,
        'QIU4' => 30,
        'QIU5' => 31,
        'YZY' => 32,
        'LIANMA' => 33,
        'ZHIXUAN' => 34,
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 143,
        'ZONGHEDAN' => 144,
        'ZONGHEWEIDA' => 145,
        'LONG' => 146,
        'ZONGHEXIAO' => 147,
        'ZONGHESHUANG' => 148,
        'ZONGHEWEIXIAO' => 149,
        'HU' => 150,
        'DIYIQIU1' => 151,
        'DIYIQIU2' => 152,
        'DIYIQIU3' => 153,
        'DIYIQIU4' => 154,
        'DIYIQIU5' => 155,
        'DIYIQIU6' => 156,
        'DIYIQIU7' => 157,
        'DIYIQIU8' => 158,
        'DIYIQIU9' => 159,
        'DIYIQIU10' => 160,
        'DIYIQIU11' => 161,
        'DIYIQIUDA' => 162,
        'DIYIQIUXIAO' => 163,
        'DIYIQIUDAN' => 164,
        'DIYIQIUSHUANG' => 165,
        'DIERQIU1' => 166,
        'DIERQIU2' => 167,
        'DIERQIU3' => 168,
        'DIERQIU4' => 169,
        'DIERQIU5' => 170,
        'DIERQIU6' => 171,
        'DIERQIU7' => 172,
        'DIERQIU8' => 173,
        'DIERQIU9' => 174,
        'DIERQIU10' => 175,
        'DIERQIU11' => 176,
        'DIERQIUDA' => 177,
        'DIERQIUXIAO' => 178,
        'DIERQIUDAN' => 179,
        'DIERQIUSHUANG' => 180,
        'DISANQIU1' => 181,
        'DISANQIU2' => 182,
        'DISANQIU3' => 183,
        'DISANQIU4' => 184,
        'DISANQIU5' => 185,
        'DISANQIU6' => 186,
        'DISANQIU7' => 187,
        'DISANQIU8' => 188,
        'DISANQIU9' => 189,
        'DISANQIU10' => 190,
        'DISANQIU11' => 191,
        'DISANQIUDA' => 192,
        'DISANQIUXIAO' => 193,
        'DISANQIUDAN' => 194,
        'DISANQIUSHUANG' => 195,
        'DISIQIU1' => 196,
        'DISIQIU2' => 197,
        'DISIQIU3' => 198,
        'DISIQIU4' => 199,
        'DISIQIU5' => 200,
        'DISIQIU6' => 201,
        'DISIQIU7' => 202,
        'DISIQIU8' => 203,
        'DISIQIU9' => 204,
        'DISIQIU10' => 205,
        'DISIQIU11' => 206,
        'DISIQIUDA' => 207,
        'DISIQIUXIAO' => 208,
        'DISIQIUDAN' => 209,
        'DISIQIUSHUANG' => 210,
        'DIWUQIU1' => 211,
        'DIWUQIU2' => 212,
        'DIWUQIU3' => 213,
        'DIWUQIU4' => 214,
        'DIWUQIU5' => 215,
        'DIWUQIU6' => 216,
        'DIWUQIU7' => 217,
        'DIWUQIU8' => 218,
        'DIWUQIU9' => 219,
        'DIWUQIU10' => 220,
        'DIWUQIU11' => 221,
        'DIWUQIUDA' => 222,
        'DIWUQIUXIAO' => 223,
        'DIWUQIUDAN' => 224,
        'DIWUQIUSHUANG' => 225,
        'YIZHONGYI1' => 226,
        'YIZHONGYI2' => 227,
        'YIZHONGYI3' => 228,
        'YIZHONGYI4' => 229,
        'YIZHONGYI5' => 230,
        'YIZHONGYI6' => 231,
        'YIZHONGYI7' => 232,
        'YIZHONGYI8' => 233,
        'YIZHONGYI9' => 234,
        'YIZHONGYI10' => 235,
        'YIZHONGYI11' => 236,
        'RENXUANERZHONGER' => 237,
        'RENXUANSANZHONGSAN' => 238,
        'RENXUANSIZHONGSI' => 239,
        'RENXUANWUZHONGWU' => 240,
        'RENXUANLIUZHONGWU' => 241,
        'RENXUANQIZHONGWU' => 242,
        'RENXUANBAZHONGWU' => 243,
        'QIANERZUXUAN' => 244,
        'QIANSANZUXUAN' => 245,
        'QIANERZHIXUAN' => 246,
        'QIANSANZHIXUAN' => 247,
    );

    protected function exc_play($openCode,$gameId)
    {
        $win = collect([]);
        $ids_he = collect([]);
        $a11X5 = new ExcelLottery11X5();
        $a11X5->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $a11X5->LM($gameId,$win,$ids_he);
        return array('win'=>$win,'ids_he'=>$ids_he,'11X5'=>$a11X5);
    }
    public function all($openCode,$issue,$id,$excel,$code,$lotterys)
    {
        $gameId = $lotterys['gameId'];
        $table = $lotterys['table'];
        $gameName = $lotterys['lottery'];

        $betCount = DB::table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $bunko = 0;
            $resData = $this->exc_play($openCode,$gameId);
            $win = @$resData['win'];
            $he = isset($resData['ids_he'])?$resData['ids_he']:array();
            $a11X5 = isset($resData['11X5'])?$resData['11X5']:null;
            try{
                $bunko = $this->bunko_gd11x5($win,$gameId,$issue,$openCode,$he,$a11X5);
            }catch (\exception $exception){
                writeLog('New_Bet', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->update(['status' => 0,'bunko' => 0]);
            }
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id,true);
                if($updateUserMoney == 1){
                    writeLog('New_Bet', $gameName . $issue . "结算出错");
                }
            }
        }
        $update = DB::table($table)->where('id',$id)->where('is_open',1)->where('bunko',2)->update([
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

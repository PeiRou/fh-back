<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/4/5
 * Time: 上午9:19
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySSC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Xjssc extends Excel
{
    protected $arrPlay_id = array(494248,494249,494250,494251,494252,494253,494254,495255,495256,495257,495258,495259,495260,495261,495262,495263,495264,495265,495266,495267,495268,496269,496270,496271,496272,496273,496274,496275,496276,496277,496278,496279,496280,496281,496282,497283,497284,497285,497286,497287,497288,497289,497290,497291,497292,497293,497294,497295,497296,498297,498298,498299,498300,498301,498302,498303,498304,498305,498306,498307,498308,498309,498310,499311,499312,499313,499314,499315,499316,499317,499318,499319,499320,499321,499322,499323,499324,4100325,4100326,4100327,4100328,4100329,4101330,4101331,4101332,4101333,4101334,4102335,4102336,4102337,4102338,4102339);
    protected $arrPlayCate = array(
        'ZONGHELONGHUHE' =>94,
        'DIYIQIU' =>95,
        'DIERQIU' =>96,
        'DISANQIU' =>97,
        'DISIQIU' =>98,
        'DIWUQIU' =>99,
        'QIANSAN' =>100,
        'ZHONGSAN' =>101,
        'HOUSAN' =>102,
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 248,
        'ZONGHEXIAO' => 249,
        'ZONGHEDAN' => 250,
        'ZONGHESHUANG' => 251,
        'LONG' => 252,
        'HU' => 253,
        'HE' => 254,
        'DIYIQIU0' => 255,
        'DIYIQIU1' => 256,
        'DIYIQIU2' => 257,
        'DIYIQIU3' => 258,
        'DIYIQIU4' => 259,
        'DIYIQIU5' => 260,
        'DIYIQIU6' => 261,
        'DIYIQIU7' => 262,
        'DIYIQIU8' => 263,
        'DIYIQIU9' => 264,
        'DIYIQIUDA' => 265,
        'DIYIQIUXIAO' => 266,
        'DIYIQIUDAN' => 267,
        'DIYIQIUSHUANG' => 268,
        'DIERQIU0' => 269,
        'DIERQIU1' => 270,
        'DIERQIU2' => 271,
        'DIERQIU3' => 272,
        'DIERQIU4' => 273,
        'DIERQIU5' => 274,
        'DIERQIU6' => 275,
        'DIERQIU7' => 276,
        'DIERQIU8' => 277,
        'DIERQIU9' => 278,
        'DIERQIUDA' => 279,
        'DIERQIUXIAO' => 280,
        'DIERQIUDAN' => 281,
        'DIERQIUSHUANG' => 282,
        'DISANQIU0' => 283,
        'DISANQIU1' => 284,
        'DISANQIU2' => 285,
        'DISANQIU3' => 286,
        'DISANQIU4' => 287,
        'DISANQIU5' => 288,
        'DISANQIU6' => 289,
        'DISANQIU7' => 290,
        'DISANQIU8' => 291,
        'DISANQIU9' => 292,
        'DISANQIUDA' => 293,
        'DISANQIUXIAO' => 294,
        'DISANQIUDAN' => 295,
        'DISANQIUSHUANG' => 296,
        'DISIQIU0' => 297,
        'DISIQIU1' => 298,
        'DISIQIU2' => 299,
        'DISIQIU3' => 300,
        'DISIQIU4' => 301,
        'DISIQIU5' => 302,
        'DISIQIU6' => 303,
        'DISIQIU7' => 304,
        'DISIQIU8' => 305,
        'DISIQIU9' => 306,
        'DISIQIUDA' => 307,
        'DISIQIUXIAO' => 308,
        'DISIQIUDAN' => 309,
        'DISIQIUSHUANG' => 310,
        'DIWUQIU0' => 311,
        'DIWUQIU1' => 312,
        'DIWUQIU2' => 313,
        'DIWUQIU3' => 314,
        'DIWUQIU4' => 315,
        'DIWUQIU5' => 316,
        'DIWUQIU6' => 317,
        'DIWUQIU7' => 318,
        'DIWUQIU8' => 319,
        'DIWUQIU9' => 320,
        'DIWUQIUDA' => 321,
        'DIWUQIUXIAO' => 322,
        'DIWUQIUDAN' => 323,
        'DIWUQIUSHUANG' => 324,
        'QIANSANBAOZI' => 325,
        'QIANSANSHUNZI' => 326,
        'QIANSANDUIZI' => 327,
        'QIANSANBANSHUN' => 328,
        'QIANSANZALIU' => 329,
        'ZHONGSANBAOZI' => 330,
        'ZHONGSANSHUNZI' => 331,
        'ZHONGSANDUIZI' => 332,
        'ZHONGSANBANSHUN' => 333,
        'ZHONGSANZALIU' => 334,
        'HOUSANBAOZI' => 335,
        'HOUSANSHUNZI' => 336,
        'HOUSANDUIZI' => 337,
        'HOUSANBANSHUN' => 338,
        'HOUSANZALIU' => 339
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
    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_xjssc';
        $gameName = '新疆时时彩';
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
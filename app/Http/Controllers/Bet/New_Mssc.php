<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/4/4
 * Time: 上午12:16
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Mssc extends Excel
{
    protected $arrPlay_id = array(801122163,801122164,801122165,801122166,801122167,801122168,801122169,801122170,801122171,801122172,801122173,801122174,801122175,801122176,801122177,801122178,801122179,801122180,801122181,801122182,801122183,801132184,801132185,801132186,801132187,801132188,801132189,801132190,801132191,801132192,801132193,801132194,801132195,801132196,801132197,801132198,801132199,801142200,801142201,801142202,801142203,801142204,801142205,801142206,801142207,801142208,801142209,801142210,801142211,801142212,801142213,801142214,801142215,801152216,801152217,801152218,801152219,801152220,801152221,801152222,801152223,801152224,801152225,801152226,801152227,801152228,801152229,801152230,801152231,801162232,801162233,801162234,801162235,801162236,801162237,801162238,801162239,801162240,801162241,801162242,801162243,801162244,801162245,801162246,801162247,801172248,801172249,801172250,801172251,801172252,801172253,801172254,801172255,801172256,801172257,801172258,801172259,801172260,801172261,801172262,801172263,801182264,801182265,801182266,801182267,801182268,801182269,801182270,801182271,801182272,801182273,801182274,801182275,801182276,801182277,801192278,801192279,801192280,801192281,801192282,801192283,801192284,801192285,801192286,801192287,801192288,801192289,801192290,801192291,801202292,801202293,801202294,801202295,801202296,801202297,801202298,801202299,801202300,801202301,801202302,801202303,801202304,801202305,801212306,801212307,801212308,801212309,801212310,801212311,801212312,801212313,801212314,801212315,801212316,801212317,801212318,801212319,801222320,801222321,801222322,801222323,801222324,801222325,801222326,801222327,801222328,801222329,801222330,801222331,801222332,801222333);
    protected $arrPlayCate = array(
        'GUANYAJUNHE' =>112,
        'GUANJUN' =>113,
        'YAJUN' =>114,
        'DISANMING' =>115,
        'DISIMING' =>116,
        'DIWUMING' =>117,
        'DILIUMING' =>118,
        'DIQIMING' =>119,
        'DIBAMING' =>120,
        'DIJIUMING' =>121,
        'DISHIMING' =>122
    );
    protected $arrPlayId = array(
        'GUANYADA' => 2163,
        'GUANYAXIAO' => 2164,
        'GUANYADAN' => 2165,
        'GUANYASHUANG' => 2166,
        'GUANYAJUNHE3' => 2167,
        'GUANYAJUNHE4' => 2168,
        'GUANYAJUNHE5' => 2169,
        'GUANYAJUNHE6' => 2170,
        'GUANYAJUNHE7' => 2171,
        'GUANYAJUNHE8' => 2172,
        'GUANYAJUNHE9' => 2173,
        'GUANYAJUNHE10' => 2174,
        'GUANYAJUNHE11' => 2175,
        'GUANYAJUNHE12' => 2176,
        'GUANYAJUNHE13' => 2177,
        'GUANYAJUNHE14' => 2178,
        'GUANYAJUNHE15' => 2179,
        'GUANYAJUNHE16' => 2180,
        'GUANYAJUNHE17' => 2181,
        'GUANYAJUNHE18' => 2182,
        'GUANYAJUNHE19' => 2183,
        'LIANGMIANGUANJUNDA' => 2184,
        'LIANGMIANGUANJUNXIAO' => 2185,
        'LIANGMIANGUANJUNDAN' => 2186,
        'LIANGMIANGUANJUNSHUANG' => 2187,
        'LIANGMIANGUANJUNLONG' => 2188,
        'LIANGMIANGUANJUNHU' => 2189,
        'DANHAOGUANJUN1' => 2190,
        'DANHAOGUANJUN2' => 2191,
        'DANHAOGUANJUN3' => 2192,
        'DANHAOGUANJUN4' => 2193,
        'DANHAOGUANJUN5' => 2194,
        'DANHAOGUANJUN6' => 2195,
        'DANHAOGUANJUN7' => 2196,
        'DANHAOGUANJUN8' => 2197,
        'DANHAOGUANJUN9' => 2198,
        'DANHAOGUANJUN10' => 2199,
        'LIANGMIANYAJUNDA' => 2200,
        'LIANGMIANYAJUNXIAO' => 2201,
        'LIANGMIANYAJUNDAN' => 2202,
        'LIANGMIANYAJUNSHUANG' => 2203,
        'LIANGMIANYAJUNLONG' => 2204,
        'LIANGMIANYAJUNHU' => 2205,
        'DANHAOYAJUN1' => 2206,
        'DANHAOYAJUN2' => 2207,
        'DANHAOYAJUN3' => 2208,
        'DANHAOYAJUN4' => 2209,
        'DANHAOYAJUN5' => 2210,
        'DANHAOYAJUN6' => 2211,
        'DANHAOYAJUN7' => 2212,
        'DANHAOYAJUN8' => 2213,
        'DANHAOYAJUN9' => 2214,
        'DANHAOYAJUN10' => 2215,
        'LIANGMIANDISANMINGDA' => 2216,
        'LIANGMIANDISANMINGXIAO' => 2217,
        'LIANGMIANDISANMINGDAN' => 2218,
        'LIANGMIANDISANMINGSHUANG' => 2219,
        'LIANGMIANDISANMINGLONG' => 2220,
        'LIANGMIANDISANMINGHU' => 2221,
        'DANHAODISANMING1' => 2222,
        'DANHAODISANMING2' => 2223,
        'DANHAODISANMING3' => 2224,
        'DANHAODISANMING4' => 2225,
        'DANHAODISANMING5' => 2226,
        'DANHAODISANMING6' => 2227,
        'DANHAODISANMING7' => 2228,
        'DANHAODISANMING8' => 2229,
        'DANHAODISANMING9' => 2230,
        'DANHAODISANMING10' => 2231,
        'LIANGMIANDISIMINGDA' => 2232,
        'LIANGMIANDISIMINGXIAO' => 2233,
        'LIANGMIANDISIMINGDAN' => 2234,
        'LIANGMIANDISIMINGSHUANG' => 2235,
        'LIANGMIANDISIMINGLONG' => 2236,
        'LIANGMIANDISIMINGHU' => 2237,
        'DANHAODISIMING1' => 2238,
        'DANHAODISIMING2' => 2239,
        'DANHAODISIMING3' => 2240,
        'DANHAODISIMING4' => 2241,
        'DANHAODISIMING5' => 2242,
        'DANHAODISIMING6' => 2243,
        'DANHAODISIMING7' => 2244,
        'DANHAODISIMING8' => 2245,
        'DANHAODISIMING9' => 2246,
        'DANHAODISIMING10' => 2247,
        'LIANGMIANDIWUMINGDA' => 2248,
        'LIANGMIANDIWUMINGXIAO' => 2249,
        'LIANGMIANDIWUMINGDAN' => 2250,
        'LIANGMIANDIWUMINGSHUANG' => 2251,
        'LIANGMIANDIWUMINGLONG' => 2252,
        'LIANGMIANDIWUMINGHU' => 2253,
        'DANHAODIWUMING1' => 2254,
        'DANHAODIWUMING2' => 2255,
        'DANHAODIWUMING3' => 2256,
        'DANHAODIWUMING4' => 2257,
        'DANHAODIWUMING5' => 2258,
        'DANHAODIWUMING6' => 2259,
        'DANHAODIWUMING7' => 2260,
        'DANHAODIWUMING8' => 2261,
        'DANHAODIWUMING9' => 2262,
        'DANHAODIWUMING10' => 2263,
        'LIANGMIANDILIUMINGDA' => 2264,
        'LIANGMIANDILIUMINGXIAO' => 2265,
        'LIANGMIANDILIUMINGDAN' => 2266,
        'LIANGMIANDILIUMINGSHUANG' => 2267,
        'DANHAODILIUMING1' => 2268,
        'DANHAODILIUMING2' => 2269,
        'DANHAODILIUMING3' => 2270,
        'DANHAODILIUMING4' => 2271,
        'DANHAODILIUMING5' => 2272,
        'DANHAODILIUMING6' => 2273,
        'DANHAODILIUMING7' => 2274,
        'DANHAODILIUMING8' => 2275,
        'DANHAODILIUMING9' => 2276,
        'DANHAODILIUMING10' => 2277,
        'LIANGMIANDIQIMINGDA' => 2278,
        'LIANGMIANDIQIMINGXIAO' => 2279,
        'LIANGMIANDIQIMINGDAN' => 2280,
        'LIANGMIANDIQIMINGSHUANG' => 2281,
        'DANHAODIQIMING1' => 2282,
        'DANHAODIQIMING2' => 2283,
        'DANHAODIQIMING3' => 2284,
        'DANHAODIQIMING4' => 2285,
        'DANHAODIQIMING5' => 2286,
        'DANHAODIQIMING6' => 2287,
        'DANHAODIQIMING7' => 2288,
        'DANHAODIQIMING8' => 2289,
        'DANHAODIQIMING9' => 2290,
        'DANHAODIQIMING10' => 2291,
        'LIANGMIANDIBAMINGDA' => 2292,
        'LIANGMIANDIBAMINGXIAO' => 2293,
        'LIANGMIANDIBAMINGDAN' => 2294,
        'LIANGMIANDIBAMINGSHUANG' => 2295,
        'DANHAODIBAMING1' => 2296,
        'DANHAODIBAMING2' => 2297,
        'DANHAODIBAMING3' => 2298,
        'DANHAODIBAMING4' => 2299,
        'DANHAODIBAMING5' => 2300,
        'DANHAODIBAMING6' => 2301,
        'DANHAODIBAMING7' => 2302,
        'DANHAODIBAMING8' => 2303,
        'DANHAODIBAMING9' => 2304,
        'DANHAODIBAMING10' => 2305,
        'LIANGMIANDIJIUMINGDA' => 2306,
        'LIANGMIANDIJIUMINGXIAO' => 2307,
        'LIANGMIANDIJIUMINGDAN' => 2308,
        'LIANGMIANDIJIUMINGSHUANG' => 2309,
        'DANHAODIJIUMING1' => 2310,
        'DANHAODIJIUMING2' => 2311,
        'DANHAODIJIUMING3' => 2312,
        'DANHAODIJIUMING4' => 2313,
        'DANHAODIJIUMING5' => 2314,
        'DANHAODIJIUMING6' => 2315,
        'DANHAODIJIUMING7' => 2316,
        'DANHAODIJIUMING8' => 2317,
        'DANHAODIJIUMING9' => 2318,
        'DANHAODIJIUMING10' => 2319,
        'LIANGMIANDISHIMINGDA' => 2320,
        'LIANGMIANDISHIMINGXIAO' => 2321,
        'LIANGMIANDISHIMINGDAN' => 2322,
        'LIANGMIANDISHIMINGSHUANG' => 2323,
        'DANHAODISHIMING1' => 2324,
        'DANHAODISHIMING2' => 2325,
        'DANHAODISHIMING3' => 2326,
        'DANHAODISHIMING4' => 2327,
        'DANHAODISHIMING5' => 2328,
        'DANHAODISHIMING6' => 2329,
        'DANHAODISHIMING7' => 2330,
        'DANHAODISHIMING8' => 2331,
        'DANHAODISHIMING9' => 2332,
        'DANHAODISHIMING10' => 2333,
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $SC = new ExcelLotterySC();
        $SC->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $SC->GYH($gameId,$win);
        $SC->GYH_ZD_NUM($gameId,$win);
        $SC->GJ($gameId,$win);
        $SC->YJ($gameId,$win);
        $SC->SAN($gameId,$win);
        $SC->SI($gameId,$win);
        $SC->WU($gameId,$win);
        $SC->LIU($gameId,$win);
        $SC->QI($gameId,$win);
        $SC->BA($gameId,$win);
        $SC->JIU($gameId,$win);
        $SC->SHI($gameId,$win);
        $SC->NUM1($gameId,$win);
        $SC->NUM2($gameId,$win);
        $SC->NUM3($gameId,$win);
        $SC->NUM4($gameId,$win);
        $SC->NUM5($gameId,$win);
        $SC->NUM6($gameId,$win);
        $SC->NUM7($gameId,$win);
        $SC->NUM8($gameId,$win);
        $SC->NUM9($gameId,$win);
        $SC->NUM10($gameId,$win);
        return $win;
    }
    public function all($openCode,$issue,$gameId,$id,$excel)
    {
        $table = 'game_mssc';
        $gameName = '秒速赛车';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'mssc killing...');
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
}
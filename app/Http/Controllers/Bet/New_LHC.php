<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/7/11
 * Time: 下午10:59
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\Helpers\LHC_SX;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_LHC extends Excel
{
    protected $arrPlay_id = array(70641359,70641360,70641361,70641362,70641363,70641364,70641365,70641366,70641367,70641368,70641369,70641370,70641371,70641372,70641373,70641374,70641375,70641376,70641377,70641378,70641379,70641380,70641381,70641382,70641383,70641384,70641385,70641386,70641387,70641388,70641389,70641390,70641391,70641392,70641393,70641394,70641395,70641396,70641397,70641398,70641399,70641400,70641401,70641402,70641403,70641404,70641405,70641406,70641407,70641408,70641409,70641410,70641411,70641412,70641413,70641414,70641415,70641416,70641417,70641418,70641419,70641420,70641421,70641422,70641423,70641424,70641425,70641426,70641427,70641428,70641429,70641430,70641431,70641432,70641433,70641434,70641435,70641436,70641437,70641438,70641439,70641440,70641441,70641442,70641443,70641444,70641445,70641446,70641447,70641448,70641449,70641450,70641451,70641452,70641453,70641454,70641455,70641456,70651457,70651458,70651459,70651460,70651461,70651462,70651463,70651464,70651465,70651466,70651467,70651468,70651469,70651470,70651471,70651472,70651473,70651474,70651475,70651476,70651477,70651478,70651479,70651480,70661481,70661482,70661483,70661484,70661485,70661486,70661487,70661488,70661489,70661490,70661491,70661492,70661493,70661494,70661495,70661496,70661497,70661498,70661499,70661500,70661501,70661502,70661503,70661504,70661505,70661506,70661507,70671508,70671509,70671510,70671511,70671512,70671513,70671514,70671515,70671516,70671517,70671518,70671519,70681520,70681521,70681522,70681523,70681524,70681525,70681526,70681527,70681528,70681529,70691530,70691531,70691532,70691533,70691534,70691535,70691536,70691537,70691538,70691539,70691540,70691541,70691542,70691543,70691544,70701545,70701546,70701547,70701548,70701549,70701550,70701551,70701552,70701553,70701554,70701555,70701556,70701557,70701558,70701559,70701560,70701561,70701562,70701563,70701564,70701565,70701566,70701567,70701568,70701569,70701570,70701571,70701572,70701573,70701574,70701575,70701576,70701577,70701578,70701579,70701580,70701581,70701582,70701583,70701584,70701585,70701586,70701587,70701588,70701589,70701590,70701591,70701592,70701593,70721594,70721595,70721596,70721597,70721598,70731599,70731600,70731601,70731602,70731603,70731604,70731605,70731606,70731607,70731608,70731609,70731610,70731611,70731612,70731613,70731614,70731615,70731616,70731617,70731618,70731619,70731620,70741621,70741622,70741623,70741624,70741625,70741626,70741627,70741628,70741629,70741630,70741631,70741632,70751633,70751634,70751635,70751636,70761637,70761638,70761639,70761640,70761641,70761642,70761643,70761644,70771645,70771646,70771647,70771648,70771649,70771650,70771651,70771652,70781653,70781654,70781655,70781656,70781657,70781658,70781659,70781660,70781661,70781662,70781663,70781664,70781665,70781666,70781667,70781668,70781669,70781670,70781671,70781672,70781673,70781674,70781675,70781676,70781677,70781678,70781679,70781680,70781681,70781682,70781683,70781684,70781685,70781686,70781687,70781688,70781689,70781690,70781691,70781692,70781693,70781694,70781695,70781696,70781697,70781698,70781699,70781700,70781701,70781702,70781703,70781704,70781705,70781706,70781707,70781708,70781709,70781710,70781711,70781712,70781713,70781714,70781715,70781716,70781717,70781718,70781719,70781720,70781721,70781722,70781723,70781724,70781725,70781726,70781727,70781728,70781729,70781730,70781731,70781732,70781733,70781734,70781735,70781736,70781737,70781738,70781739,70781740,70791783,70791784,70791785,70791786,70791787,70791788,70791789,70791790,70711791,70711792,70711793,70711794,70711795,70711796,70711797,70711798,70711799,70711800,70711801,70711802,70711803,70711804,70711805,70711806,70711807,70711808,70711809,70711810,70711811,70711812,70711813,70711814,70711815,70711816,70711817,70711818,70711819,70711820,70711821,70711822,70711823,70711824,70711825,70711826,70711827,70711828,70711829,70711830,70711831,70711832,70711833,70711834,70711835,70711836,70711837,70711838,70711839,70711840,70711841,70711842,70711843,70711844,70711845,70711846,70711847,70711848,70711849,70711850,70711851,70711852,70711853,70711854,70711855,70711856,70711857,70711858,70711859,70711860,70711861,70711862,70711863,70711864,70711865,70711866,70711867,70711868,70711869,70711870,70711871,70711872,70711873,70711874,70711875,70711876,70711877,70711878,70711879,70711880,70711881,70711882,70711883,70711884,70711885,70711886,70711887,70711888,70711889,70711890,70711891,70711892,70711893,70711894,70711895,70711896,70711897,70711898,70711899,70711900,70711901,70711902,70711903,70711904,70711905,70711906,70711907,70711908,70711909,70711910,70711911,70711912,70711913,70711914,70711915,70711916,70711917,70711918,70711919,70711920,70711921,70711922,70711923,70711924,70711925,70711926,70711927,70711928,70711929,70711930,70711931,70711932,70711933,70711934,70711935,70711936,70711937,70711938,70711939,70711940,70711941,70711942,70711943,70711944,70711945,70711946,70711947,70711948,70711949,70711950,70711951,70711952,70711953,70711954,70711955,70711956,70711957,70711958,70711959,70711960,70711961,70711962,70711963,70711964,70711965,70711966,70711967,70711968,70711969,70711970,70711971,70711972,70711973,70711974,70711975,70711976,70711977,70711978,70711979,70711980,70711981,70711982,70711983,70711984,70711985,70711986,70711987,70711988,70711989,70711990,70711991,70711992,70711993,70711994,70711995,70711996,70711997,70711998,70711999,70712000,70712001,70712002,70712003,70712004,70712005,70712006,70712007,70712008,70712009,70712010,70712011,70712012,70712013,70712014,70712015,70712016,70712017,70712018,70712019,70712020,70712021,70712022,70712023,70712024,70712025,70712026,70712027,70712028,70712029,70712030,70712031,70712032,70712033,70712034,70712035,70712036,70712037,70712038,70712039,70712040,70712041,70712042,70712043,70712044,70712045,70712046,70712047,70712048,70712049,70712050,70712051,70712052,70712053,70712054,70712055,70712056,70712057,70712058,70712059,70712060,70712061,70712062,70712063,70712064,70712065,70712066,70712067,70712068,70712069,70712070,70712071,70712072,70712073,70712074,70712075,70712076,70712077,70712078,70712079,70712080,70712081,70712082,70712083,70712084,70712085,70712086,70712087,70712088,70712089,70712090,70712091,70712092,70712093,70712094,70712095,70712096,70712097,70712098,70712099,70712100,70712101,70712102,70712103,70712104,70712105,70712106,70712107,70712108,70712109,70712110,70712111,70712112,70712113,70712114,70712115,70712116,70712117,70712118,70712119,70712120,70712121,70712122,70712123,70712124,70712125,70712126,70712127,70712128,70712129,70712130,70712131,70712132,70712133,70712134,70712135,70712136,70712137,70712138,70712139,70712140,70712141,70712142,70712143,70712144,70712145,70712146,70712147,70712148,70712149,70712150,70712151,70712152,70712153,70712154,70712155,70712156,70712157,70712158,70712159,70712160,70712161,70712162);
    protected $LHC_SX;

    /**
     * New_LHC constructor.
     * @param $LHC_SX
     */
    public function __construct(LHC_SX $LHC_SX)
    {
        $this->LHC_SX = $LHC_SX;
    }

    protected function exc_play($openCode,$gameId){
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

    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_lhc';
        $gameName = '六合彩';
        $betCount = DB::table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $bunko = 0;
            $resData = $this->exc_play($openCode,$gameId);
            $win = @$resData['win'];
            $he = isset($resData['ids_he'])?$resData['ids_he']:array();
            try{
                $bunko = $this->BUNKO_LHC($openCode,$win,$gameId,$issue,$he,false);
            }catch (\exception $exception){
                writeLog('New_Bet', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->update(['status' => 0,'bunko' => 0]);
            }
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName);
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
            $agentJob = new AgentBackwaterJob($gameId,$issue);
            $agentJob->addQueue();
        }
    }
    
    //特码A-B
    public function TM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tm_playCate = 64; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        switch ($tm){
            case 1:
                $playId_B = 1408;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1359;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 2:
                $playId_B = 1409;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1360;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 3:
                $playId_B = 1410;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1361;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 4:
                $playId_B = 1411;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1362;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 5:
                $playId_B = 1412;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1363;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 6:
                $playId_B = 1413;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1364;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 7:
                $playId_B = 1414;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1365;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 8:
                $playId_B = 1415;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1366;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 9:
                $playId_B = 1416;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1367;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                 break;
            case 10:
                $playId_B = 1417;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1368;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 11:
                $playId_B = 1418;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1369;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 12:
                $playId_B = 1419;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1370;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 13:
                $playId_B = 1420;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1371;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 14:
                $playId_B = 1421;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1372;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 15:
                $playId_B = 1422;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1373;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 16:
                $playId_B = 1423;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1374;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 17:
                $playId_B = 1424;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1375;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 18:
                $playId_B = 1425;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1376;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 19:
                $playId_B = 1426;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1377;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 20:
                $playId_B = 1427;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1378;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 21:
                $playId_B = 1428;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1379;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 22:
                $playId_B = 1429;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1380;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 23:
                $playId_B = 1430;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1381;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 24:
                $playId_B = 1431;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1382;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 25:
                $playId_B = 1432;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1383;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 26:
                $playId_B = 1433;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1384;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 27:
                $playId_B = 1434;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1385;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 28:
                $playId_B = 1435;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1386;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 29:
                $playId_B = 1436;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1387;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 30:
                $playId_B = 1437;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1388;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 31:
                $playId_B = 1438;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1389;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 32:
                $playId_B = 1439;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1390;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 33:
                $playId_B = 1440;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1391;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 34:
                $playId_B = 1441;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1392;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 35:
                $playId_B = 1442;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1393;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 36:
                $playId_B = 1443;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1394;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 37:
                $playId_B = 1444;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1395;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 38:
                $playId_B = 1445;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1396;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 39:
                $playId_B = 1446;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1397;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 40:
                $playId_B = 1447;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1398;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 41:
                $playId_B = 1448;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1399;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 42:
                $playId_B = 1449;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1400;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 43:
                $playId_B = 1450;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1401;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 44:
                $playId_B = 1451;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1402;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 45:
                $playId_B = 1452;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1403;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 46:
                $playId_B = 1453;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1404;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 47:
                $playId_B = 1454;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1405;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 48:
                $playId_B = 1455;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1406;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 49:
                $playId_B = 1456;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 1407;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
        }
    }
    
    //两面
    public function LM($openCode,$gameId,$win,$ids_he)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $lm_playCate = 65; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        $ZH = (int)$arrOpenCode[0]+(int)$arrOpenCode[1]+(int)$arrOpenCode[2]+(int)$arrOpenCode[3]+(int)$arrOpenCode[4]+(int)$arrOpenCode[5]+(int)$arrOpenCode[6];
        //特码大小
        if($tm >= 25 && $tm <= 48){ //大
            $playId = 1457;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
            if($tm%2 == 0){ //特大双
                $playId = 1468;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            } else { //特大单
                $playId = 1467;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
        }else if($tm <= 24){
            $playId = 1458;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
            if($tm%2 == 0){ //特小双
                $playId = 1470;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            } else { //特小单
                $playId = 1469;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
        }else{  //和局退本金
            $playId = 1457;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 1458;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //特码单双
        if($tm%2 == 0){ // 双
            $playId = 1460;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($tm%2 != 0 && $tm != 49){
            $playId = 1459;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 1459;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 1460;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //特码合数大小
        $tmBL = str_pad($tm,2,"0",STR_PAD_LEFT); //十位补零
        $chaiTM = str_split($tmBL); //拆分个位 十位
        $TMHS = (int)$chaiTM[0]+(int)$chaiTM[1];
        if($TMHS >= 7 && $tmBL != 49){ //特合大
            $playId = 1461;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($TMHS <= 6 && $tmBL != 49){ //特合小
            $playId = 1462;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 1461;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 1462;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        if($TMHS%2 == 0){ // 双
            $playId = 1464;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($TMHS%2 != 0 && $tmBL != 49){
            $playId = 1463;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 1463;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 1464;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //特天肖 地肖
        $TTX = $this->LHC_SX->shengxiao($tm);
        if($TTX == '兔' || $TTX == '马' || $TTX == '猴' || $TTX == '猪' || $TTX == '牛' || $TTX == '龙'){ //天肖
            $playId = 1471;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TTX == '蛇' || $TTX == '羊' || $TTX == '鸡' || $TTX == '狗' || $TTX == '鼠' || $TTX == '虎'){ //地肖
            $playId = 1472;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特前肖 后肖
        $TQH = $this->LHC_SX->shengxiao($tm);
        if($TQH == '鼠' || $TQH == '牛' || $TQH == '虎' || $TQH == '兔' || $TQH == '龙' || $TQH == '蛇'){ //前肖
            $playId = 1473;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TQH == '马' || $TQH == '羊' || $TQH == '猴' || $TQH == '鸡' || $TQH == '狗' || $TQH == '猪'){ //后肖
            $playId = 1474;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特家肖 野肖
         $TJX = $this->LHC_SX->shengxiao($tm);
        if($TJX == '牛' || $TJX == '马' || $TJX == '羊' || $TJX == '鸡' || $TJX == '狗' || $TJX == '猪'){ //家肖
            $playId = 1475;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TJX == '鼠' || $TJX == '虎' || $TJX == '兔' || $TJX == '龙' || $TJX == '蛇' || $TJX == '猴'){ //野肖
            $playId = 1476;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特尾大 特尾小
        $TW = $chaiTM[1];
        if($TW >= 5 && $tmBL != 49){ //尾大
            $playId = 1465;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($TW <= 4 && $tmBL != 49){
            $playId = 1466;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 1465;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 1466;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //总和大小
        if($ZH >= 175){ //大
            $playId = 1479;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        } else { //小
            $playId = 1480;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //总和单双
        if($ZH%2 == 0){ //双
            $playId = 1478;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 1477;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
    }

    //色波
    public function SB($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $sb_playCate = 66; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        //色波
        if($tm == 1 || $tm == 2 || $tm == 7 || $tm == 8 || $tm == 12 || $tm == 13 || $tm == 18 || $tm == 19 || $tm == 23 || $tm == 24 || $tm == 29 || $tm == 30 || $tm == 34 || $tm == 35 || $tm == 40 || $tm == 45 || $tm == 46){ //红波
            $playId = 1481;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //红双
                $playId = 1485;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //红单
                $playId = 1484;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //红大
                $playId = 1486;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //红大双
                    $playId = 1497;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 红大单
                    $playId = 1496;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //红小
                $playId = 1487;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //红小双
                    $playId = 1499;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 红小单
                    $playId = 1498;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if($tm == 3 || $tm == 4 || $tm == 9 || $tm == 10 || $tm == 14 || $tm == 15 || $tm == 20 || $tm == 25 || $tm == 26 || $tm == 31 || $tm == 36 || $tm == 37 || $tm == 41 || $tm == 42 || $tm == 47 || $tm == 48){ //蓝波
            $playId = 1482;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //蓝双
                $playId = 1489;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //蓝单
                $playId = 1488;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //蓝大
                $playId = 1490;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //蓝大双
                    $playId = 1501;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 蓝大单
                    $playId = 1500;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //蓝小
                $playId = 1491;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //蓝小双
                    $playId = 1503;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 蓝小单
                    $playId = 1502;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if($tm == 5 || $tm == 6 || $tm == 11 || $tm == 16 || $tm == 17 || $tm == 21 || $tm == 22 || $tm == 27 || $tm == 28 || $tm == 32 || $tm == 33 || $tm == 38 || $tm == 39 || $tm == 43 || $tm == 44 || $tm == 49){ //绿波
            $playId = 1483;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //绿双
                $playId = 1493;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //绿单
                $playId = 1492;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //绿大
                $playId = 1494;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //绿大双
                    $playId = 1505;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 绿大单
                    $playId = 1504;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //绿小
                $playId = 1495;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //绿小双
                    $playId = 1507;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 绿小单
                    $playId = 1506;
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
        $tx_playCate = 67; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        if($tm == 7 || $tm == 19 || $tm == 31 || $tm == 43){ //蛇
            $playId = 1513;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 6 || $tm == 18 || $tm == 30 || $tm == 42){ //马
            $playId = 1514;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 5 || $tm == 17 || $tm == 29 || $tm == 41){ //羊
            $playId = 1515;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 4 || $tm == 16 || $tm == 28 || $tm == 40){ //猴
            $playId = 1516;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 3 || $tm == 15 || $tm == 27 || $tm == 39){ //鸡
            $playId = 1517;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 2 || $tm == 14 || $tm == 26 || $tm == 38){ //狗
            $playId = 1518;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 1 || $tm == 13 || $tm == 25 || $tm == 37 || $tm == 49){ //猪
            $playId = 1519;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 12 || $tm == 24 || $tm == 36 || $tm == 48){ // 鼠
            $playId = 1508;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 11 || $tm == 23 || $tm == 35 || $tm == 47){ //牛
            $playId = 1509;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 10 || $tm == 22 || $tm == 34 || $tm == 46){ //虎
            $playId = 1510;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 9 || $tm == 21 || $tm == 33 || $tm == 45){ //兔
            $playId = 1511;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 8 || $tm == 20 || $tm == 32 || $tm == 44){ //龙
            $playId = 1512;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
    }

    //特码头尾数
    public function TMTWS($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tmtws_playCate = 69; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        $tmBL = str_pad($tm,2,"0",STR_PAD_LEFT); //十位补零
        $chaiTM = str_split($tmBL); //拆分个位 十位
        $tou = (int)$chaiTM[0];
        $wei = (int)$chaiTM[1];
        if($tou == 0){
            $playId = 1530;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 1){
            $playId = 1531;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 2){
            $playId = 1532;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 3){
            $playId = 1533;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 4){
            $playId = 1534;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 0){
            $playId = 1544;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 1){
            $playId = 1535;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 2){
            $playId = 1536;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 3){
            $playId = 1537;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 4){
            $playId = 1538;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 5){
            $playId = 1539;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 6){
            $playId = 1540;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 7){
            $playId = 1541;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 8){
            $playId = 1542;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 9){
            $playId = 1543;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
    }

    //正码
    public function ZM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $zm_playCate = 70; //特码分类ID
        $ZM1 = $arrOpenCode[0];
        $ZM2 = $arrOpenCode[1];
        $ZM3 = $arrOpenCode[2];
        $ZM4 = $arrOpenCode[3];
        $ZM5 = $arrOpenCode[4];
        $ZM6 = $arrOpenCode[5];
        $nums = ['1'=>'1545','2'=>'1546','3'=>'1547','4'=>'1548','5'=>'1549','6'=>'1550','7'=>'1551','8'=>'1552','9'=>'1553','10'=>'1554','11'=>'1555','12'=>'1556','13'=>'1557','14'=>'1558','15'=>'1559','16'=>'1560','17'=>'1561','18'=>'1562','19'=>'1563','20'=>'1564','21'=>'1565','22'=>'1566','23'=>'1567','24'=>'1568','25'=>'1569','26'=>'1570','27'=>'1571','28'=>'1572','29'=>'1573','30'=>'1574','31'=>'1575','32'=>'1576','33'=>'1577','34'=>'1578','35'=>'1579','36'=>'1580','37'=>'1581','38'=>'1582','39'=>'1583','40'=>'1584','41'=>'1585','42'=>'1586','43'=>'1587','44'=>'1588','45'=>'1589','46'=>'1590','47'=>'1591','48'=>'1592','49'=>'1593'];
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
        $wx_playCate = 72; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        if($tm == 5 || $tm == 6 || $tm == 19 || $tm == 20 || $tm == 27 || $tm == 28 || $tm == 35 || $tm == 36 || $tm == 49){ //金
            $playId = 1594;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 1 || $tm == 2 || $tm == 9 || $tm == 10 || $tm == 17 || $tm == 18 || $tm == 31 || $tm == 32 || $tm == 39 || $tm == 40 || $tm == 47 || $tm == 48){ //木
            $playId = 1595;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 7 || $tm == 8 || $tm == 15 || $tm == 16 || $tm == 23 || $tm == 24 || $tm == 37 || $tm == 38 || $tm == 45 || $tm == 46){ //水
            $playId = 1596;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 3 || $tm == 4 || $tm == 11 || $tm == 12 || $tm == 25 || $tm == 26 || $tm == 33 || $tm == 34 || $tm == 41 || $tm == 42){ //火
            $playId = 1597;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 13 || $tm == 14 || $tm == 21 || $tm == 22 || $tm == 29 || $tm == 30 || $tm == 43 || $tm == 44){ //土
            $playId = 1598;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
    }

    //七色波
    public function QSB($openCode,$gameId,$win,$ids_he)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $qsb_playCate = 75; //特码分类ID
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
            $playId = 1636;
            $winCode = $gameId.$qsb_playCate.$playId;
            $win->push($winCode);
            //和局退本金
            $playId = 1633;
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 1634;
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 1635;
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
        } else {
            if ($redTotal>$blueTotal&$redTotal>$greenTotal){
                $playId = 1633;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            }else if ($blueTotal>$greenTotal) {
                $playId = 1634;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = 1635;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            }
        }
    }

    //平特一肖位数
    public function PTYXWS($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $ptyxws_playCate = 73; //特码分类ID
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
        $w7 = [7,17,27,36,47];
        $w8 = [8,18,28,38,48];
        $w9 = [9,19,29,39,49];
        if(in_array($m1,$shu) || in_array($m2,$shu) || in_array($m3,$shu) || in_array($m4,$shu) || in_array($m5,$shu) || in_array($m6,$shu) || in_array($m7,$shu)){
            $playId = 1599;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$niu) || in_array($m2,$niu) || in_array($m3,$niu) || in_array($m4,$niu) || in_array($m5,$niu) || in_array($m6,$niu) || in_array($m7,$niu)){
            $playId = 1600;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$hu) || in_array($m2,$hu) || in_array($m3,$hu) || in_array($m4,$hu) || in_array($m5,$hu) || in_array($m6,$hu) || in_array($m7,$hu)){
            $playId = 1601;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$tu) || in_array($m2,$tu) || in_array($m3,$tu) || in_array($m4,$tu) || in_array($m5,$tu) || in_array($m6,$tu) || in_array($m7,$tu)){
            $playId = 1602;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$long) || in_array($m2,$long) || in_array($m3,$long) || in_array($m4,$long) || in_array($m5,$long) || in_array($m6,$long) || in_array($m7,$long)){
            $playId = 1603;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$she) || in_array($m2,$she) || in_array($m3,$she) || in_array($m4,$she) || in_array($m5,$she) || in_array($m6,$she) || in_array($m7,$she)){
            $playId = 1604;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$ma) || in_array($m2,$ma) || in_array($m3,$ma) || in_array($m4,$ma) || in_array($m5,$ma) || in_array($m6,$ma) || in_array($m7,$ma)){
            $playId = 1605;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$yang) || in_array($m2,$yang) || in_array($m3,$yang) || in_array($m4,$yang) || in_array($m5,$yang) || in_array($m6,$yang) || in_array($m7,$yang)){
            $playId = 1606;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$hou) || in_array($m2,$hou) || in_array($m3,$hou) || in_array($m4,$hou) || in_array($m5,$hou) || in_array($m6,$hou) || in_array($m7,$hou)){
            $playId = 1607;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$ji) || in_array($m2,$ji) || in_array($m3,$ji) || in_array($m4,$ji) || in_array($m5,$ji) || in_array($m6,$ji) || in_array($m7,$ji)){
            $playId = 1608;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$gou) || in_array($m2,$gou) || in_array($m3,$gou) || in_array($m4,$gou) || in_array($m5,$gou) || in_array($m6,$gou) || in_array($m7,$gou)){
            $playId = 1609;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$zhu) || in_array($m2,$zhu) || in_array($m3,$zhu) || in_array($m4,$zhu) || in_array($m5,$zhu) || in_array($m6,$zhu) || in_array($m7,$zhu)){
            $playId = 1610;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        //尾数
        if(in_array($m1,$w0) || in_array($m2,$w0) || in_array($m3,$w0) || in_array($m4,$w0) || in_array($m5,$w0) || in_array($m6,$w0) || in_array($m7,$w0)){
            $playId = 1611;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w1) || in_array($m2,$w1) || in_array($m3,$w1) || in_array($m4,$w1) || in_array($m5,$w1) || in_array($m6,$w1) || in_array($m7,$w1)){
            $playId = 1612;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w2) || in_array($m2,$w2) || in_array($m3,$w2) || in_array($m4,$w2) || in_array($m5,$w2) || in_array($m6,$w2) || in_array($m7,$w2)){
            $playId = 1613;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w3) || in_array($m2,$w3) || in_array($m3,$w3) || in_array($m4,$w3) || in_array($m5,$w3) || in_array($m6,$w3) || in_array($m7,$w3)){
            $playId = 1614;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w4) || in_array($m2,$w4) || in_array($m3,$w4) || in_array($m4,$w4) || in_array($m5,$w4) || in_array($m6,$w4) || in_array($m7,$w4)){
            $playId = 1615;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w5) || in_array($m2,$w5) || in_array($m3,$w5) || in_array($m4,$w5) || in_array($m5,$w5) || in_array($m6,$w5) || in_array($m7,$w5)){
            $playId = 1616;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w6) || in_array($m2,$w6) || in_array($m3,$w6) || in_array($m4,$w6) || in_array($m5,$w6) || in_array($m6,$w6) || in_array($m7,$w6)){
            $playId = 1617;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w7) || in_array($m2,$w7) || in_array($m3,$w7) || in_array($m4,$w7) || in_array($m5,$w7) || in_array($m6,$w7) || in_array($m7,$w7)){
            $playId = 1618;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w8) || in_array($m2,$w8) || in_array($m3,$w8) || in_array($m4,$w8) || in_array($m5,$w8) || in_array($m6,$w8) || in_array($m7,$w8)){
            $playId = 1619;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w9) || in_array($m2,$w9) || in_array($m3,$w9) || in_array($m4,$w9) || in_array($m5,$w9) || in_array($m6,$w9) || in_array($m7,$w9)){
            $playId = 1620;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
    }

    //总肖
    public function ZONGXIAO($openCode,$gameId,$win)
    {
        $playCate = 76;
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
            $playId = 1637;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 3){
            $playId = 1638;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 4){
            $playId = 1639;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 5){
            $playId = 1640;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 6){
            $playId = 1641;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 7){
            $playId = 1642;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count%2 == 0){
            $playId = 1644;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 1643;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    //正码特
    public function ZMT($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 71;
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

        $zm1_nums = [1=>1791,2=>1792,3=>1793,4=>1794,5=>1795,6=>1796,7=>1797,8=>1798,9=>1799,10=>1800,11=>1801,12=>1802,13=>1803,14=>1804,15=>1805,16=>1806,17=>1807,18=>1808,19=>1809,20=>1810,21=>1811,22=>1812,23=>1813,24=>1814,25=>1815,26=>1816,27=>1817,28=>1818,29=>1819,30=>1820,31=>1821,32=>1822,33=>1823,34=>1824,35=>1825,36=>1826,37=>1827,38=>1828,39=>1829,40=>1830,41=>1831,42=>1832,43=>1833,44=>1834,45=>1835,46=>1836,47=>1837,48=>1838,49=>1839];
        $zm2_nums = [1=>1853,2=>1854,3=>1855,4=>1856,5=>1857,6=>1858,7=>1859,8=>1860,9=>1861,10=>1862,11=>1863,12=>1864,13=>1865,14=>1866,15=>1867,16=>1868,17=>1869,18=>1870,19=>1871,20=>1872,21=>1873,22=>1874,23=>1875,24=>1876,25=>1877,26=>1878,27=>1879,28=>1880,29=>1881,30=>1882,31=>1883,32=>1884,33=>1885,34=>1886,35=>1887,36=>1888,37=>1889,38=>1890,39=>1891,40=>1892,41=>1893,42=>1894,43=>1895,44=>1896,45=>1897,46=>1898,47=>1899,48=>1900,49=>1901];
        $zm3_nums = [1=>1915,2=>1916,3=>1917,4=>1918,5=>1919,6=>1920,7=>1921,8=>1922,9=>1923,10=>1924,11=>1925,12=>1926,13=>1927,14=>1928,15=>1929,16=>1930,17=>1931,18=>1932,19=>1933,20=>1934,21=>1935,22=>1936,23=>1937,24=>1938,25=>1939,26=>1940,27=>1941,28=>1942,29=>1943,30=>1944,31=>1945,32=>1946,33=>1947,34=>1948,35=>1949,36=>1950,37=>1951,38=>1952,39=>1953,40=>1954,41=>1955,42=>1956,43=>1957,44=>1958,45=>1959,46=>1960,47=>1961,48=>1962,49=>1963];
        $zm4_nums = [1=>1977,2=>1978,3=>1979,4=>1980,5=>1981,6=>1982,7=>1983,8=>1984,9=>1985,10=>1986,11=>1987,12=>1988,13=>1989,14=>1990,15=>1991,16=>1992,17=>1993,18=>1994,19=>1995,20=>1996,21=>1997,22=>1998,23=>1999,24=>2000,25=>2001,26=>2002,27=>2003,28=>2004,29=>2005,30=>2006,31=>2007,32=>2008,33=>2009,34=>2010,35=>2011,36=>2012,37=>2013,38=>2014,39=>2015,40=>2016,41=>2017,42=>2018,43=>2019,44=>2020,45=>2021,46=>2022,47=>2023,48=>2024,49=>2025];
        $zm5_nums = [1=>2039,2=>2040,3=>2041,4=>2042,5=>2043,6=>2044,7=>2045,8=>2046,9=>2047,10=>2048,11=>2049,12=>2050,13=>2051,14=>2052,15=>2053,16=>2054,17=>2055,18=>2056,19=>2057,20=>2058,21=>2059,22=>2060,23=>2061,24=>2062,25=>2063,26=>2064,27=>2065,28=>2066,29=>2067,30=>2068,31=>2069,32=>2070,33=>2071,34=>2072,35=>2073,36=>2074,37=>2075,38=>2076,39=>2077,40=>2078,41=>2079,42=>2080,43=>2081,44=>2082,45=>2083,46=>2084,47=>2085,48=>2086,49=>2087];
        $zm6_nums = [1=>2101,2=>2102,3=>2103,4=>2104,5=>2105,6=>2106,7=>2107,8=>2108,9=>2109,10=>2110,11=>2111,12=>2112,13=>2113,14=>2114,15=>2115,16=>2116,17=>2117,18=>2118,19=>2119,20=>2120,21=>2121,22=>2122,23=>2123,24=>2124,25=>2125,26=>2126,27=>2127,28=>2128,29=>2129,30=>2130,31=>2131,32=>2132,33=>2133,34=>2134,35=>2135,36=>2136,37=>2137,38=>2138,39=>2139,40=>2140,41=>2141,42=>2142,43=>2143,44=>2144,45=>2145,46=>2146,47=>2147,48=>2148,49=>2149];
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
            $playId = 1841;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 1840;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1 <= 24){ //小
            $playId = 1843;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //大
            $playId = 1842;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_heshu%2 == 0){//合双
            $playId = 1845;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //合单
            $playId = 1844;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_heshu >= 7){ //合大
            $playId = 1846;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_heshu <= 6){ //合小
            $playId = 1847;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_wei == 5 || $zm1_wei == 6 || $zm1_wei == 7 || $zm1_wei == 8 || $zm1_wei == 9){ //尾大
            $playId = 1851;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_wei == 0 || $zm1_wei == 1 || $zm1_wei == 2 || $zm1_wei == 3 || $zm1_wei == 4){ //尾小
            $playId = 1852;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'R'){
            $playId = 1848;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'B'){
            $playId = 1849;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'G'){
            $playId = 1850;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正1====两面====结束
        //正2====两面====开始
        if($zm2%2 == 0){ //双
            $playId = 1903;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 1902;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2 <= 24){ //小
            $playId = 1905;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 1904;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_heshu%2 == 0){//合双
            $playId = 1907;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 1906;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_heshu >= 7){ //合大
            $playId = 1908;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_heshu <= 6){ //合小
            $playId = 1909;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_wei == 5 || $zm2_wei == 6 || $zm2_wei == 7 || $zm2_wei == 8 || $zm2_wei == 9){ //尾大
            $playId = 1913;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_wei == 0 || $zm2_wei == 1 || $zm2_wei == 2 || $zm2_wei == 3 || $zm2_wei == 4){ //尾小
            $playId = 1914;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'R'){
            $playId = 1910;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'B'){
            $playId = 1911;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'G'){
            $playId = 1912;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正2====两面====结束
        //正3====两面====开始
        if($zm3%2 == 0){ //双
            $playId = 1965;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 1964;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3 <= 24){ //小
            $playId = 1967;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 1966;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_heshu%2 == 0){//合双
            $playId = 1969;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 1968;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_heshu >= 7){ //合大
            $playId = 1970;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_heshu <= 6){ //合小
            $playId = 1971;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_wei == 5 || $zm3_wei == 6 || $zm3_wei == 7 || $zm3_wei == 8 || $zm3_wei == 9){ //尾大
            $playId = 1975;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_wei == 0 || $zm3_wei == 1 || $zm3_wei == 2 || $zm3_wei == 3 || $zm3_wei == 4){ //尾小
            $playId = 1976;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'R'){
            $playId = 1972;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'B'){
            $playId = 1973;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'G'){
            $playId = 1974;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正3====两面====结束
        //正4====两面====开始
        if($zm4%2 == 0){ //双
            $playId = 2027;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2026;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4 <= 24){ //小
            $playId = 2029;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2028;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_heshu%2 == 0){//合双
            $playId = 2031;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2030;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_heshu >= 7){ //合大
            $playId = 2032;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_heshu <= 6){ //合小
            $playId = 2033;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_wei == 5 || $zm4_wei == 6 || $zm4_wei == 7 || $zm4_wei == 8 || $zm4_wei == 9){ //尾大
            $playId = 2037;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_wei == 0 || $zm4_wei == 1 || $zm4_wei == 2 || $zm4_wei == 3 || $zm4_wei == 4){ //尾小
            $playId = 2038;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'R'){
            $playId = 2034;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'B'){
            $playId = 2035;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'G'){
            $playId = 2036;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正4====两面====结束
        //正5====两面====开始
        if($zm5%2 == 0){ //双
            $playId = 2089;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2088;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5 <= 24){ //小
            $playId = 2091;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2090;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_heshu%2 == 0){//合双
            $playId = 2093;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2092;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_heshu >= 7){ //合大
            $playId = 2094;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_heshu <= 6){ //合小
            $playId = 2095;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_wei == 5 || $zm5_wei == 6 || $zm5_wei == 7 || $zm5_wei == 8 || $zm5_wei == 9){ //尾大
            $playId = 2099;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_wei == 0 || $zm5_wei == 1 || $zm5_wei == 2 || $zm5_wei == 3 || $zm5_wei == 4){ //尾小
            $playId = 2100;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'R'){
            $playId = 2096;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'B'){
            $playId = 2097;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'G'){
            $playId = 2098;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正5====两面====结束
        //正6====两面====开始
        if($zm6%2 == 0){ //双
            $playId = 2151;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2150;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6 <= 24){ //小
            $playId = 2153;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2152;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_heshu%2 == 0){//合双
            $playId = 2155;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 2154;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_heshu >= 7){ //合大
            $playId = 2156;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_heshu <= 6){ //合小
            $playId = 2157;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_wei == 5 || $zm6_wei == 6 || $zm6_wei == 7 || $zm6_wei == 8 || $zm6_wei == 9){ //尾大
            $playId = 2161;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_wei == 0 || $zm6_wei == 1 || $zm6_wei == 2 || $zm6_wei == 3 || $zm6_wei == 4){ //尾小
            $playId = 2162;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'R'){
            $playId = 2158;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'B'){
            $playId = 2159;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'G'){
            $playId = 2160;
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
    protected function BUNKO_LHC($openCode,$win,$gameId,$issue,$he,$excel=false)
    {
        $bunko_index = 0;

        $openCodeArr = explode(',',$openCode);
        $tema = $openCodeArr[6]; //特码号码
        $tema_SX = $this->LHC_SX->shengxiao($tema); //特码生肖

        $id = [];
        foreach ($win as $k=>$v){
            $id[] = $v;
        }
        $table = 'bet';
        $getUserBets = DB::connection('mysql::write')->table($table)->select('bet_id','bet_money','play_odds')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        if($getUserBets){
            $sql = "UPDATE bet SET bunko = CASE "; //中奖的SQL语句
            $sql_lose = "UPDATE bet SET bunko = CASE "; //未中奖的SQL语句
            $sql_he = "UPDATE bet SET bunko = CASE "; //和局的SQL语句

            $win = $id;
            $lose = $id;
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
                foreach ($he as $k=>$v){
                    $ids_he[] = $v;
                    unset($win[$v]);
                    $lose[] = $v;
                }
                $ids_he = implode(',', $ids_he);
                $sql_he .= $sql_bets_he . "END, status = 1 , updated_at ='" . date('Y-m-d H:i:s') . "' WHERE status = 0 AND `game_id` = $gameId AND `issue` = $issue AND `play_id` IN ($ids_he)";
            }else
                $sql_he = '';
            $ids = implode(',', $win);
            $ids_lose = array_diff($this->arrPlay_id,$lose);
            $ids_lose = implode(',', $ids_lose);
            $sql .= $sql_bets . "END, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE status = 0 AND `game_id` = $gameId AND `issue` = $issue AND `play_id` IN ($ids)";
            $sql_lose .= $sql_bets_lose . "END, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE status = 0 AND `game_id` = $gameId AND `issue` = $issue AND `play_id` IN ($ids_lose)";
            if(!empty($sql_bets)) {
                $run = DB::statement($sql);
                if($run == 1)
                    $bunko_index++;
            }
            if(!empty($sql_he)){
                $runhe = DB::connection('mysql::write')->statement($sql_he);
                if($runhe == 1)
                    $bunko_index++;
            }
            if(!empty($sql_bets_lose)){
                $run2 = DB::connection('mysql::write')->statement($sql_lose);
                if($run2 == 1){
                    $bunko_index++;
                }
            }
            //自选不中------开始
            $zxbz_playCate = 77; //特码分类ID
            $zxbz_ids = [];
            $zxbz_lose_ids = [];
            $get = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$zxbz_playCate)->where('bunko','=',0.00)->get();
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
            $hexiao_playCate = 68; //分类ID
            $hexiao_ids = [];
            $getHexiao = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$hexiao_playCate)->where('bunko','=',0.00)->get();
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
            $zx_playCate = 74; //分类ID
            $zx_id = [];
            $zx_plays = ['鼠'=>1621,'牛'=>1622,'虎'=>1623,'兔'=>1624,'龙'=>1625,'蛇'=>1626,'马'=>1627,'羊'=>1628,'猴'=>1629,'鸡'=>1630,'狗'=>1631,'猪'=>1632];
            $arrOpenCode = explode(',',$openCode); // 分割开奖号码
            $sx1 = $this->LHC_SX->shengxiao($arrOpenCode[0]);
            $sx2 = $this->LHC_SX->shengxiao($arrOpenCode[1]);
            $sx3 = $this->LHC_SX->shengxiao($arrOpenCode[2]);
            $sx4 = $this->LHC_SX->shengxiao($arrOpenCode[3]);
            $sx5 = $this->LHC_SX->shengxiao($arrOpenCode[4]);
            $sx6 = $this->LHC_SX->shengxiao($arrOpenCode[5]);
            $openSX = [$sx1,$sx2,$sx3,$sx4,$sx5,$sx6];
            $countOpen = array_count_values($openSX);
            $zx_sql = "UPDATE bet SET bunko = CASE play_id ";
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
                $zx_sql .= "END, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE status = 0 AND `game_id` = $gameId AND `issue` = $issue AND play_id IN ($zx_ids)";
            } else {
                $zx_sql = 0;
            }

            //正肖-----结束

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
        }

        if($bunko_index !== 0){
            //\Log::info('BUNKO:'.$bunko_index);
            return 1;
        }
    }
}
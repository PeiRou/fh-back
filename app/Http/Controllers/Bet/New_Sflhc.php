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

class New_Sflhc extends Excel
{
    protected $arrPlay_id = array(9043936790,9043936791,9043936792,9043936793,9043936794,9043936795,9043936796,9043936797,9043936798,9043936799,9043936800,9043936801,9043936802,9043936803,9043936804,9043936805,9043936806,9043936807,9043936808,9043936809,9043936810,9043936811,9043936812,9043936813,9043936814,9043936815,9043936816,9043936817,9043936818,9043936819,9043936820,9043936821,9043936822,9043936823,9043936824,9043936825,9043936826,9043936827,9043936828,9043936829,9043936830,9043936831,9043936832,9043936833,9043936834,9043936835,9043936836,9043936837,9043936838,9043936839,9043936840,9043936841,9043936842,9043936843,9043936844,9043936845,9043936846,9043936847,9043936848,9043936849,9043936850,9043936851,9043936852,9043936853,9043936854,9043936855,9043936856,9043936857,9043936858,9043936859,9043936860,9043936861,9043936862,9043936863,9043936864,9043936865,9043936866,9043936867,9043936868,9043936869,9043936870,9043936871,9043936872,9043936873,9043936874,9043936875,9043936876,9043936877,9043936878,9043936879,9043936880,9043936881,9043936882,9043936883,9043936884,9043936885,9043936886,9043936887,9043946888,9043946889,9043946890,9043946891,9043946892,9043946893,9043946894,9043946895,9043946896,9043946897,9043946898,9043946899,9043946900,9043946901,9043946902,9043946903,9043946904,9043946905,9043946906,9043946907,9043946908,9043946909,9043946910,9043946911,9043956912,9043956913,9043956914,9043956915,9043956916,9043956917,9043956918,9043956919,9043956920,9043956921,9043956922,9043956923,9043956924,9043956925,9043956926,9043956927,9043956928,9043956929,9043956930,9043956931,9043956932,9043956933,9043956934,9043956935,9043956936,9043956937,9043956938,9043966939,9043966940,9043966941,9043966942,9043966943,9043966944,9043966945,9043966946,9043966947,9043966948,9043966949,9043966950,9043976951,9043976952,9043976953,9043976954,9043976955,9043976956,9043976957,9043976958,9043976959,9043976960,9043986961,9043986962,9043986963,9043986964,9043986965,9043986966,9043986967,9043986968,9043986969,9043986970,9043986971,9043986972,9043986973,9043986974,9043986975,9043996976,9043996977,9043996978,9043996979,9043996980,9043996981,9043996982,9043996983,9043996984,9043996985,9043996986,9043996987,9043996988,9043996989,9043996990,9043996991,9043996992,9043996993,9043996994,9043996995,9043996996,9043996997,9043996998,9043996999,9043997000,9043997001,9043997002,9043997003,9043997004,9043997005,9043997006,9043997007,9043997008,9043997009,9043997010,9043997011,9043997012,9043997013,9043997014,9043997015,9043997016,9043997017,9043997018,9043997019,9043997020,9043997021,9043997022,9043997023,9043997024,9044017025,9044017026,9044017027,9044017028,9044017029,9044027030,9044027031,9044027032,9044027033,9044027034,9044027035,9044027036,9044027037,9044027038,9044027039,9044027040,9044027041,9044027042,9044027043,9044027044,9044027045,9044027046,9044027047,9044027048,9044027049,9044027050,9044027051,9044037052,9044037053,9044037054,9044037055,9044037056,9044037057,9044037058,9044037059,9044037060,9044037061,9044037062,9044037063,9044047064,9044047065,9044047066,9044047067,9044057068,9044057069,9044057070,9044057071,9044057072,9044057073,9044057074,9044057075,9044067076,9044067077,9044067078,9044067079,9044067080,9044067081,9044067082,9044067083,9044077084,9044077085,9044077086,9044077087,9044077088,9044077089,9044077090,9044077091,9044077092,9044077093,9044077094,9044077095,9044077096,9044077097,9044077098,9044077099,9044077100,9044077101,9044077102,9044077103,9044077104,9044077105,9044077106,9044077107,9044077108,9044077109,9044077110,9044077111,9044077112,9044077113,9044077114,9044077115,9044077116,9044077117,9044077118,9044077119,9044077120,9044077121,9044077122,9044077123,9044077124,9044077125,9044077126,9044077127,9044077128,9044077129,9044077130,9044077131,9044077132,9044077133,9044077134,9044077135,9044077136,9044077137,9044077138,9044077139,9044077140,9044077141,9044077142,9044077143,9044077144,9044077145,9044077146,9044077147,9044077148,9044077149,9044077150,9044077151,9044077152,9044077153,9044077154,9044077155,9044077156,9044077157,9044077158,9044077159,9044077160,9044077161,9044077162,9044077163,9044077164,9044077165,9044077166,9044077167,9044077168,9044077169,9044077170,9044077171,9044087172,9044087173,9044087174,9044087175,9044087176,9044087177,9044087178,9044087179,9044007180,9044007181,9044007182,9044007183,9044007184,9044007185,9044007186,9044007187,9044007188,9044007189,9044007190,9044007191,9044007192,9044007193,9044007194,9044007195,9044007196,9044007197,9044007198,9044007199,9044007200,9044007201,9044007202,9044007203,9044007204,9044007205,9044007206,9044007207,9044007208,9044007209,9044007210,9044007211,9044007212,9044007213,9044007214,9044007215,9044007216,9044007217,9044007218,9044007219,9044007220,9044007221,9044007222,9044007223,9044007224,9044007225,9044007226,9044007227,9044007228,9044007229,9044007230,9044007231,9044007232,9044007233,9044007234,9044007235,9044007236,9044007237,9044007238,9044007239,9044007240,9044007241,9044007242,9044007243,9044007244,9044007245,9044007246,9044007247,9044007248,9044007249,9044007250,9044007251,9044007252,9044007253,9044007254,9044007255,9044007256,9044007257,9044007258,9044007259,9044007260,9044007261,9044007262,9044007263,9044007264,9044007265,9044007266,9044007267,9044007268,9044007269,9044007270,9044007271,9044007272,9044007273,9044007274,9044007275,9044007276,9044007277,9044007278,9044007279,9044007280,9044007281,9044007282,9044007283,9044007284,9044007285,9044007286,9044007287,9044007288,9044007289,9044007290,9044007291,9044007292,9044007293,9044007294,9044007295,9044007296,9044007297,9044007298,9044007299,9044007300,9044007301,9044007302,9044007303,9044007304,9044007305,9044007306,9044007307,9044007308,9044007309,9044007310,9044007311,9044007312,9044007313,9044007314,9044007315,9044007316,9044007317,9044007318,9044007319,9044007320,9044007321,9044007322,9044007323,9044007324,9044007325,9044007326,9044007327,9044007328,9044007329,9044007330,9044007331,9044007332,9044007333,9044007334,9044007335,9044007336,9044007337,9044007338,9044007339,9044007340,9044007341,9044007342,9044007343,9044007344,9044007345,9044007346,9044007347,9044007348,9044007349,9044007350,9044007351,9044007352,9044007353,9044007354,9044007355,9044007356,9044007357,9044007358,9044007359,9044007360,9044007361,9044007362,9044007363,9044007364,9044007365,9044007366,9044007367,9044007368,9044007369,9044007370,9044007371,9044007372,9044007373,9044007374,9044007375,9044007376,9044007377,9044007378,9044007379,9044007380,9044007381,9044007382,9044007383,9044007384,9044007385,9044007386,9044007387,9044007388,9044007389,9044007390,9044007391,9044007392,9044007393,9044007394,9044007395,9044007396,9044007397,9044007398,9044007399,9044007400,9044007401,9044007402,9044007403,9044007404,9044007405,9044007406,9044007407,9044007408,9044007409,9044007410,9044007411,9044007412,9044007413,9044007414,9044007415,9044007416,9044007417,9044007418,9044007419,9044007420,9044007421,9044007422,9044007423,9044007424,9044007425,9044007426,9044007427,9044007428,9044007429,9044007430,9044007431,9044007432,9044007433,9044007434,9044007435,9044007436,9044007437,9044007438,9044007439,9044007440,9044007441,9044007442,9044007443,9044007444,9044007445,9044007446,9044007447,9044007448,9044007449,9044007450,9044007451,9044007452,9044007453,9044007454,9044007455,9044007456,9044007457,9044007458,9044007459,9044007460,9044007461,9044007462,9044007463,9044007464,9044007465,9044007466,9044007467,9044007468,9044007469,9044007470,9044007471,9044007472,9044007473,9044007474,9044007475,9044007476,9044007477,9044007478,9044007479,9044007480,9044007481,9044007482,9044007483,9044007484,9044007485,9044007486,9044007487,9044007488,9044007489,9044007490,9044007491,9044007492,9044007493,9044007494,9044007495,9044007496,9044007497,9044007498,9044007499,9044007500,9044007501,9044007502,9044007503,9044007504,9044007505,9044007506,9044007507,9044007508,9044007509,9044007510,9044007511,9044007512,9044007513,9044007514,9044007515,9044007516,9044007517,9044007518,9044007519,9044007520,9044007521,9044007522,9044007523,9044007524,9044007525,9044007526,9044007527,9044007528,9044007529,9044007530,9044007531,9044007532,9044007533,9044007534,9044007535,9044007536,9044007537,9044007538,9044007539,9044007540,9044007541,9044007542,9044007543,9044007544,9044007545,9044007546,9044007547,9044007548,9044007549,9044007550,9044007551);
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

    public function all($openCode,$issue,$gameId,$id,$excel)
    {
        $table = 'game_sflhc';
        $gameName = '三分六合彩';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();

        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                writeLog('New_Kill', 'excel_num:'.$update);
                if($update == 1) {
                    writeLog('New_Kill', 'sflhc killing...');
                    $this->excel($openCode, $exeBase, $issue, $gameId, $table,'lhc');
                }
            }
            if(!$excel){
                $resData = $this->exc_play($openCode,$gameId);
                $win = @$resData['win'];
                $he = isset($resData['ids_he'])?$resData['ids_he']:array();
                try {
                    $bunko = $this->BUNKO_LHC($openCode, $win, $gameId, $issue, $he, $excel);
                }catch (\exception $exception){
                    writeLog('New_Bet', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                    DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->update(['status' => 0,'bunko' => 0]);
                }
                $this->bet_total($issue,$gameId);
                if(isset($bunko) && $bunko == 1){
                    $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName);
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
                $agentJob = new AgentBackwaterJob($gameId,$issue);
                $agentJob->addQueue();
            }
        }
    }

    //特码A-B
    public function TM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tm_playCate = 393; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        switch ($tm){
            case 1:
                $playId_B = 6839;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6790;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 2:
                $playId_B = 6840;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6791;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 3:
                $playId_B = 6841;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6792;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 4:
                $playId_B = 6842;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6793;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 5:
                $playId_B = 6843;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6794;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 6:
                $playId_B = 6844;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6795;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 7:
                $playId_B = 6845;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6796;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 8:
                $playId_B = 6846;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6797;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 9:
                $playId_B = 6847;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6798;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 10:
                $playId_B = 6848;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6799;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 11:
                $playId_B = 6849;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6800;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 12:
                $playId_B = 6850;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6801;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 13:
                $playId_B = 6851;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6802;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 14:
                $playId_B = 6852;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6803;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 15:
                $playId_B = 6853;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6804;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 16:
                $playId_B = 6854;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6805;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 17:
                $playId_B = 6855;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6806;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 18:
                $playId_B = 6856;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6807;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 19:
                $playId_B = 6857;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6808;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 20:
                $playId_B = 6858;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6809;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 21:
                $playId_B = 6859;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6810;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 22:
                $playId_B = 6860;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6811;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 23:
                $playId_B = 6861;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6812;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 24:
                $playId_B = 6862;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6813;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 25:
                $playId_B = 6863;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6814;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 26:
                $playId_B = 6864;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6815;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 27:
                $playId_B = 6865;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6816;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 28:
                $playId_B = 6866;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6817;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 29:
                $playId_B = 6867;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6818;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 30:
                $playId_B = 6868;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6819;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 31:
                $playId_B = 6869;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6820;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 32:
                $playId_B = 6870;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6821;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 33:
                $playId_B = 6871;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6822;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 34:
                $playId_B = 6872;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6823;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 35:
                $playId_B = 6873;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6824;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 36:
                $playId_B = 6874;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6825;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 37:
                $playId_B = 6875;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6826;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 38:
                $playId_B = 6876;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6827;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 39:
                $playId_B = 6877;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6828;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 40:
                $playId_B = 6878;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6829;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 41:
                $playId_B = 6879;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6830;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 42:
                $playId_B = 6880;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6831;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 43:
                $playId_B = 6881;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6832;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 44:
                $playId_B = 6882;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6833;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 45:
                $playId_B = 6883;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6834;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 46:
                $playId_B = 6884;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6835;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 47:
                $playId_B = 6885;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6836;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 48:
                $playId_B = 6886;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6837;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 49:
                $playId_B = 6887;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 6838;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
        }
    }

    //两面
    public function LM($openCode,$gameId,$win,$ids_he)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $lm_playCate = 394; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        $ZH = (int)$arrOpenCode[0]+(int)$arrOpenCode[1]+(int)$arrOpenCode[2]+(int)$arrOpenCode[3]+(int)$arrOpenCode[4]+(int)$arrOpenCode[5]+(int)$arrOpenCode[6];
        //特码大小
        if($tm >= 25 && $tm <= 48){ //大
            $playId = 6888;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
            if($tm%2 == 0){ //特大双
                $playId = 6899;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            } else { //特大单
                $playId = 6898;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
        }else if($tm <= 24){
            $playId = 6889;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
            if($tm%2 == 0){ //特小双
                $playId = 6901;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            } else { //特小单
                $playId = 6900;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
        }else{  //和局退本金
            $playId = 6888;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 6889;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //特码单双
        if($tm%2 == 0){ // 双
            $playId = 6891;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($tm%2 != 0 && $tm != 49){
            $playId = 6890;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 6890;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 6891;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //特码合数大小
        $tmBL = str_pad($tm,2,"0",STR_PAD_LEFT); //十位补零
        $chaiTM = str_split($tmBL); //拆分个位 十位
        $TMHS = (int)$chaiTM[0]+(int)$chaiTM[1];
        if($TMHS >= 7 && $tmBL != 49){ //特合大
            $playId = 6892;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($TMHS <= 6 && $tmBL != 49){ //特合小
            $playId = 6893;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 6892;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 6893;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        if($TMHS%2 == 0){ // 双
            $playId = 6895;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($TMHS%2 != 0 && $tmBL != 49){
            $playId = 6894;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 6894;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 6895;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //特天肖 地肖
        $TTX = $this->LHC_SX->shengxiao($tm);
        if($TTX == '兔' || $TTX == '马' || $TTX == '猴' || $TTX == '猪' || $TTX == '牛' || $TTX == '龙'){ //天肖
            $playId = 6902;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TTX == '蛇' || $TTX == '羊' || $TTX == '鸡' || $TTX == '狗' || $TTX == '鼠' || $TTX == '虎'){ //地肖
            $playId = 6903;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特前肖 后肖
        $TQH = $this->LHC_SX->shengxiao($tm);
        if($TQH == '鼠' || $TQH == '牛' || $TQH == '虎' || $TQH == '兔' || $TQH == '龙' || $TQH == '蛇'){ //前肖
            $playId = 6904;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TQH == '马' || $TQH == '羊' || $TQH == '猴' || $TQH == '鸡' || $TQH == '狗' || $TQH == '猪'){ //后肖
            $playId = 6905;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特家肖 野肖
        $TJX = $this->LHC_SX->shengxiao($tm);
        if($TJX == '牛' || $TJX == '马' || $TJX == '羊' || $TJX == '鸡' || $TJX == '狗' || $TJX == '猪'){ //家肖
            $playId = 6906;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TJX == '鼠' || $TJX == '虎' || $TJX == '兔' || $TJX == '龙' || $TJX == '蛇' || $TJX == '猴'){ //野肖
            $playId = 6907;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特尾大 特尾小
        $TW = $chaiTM[1];
        if($TW >= 5 && $tmBL != 49){ //尾大
            $playId = 6896;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else if($TW <= 4 && $tmBL != 49){
            $playId = 6897;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }else{  //和局退本金
            $playId = 6896;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 6897;
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }
        //总和大小
        if($ZH >= 175){ //大
            $playId = 6910;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        } else { //小
            $playId = 6911;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //总和单双
        if($ZH%2 == 0){ //双
            $playId = 6909;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 6908;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
    }

    //色波
    public function SB($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $sb_playCate = 395; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        //色波
        if($tm == 1 || $tm == 2 || $tm == 7 || $tm == 8 || $tm == 12 || $tm == 13 || $tm == 18 || $tm == 19 || $tm == 23 || $tm == 24 || $tm == 29 || $tm == 30 || $tm == 34 || $tm == 35 || $tm == 40 || $tm == 45 || $tm == 46){ //红波
            $playId = 6912;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //红双
                $playId = 6916;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //红单
                $playId = 6915;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //红大
                $playId = 6917;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //红大双
                    $playId = 6928;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 红大单
                    $playId = 6927;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //红小
                $playId = 6918;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //红小双
                    $playId = 6930;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 红小单
                    $playId = 6929;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if($tm == 3 || $tm == 4 || $tm == 9 || $tm == 10 || $tm == 14 || $tm == 15 || $tm == 20 || $tm == 25 || $tm == 26 || $tm == 31 || $tm == 36 || $tm == 37 || $tm == 41 || $tm == 42 || $tm == 47 || $tm == 48){ //蓝波
            $playId = 6913;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //蓝双
                $playId = 6920;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //蓝单
                $playId = 6919;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //蓝大
                $playId = 6921;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //蓝大双
                    $playId = 6932;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 蓝大单
                    $playId = 6931;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //蓝小
                $playId = 6922;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //蓝小双
                    $playId = 6934;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 蓝小单
                    $playId = 6933;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if($tm == 5 || $tm == 6 || $tm == 11 || $tm == 16 || $tm == 17 || $tm == 21 || $tm == 22 || $tm == 27 || $tm == 28 || $tm == 32 || $tm == 33 || $tm == 38 || $tm == 39 || $tm == 43 || $tm == 44 || $tm == 49){ //绿波
            $playId = 6914;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //绿双
                $playId = 6924;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //绿单
                $playId = 6923;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //绿大
                $playId = 6925;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //绿大双
                    $playId = 6936;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 绿大单
                    $playId = 6935;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //绿小
                $playId = 6926;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //绿小双
                    $playId = 6938;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 绿小单
                    $playId = 6937;
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
        $tx_playCate = 396; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        if($tm == 7 || $tm == 19 || $tm == 31 || $tm == 43){ //蛇
            $playId = 6944;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 6 || $tm == 18 || $tm == 30 || $tm == 42){ //马
            $playId = 6945;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 5 || $tm == 17 || $tm == 29 || $tm == 41){ //羊
            $playId = 6946;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 4 || $tm == 16 || $tm == 28 || $tm == 40){ //猴
            $playId = 6947;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 3 || $tm == 15 || $tm == 27 || $tm == 39){ //鸡
            $playId = 6948;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 2 || $tm == 14 || $tm == 26 || $tm == 38){ //狗
            $playId = 6949;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 1 || $tm == 13 || $tm == 25 || $tm == 37 || $tm == 49){ //猪
            $playId = 6950;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 12 || $tm == 24 || $tm == 36 || $tm == 48){ // 鼠
            $playId = 6939;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 11 || $tm == 23 || $tm == 35 || $tm == 47){ //牛
            $playId = 6940;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 10 || $tm == 22 || $tm == 34 || $tm == 46){ //虎
            $playId = 6941;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 9 || $tm == 21 || $tm == 33 || $tm == 45){ //兔
            $playId = 6942;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 8 || $tm == 20 || $tm == 32 || $tm == 44){ //龙
            $playId = 6943;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
    }

    //特码头尾数
    public function TMTWS($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tmtws_playCate = 398; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        $tmBL = str_pad($tm,2,"0",STR_PAD_LEFT); //十位补零
        $chaiTM = str_split($tmBL); //拆分个位 十位
        $tou = (int)$chaiTM[0];
        $wei = (int)$chaiTM[1];
        if($tou == 0){
            $playId = 6961;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 1){
            $playId = 6962;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 2){
            $playId = 6963;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 3){
            $playId = 6964;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 4){
            $playId = 6965;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 0){
            $playId = 6975;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 1){
            $playId = 6966;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 2){
            $playId = 6967;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 3){
            $playId = 6968;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 4){
            $playId = 6969;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 5){
            $playId = 6970;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 6){
            $playId = 6971;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 7){
            $playId = 6972;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 8){
            $playId = 6973;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 9){
            $playId = 6974;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
    }

    //正码
    public function ZM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $zm_playCate = 399; //正码分类ID
        $ZM1 = $arrOpenCode[0];
        $ZM2 = $arrOpenCode[1];
        $ZM3 = $arrOpenCode[2];
        $ZM4 = $arrOpenCode[3];
        $ZM5 = $arrOpenCode[4];
        $ZM6 = $arrOpenCode[5];
        $nums = ['1'=>'6976','2'=>'6977','3'=>'6978','4'=>'6979','5'=>'6980','6'=>'6981','7'=>'6982','8'=>'6983','9'=>'6984','10'=>'6985','11'=>'6986','12'=>'6987','13'=>'6988','14'=>'6989','15'=>'6990','16'=>'6991','17'=>'6992','18'=>'6993','19'=>'6994','20'=>'6995','21'=>'6996','22'=>'6997','23'=>'6998','24'=>'6999','25'=>'7000','26'=>'7001','27'=>'7002','28'=>'7003','29'=>'7004','30'=>'7005','31'=>'7006','32'=>'7007','33'=>'7008','34'=>'7009','35'=>'7010','36'=>'7011','37'=>'7012','38'=>'7013','39'=>'7014','40'=>'7015','41'=>'7016','42'=>'7017','43'=>'7018','44'=>'7019','45'=>'7020','46'=>'7021','47'=>'7022','48'=>'7023','49'=>'7024'];
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
        $wx_playCate = 401; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        if($tm == 5 || $tm == 6 || $tm == 19 || $tm == 20 || $tm == 27 || $tm == 28 || $tm == 35 || $tm == 36 || $tm == 49){ //金
            $playId = 7025;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 1 || $tm == 2 || $tm == 9 || $tm == 10 || $tm == 17 || $tm == 18 || $tm == 31 || $tm == 32 || $tm == 39 || $tm == 40 || $tm == 47 || $tm == 48){ //木
            $playId = 7026;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 7 || $tm == 8 || $tm == 15 || $tm == 16 || $tm == 23 || $tm == 24 || $tm == 37 || $tm == 38 || $tm == 45 || $tm == 46){ //水
            $playId = 7027;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 3 || $tm == 4 || $tm == 11 || $tm == 12 || $tm == 25 || $tm == 26 || $tm == 33 || $tm == 34 || $tm == 41 || $tm == 42){ //火
            $playId = 7028;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 13 || $tm == 14 || $tm == 21 || $tm == 22 || $tm == 29 || $tm == 30 || $tm == 43 || $tm == 44){ //土
            $playId = 7029;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
    }

    //七色波
    public function QSB($openCode,$gameId,$win,$ids_he)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $qsb_playCate = 404; //特码分类ID
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
            $playId = 7067;
            $winCode = $gameId.$qsb_playCate.$playId;
            $win->push($winCode);
            //和局退本金
            $playId = 7064;
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 7065;
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
            $playId = 7066;
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
        } else {
            if ($redTotal>$blueTotal&$redTotal>$greenTotal){ //红
                $playId = 7064;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            }else if ($blueTotal>$greenTotal) { //蓝
                $playId = 7065;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            } else { //绿
                $playId = 7066;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            }
        }
    }

    //平特一肖尾数
    public function PTYXWS($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $ptyxws_playCate = 402; //特码分类ID
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
            $playId = 7030;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$niu) || in_array($m2,$niu) || in_array($m3,$niu) || in_array($m4,$niu) || in_array($m5,$niu) || in_array($m6,$niu) || in_array($m7,$niu)){
            $playId = 7031;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$hu) || in_array($m2,$hu) || in_array($m3,$hu) || in_array($m4,$hu) || in_array($m5,$hu) || in_array($m6,$hu) || in_array($m7,$hu)){
            $playId = 7032;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$tu) || in_array($m2,$tu) || in_array($m3,$tu) || in_array($m4,$tu) || in_array($m5,$tu) || in_array($m6,$tu) || in_array($m7,$tu)){
            $playId = 7033;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$long) || in_array($m2,$long) || in_array($m3,$long) || in_array($m4,$long) || in_array($m5,$long) || in_array($m6,$long) || in_array($m7,$long)){
            $playId = 7034;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$she) || in_array($m2,$she) || in_array($m3,$she) || in_array($m4,$she) || in_array($m5,$she) || in_array($m6,$she) || in_array($m7,$she)){
            $playId = 7035;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$ma) || in_array($m2,$ma) || in_array($m3,$ma) || in_array($m4,$ma) || in_array($m5,$ma) || in_array($m6,$ma) || in_array($m7,$ma)){
            $playId = 7036;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$yang) || in_array($m2,$yang) || in_array($m3,$yang) || in_array($m4,$yang) || in_array($m5,$yang) || in_array($m6,$yang) || in_array($m7,$yang)){
            $playId = 7037;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$hou) || in_array($m2,$hou) || in_array($m3,$hou) || in_array($m4,$hou) || in_array($m5,$hou) || in_array($m6,$hou) || in_array($m7,$hou)){
            $playId = 7038;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$ji) || in_array($m2,$ji) || in_array($m3,$ji) || in_array($m4,$ji) || in_array($m5,$ji) || in_array($m6,$ji) || in_array($m7,$ji)){
            $playId = 7039;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$gou) || in_array($m2,$gou) || in_array($m3,$gou) || in_array($m4,$gou) || in_array($m5,$gou) || in_array($m6,$gou) || in_array($m7,$gou)){
            $playId = 7040;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$zhu) || in_array($m2,$zhu) || in_array($m3,$zhu) || in_array($m4,$zhu) || in_array($m5,$zhu) || in_array($m6,$zhu) || in_array($m7,$zhu)){
            $playId = 7041;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        //尾数
        if(in_array($m1,$w0) || in_array($m2,$w0) || in_array($m3,$w0) || in_array($m4,$w0) || in_array($m5,$w0) || in_array($m6,$w0) || in_array($m7,$w0)){
            $playId = 7042;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w1) || in_array($m2,$w1) || in_array($m3,$w1) || in_array($m4,$w1) || in_array($m5,$w1) || in_array($m6,$w1) || in_array($m7,$w1)){
            $playId = 7043;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w2) || in_array($m2,$w2) || in_array($m3,$w2) || in_array($m4,$w2) || in_array($m5,$w2) || in_array($m6,$w2) || in_array($m7,$w2)){
            $playId = 7044;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w3) || in_array($m2,$w3) || in_array($m3,$w3) || in_array($m4,$w3) || in_array($m5,$w3) || in_array($m6,$w3) || in_array($m7,$w3)){
            $playId = 7045;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w4) || in_array($m2,$w4) || in_array($m3,$w4) || in_array($m4,$w4) || in_array($m5,$w4) || in_array($m6,$w4) || in_array($m7,$w4)){
            $playId = 7046;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w5) || in_array($m2,$w5) || in_array($m3,$w5) || in_array($m4,$w5) || in_array($m5,$w5) || in_array($m6,$w5) || in_array($m7,$w5)){
            $playId = 7047;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w6) || in_array($m2,$w6) || in_array($m3,$w6) || in_array($m4,$w6) || in_array($m5,$w6) || in_array($m6,$w6) || in_array($m7,$w6)){
            $playId = 7048;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w7) || in_array($m2,$w7) || in_array($m3,$w7) || in_array($m4,$w7) || in_array($m5,$w7) || in_array($m6,$w7) || in_array($m7,$w7)){
            $playId = 7049;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w8) || in_array($m2,$w8) || in_array($m3,$w8) || in_array($m4,$w8) || in_array($m5,$w8) || in_array($m6,$w8) || in_array($m7,$w8)){
            $playId = 7050;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w9) || in_array($m2,$w9) || in_array($m3,$w9) || in_array($m4,$w9) || in_array($m5,$w9) || in_array($m6,$w9) || in_array($m7,$w9)){
            $playId = 7051;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
    }

    //总肖
    public function ZONGXIAO($openCode,$gameId,$win)
    {
        $playCate = 405;
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
            $playId = 7068;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 3){
            $playId = 7069;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 4){
            $playId = 7070;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 5){
            $playId = 7071;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 6){
            $playId = 7072;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 7){
            $playId = 7073;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count%2 == 0){
            $playId = 7075;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7074;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    //正码特
    public function ZMT($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 400;
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

        $zm1_nums = [1=>7180,2=>7181,3=>7182,4=>7183,5=>7184,6=>7185,7=>7186,8=>7187,9=>7188,10=>7189,11=>7190,12=>7191,13=>7192,14=>7193,15=>7194,16=>7195,17=>7196,18=>7197,19=>7198,20=>7199,21=>7200,22=>7201,23=>7202,24=>7203,25=>7204,26=>7205,27=>7206,28=>7207,29=>7208,30=>7209,31=>7210,32=>7211,33=>7212,34=>7213,35=>7214,36=>7215,37=>7216,38=>7217,39=>7218,40=>7219,41=>7220,42=>7221,43=>7222,44=>7223,45=>7224,46=>7225,47=>7226,48=>7227,49=>7228];
        $zm2_nums = [1=>7242,2=>7243,3=>7244,4=>7245,5=>7246,6=>7247,7=>7248,8=>7249,9=>7250,10=>7251,11=>7252,12=>7253,13=>7254,14=>7255,15=>7256,16=>7257,17=>7258,18=>7259,19=>7260,20=>7261,21=>7262,22=>7263,23=>7264,24=>7265,25=>7266,26=>7267,27=>7268,28=>7269,29=>7270,30=>7271,31=>7272,32=>7273,33=>7274,34=>7275,35=>7276,36=>7277,37=>7278,38=>7279,39=>7280,40=>7281,41=>7282,42=>7283,43=>7284,44=>7285,45=>7286,46=>7287,47=>7288,48=>7289,49=>7290];
        $zm3_nums = [1=>7304,2=>7305,3=>7306,4=>7307,5=>7308,6=>7309,7=>7310,8=>7311,9=>7312,10=>7313,11=>7314,12=>7315,13=>7316,14=>7317,15=>7318,16=>7319,17=>7320,18=>7321,19=>7322,20=>7323,21=>7324,22=>7325,23=>7326,24=>7327,25=>7328,26=>7329,27=>7330,28=>7331,29=>7332,30=>7333,31=>7334,32=>7335,33=>7336,34=>7337,35=>7338,36=>7339,37=>7340,38=>7341,39=>7342,40=>7343,41=>7344,42=>7345,43=>7346,44=>7347,45=>7348,46=>7349,47=>7350,48=>7351,49=>7352];
        $zm4_nums = [1=>7366,2=>7367,3=>7368,4=>7369,5=>7370,6=>7371,7=>7372,8=>7373,9=>7374,10=>7375,11=>7376,12=>7377,13=>7378,14=>7379,15=>7380,16=>7381,17=>7382,18=>7383,19=>7384,20=>7385,21=>7386,22=>7387,23=>7388,24=>7389,25=>7390,26=>7391,27=>7392,28=>7393,29=>7394,30=>7395,31=>7396,32=>7397,33=>7398,34=>7399,35=>7400,36=>7401,37=>7402,38=>7403,39=>7404,40=>7405,41=>7406,42=>7407,43=>7408,44=>7409,45=>7410,46=>7411,47=>7412,48=>7413,49=>7414];
        $zm5_nums = [1=>7428,2=>7429,3=>7430,4=>7431,5=>7432,6=>7433,7=>7434,8=>7435,9=>7436,10=>7437,11=>7438,12=>7439,13=>7440,14=>7441,15=>7442,16=>7443,17=>7444,18=>7445,19=>7446,20=>7447,21=>7448,22=>7449,23=>7450,24=>7451,25=>7452,26=>7453,27=>7454,28=>7455,29=>7456,30=>7457,31=>7458,32=>7459,33=>7460,34=>7461,35=>7462,36=>7463,37=>7464,38=>7465,39=>7466,40=>7467,41=>7468,42=>7469,43=>7470,44=>7471,45=>7472,46=>7473,47=>7474,48=>7475,49=>7476];
        $zm6_nums = [1=>7490,2=>7491,3=>7492,4=>7493,5=>7494,6=>7495,7=>7496,8=>7497,9=>7498,10=>7499,11=>7500,12=>7501,13=>7502,14=>7503,15=>7504,16=>7505,17=>7506,18=>7507,19=>7508,20=>7509,21=>7510,22=>7511,23=>7512,24=>7513,25=>7514,26=>7515,27=>7516,28=>7517,29=>7518,30=>7519,31=>7520,32=>7521,33=>7522,34=>7523,35=>7524,36=>7525,37=>7526,38=>7527,39=>7528,40=>7529,41=>7530,42=>7531,43=>7532,44=>7533,45=>7534,46=>7535,47=>7536,48=>7537,49=>7538];
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
            $playId = 7230;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 7229;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1 <= 24){ //小
            $playId = 7232;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //大
            $playId = 7231;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_heshu%2 == 0){//合双
            $playId = 7234;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //合单
            $playId = 7233;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_heshu >= 7){ //合大
            $playId = 7235;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_heshu <= 6){ //合小
            $playId = 7236;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_wei == 5 || $zm1_wei == 6 || $zm1_wei == 7 || $zm1_wei == 8 || $zm1_wei == 9){ //尾大
            $playId = 7240;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm1_wei == 0 || $zm1_wei == 1 || $zm1_wei == 2 || $zm1_wei == 3 || $zm1_wei == 4){ //尾小
            $playId = 7241;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'R'){
            $playId = 7237;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'B'){
            $playId = 7238;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'G'){
            $playId = 7239;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正1====两面====结束
        //正2====两面====开始
        if($zm2%2 == 0){ //双
            $playId = 7292;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7291;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2 <= 24){ //小
            $playId = 7294;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7293;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_heshu%2 == 0){//合双
            $playId = 7296;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7295;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_heshu >= 7){ //合大
            $playId = 7297;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_heshu <= 6){ //合小
            $playId = 7298;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_wei == 5 || $zm2_wei == 6 || $zm2_wei == 7 || $zm2_wei == 8 || $zm2_wei == 9){ //尾大
            $playId = 7302;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm2_wei == 0 || $zm2_wei == 1 || $zm2_wei == 2 || $zm2_wei == 3 || $zm2_wei == 4){ //尾小
            $playId = 7303;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'R'){
            $playId = 7299;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'B'){
            $playId = 7300;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'G'){
            $playId = 7301;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正2====两面====结束
        //正3====两面====开始
        if($zm3%2 == 0){ //双
            $playId = 7354;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7353;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3 <= 24){ //小
            $playId = 7356;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7355;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_heshu%2 == 0){//合双
            $playId = 7358;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7357;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_heshu >= 7){ //合大
            $playId = 7359;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_heshu <= 6){ //合小
            $playId = 7360;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_wei == 5 || $zm3_wei == 6 || $zm3_wei == 7 || $zm3_wei == 8 || $zm3_wei == 9){ //尾大
            $playId = 7364;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm3_wei == 0 || $zm3_wei == 1 || $zm3_wei == 2 || $zm3_wei == 3 || $zm3_wei == 4){ //尾小
            $playId = 7365;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'R'){
            $playId = 7361;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'B'){
            $playId = 7362;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'G'){
            $playId = 7363;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正3====两面====结束
        //正4====两面====开始
        if($zm4%2 == 0){ //双
            $playId = 7416;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7415;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4 <= 24){ //小
            $playId = 7418;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7417;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_heshu%2 == 0){//合双
            $playId = 7420;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7419;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_heshu >= 7){ //合大
            $playId = 7421;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_heshu <= 6){ //合小
            $playId = 7422;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_wei == 5 || $zm4_wei == 6 || $zm4_wei == 7 || $zm4_wei == 8 || $zm4_wei == 9){ //尾大
            $playId = 7426;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm4_wei == 0 || $zm4_wei == 1 || $zm4_wei == 2 || $zm4_wei == 3 || $zm4_wei == 4){ //尾小
            $playId = 7427;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'R'){
            $playId = 7423;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'B'){
            $playId = 7424;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'G'){
            $playId = 7425;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正4====两面====结束
        //正5====两面====开始
        if($zm5%2 == 0){ //双
            $playId = 7478;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7477;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5 <= 24){ //小
            $playId = 7480;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7479;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_heshu%2 == 0){//合双
            $playId = 7482;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7481;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_heshu >= 7){ //合大
            $playId = 7483;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_heshu <= 6){ //合小
            $playId = 7484;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_wei == 5 || $zm5_wei == 6 || $zm5_wei == 7 || $zm5_wei == 8 || $zm5_wei == 9){ //尾大
            $playId = 7488;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm5_wei == 0 || $zm5_wei == 1 || $zm5_wei == 2 || $zm5_wei == 3 || $zm5_wei == 4){ //尾小
            $playId = 7489;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'R'){
            $playId = 7485;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'B'){
            $playId = 7486;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'G'){
            $playId = 7487;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正5====两面====结束
        //正6====两面====开始
        if($zm6%2 == 0){ //双
            $playId = 7540;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7539;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6 <= 24){ //小
            $playId = 7542;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7541;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_heshu%2 == 0){//合双
            $playId = 7544;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 7543;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_heshu >= 7){ //合大
            $playId = 7545;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_heshu <= 6){ //合小
            $playId = 7546;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_wei == 5 || $zm6_wei == 6 || $zm6_wei == 7 || $zm6_wei == 8 || $zm6_wei == 9){ //尾大
            $playId = 7550;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($zm6_wei == 0 || $zm6_wei == 1 || $zm6_wei == 2 || $zm6_wei == 3 || $zm6_wei == 4){ //尾小
            $playId = 7551;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'R'){
            $playId = 7547;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'B'){
            $playId = 7548;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'G'){
            $playId = 7549;
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

        if($excel) {
            $table = 'excel_bet';
        }else{
            $table = 'bet';
        }
        $getUserBets = DB::connection('mysql::write')->table($table)->select('bet_id','bet_money','play_odds')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();

        if($getUserBets){
            $sql = "UPDATE ".$table." SET bunko = CASE "; //中奖的SQL语句
            $sql_lose = "UPDATE ".$table." SET bunko = CASE "; //未中奖的SQL语句
            $sql_he = "UPDATE ".$table." SET bunko = CASE "; //和局的SQL语句

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

            //自选不中------开始
            $zxbz_playCate = 406; //特码分类ID
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
            $hexiao_playCate = 397; //分类ID
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
            $zx_playCate = 403; //分类ID
            $zx_id = [];
            $zx_plays = ['鼠'=>7052,'牛'=>7053,'虎'=>7054,'兔'=>7055,'龙'=>7056,'蛇'=>7057,'马'=>7058,'羊'=>7059,'猴'=>7060,'鸡'=>7061,'狗'=>7062,'猪'=>7063];
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
                        $zx_sql .= sprintf("WHEN %d THEN bet_money + (bet_money * (play_odds-1)) * %d ", $playId, $vv);
                    }
                }
            }
            $zx_ids = implode(',',$zx_id);
            if($zx_ids && isset($zx_ids)){
                $zx_sql .= "END, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `game_id` = $gameId AND `issue` = $issue AND play_id IN ($zx_ids)";
            } else {
                $zx_sql = 0;
            }
            //正肖-----结束

            //连肖连尾-----开始
            $lxlw_playCate = 407; //分类ID
            $uniqueSX = array_unique([$sx1,$sx2,$sx3,$sx4,$sx5,$sx6,$sx7]);
            //二连肖
            $lx_ids = [];
            $get2LX = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lxlw_playCate)->where('play_name','like','%二连肖%')->where('bunko','=',0.00)->get();
            foreach ($get2LX as $item) {
                $userBetInfoSX = explode(',',$item->bet_info);
                $bi = array_intersect($uniqueSX, $userBetInfoSX);
                if(count($bi) == 2){
                    $lx_ids[] = $item->bet_id;
                }
            }
            //三连肖
            $get3LX = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lxlw_playCate)->where('play_name','like','%三连肖%')->where('bunko','=',0.00)->get();
            foreach ($get3LX as $item) {
                $userBetInfoSX_3 = explode(',',$item->bet_info);
                $bi = array_intersect($uniqueSX, $userBetInfoSX_3);
                if(count($bi) == 3){
                    $lx_ids[] = $item->bet_id;
                }
            }
            //四连肖
            $get4LX = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lxlw_playCate)->where('play_name','like','%四连肖%')->where('bunko','=',0.00)->get();
            foreach ($get4LX as $item) {
                $userBetInfoSX_4 = explode(',',$item->bet_info);
                $bi = array_intersect($uniqueSX, $userBetInfoSX_4);
                if(count($bi) == 4){
                    $lx_ids[] = $item->bet_id;
                }
            }
            //五连肖
            $get5LX = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lxlw_playCate)->where('play_name','like','%五连肖%')->where('bunko','=',0.00)->get();
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
            $get2LW = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lxlw_playCate)->where('play_name','like','%二连尾%')->where('bunko','=',0.00)->get();
            foreach ($get2LW as $item) {
                $userBetInfoWei = explode(',',$item->bet_info);
                $bi = array_intersect($uniqueWei, $userBetInfoWei);
                if(count($bi) == 2){
                    $lw_ids[] = $item->bet_id;
                }
            }
            //三连尾
            $get3LW = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lxlw_playCate)->where('play_name','like','%三连尾%')->where('bunko','=',0.00)->get();
            foreach ($get3LW as $item) {
                $userBetInfoWei_3 = explode(',',$item->bet_info);
                $bi = array_intersect($uniqueWei, $userBetInfoWei_3);
                if(count($bi) == 3){
                    $lw_ids[] = $item->bet_id;
                }
            }
            //四连尾
            $get4LW = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lxlw_playCate)->where('play_name','like','%四连尾%')->where('bunko','=',0.00)->get();
            foreach ($get4LW as $item) {
                $userBetInfoWei_4 = explode(',',$item->bet_info);
                $bi = array_intersect($uniqueWei, $userBetInfoWei_4);
                if(count($bi) == 4){
                    $lw_ids[] = $item->bet_id;
                }
            }
            //五连尾
            $get5LW = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lxlw_playCate)->where('play_name','like','%五连尾%')->where('bunko','=',0.00)->get();
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
            $lm_playCate = 408; //分类ID
            //连码-----结束

            if(!empty($sql_bets_lose)){
                $run2 = DB::connection('mysql::write')->statement($sql_lose);
                if($run2 == 1){
                    $bunko_index++;
                }
            }
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

        if($bunko_index !== 0){
            return 1;
        }
    }
}
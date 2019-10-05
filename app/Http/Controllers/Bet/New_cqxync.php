<?php

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryNC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_cqxync extends Excel
{
    protected $arrPlay_id = array(6142931,6142932,6142933,6142934,6142935,6142936,6143937,6143938,6143939,6143940,6143941,6143942,6143943,6143944,6143945,6143946,6143947,6143948,6143949,6143950,6143951,6143952,6143953,6143954,6143955,6143956,6143957,6143958,6143959,6143960,6143961,6143962,6143963,6143964,6143965,6143966,6143967,6143968,6143969,6143970,6143971,6143972,6143973,6144974,6144975,6144976,6144977,6144978,6144979,6144980,6144981,6144982,6144983,6144984,6144985,6144986,6144987,6144988,6144989,6144990,6144991,6144992,6144993,6144994,6144995,6144996,6144997,6144998,6144999,61441000,61441001,61441002,61441003,61441004,61441005,61441006,61441007,61441008,61441009,61441010,61451011,61451012,61451013,61451014,61451015,61451016,61451017,61451018,61451019,61451020,61451021,61451022,61451023,61451024,61451025,61451026,61451027,61451028,61451029,61451030,61451031,61451032,61451033,61451034,61451035,61451036,61451037,61451038,61451039,61451040,61451041,61451042,61451043,61451044,61451045,61451046,61451047,61461048,61461049,61461050,61461051,61461052,61461053,61461054,61461055,61461056,61461057,61461058,61461059,61461060,61461061,61461062,61461063,61461064,61461065,61461066,61461067,61461068,61461069,61461070,61461071,61461072,61461073,61461074,61461075,61461076,61461077,61461078,61461079,61461080,61461081,61461082,61461083,61461084,61471085,61471086,61471087,61471088,61471089,61471090,61471091,61471092,61471093,61471094,61471095,61471096,61471097,61471098,61471099,61471100,61471101,61471102,61471103,61471104,61471105,61471106,61471107,61471108,61471109,61471110,61471111,61471112,61471113,61471114,61471115,61471116,61471117,61471118,61471119,61471120,61471121,61481122,61481123,61481124,61481125,61481126,61481127,61481128,61481129,61481130,61481131,61481132,61481133,61481134,61481135,61481136,61481137,61481138,61481139,61481140,61481141,61481142,61481143,61481144,61481145,61481146,61481147,61481148,61481149,61481150,61481151,61481152,61481153,61481154,61481155,61481156,61481157,61481158,61491159,61491160,61491161,61491162,61491163,61491164,61491165,61491166,61491167,61491168,61491169,61491170,61491171,61491172,61491173,61491174,61491175,61491176,61491177,61491178,61491179,61491180,61491181,61491182,61491183,61491184,61491185,61491186,61491187,61491188,61491189,61491190,61491191,61491192,61491193,61491194,61491195,61501196,61501197,61501198,61501199,61501200,61501201,61501202,61501203,61501204,61501205,61501206,61501207,61501208,61501209,61501210,61501211,61501212,61501213,61501214,61501215,61501216,61501217,61501218,61501219,61501220,61501221,61501222,61501223,61501224,61501225,61501226,61501227,61501228,61501229,61501230,61501231,61501232,61511233,61511234,61511235,61511236,61511237,61511238,61511239,61511240,61511241,61511242,61511243,61511244,61511245,61511246,61511247,61511248,61511249,61511250,61511251,61511252,61521253,61521254,61521255,61521256,61521257,61521258);
    protected $arrPlayCate = array(
        'ZH' => 42,
        'QIU1' => 43,
        'QIU2' => 44,
        'QIU3' => 45,
        'QIU4' => 46,
        'QIU5' => 47,
        'QIU6' => 48,
        'QIU7' => 49,
        'QIU8' => 50,
        'ZM' => 51,
        'LM' => 52,
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 931,
        'ZONGHEXIAO' => 932,
        'ZONGHEDAN' => 933,
        'ZONGHESHUANG' => 934,
        'ZONGHEWEIDA' => 935,
        'ZONGHEWEIXIAO' => 936,
        'DIYIQIU1' => 937,
        'DIYIQIU2' => 938,
        'DIYIQIU3' => 939,
        'DIYIQIU4' => 940,
        'DIYIQIU5' => 941,
        'DIYIQIU6' => 942,
        'DIYIQIU7' => 943,
        'DIYIQIU8' => 944,
        'DIYIQIU9' => 945,
        'DIYIQIU10' => 946,
        'DIYIQIU11' => 947,
        'DIYIQIU12' => 948,
        'DIYIQIU13' => 949,
        'DIYIQIU14' => 950,
        'DIYIQIU15' => 951,
        'DIYIQIU16' => 952,
        'DIYIQIU17' => 953,
        'DIYIQIU18' => 954,
        'DIYIQIU19' => 955,
        'DIYIQIU20' => 956,
        'DIYIQIUDA' => 957,
        'DIYIQIUXIAO' => 958,
        'DIYIQIUDAN' => 959,
        'DIYIQIUSHUANG' => 960,
        'DIYIQIUWEIDA' => 961,
        'DIYIQIUWEIXIAO' => 962,
        'DIYIQIUHESHUDAN' => 963,
        'DIYIQIUHESHUSHUANG' => 964,
        'DIYIQIUDONG' => 965,
        'DIYIQIUNAN' => 966,
        'DIYIQIUXI' => 967,
        'DIYIQIUBEI' => 968,
        'DIYIQIUZHONG' => 969,
        'DIYIQIUFA' => 970,
        'DIYIQIUBAI' => 971,
        'DIYIQIULONG' => 972,
        'DIYIQIUHU' => 973,
        'DIERQIU1' => 974,
        'DIERQIU2' => 975,
        'DIERQIU3' => 976,
        'DIERQIU4' => 977,
        'DIERQIU5' => 978,
        'DIERQIU6' => 979,
        'DIERQIU7' => 980,
        'DIERQIU8' => 981,
        'DIERQIU9' => 982,
        'DIERQIU10' => 983,
        'DIERQIU11' => 984,
        'DIERQIU12' => 985,
        'DIERQIU13' => 986,
        'DIERQIU14' => 987,
        'DIERQIU15' => 988,
        'DIERQIU16' => 989,
        'DIERQIU17' => 990,
        'DIERQIU18' => 991,
        'DIERQIU19' => 992,
        'DIERQIU20' => 993,
        'DIERQIUDA' => 994,
        'DIERQIUXIAO' => 995,
        'DIERQIUDAN' => 996,
        'DIERQIUSHUANG' => 997,
        'DIERQIUWEIDA' => 998,
        'DIERQIUWEIXIAO' => 999,
        'DIERQIUHESHUDAN' => 1000,
        'DIERQIUHESHUSHUANG' => 1001,
        'DIERQIUDONG' => 1002,
        'DIERQIUNAN' => 1003,
        'DIERQIUXI' => 1004,
        'DIERQIUBEI' => 1005,
        'DIERQIUZHONG' => 1006,
        'DIERQIUFA' => 1007,
        'DIERQIUBAI' => 1008,
        'DIERQIULONG' => 1009,
        'DIERQIUHU' => 1010,
        'DISANQIU1' => 1011,
        'DISANQIU2' => 1012,
        'DISANQIU3' => 1013,
        'DISANQIU4' => 1014,
        'DISANQIU5' => 1015,
        'DISANQIU6' => 1016,
        'DISANQIU7' => 1017,
        'DISANQIU8' => 1018,
        'DISANQIU9' => 1019,
        'DISANQIU10' => 1020,
        'DISANQIU11' => 1021,
        'DISANQIU12' => 1022,
        'DISANQIU13' => 1023,
        'DISANQIU14' => 1024,
        'DISANQIU15' => 1025,
        'DISANQIU16' => 1026,
        'DISANQIU17' => 1027,
        'DISANQIU18' => 1028,
        'DISANQIU19' => 1029,
        'DISANQIU20' => 1030,
        'DISANQIUDA' => 1031,
        'DISANQIUXIAO' => 1032,
        'DISANQIUDAN' => 1033,
        'DISANQIUSHUANG' => 1034,
        'DISANQIUWEIDA' => 1035,
        'DISANQIUWEIXIAO' => 1036,
        'DISANQIUHESHUDAN' => 1037,
        'DISANQIUHESHUSHUANG' => 1038,
        'DISANQIUDONG' => 1039,
        'DISANQIUNAN' => 1040,
        'DISANQIUXI' => 1041,
        'DISANQIUBEI' => 1042,
        'DISANQIUZHONG' => 1043,
        'DISANQIUFA' => 1044,
        'DISANQIUBAI' => 1045,
        'DISANQIULONG' => 1046,
        'DISANQIUHU' => 1047,
        'DISIQIU1' => 1048,
        'DISIQIU2' => 1049,
        'DISIQIU3' => 1050,
        'DISIQIU4' => 1051,
        'DISIQIU5' => 1052,
        'DISIQIU6' => 1053,
        'DISIQIU7' => 1054,
        'DISIQIU8' => 1055,
        'DISIQIU9' => 1056,
        'DISIQIU10' => 1057,
        'DISIQIU11' => 1058,
        'DISIQIU12' => 1059,
        'DISIQIU13' => 1060,
        'DISIQIU14' => 1061,
        'DISIQIU15' => 1062,
        'DISIQIU16' => 1063,
        'DISIQIU17' => 1064,
        'DISIQIU18' => 1065,
        'DISIQIU19' => 1066,
        'DISIQIU20' => 1067,
        'DISIQIUDA' => 1068,
        'DISIQIUXIAO' => 1069,
        'DISIQIUDAN' => 1070,
        'DISIQIUSHUANG' => 1071,
        'DISIQIUWEIDA' => 1072,
        'DISIQIUWEIXIAO' => 1073,
        'DISIQIUHESHUDAN' => 1074,
        'DISIQIUHESHUSHUANG' => 1075,
        'DISIQIUDONG' => 1076,
        'DISIQIUNAN' => 1077,
        'DISIQIUXI' => 1078,
        'DISIQIUBEI' => 1079,
        'DISIQIUZHONG' => 1080,
        'DISIQIUFA' => 1081,
        'DISIQIUBAI' => 1082,
        'DISIQIULONG' => 1083,
        'DISIQIUHU' => 1084,
        'DIWUQIU1' => 1085,
        'DIWUQIU2' => 1086,
        'DIWUQIU3' => 1087,
        'DIWUQIU4' => 1088,
        'DIWUQIU5' => 1089,
        'DIWUQIU6' => 1090,
        'DIWUQIU7' => 1091,
        'DIWUQIU8' => 1092,
        'DIWUQIU9' => 1093,
        'DIWUQIU10' => 1094,
        'DIWUQIU11' => 1095,
        'DIWUQIU12' => 1096,
        'DIWUQIU13' => 1097,
        'DIWUQIU14' => 1098,
        'DIWUQIU15' => 1099,
        'DIWUQIU16' => 1100,
        'DIWUQIU17' => 1101,
        'DIWUQIU18' => 1102,
        'DIWUQIU19' => 1103,
        'DIWUQIU20' => 1104,
        'DIWUQIUDA' => 1105,
        'DIWUQIUXIAO' => 1106,
        'DIWUQIUDAN' => 1107,
        'DIWUQIUSHUANG' => 1108,
        'DIWUQIUWEIDA' => 1109,
        'DIWUQIUWEIXIAO' => 1110,
        'DIWUQIUHESHUDAN' => 1111,
        'DIWUQIUHESHUSHUANG' => 1112,
        'DIWUQIUDONG' => 1113,
        'DIWUQIUNAN' => 1114,
        'DIWUQIUXI' => 1115,
        'DIWUQIUBEI' => 1116,
        'DIWUQIUZHONG' => 1117,
        'DIWUQIUFA' => 1118,
        'DIWUQIUBAI' => 1119,
        'DIWUQIULONG' => 1120,
        'DIWUQIUHU' => 1121,
        'DILIUQIU1' => 1122,
        'DILIUQIU2' => 1123,
        'DILIUQIU3' => 1124,
        'DILIUQIU4' => 1125,
        'DILIUQIU5' => 1126,
        'DILIUQIU6' => 1127,
        'DILIUQIU7' => 1128,
        'DILIUQIU8' => 1129,
        'DILIUQIU9' => 1130,
        'DILIUQIU10' => 1131,
        'DILIUQIU11' => 1132,
        'DILIUQIU12' => 1133,
        'DILIUQIU13' => 1134,
        'DILIUQIU14' => 1135,
        'DILIUQIU15' => 1136,
        'DILIUQIU16' => 1137,
        'DILIUQIU17' => 1138,
        'DILIUQIU18' => 1139,
        'DILIUQIU19' => 1140,
        'DILIUQIU20' => 1141,
        'DILIUQIUDA' => 1142,
        'DILIUQIUXIAO' => 1143,
        'DILIUQIUDAN' => 1144,
        'DILIUQIUSHUANG' => 1145,
        'DILIUQIUWEIDA' => 1146,
        'DILIUQIUWEIXIAO' => 1147,
        'DILIUQIUHESHUDAN' => 1148,
        'DILIUQIUHESHUSHUANG' => 1149,
        'DILIUQIUDONG' => 1150,
        'DILIUQIUNAN' => 1151,
        'DILIUQIUXI' => 1152,
        'DILIUQIUBEI' => 1153,
        'DILIUQIUZHONG' => 1154,
        'DILIUQIUFA' => 1155,
        'DILIUQIUBAI' => 1156,
        'DILIUQIULONG' => 1157,
        'DILIUQIUHU' => 1158,
        'DIQIQIU1' => 1159,
        'DIQIQIU2' => 1160,
        'DIQIQIU3' => 1161,
        'DIQIQIU4' => 1162,
        'DIQIQIU5' => 1163,
        'DIQIQIU6' => 1164,
        'DIQIQIU7' => 1165,
        'DIQIQIU8' => 1166,
        'DIQIQIU9' => 1167,
        'DIQIQIU10' => 1168,
        'DIQIQIU11' => 1169,
        'DIQIQIU12' => 1170,
        'DIQIQIU13' => 1171,
        'DIQIQIU14' => 1172,
        'DIQIQIU15' => 1173,
        'DIQIQIU16' => 1174,
        'DIQIQIU17' => 1175,
        'DIQIQIU18' => 1176,
        'DIQIQIU19' => 1177,
        'DIQIQIU20' => 1178,
        'DIQIQIUDA' => 1179,
        'DIQIQIUXIAO' => 1180,
        'DIQIQIUDAN' => 1181,
        'DIQIQIUSHUANG' => 1182,
        'DIQIQIUWEIDA' => 1183,
        'DIQIQIUWEIXIAO' => 1184,
        'DIQIQIUHESHUDAN' => 1185,
        'DIQIQIUHESHUSHUANG' => 1186,
        'DIQIQIUDONG' => 1187,
        'DIQIQIUNAN' => 1188,
        'DIQIQIUXI' => 1189,
        'DIQIQIUBEI' => 1190,
        'DIQIQIUZHONG' => 1191,
        'DIQIQIUFA' => 1192,
        'DIQIQIUBAI' => 1193,
        'DIQIQIULONG' => 1194,
        'DIQIQIUHU' => 1195,
        'DIBAQIU1' => 1196,
        'DIBAQIU2' => 1197,
        'DIBAQIU3' => 1198,
        'DIBAQIU4' => 1199,
        'DIBAQIU5' => 1200,
        'DIBAQIU6' => 1201,
        'DIBAQIU7' => 1202,
        'DIBAQIU8' => 1203,
        'DIBAQIU9' => 1204,
        'DIBAQIU10' => 1205,
        'DIBAQIU11' => 1206,
        'DIBAQIU12' => 1207,
        'DIBAQIU13' => 1208,
        'DIBAQIU14' => 1209,
        'DIBAQIU15' => 1210,
        'DIBAQIU16' => 1211,
        'DIBAQIU17' => 1212,
        'DIBAQIU18' => 1213,
        'DIBAQIU19' => 1214,
        'DIBAQIU20' => 1215,
        'DIBAQIUDA' => 1216,
        'DIBAQIUXIAO' => 1217,
        'DIBAQIUDAN' => 1218,
        'DIBAQIUSHUANG' => 1219,
        'DIBAQIUWEIDA' => 1220,
        'DIBAQIUWEIXIAO' => 1221,
        'DIBAQIUHESHUDAN' => 1222,
        'DIBAQIUHESHUSHUANG' => 1223,
        'DIBAQIUDONG' => 1224,
        'DIBAQIUNAN' => 1225,
        'DIBAQIUXI' => 1226,
        'DIBAQIUBEI' => 1227,
        'DIBAQIUZHONG' => 1228,
        'DIBAQIUFA' => 1229,
        'DIBAQIUBAI' => 1230,
        'DIBAQIULONG' => 1231,
        'DIBAQIUHU' => 1232,
        'ZHENGMA1' => 1233,
        'ZHENGMA2' => 1234,
        'ZHENGMA3' => 1235,
        'ZHENGMA4' => 1236,
        'ZHENGMA5' => 1237,
        'ZHENGMA6' => 1238,
        'ZHENGMA7' => 1239,
        'ZHENGMA8' => 1240,
        'ZHENGMA9' => 1241,
        'ZHENGMA10' => 1242,
        'ZHENGMA11' => 1243,
        'ZHENGMA12' => 1244,
        'ZHENGMA13' => 1245,
        'ZHENGMA14' => 1246,
        'ZHENGMA15' => 1247,
        'ZHENGMA16' => 1248,
        'ZHENGMA17' => 1249,
        'ZHENGMA18' => 1250,
        'ZHENGMA19' => 1251,
        'ZHENGMA20' => 1252,
        'RENXUANER' => 1253,
        'XUANERLIANZU' => 1254,
        'RENXUANSAN' => 1255,
        'XUANSANQIANZU' => 1256,
        'RENXUANSI' => 1257,
        'RENXUANWU' => 1258,
    );

    protected function exc_play($openCode,$gameId)
    {
        $win = collect([]);
        $ids_he = collect([]);
        $NC = new ExcelLotteryNC();
        $NC->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $NC->LM($gameId,$win,$ids_he);
        $NC->ZM($openCode,$gameId,$win);
        return array('win'=>$win,'ids_he'=>$ids_he,'NC'=>$NC);
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
            $NC = isset($resData['NC'])?$resData['NC']:null;
            try{
                $bunko = $this->bunko_nc($win,$gameId,$issue,$openCode,$he,$NC);
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

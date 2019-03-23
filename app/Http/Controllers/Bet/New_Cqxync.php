<?php

namespace App\Http\Controllers\Bet;

use App\Bets;
use App\Excel;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Cqxync extends Excel
{
    private function exc_play($openCode,$gameId)
    {
        $win = collect([]);
        $ids_he = collect([]);
        $this->LM($openCode,$gameId,$win,$ids_he);
        $this->ZM($openCode,$gameId,$win);
        return array('win'=>$win,'ids_he'=>$ids_he);
    }
    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_cqxync';
        $gameName = '重庆幸运农场';
        $betCount = DB::table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $excelModel = new Excel();
            $bunko = 0;
            $resData = $this->exc_play($openCode,$gameId);
            $win = @$resData['win'];
            $he = isset($resData['ids_he'])?$resData['ids_he']:array();
            try{
                $bunko = $this->bunko($win,$gameId,$issue,$openCode,$he);
            }catch (\exception $exception){
                writeLog('New_Bet', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->update(['bunko' => 0]);
            }
            if($bunko == 1){
                $updateUserMoney = $excelModel->updateUserMoney($gameId,$issue,$gameName);
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
            $agentJob = new AgentBackwaterJob($gameId,$issue);
            $agentJob->addQueue();
        }
    }

    //两面部分结算
    private function LM($openCode,$gameId,$win,$ids_he){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 42;
        $num1 = (int)$arrOpenCode[0];
        $num2 = (int)$arrOpenCode[1];
        $num3 = (int)$arrOpenCode[2];
        $num4 = (int)$arrOpenCode[3];
        $num5 = (int)$arrOpenCode[4];
        $num6 = (int)$arrOpenCode[5];
        $num7 = (int)$arrOpenCode[6];
        $num8 = (int)$arrOpenCode[7];
        $numsTotal = (int)$num1 + (int)$num2 + (int)$num3 + (int)$num4 + (int)$num5 + (int)$num6 + (int)$num7 + (int)$num8;
        $zhongArr = [1,2,3,4,5,6,7]; //中
        $faArr = [8,9,10,11,12,13,14]; //发
        $baiArr = [15,16,17,18,19,20]; //白
        $dongArr = [1,5,9,13,17]; //东
        $nanArr = [2,6,10,14,18]; //南
        $xiArr = [3,7,11,15,19]; //西
        $beiArr = [4,8,12,16,20]; //北

        //总和大小-Start
        if($numsTotal == 84){ //总和等于84视为和局  //和局退本金
            $playId = 931;
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = 932;
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
        }
        if($numsTotal >= 85 && $numsTotal <= 132){ //总和大
            $playId = 931;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }else if($numsTotal >= 36 && $numsTotal <= 83){ //总和小
            $playId = 932;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //总和大小-End

        //总和单双-Start
        if($numsTotal%2 == 0){
            $playId = 934;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 933;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //总和单双-End

        //总和尾大、尾小-Start
        $totalStrSplit = str_split($numsTotal);
        if(count($totalStrSplit) == 3){
            $totalWei = (int)$totalStrSplit[2];
        }
        if(count($totalStrSplit) == 2){
            $totalWei = (int)$totalStrSplit[1];
        }

        if($totalWei >= 5){
            $playId = 935;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($totalWei <= 4){
            $playId = 936;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //总和尾大、尾小-End

        //第一球两面-Start
        $Q1PlayCate = 43;
        if($num1 >= 11){ //大
            $playId = 957;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1 <= 10){ //小
            $playId = 958;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1%2 == 0){ //双
            $playId = 960;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 959;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        $num1_add_zero = str_pad($num1,2,"0",STR_PAD_LEFT); //十位补零
        $num1_over = str_split($num1_add_zero); //拆分个位 十位
        $num1_tou = (int)$num1_over[0];
        $num1_wei = (int)$num1_over[1];
        $num1Total = $num1_wei+$num1_tou;
        if($num1_wei >= 5){ //尾大
            $playId = 961;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1_wei <= 4){ //尾小
            $playId = 962;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1Total%2 == 0){ //合数双
            $playId = 964;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 963;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1 > $num8){ //龙
            $playId = 972;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = 973;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$zhongArr)){ //中
            $playId = 969;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$faArr)){ //发
            $playId = 970;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$baiArr)){ //白
            $playId = 971;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$dongArr)){ //东
            $playId = 965;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$nanArr)){ //南
            $playId = 966;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$xiArr)){ //西
            $playId = 967;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$beiArr)){ //北
            $playId = 968;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        //第一球两面-End
        //第一球单号-Start
        switch ($num1){
            case 1:
                $playId = 937;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 938;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 939;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 940;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 941;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 942;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 943;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 944;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 945;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 946;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 947;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 948;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 949;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 950;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 951;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 952;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 953;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 954;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 955;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 956;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第一球单号-End

        //第二球两面-Start
        $Q2PlayCate = 44;
        if($num2 >= 11){ //大
            $playId = 994;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2 <= 10){ //小
            $playId = 995;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2%2 == 0){ //双
            $playId = 997;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 996;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        $num2_add_zero = str_pad($num2,2,"0",STR_PAD_LEFT); //十位补零
        $num2_over = str_split($num2_add_zero); //拆分个位 十位
        $num2_tou = (int)$num2_over[0];
        $num2_wei = (int)$num2_over[1];
        $num2Total = $num2_wei+$num2_tou;
        if($num2_wei >= 5){ //尾大
            $playId = 998;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2_wei <= 4){ //尾小
            $playId = 999;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2Total%2 == 0){ //合数双
            $playId = 1001;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 1000;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2 > $num7){ //龙
            $playId = 1009;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = 1010;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$zhongArr)){ //中
            $playId = 1006;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$faArr)){ //发
            $playId = 1007;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$baiArr)){ //白
            $playId = 1008;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$dongArr)){ //东
            $playId = 1002;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$nanArr)){ //南
            $playId = 1003;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$xiArr)){ //西
            $playId = 1004;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$beiArr)){ //北
            $playId = 1005;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        //第二球两面-End
        //第二球单号-Start
        switch ($num2){
            case 1:
                $playId = 974;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 975;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 976;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 977;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 978;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 979;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 980;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 981;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 982;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 983;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 984;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 985;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 986;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 987;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 988;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 989;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 990;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 991;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 992;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 993;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第二球单号-End

        //第三球两面-Start
        $Q3PlayCate = 45;
        if($num3 >= 11){ //大
            $playId = 1031;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3 <= 10){ //小
            $playId = 1032;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3%2 == 0){ //双
            $playId = 1034;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 1033;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        $num3_add_zero = str_pad($num3,2,"0",STR_PAD_LEFT); //十位补零
        $num3_over = str_split($num3_add_zero); //拆分个位 十位
        $num3_tou = (int)$num3_over[0];
        $num3_wei = (int)$num3_over[1];
        $num3Total = $num3_wei+$num3_tou;
        if($num3_wei >= 5){ //尾大
            $playId = 1035;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3_wei <= 4){ //尾小
            $playId = 1036;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3Total%2 == 0){ //合数双
            $playId = 1038;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 1037;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3 > $num6){ //龙
            $playId = 1046;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = 1047;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$zhongArr)){ //中
            $playId = 1043;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$faArr)){ //发
            $playId = 1044;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$baiArr)){ //白
            $playId = 1045;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$dongArr)){ //东
            $playId = 1039;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$nanArr)){ //南
            $playId = 1040;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$xiArr)){ //西
            $playId = 1041;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$beiArr)){ //北
            $playId = 1042;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        //第三球两面-End
        //第三球单号-Start
        switch ($num3){
            case 1:
                $playId = 1011;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 1012;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 1013;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 1014;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 1015;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 1016;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 1017;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 1018;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 1019;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 1020;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 1021;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 1022;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 1023;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 1024;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 1025;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 1026;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 1027;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 1028;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 1029;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 1030;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第三球单号-End

        //第四球两面-Start
        $Q4PlayCate = 46;
        if($num4 >= 11){ //大
            $playId = 1068;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4 <= 10){ //小
            $playId = 1069;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4%2 == 0){ //双
            $playId = 1071;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 1070;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        $num4_add_zero = str_pad($num4,2,"0",STR_PAD_LEFT); //十位补零
        $num4_over = str_split($num4_add_zero); //拆分个位 十位
        $num4_tou = (int)$num4_over[0];
        $num4_wei = (int)$num4_over[1];
        $num4Total = $num4_wei+$num4_tou;
        if($num4_wei >= 5){ //尾大
            $playId = 1072;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4_wei <= 4){ //尾小
            $playId = 1073;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4Total%2 == 0){ //合数双
            $playId = 1075;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 1074;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4 > $num5){ //龙
            $playId = 1083;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = 1084;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$zhongArr)){ //中
            $playId = 1080;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$faArr)){ //发
            $playId = 1081;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$baiArr)){ //白
            $playId = 1082;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$dongArr)){ //东
            $playId = 1076;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$nanArr)){ //南
            $playId = 1077;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$xiArr)){ //西
            $playId = 1078;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$beiArr)){ //北
            $playId = 1079;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        //第四球两面-End
        //第四球单号-Start
        switch ($num4){
            case 1:
                $playId = 1048;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 1049;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 1050;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 1051;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 1052;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 1053;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 1054;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 1055;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 1056;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 1057;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 1058;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 1059;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 1060;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 1061;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 1062;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 1063;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 1064;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 1065;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 1066;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 1067;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第四球单号-End

        //第五球两面-Start
        $Q5PlayCate = 47;
        if($num5 >= 11){ //大
            $playId = 1105;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5 <= 10){ //小
            $playId = 1106;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5%2 == 0){ //双
            $playId = 1108;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 1107;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        $num5_add_zero = str_pad($num5,2,"0",STR_PAD_LEFT); //十位补零
        $num5_over = str_split($num5_add_zero); //拆分个位 十位
        $num5_tou = (int)$num5_over[0];
        $num5_wei = (int)$num5_over[1];
        $num5Total = $num5_wei+$num5_tou;
        if($num5_wei >= 5){ //尾大
            $playId = 1109;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5_wei <= 4){ //尾小
            $playId = 1110;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5Total%2 == 0){ //合数双
            $playId = 1112;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 1111;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$zhongArr)){ //中
            $playId = 1117;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$faArr)){ //发
            $playId = 1118;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$baiArr)){ //白
            $playId = 1119;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$dongArr)){ //东
            $playId = 1113;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$nanArr)){ //南
            $playId = 1114;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$xiArr)){ //西
            $playId = 1115;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$beiArr)){ //北
            $playId = 1116;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        //第五球两面-End
        //第五球单号-Start
        switch ($num5){
            case 1:
                $playId = 1085;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 1086;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 1087;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 1088;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 1089;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 1090;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 1091;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 1092;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 1093;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 1094;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 1095;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 1096;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 1097;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 1098;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 1099;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 1100;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 1101;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 1102;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 1103;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 1104;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第五球单号-End

        //第六球两面-Start
        $Q6PlayCate = 48;
        if($num6 >= 11){ //大
            $playId = 1142;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if($num6 <= 10){ //小
            $playId = 1143;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if($num6%2 == 0){ //双
            $playId = 1145;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 1144;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        $num6_add_zero = str_pad($num6,2,"0",STR_PAD_LEFT); //十位补零
        $num6_over = str_split($num6_add_zero); //拆分个位 十位
        $num6_tou = (int)$num6_over[0];
        $num6_wei = (int)$num6_over[1];
        $num6Total = $num6_wei+$num6_tou;
        if($num6_wei >= 5){ //尾大
            $playId = 1146;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if($num6_wei <= 4){ //尾小
            $playId = 1147;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if($num6Total%2 == 0){ //合数双
            $playId = 1149;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 1148;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$zhongArr)){ //中
            $playId = 1154;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$faArr)){ //发
            $playId = 1155;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$baiArr)){ //白
            $playId = 1156;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$dongArr)){ //东
            $playId = 1150;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$nanArr)){ //南
            $playId = 1151;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$xiArr)){ //西
            $playId = 1152;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$beiArr)){ //北
            $playId = 1153;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        //第六球两面-End
        //第六球单号-Start
        switch ($num6){
            case 1:
                $playId = 1122;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 1123;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 1124;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 1125;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 1126;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 1127;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 1128;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 1129;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 1130;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 1131;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 1132;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 1133;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 1134;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 1135;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 1136;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 1137;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 1138;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 1139;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 1140;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 1141;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第六球单号-End

        //第七球两面-Start
        $Q7PlayCate = 49;
        if($num7 >= 11){ //大
            $playId = 1179;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if($num7 <= 10){ //小
            $playId = 1180;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if($num7%2 == 0){ //双
            $playId = 1182;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 1181;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        $num7_add_zero = str_pad($num7,2,"0",STR_PAD_LEFT); //十位补零
        $num7_over = str_split($num7_add_zero); //拆分个位 十位
        $num7_tou = (int)$num7_over[0];
        $num7_wei = (int)$num7_over[1];
        $num7Total = $num7_wei+$num7_tou;
        if($num7_wei >= 5){ //尾大
            $playId = 1183;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if($num7_wei <= 4){ //尾小
            $playId = 1184;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if($num7Total%2 == 0){ //合数双
            $playId = 1186;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 1185;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$zhongArr)){ //中
            $playId = 1191;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$faArr)){ //发
            $playId = 1192;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$baiArr)){ //白
            $playId = 1193;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$dongArr)){ //东
            $playId = 1187;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$nanArr)){ //南
            $playId = 1188;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$xiArr)){ //西
            $playId = 1189;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$beiArr)){ //北
            $playId = 1190;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        //第七球两面-End
        //第七球单号-Start
        switch ($num7){
            case 1:
                $playId = 1159;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 1160;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 1161;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 1162;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 1163;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 1164;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 1165;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 1166;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 1167;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 1168;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 1169;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 1170;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 1171;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 1172;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 1173;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 1174;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 1175;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 1176;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 1177;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 1178;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第七球单号-End

        //第八球两面-Start
        $Q8PlayCate = 50;
        if($num8 >= 11){ //大
            $playId = 1216;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if($num8 <= 10){ //小
            $playId = 1217;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if($num8%2 == 0){ //双
            $playId = 1219;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 1218;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        $num8_add_zero = str_pad($num8,2,"0",STR_PAD_LEFT); //十位补零
        $num8_over = str_split($num8_add_zero); //拆分个位 十位
        $num8_tou = (int)$num8_over[0];
        $num8_wei = (int)$num8_over[1];
        $num8Total = $num8_wei+$num8_tou;
        if($num8_wei >= 5){ //尾大
            $playId = 1220;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if($num8_wei <= 4){ //尾小
            $playId = 1221;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if($num8Total%2 == 0){ //合数双
            $playId = 1223;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 1222;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$zhongArr)){ //中
            $playId = 1228;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$faArr)){ //发
            $playId = 1229;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$baiArr)){ //白
            $playId = 1230;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$dongArr)){ //东
            $playId = 1224;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$nanArr)){ //南
            $playId = 1225;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$xiArr)){ //西
            $playId = 1226;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$beiArr)){ //北
            $playId = 1227;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        //第八球两面-End
        //第八球单号-Start
        switch ($num8){
            case 1:
                $playId = 1196;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 1197;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 1198;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 1199;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 1200;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 1201;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 1202;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 1203;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 1204;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 1205;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 1206;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 1207;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 1208;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 1209;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 1210;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 1211;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 1212;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 1213;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 1214;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 1215;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第八球单号-End
    }

    //正码
    private function ZM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $playCate = 51;
        $ZM1 = $arrOpenCode[0];
        $ZM2 = $arrOpenCode[1];
        $ZM3 = $arrOpenCode[2];
        $ZM4 = $arrOpenCode[3];
        $ZM5 = $arrOpenCode[4];
        $ZM6 = $arrOpenCode[5];
        $ZM7 = $arrOpenCode[6];
        $ZM8 = $arrOpenCode[7];
        $nums = ['1'=>'1233','2'=>'1234','3'=>'1235','4'=>'1236','5'=>'1237','6'=>'1238','7'=>'1239','8'=>'1240','9'=>'1241','10'=>'1242','11'=>'1243','12'=>'1244','13'=>'1245','14'=>'1246','15'=>'1247','16'=>'1248','17'=>'1249','18'=>'1250','19'=>'1251','20'=>'1252'];
        foreach ($nums as $k => $v){
            if($ZM1 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM2 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM3 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM4 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM5 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM6 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM7 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM8 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
    }

    private function bunko($win,$gameId,$issue,$openCode,$he){
        $bunko_index = 0;
        $openCodeArr = explode(',',$openCode);
        $id = [];
        foreach ($win as $k=>$v){
            $id[] = $v;
        }
        $getUserBets = Bets::where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        if($getUserBets){
            $sql = "UPDATE bet SET bunko = CASE "; //中奖的SQL语句
            $sql_lose = "UPDATE bet SET bunko = CASE "; //未中奖的SQL语句
            $sql_he = "UPDATE bet SET bunko = CASE "; //和局的SQL语句

            $ids = implode(',', $id);
            $ids_lose = $ids;
            $sql_bets = '';
            $sql_bets_lose = '';
            $sql_bets_he = '';
            foreach ($getUserBets as $item){
                $bunko = $item->bet_money * $item->play_odds;
                $bunko_lose = 0-$item->bet_money;
                    $bunko_he = $item->bet_money * 1;
                    $sql_bets .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                    $sql_bets_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
                    $sql_bets_he .= "WHEN `bet_id` = $item->bet_id THEN $bunko_he ";
            }
            if(count($he)>0) {
                $ids_he = [];
                $tmpids = explode(',',$ids);
                $tmpids_lose = $tmpids;
                foreach ($he as $k=>$v){
                    $ids_he[] = $v;
                    unset($tmpids[$v]);
                    $tmpids_lose[] = $v;
                }
                $ids = implode(',', $tmpids);
                $ids_lose = implode(',', $tmpids_lose);
                $ids_he = implode(',', $ids_he);
                $sql_he .= $sql_bets_he . "END, status = 1 , updated_at ='" . date('Y-m-d H:i:s') . "' WHERE `play_id` IN ($ids_he) AND `issue` = $issue AND `game_id` = $gameId";
            }else
                $sql_he = '';
            $sql .= $sql_bets . "END, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `play_id` IN ($ids) AND `issue` = $issue AND `game_id` = $gameId";
            $sql_lose .= $sql_bets_lose . "END, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `play_id` NOT IN ($ids_lose) AND `issue` = $issue AND `game_id` = $gameId";
            if(!empty($sql_bets))
                $run = DB::statement($sql);
            if(isset($run) && $run == 1){
            //连码- Start
            $lm_playCate = 52; //连码分类ID
            $lm_ids = [];
            $lm_lose_ids = [];
            $get = DB::table('bet')->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lm_playCate)->where('bunko','=',0.00)->get();
            $lm_open = explode(',', $openCode);
            foreach ($get as $item) {
                $explodeBetInfo = explode(',',$item->bet_info);
                if(count($explodeBetInfo) == 2 && $item->play_name == '任选二'){
                    $diff2 = array_intersect($lm_open, $explodeBetInfo);
                    if(count($diff2) == 2){
                        $lm_ids[] = $item->bet_id;
                    } else {
                        $lm_lose_ids[] = $item->bet_id;
                    }
                }
                if(count($explodeBetInfo) == 3 && $item->play_name == '任选三'){
                    $diff3 = array_intersect($lm_open, $explodeBetInfo);
                    if(count($diff3) == 3){
                        $lm_ids[] = $item->bet_id;
                    } else {
                        $lm_lose_ids[] = $item->bet_id;
                    }
                }
                if(count($explodeBetInfo) == 4 && $item->play_name == '任选四'){
                    $diff4 = array_intersect($lm_open, $explodeBetInfo);
                    if(count($diff4) == 4){
                        $lm_ids[] = $item->bet_id;
                    } else {
                        $lm_lose_ids[] = $item->bet_id;
                    }
                }
                if(count($explodeBetInfo) == 5 && $item->play_name == '任选五'){
                    $diff5 = array_intersect($lm_open, $explodeBetInfo);
                    if(count($diff5) == 5){
                        $lm_ids[] = $item->bet_id;
                    } else {
                        $lm_lose_ids[] = $item->bet_id;
                    }
                }
                if(count($explodeBetInfo) == 2 && $item->play_name == '选二连组'){
                    $pattern = '/('.$item->bet_info.')/u';
                    $matches = preg_match($pattern, $openCode);
                    if($matches){
                        $lm_ids[] = $item->bet_id;
                    }else{
                        $lm_lose_ids[] = $item->bet_id;
                    }
                }
                if(count($explodeBetInfo) == 3 && $item->play_name == '选三前组'){
                    if($explodeBetInfo[0] == $openCodeArr[0] && $explodeBetInfo[1] == $openCodeArr[1] && $explodeBetInfo[2] == $openCodeArr[2]){
                        $lm_ids[] = $item->bet_id;
                    } else {
                        $lm_lose_ids[] = $item->bet_id;
                    }
                }
            }
            $ids_lm = implode(',', $lm_ids);
            if($ids_lm){
                $sql_lm = "UPDATE bet SET bunko = bet_money * play_odds, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `bet_id` IN ($ids_lm)"; //中奖的SQL语句
            } else {
                $sql_lm = 0;
            }
            //连码- End

                if(!empty($sql_he)){
                    $runhe = DB::connection('mysql::write')->statement($sql_he);
                    if($runhe == 1)
                        $bunko_index++;
                }
                if(!empty($sql_bets_lose)){
                    $run2 = DB::connection('mysql::write')->statement($sql_lose);
                    if($run2 == 1)
                        $bunko_index++;
                }
                if($sql_lm !== 0){
                    $run3 = DB::connection('mysql::write')->statement($sql_lm);
                    if($run3 == 1){
                        $bunko_index++;
                    }
                } else {
                    $bunko_index++;
                }

                if($bunko_index !== 0){
                    return 1;
                }
            }
        }
    }
}

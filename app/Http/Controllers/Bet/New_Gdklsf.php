<?php

namespace App\Http\Controllers\Bet;

use App\Bets;
use App\Excel;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Gdklsf extends Excel
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
        $table = 'game_gdklsf';
        $gameName = '广东快乐十分';
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
        $playCate = 53;
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
            $playId = 603;
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = 604;
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
        }
        if($numsTotal >= 85 && $numsTotal <= 132){ //总和大
            $playId = 603;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }else if($numsTotal >= 36 && $numsTotal <= 83){ //总和小
            $playId = 604;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //总和大小-End

        //总和单双-Start
        if($numsTotal%2 == 0){
            $playId = 606;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 605;
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
            $playId = 607;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($totalWei <= 4){
            $playId = 608;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //总和尾大、尾小-End

        //第一球两面-Start
        $Q1PlayCate = 54;
        if($num1 >= 11){ //大
            $playId = 629;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1 <= 10){ //小
            $playId = 630;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1%2 == 0){ //双
            $playId = 632;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 631;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        $num1_add_zero = str_pad($num1,2,"0",STR_PAD_LEFT); //十位补零
        $num1_over = str_split($num1_add_zero); //拆分个位 十位
        $num1_tou = (int)$num1_over[0];
        $num1_wei = (int)$num1_over[1];
        $num1Total = $num1_wei+$num1_tou;
        if($num1_wei >= 5){ //尾大
            $playId = 633;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1_wei <= 4){ //尾小
            $playId = 634;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1Total%2 == 0){ //合数双
            $playId = 636;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 635;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1 > $num8){ //龙
            $playId = 644;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = 645;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$zhongArr)){ //中
            $playId = 641;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$faArr)){ //发
            $playId = 642;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$baiArr)){ //白
            $playId = 643;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$dongArr)){ //东
            $playId = 637;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$nanArr)){ //南
            $playId = 638;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$xiArr)){ //西
            $playId = 639;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$beiArr)){ //北
            $playId = 640;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        //第一球两面-End
        //第一球单号-Start
        switch ($num1){
            case 1:
                $playId = 609;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 610;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 611;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 612;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 613;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 614;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 615;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 616;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 617;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 618;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 619;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 620;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 621;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 622;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 623;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 624;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 625;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 626;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 627;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 628;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第一球单号-End

        //第二球两面-Start
        $Q2PlayCate = 55;
        if($num2 >= 11){ //大
            $playId = 666;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2 <= 10){ //小
            $playId = 667;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2%2 == 0){ //双
            $playId = 669;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 668;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        $num2_add_zero = str_pad($num2,2,"0",STR_PAD_LEFT); //十位补零
        $num2_over = str_split($num2_add_zero); //拆分个位 十位
        $num2_tou = (int)$num2_over[0];
        $num2_wei = (int)$num2_over[1];
        $num2Total = $num2_wei+$num2_tou;
        if($num2_wei >= 5){ //尾大
            $playId = 670;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2_wei <= 4){ //尾小
            $playId = 671;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2Total%2 == 0){ //合数双
            $playId = 673;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 672;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2 > $num7){ //龙
            $playId = 681;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = 682;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$zhongArr)){ //中
            $playId = 678;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$faArr)){ //发
            $playId = 679;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$baiArr)){ //白
            $playId = 680;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$dongArr)){ //东
            $playId = 674;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$nanArr)){ //南
            $playId = 675;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$xiArr)){ //西
            $playId = 676;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$beiArr)){ //北
            $playId = 677;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        //第二球两面-End
        //第二球单号-Start
        switch ($num2){
            case 1:
                $playId = 646;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 647;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 648;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 649;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 650;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 651;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 652;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 653;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 654;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 655;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 656;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 657;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 658;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 659;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 660;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 661;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 662;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 663;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 664;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 665;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第二球单号-End

        //第三球两面-Start
        $Q3PlayCate = 56;
        if($num3 >= 11){ //大
            $playId = 703;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3 <= 10){ //小
            $playId = 704;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3%2 == 0){ //双
            $playId = 706;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 705;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        $num3_add_zero = str_pad($num3,2,"0",STR_PAD_LEFT); //十位补零
        $num3_over = str_split($num3_add_zero); //拆分个位 十位
        $num3_tou = (int)$num3_over[0];
        $num3_wei = (int)$num3_over[1];
        $num3Total = $num3_wei+$num3_tou;
        if($num3_wei >= 5){ //尾大
            $playId = 707;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3_wei <= 4){ //尾小
            $playId = 708;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3Total%2 == 0){ //合数双
            $playId = 710;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 709;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3 > $num6){ //龙
            $playId = 718;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = 719;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$zhongArr)){ //中
            $playId = 715;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$faArr)){ //发
            $playId = 716;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$baiArr)){ //白
            $playId = 717;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$dongArr)){ //东
            $playId = 711;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$nanArr)){ //南
            $playId = 712;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$xiArr)){ //西
            $playId = 713;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$beiArr)){ //北
            $playId = 714;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        //第三球两面-End
        //第三球单号-Start
        switch ($num3){
            case 1:
                $playId = 683;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 684;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 685;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 686;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 687;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 688;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 689;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 690;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 691;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 692;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 693;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 694;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 695;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 696;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 697;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 698;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 699;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 700;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 701;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 702;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第三球单号-End

        //第四球两面-Start
        $Q4PlayCate = 57;
        if($num4 >= 11){ //大
            $playId = 740;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4 <= 10){ //小
            $playId = 741;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4%2 == 0){ //双
            $playId = 743;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 742;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        $num4_add_zero = str_pad($num4,2,"0",STR_PAD_LEFT); //十位补零
        $num4_over = str_split($num4_add_zero); //拆分个位 十位
        $num4_tou = (int)$num4_over[0];
        $num4_wei = (int)$num4_over[1];
        $num4Total = $num4_wei+$num4_tou;
        if($num4_wei >= 5){ //尾大
            $playId = 744;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4_wei <= 4){ //尾小
            $playId = 745;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4Total%2 == 0){ //合数双
            $playId = 747;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 746;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4 > $num5){ //龙
            $playId = 755;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = 756;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$zhongArr)){ //中
            $playId = 752;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$faArr)){ //发
            $playId = 753;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$baiArr)){ //白
            $playId = 754;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$dongArr)){ //东
            $playId = 748;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$nanArr)){ //南
            $playId = 749;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$xiArr)){ //西
            $playId = 750;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$beiArr)){ //北
            $playId = 751;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        //第四球两面-End
        //第四球单号-Start
        switch ($num4){
            case 1:
                $playId = 720;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 721;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 722;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 723;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 724;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 725;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 726;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 727;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 728;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 729;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 730;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 731;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 732;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 733;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 734;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 735;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 736;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 737;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 738;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 739;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第四球单号-End

        //第五球两面-Start
        $Q5PlayCate = 58;
        if($num5 >= 11){ //大
            $playId = 777;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5 <= 10){ //小
            $playId = 778;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5%2 == 0){ //双
            $playId = 780;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 779;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        $num5_add_zero = str_pad($num5,2,"0",STR_PAD_LEFT); //十位补零
        $num5_over = str_split($num5_add_zero); //拆分个位 十位
        $num5_tou = (int)$num5_over[0];
        $num5_wei = (int)$num5_over[1];
        $num5Total = $num5_wei+$num5_tou;
        if($num5_wei >= 5){ //尾大
            $playId = 781;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5_wei <= 4){ //尾小
            $playId = 782;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5Total%2 == 0){ //合数双
            $playId = 784;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 783;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$zhongArr)){ //中
            $playId = 789;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$faArr)){ //发
            $playId = 790;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$baiArr)){ //白
            $playId = 791;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$dongArr)){ //东
            $playId = 785;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$nanArr)){ //南
            $playId = 786;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$xiArr)){ //西
            $playId = 787;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$beiArr)){ //北
            $playId = 788;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        //第五球两面-End
        //第五球单号-Start
        switch ($num5){
            case 1:
                $playId = 757;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 758;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 759;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 760;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 761;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 762;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 763;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 764;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 765;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 766;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 767;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 768;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 769;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 770;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 771;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 772;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 773;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 774;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 775;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 776;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第五球单号-End

        //第六球两面-Start
        $Q6PlayCate = 59;
        if($num6 >= 11){ //大
            $playId = 814;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if($num6 <= 10){ //小
            $playId = 815;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if($num6%2 == 0){ //双
            $playId = 817;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 816;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        $num6_add_zero = str_pad($num6,2,"0",STR_PAD_LEFT); //十位补零
        $num6_over = str_split($num6_add_zero); //拆分个位 十位
        $num6_tou = (int)$num6_over[0];
        $num6_wei = (int)$num6_over[1];
        $num6Total = $num6_wei+$num6_tou;
        if($num6_wei >= 5){ //尾大
            $playId = 818;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if($num6_wei <= 4){ //尾小
            $playId = 819;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if($num6Total%2 == 0){ //合数双
            $playId = 821;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 820;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$zhongArr)){ //中
            $playId = 826;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$faArr)){ //发
            $playId = 827;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$baiArr)){ //白
            $playId = 828;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$dongArr)){ //东
            $playId = 822;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$nanArr)){ //南
            $playId = 823;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$xiArr)){ //西
            $playId = 824;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$beiArr)){ //北
            $playId = 825;
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        //第六球两面-End
        //第六球单号-Start
        switch ($num6){
            case 1:
                $playId = 794;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 795;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 796;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 797;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 798;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 799;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 800;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 801;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 802;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 803;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 804;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 805;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 806;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 807;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 808;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 809;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 810;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 811;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 812;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 813;
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第六球单号-End

        //第七球两面-Start
        $Q7PlayCate = 60;
        if($num7 >= 11){ //大
            $playId = 851;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if($num7 <= 10){ //小
            $playId = 852;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if($num7%2 == 0){ //双
            $playId = 854;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 853;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        $num7_add_zero = str_pad($num7,2,"0",STR_PAD_LEFT); //十位补零
        $num7_over = str_split($num7_add_zero); //拆分个位 十位
        $num7_tou = (int)$num7_over[0];
        $num7_wei = (int)$num7_over[1];
        $num7Total = $num7_wei+$num7_tou;
        if($num7_wei >= 5){ //尾大
            $playId = 855;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if($num7_wei <= 4){ //尾小
            $playId = 856;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if($num7Total%2 == 0){ //合数双
            $playId = 858;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 857;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$zhongArr)){ //中
            $playId = 863;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$faArr)){ //发
            $playId = 864;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$baiArr)){ //白
            $playId = 865;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$dongArr)){ //东
            $playId = 859;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$nanArr)){ //南
            $playId = 860;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$xiArr)){ //西
            $playId = 861;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$beiArr)){ //北
            $playId = 862;
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        //第七球两面-End
        //第七球单号-Start
        switch ($num7){
            case 1:
                $playId = 831;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 832;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 833;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 834;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 835;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 836;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 837;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 838;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 839;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 840;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 841;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 842;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 843;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 844;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 845;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 846;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 847;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 848;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 849;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 850;
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第七球单号-End

        //第八球两面-Start
        $Q8PlayCate = 61;
        if($num8 >= 11){ //大
            $playId = 888;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if($num8 <= 10){ //小
            $playId = 889;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if($num8%2 == 0){ //双
            $playId = 891;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 890;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        $num8_add_zero = str_pad($num8,2,"0",STR_PAD_LEFT); //十位补零
        $num8_over = str_split($num8_add_zero); //拆分个位 十位
        $num8_tou = (int)$num8_over[0];
        $num8_wei = (int)$num8_over[1];
        $num8Total = $num8_wei+$num8_tou;
        if($num8_wei >= 5){ //尾大
            $playId = 892;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if($num8_wei <= 4){ //尾小
            $playId = 893;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if($num8Total%2 == 0){ //合数双
            $playId = 895;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = 894;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$zhongArr)){ //中
            $playId = 900;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$faArr)){ //发
            $playId = 901;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$baiArr)){ //白
            $playId = 902;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$dongArr)){ //东
            $playId = 896;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$nanArr)){ //南
            $playId = 897;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$xiArr)){ //西
            $playId = 898;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$beiArr)){ //北
            $playId = 899;
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        //第八球两面-End
        //第八球单号-Start
        switch ($num8){
            case 1:
                $playId = 868;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 869;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 870;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 871;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 872;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 873;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 874;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 875;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 876;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 877;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 878;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 879;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 880;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 881;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 882;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 883;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 884;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 885;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 886;
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 887;
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
        $playCate = 62;
        $ZM1 = $arrOpenCode[0];
        $ZM2 = $arrOpenCode[1];
        $ZM3 = $arrOpenCode[2];
        $ZM4 = $arrOpenCode[3];
        $ZM5 = $arrOpenCode[4];
        $ZM6 = $arrOpenCode[5];
        $ZM7 = $arrOpenCode[6];
        $ZM8 = $arrOpenCode[7];
        $nums = ['1'=>'905','2'=>'906','3'=>'907','4'=>'908','5'=>'909','6'=>'910','7'=>'911','8'=>'912','9'=>'913','10'=>'914','11'=>'915','12'=>'916','13'=>'917','14'=>'918','15'=>'919','16'=>'920','17'=>'921','18'=>'922','19'=>'923','20'=>'924'];
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
                $lm_playCate = 63; //连码分类ID
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

<?php

namespace App\Http\Controllers\Bet;

use App\Bets;
use App\Excel;
use Illuminate\Support\Facades\DB;

class New_Gd11x5
{
    public function all($openCode,$issue,$gameId,$id)
    {
        $win = collect([]);
        $this->LM($openCode,$gameId,$win);
        $table = 'game_gd11x5';
        $gameName = '广东11选5';
        $betCount = DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $excelModel = new Excel();
            $bunko = $this->bunko($win,$gameId,$issue,$openCode);
            if($bunko == 1){
                $updateUserMoney = $excelModel->updateUserMoney($gameId,$issue,$gameName);
                if($updateUserMoney == 1){
                    \Log::info($gameName . $issue . "结算出错");
                }
            }
        }
        $update = DB::table($table)->where('id',$id)->update([
            'bunko' => 1
        ]);
        if ($update !== 1) {
            \Log::info($gameName . $issue . "结算not Finshed");
        }
    }

    //两面部分结算
    private function LM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 26;
        $num1 = (int)$arrOpenCode[0];
        $num2 = (int)$arrOpenCode[1];
        $num3 = (int)$arrOpenCode[2];
        $num4 = (int)$arrOpenCode[3];
        $num5 = (int)$arrOpenCode[4];
        $numsTotal = $num1 + $num2 + $num3 + $num4 + $num5;

        //总和大小-Start
        if($numsTotal == 30){ //和局

        }
        if($numsTotal > 30){ //总和大
            $playId = 143;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($numsTotal < 30){ //总和小
            $playId = 147;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //总和大小-End

        //总和单双-Start
        if($numsTotal%2 == 0){ //总和双
            $playId = 148;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //总和单
            $playId = 144;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //总和单双-End

        //总和尾大、尾小-Start
        $totalStrSplit = str_split($numsTotal);
        $totalWei = (int)$totalStrSplit[1];
        if($totalWei >= 5){ //总和尾大
            $playId = 145;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($totalWei <= 4){ //总和尾小
            $playId = 149;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //总和尾大、尾小-End

        //龙虎-Start
        if($num1 > $num5){ //龙
            $playId = 146;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = 150;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //龙虎-End

        //单号1两面-Start
        $Q1PlayCate = 27;
        switch ($num1){
            case 1:
                $playId = 151;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 152;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 153;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 154;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 155;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 156;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 157;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 158;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 159;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 160;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 161;
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        if($num1 == 11){ //和

        }
        if($num1 >= 6){ //大
            $playId = 162;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1 <= 5){ //小
            $playId = 163;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1%2 == 0){ //双
            $playId = 165;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 164;
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        //单号1两面-End

        //单号2两面-Start
        $Q2PlayCate = 28;
        switch ($num2){
            case 1:
                $playId = 166;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 167;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 168;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 169;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 170;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 171;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 172;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 173;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 174;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 175;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 176;
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        if($num2 == 11){ //和

        }
        if($num2 >= 6){ //大
            $playId = 177;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2 <= 5){ //小
            $playId = 178;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2%2 == 0){ //双
            $playId = 180;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 179;
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        //单号2两面-End

        //单号3两面-Start
        $Q3PlayCate = 29;
        switch ($num3){
            case 1:
                $playId = 181;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 182;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 183;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 184;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 185;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 186;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 187;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 188;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 189;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 190;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 191;
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        if($num3 == 11){ //和

        }
        if($num3 >= 6){ //大
            $playId = 192;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3 <= 5){ //小
            $playId = 193;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3%2 == 0){ //双
            $playId = 195;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 194;
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        //单号3两面-End

        //单号4两面-Start
        $Q4PlayCate = 30;
        switch ($num4){
            case 1:
                $playId = 196;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 197;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 198;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 199;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 200;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 201;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 202;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 203;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 204;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 205;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 206;
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        if($num4 == 11){ //和

        }
        if($num4 >= 6){ //大
            $playId = 207;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4 <= 5){ //小
            $playId = 208;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4%2 == 0){ //双
            $playId = 210;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 209;
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        //单号4两面-End

        //单号5两面-Start
        $Q5PlayCate = 31;
        switch ($num5){
            case 1:
                $playId = 211;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 212;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 213;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 214;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 215;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 216;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 217;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 218;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 219;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 220;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 221;
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        if($num5 == 11){ //和

        }
        if($num5 >= 6){ //大
            $playId = 222;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5 <= 5){ //小
            $playId = 223;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5%2 == 0){ //双
            $playId = 225;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 224;
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        //单号5两面-End

        //一中一 - Start
        $YZYPlayCate = 32;
        $YZYNums = ['1'=>'226','2'=>'227','3'=>'228','4'=>'229','5'=>'230','6'=>'231','7'=>'232','8'=>'233','9'=>'234','10'=>'235','11'=>'236'];
        foreach ($YZYNums as $k => $v){
            if($num1 == $k){
                $playId = $v;
                $winCode = $gameId.$YZYPlayCate.$playId;
                $win->push($winCode);
            }
            if($num2 == $k){
                $playId = $v;
                $winCode = $gameId.$YZYPlayCate.$playId;
                $win->push($winCode);
            }
            if($num3 == $k){
                $playId = $v;
                $winCode = $gameId.$YZYPlayCate.$playId;
                $win->push($winCode);
            }
            if($num4 == $k){
                $playId = $v;
                $winCode = $gameId.$YZYPlayCate.$playId;
                $win->push($winCode);
            }
            if($num5 == $k){
                $playId = $v;
                $winCode = $gameId.$YZYPlayCate.$playId;
                $win->push($winCode);
            }
        }
        //一中一 - End
    }

    private function bunko($win,$gameId,$issue,$openCode){

        $bunko_index = 0;
        $openCodeArr = explode(',',$openCode);
        $OPEN_QIAN_2 = $openCodeArr[0].','.$openCodeArr[1];
        $OPEN_QIAN_3 = $openCodeArr[0].','.$openCodeArr[1].','.$openCodeArr[2];

        $id = [];
        foreach ($win as $k=>$v){
            $id[] = $v;
        }
        $getUserBets = Bets::where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        $sql = "UPDATE bet SET bunko = CASE ";
        $sql_lose = "UPDATE bet SET bunko = CASE ";
        $ids = implode(',', $id);
        foreach ($getUserBets as $item){
            $bunko = $item->bet_money * $item->play_odds;
            $bunko_lose = 0-$item->bet_money;
            $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
            $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
        }
        $sql .= "END WHERE `play_id` IN ($ids) AND `issue` = $issue AND `game_id` = $gameId";
        $sql_lose .= "END WHERE `play_id` NOT IN ($ids) AND `issue` = $issue AND `game_id` = $gameId";
        $run = DB::statement($sql);
        if($run == 1){
            //直选- Start
            $zhixuan_playCate = 34; //直选分类ID
            $zhixuan_ids = [];
            $zhixuan_lose_ids = [];
            $get = DB::table('bet')->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$zhixuan_playCate)->where('bunko','=',0.00)->get();
            $open2 = explode(',', $OPEN_QIAN_2);
            $open3 = explode(',', $OPEN_QIAN_3);
            foreach ($get as $item) {
                $user = explode(',', $item->bet_info);
                if($item->play_id == '2134246'){ //前二直选
                    if($open2[0] == $user[0] && $open2[1] == $user[1]){
                        $zhixuan_ids[] = $item->bet_id;
                    } else {
                        $zhixuan_lose_ids[] = $item->bet_id;
                    }
                }
                if($item->play_id == '2134247'){ //前三直选
                    if($open3[0] == $user[0] && $open3[1] == $user[1] && $open3[2] == $user[2]){
                        $zhixuan_ids[] = $item->bet_id;
                    } else {
                        $zhixuan_lose_ids[] = $item->bet_id;
                    }
                }
            }
            $ids_zhixuan = implode(',', $zhixuan_ids);
            if($ids_zhixuan){
                $sql_zhixuan = "UPDATE bet SET bunko = bet_money * play_odds WHERE `bet_id` IN ($ids_zhixuan)"; //中奖的SQL语句
            } else {
                $sql_zhixuan = 0;
            }
            //直选 - End

            //连码 - Start
            $lm_playCate = 33;
            $lm_ids = [];
            $lm_lose_ids = [];
            $get_lm = DB::table('bet')->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lm_playCate)->where('bunko','=',0.00)->get();
            $lm_open = explode(',', $openCode);
            $lm_open_qian2 = explode(',',$OPEN_QIAN_2);
            $lm_open_qian3 = explode(',',$OPEN_QIAN_3);
            foreach ($get_lm as $item) {
                $explodeBetInfo = explode(',',$item->bet_info);
                if(count($explodeBetInfo) == 2 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                    $diff2 = array_intersect($lm_open, $explodeBetInfo);
                    if(count($diff2) == 2){
                        $lm_ids[] = $item->bet_id;
                    } else {
                        $lm_lose_ids[] = $item->bet_id;
                    }
                } else if (count($explodeBetInfo) == 3 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                    $diff3 = array_intersect($lm_open, $explodeBetInfo);
                    if(count($diff3) == 3){
                        $lm_ids[] = $item->bet_id;
                    } else {
                        $lm_lose_ids[] = $item->bet_id;
                    }
                } else if (count($explodeBetInfo) == 4 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                    $diff4 = array_intersect($lm_open, $explodeBetInfo);
                    if(count($diff4) == 4){
                        $lm_ids[] = $item->bet_id;
                    } else {
                        $lm_lose_ids[] = $item->bet_id;
                    }
                } else if (count($explodeBetInfo) == 5 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                    $diff5 = array_intersect($lm_open, $explodeBetInfo);
                    if(count($diff5) == 5){
                        $lm_ids[] = $item->bet_id;
                    } else {
                        $lm_lose_ids[] = $item->bet_id;
                    }
                } else if (count($explodeBetInfo) == 6 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                    $diff6 = array_intersect($lm_open, $explodeBetInfo);
                    if(count($diff6) == 5){
                        $lm_ids[] = $item->bet_id;
                    } else {
                        $lm_lose_ids[] = $item->bet_id;
                    }
                } else if (count($explodeBetInfo) == 7 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                    $diff7 = array_intersect($lm_open, $explodeBetInfo);
                    if(count($diff7) == 5){
                        $lm_ids[] = $item->bet_id;
                    } else {
                        $lm_lose_ids[] = $item->bet_id;
                    }
                } else if (count($explodeBetInfo) == 8 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                    $diff8 = array_intersect($lm_open, $explodeBetInfo);
                    if(count($diff8) == 5){
                        $lm_ids[] = $item->bet_id;
                    } else {
                        $lm_lose_ids[] = $item->bet_id;
                    }
                }
            }
            foreach ($get_lm as $x) {
                $explodeBetInfo = explode(',',$x->bet_info);
                if($x->play_id == '2133244'){ //前二组选
                    if($explodeBetInfo[0] == $lm_open_qian2[0] && $explodeBetInfo[1] == $lm_open_qian2[1]){
                        $lm_ids[] = $x->bet_id;
                    } else {
                        $lm_lose_ids[] = $x->bet_id;
                    }
                }
                if($x->play_id == '2133245'){ //前三组选
                    if($explodeBetInfo[0] == $lm_open_qian3[0] && $explodeBetInfo[1] == $lm_open_qian3[1] && $explodeBetInfo[2] == $lm_open_qian3[2]){
                        $lm_ids[] = $x->bet_id;
                    } else {
                        $lm_lose_ids[] = $x->bet_id;
                    }
                }
            }
            $ids_lm = implode(',', $lm_ids);
            if($ids_lm){
                $sql_lm = "UPDATE bet SET bunko = bet_money * play_odds WHERE `bet_id` IN ($ids_lm)"; //中奖的SQL语句
            } else {
                $sql_lm = 0;
            }
            //连码 - End

            $run2 = DB::connection('mysql::write')->statement($sql_lose);
            if($run2 == 1){
                $bunko_index++;
                if($sql_zhixuan !== 0){
                    $run3 = DB::connection('mysql::write')->statement($sql_zhixuan);
                    if($run3 == 1){
                        $bunko_index++;
                    }
                } else {
                    $bunko_index++;
                }

                if($sql_lm !== 0){
                    $run4 = DB::connection('mysql::write')->statement($sql_lm);
                    if($run4 == 1){
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
}

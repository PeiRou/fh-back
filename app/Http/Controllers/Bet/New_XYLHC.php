<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/7/14
 * Time: 下午4:57
 */

namespace App\Http\Controllers\Bet;

use App\Helpers\LHC_SX;
use Illuminate\Support\Facades\DB;

class New_XYLHC
{
    protected $LHC_SX;

    /**
     * New_LHC constructor.
     * @param $LHC_SX
     */
    public function __construct(LHC_SX $LHC_SX)
    {
        $this->LHC_SX = $LHC_SX;
    }

    public function all($openCode,$issue,$gameId,$id)
    {
        $win = collect([]);
        $this->TM($openCode,$gameId,$win);
        $this->LM($openCode,$gameId,$win);
        $this->SB($openCode,$gameId,$win);
        $this->TX($openCode,$gameId,$win);
        $this->TMTWS($openCode,$gameId,$win);
        $this->ZM($openCode,$gameId,$win);
        $this->WX($openCode,$gameId,$win);
        $this->QSB($openCode,$gameId,$win);
        $this->PTYXWS($openCode,$gameId,$win);
        $betCount = DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $bunko = $this->BUNKO($openCode,$win,$gameId,$issue);
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue);
                if($updateUserMoney == 1){
                    $update = DB::table('game_xylhc')->where('id',$id)->update([
                        'bunko' => 1
                    ]);
                    if($update == 1){
                        echo '幸运六合彩'.$issue.'已结算';
                    } else {
                        echo '幸运六合彩'.$issue.'结算失败！';
                    }
                }
            }
        } else {
            $update = DB::table('game_xylhc')->where('id',$id)->update([
                'bunko' => 1
            ]);
            if($update == 1){
                echo '幸运六合彩'.$issue.'已结算';
            } else {
                echo '幸运六合彩'.$issue.'结算失败！';
            }
        }
    }

    //特码A-B
    public function TM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tm_playCate = 162; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        switch ($tm){
            case 1:
                $playId_B = 3516;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3467;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 2:
                $playId_B = 3517;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3468;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 3:
                $playId_B = 3518;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3469;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 4:
                $playId_B = 3519;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3470;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 5:
                $playId_B = 3520;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3471;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 6:
                $playId_B = 3521;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3472;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 7:
                $playId_B = 3522;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3473;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 8:
                $playId_B = 3523;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3474;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 9:
                $playId_B = 3524;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3475;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 10:
                $playId_B = 3525;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3476;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 11:
                $playId_B = 3526;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3477;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 12:
                $playId_B = 3527;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3478;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 13:
                $playId_B = 3528;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3479;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 14:
                $playId_B = 3529;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3480;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 15:
                $playId_B = 3530;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3481;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 16:
                $playId_B = 3531;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3482;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 17:
                $playId_B = 3532;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3483;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 18:
                $playId_B = 3533;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3484;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 19:
                $playId_B = 3534;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3485;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 20:
                $playId_B = 3535;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3486;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 21:
                $playId_B = 3536;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3487;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 22:
                $playId_B = 3537;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3488;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 23:
                $playId_B = 3538;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3489;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 24:
                $playId_B = 3539;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3490;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 25:
                $playId_B = 3540;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3491;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 26:
                $playId_B = 3541;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3492;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 27:
                $playId_B = 3542;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3493;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 28:
                $playId_B = 3543;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3494;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 29:
                $playId_B = 3544;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3495;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 30:
                $playId_B = 3545;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3496;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 31:
                $playId_B = 3546;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3497;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 32:
                $playId_B = 3547;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3498;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 33:
                $playId_B = 3548;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3499;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 34:
                $playId_B = 3549;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3500;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 35:
                $playId_B = 3550;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3501;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 36:
                $playId_B = 3551;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3502;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 37:
                $playId_B = 3552;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3503;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 38:
                $playId_B = 3553;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3504;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 39:
                $playId_B = 3554;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3505;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 40:
                $playId_B = 3555;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3506;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 41:
                $playId_B = 3556;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3507;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 42:
                $playId_B = 3557;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3508;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 43:
                $playId_B = 3558;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3509;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 44:
                $playId_B = 3559;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3510;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 45:
                $playId_B = 3560;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3511;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 46:
                $playId_B = 3561;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3512;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 47:
                $playId_B = 3562;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3513;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 48:
                $playId_B = 3563;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3514;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
            case 49:
                $playId_B = 3564;
                $winCode_B = $gameId.$tm_playCate.$playId_B;
                $win->push($winCode_B);
                $playId_A = 3515;
                $winCode_A = $gameId.$tm_playCate.$playId_A;
                $win->push($winCode_A);
                break;
        }
    }

    //两面
    public function LM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $lm_playCate = 163; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        $ZH = (int)$arrOpenCode[0]+(int)$arrOpenCode[1]+(int)$arrOpenCode[2]+(int)$arrOpenCode[3]+(int)$arrOpenCode[4]+(int)$arrOpenCode[5]+(int)$arrOpenCode[6];
        //特码大小
        if($tm >= 25 && $tm <= 48){ //大
            $playId = 3565;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
            if($tm%2 == 0){ //特大双
                $playId = 3576;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            } else { //特大单
                $playId = 3575;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
        }
        if($tm <= 24){
            $playId = 3566;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
            if($tm%2 == 0){ //特小双
                $playId = 3578;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            } else { //特小单
                $playId = 3577;
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
        }
        //特码单双
        if($tm%2 == 0){ // 双
            $playId = 3568;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($tm%2 != 0 && $tm != 49){
            $playId = 3567;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特码合数大小
        $tmBL = str_pad($tm,2,"0",STR_PAD_LEFT); //十位补零
        $chaiTM = str_split($tmBL); //拆分个位 十位
        $TMHS = (int)$chaiTM[0]+(int)$chaiTM[1];
        if($TMHS >= 7 && $tmBL != 49){ //特合大
            $playId = 3569;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TMHS <= 6 && $tmBL != 49){ //特合小
            $playId = 3570;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TMHS%2 == 0){ // 双
            $playId = 3572;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TMHS%2 != 0 && $tmBL != 49){
            $playId = 3571;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特天肖 地肖
        $TTX = $this->LHC_SX->shengxiao($tm);
        if($TTX == '兔' || $TTX == '马' || $TTX == '猴' || $TTX == '猪' || $TTX == '牛' || $TTX == '龙'){ //天肖
            $playId = 3579;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TTX == '蛇' || $TTX == '羊' || $TTX == '鸡' || $TTX == '狗' || $TTX == '鼠' || $TTX == '虎'){ //地肖
            $playId = 3580;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特前肖 后肖
        $TQH = $this->LHC_SX->shengxiao($tm);
        if($TQH == '鼠' || $TQH == '牛' || $TQH == '虎' || $TQH == '兔' || $TQH == '龙' || $TQH == '蛇'){ //前肖
            $playId = 3581;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TQH == '马' || $TQH == '羊' || $TQH == '猴' || $TQH == '鸡' || $TQH == '狗' || $TQH == '猪'){ //后肖
            $playId = 3582;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特家肖 野肖
        $TJX = $this->LHC_SX->shengxiao($tm);
        if($TJX == '牛' || $TJX == '马' || $TJX == '羊' || $TJX == '鸡' || $TJX == '狗' || $TJX == '猪'){ //家肖
            $playId = 3583;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TJX == '鼠' || $TJX == '虎' || $TJX == '兔' || $TJX == '龙' || $TJX == '蛇' || $TJX == '猴'){ //野肖
            $playId = 3584;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //特尾大 特尾小
        $TW = $chaiTM[1];
        if($TW >= 5 && $tmBL != 49){ //尾大
            $playId = 3573;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        if($TW <= 4 && $tmBL != 49){
            $playId = 3574;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //总和大小
        if($ZH >= 175){ //大
            $playId = 3587;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        } else { //小
            $playId = 3588;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
        //总和单双
        if($ZH%2 == 0){ //双
            $playId = 3586;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 3585;
            $winCode = $gameId.$lm_playCate.$playId;
            $win->push($winCode);
        }
    }

    //色波
    public function SB($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $sb_playCate = 164; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        //色波
        if($tm == 1 || $tm == 2 || $tm == 7 || $tm == 8 || $tm == 12 || $tm == 13 || $tm == 18 || $tm == 19 || $tm == 23 || $tm == 24 || $tm == 29 || $tm == 30 || $tm == 34 || $tm == 35 || $tm == 40 || $tm == 45 || $tm == 46){ //红波
            $playId = 3589;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //红双
                $playId = 3593;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //红单
                $playId = 3592;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //红大
                $playId = 3594;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //红大双
                    $playId = 3605;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 红大单
                    $playId = 3604;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //红小
                $playId = 3595;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //红小双
                    $playId = 3607;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 红小单
                    $playId = 3606;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if($tm == 3 || $tm == 4 || $tm == 9 || $tm == 10 || $tm == 14 || $tm == 15 || $tm == 20 || $tm == 25 || $tm == 26 || $tm == 31 || $tm == 36 || $tm == 37 || $tm == 41 || $tm == 42 || $tm == 47 || $tm == 48){ //蓝波
            $playId = 3590;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //蓝双
                $playId = 3597;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //蓝单
                $playId = 3596;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //蓝大
                $playId = 3598;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //蓝大双
                    $playId = 3609;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 蓝大单
                    $playId = 3608;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //蓝小
                $playId = 3599;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //蓝小双
                    $playId = 3611;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 蓝小单
                    $playId = 3610;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if($tm == 5 || $tm == 6 || $tm == 11 || $tm == 16 || $tm == 17 || $tm == 21 || $tm == 22 || $tm == 27 || $tm == 28 || $tm == 32 || $tm == 33 || $tm == 38 || $tm == 39 || $tm == 43 || $tm == 44 || $tm == 49){ //绿波
            $playId = 3591;
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //绿双
                $playId = 3601;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //绿单
                $playId = 3600;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //绿大
                $playId = 3602;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //绿大双
                    $playId = 3613;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 绿大单
                    $playId = 3612;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //绿小
                $playId = 3603;
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //绿小双
                    $playId = 3615;
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 绿小单
                    $playId = 3614;
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
        $tx_playCate = 165; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        if($tm == 6 || $tm == 18 || $tm == 30 || $tm == 42){ //蛇
            $playId = 3621;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 5 || $tm == 17 || $tm == 29 || $tm == 41){ //马
            $playId = 3622;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 4 || $tm == 16 || $tm == 28 || $tm == 40){ //羊
            $playId = 3623;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 3 || $tm == 15 || $tm == 27 || $tm == 39){ //猴
            $playId = 3624;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 2 || $tm == 14 || $tm == 26 || $tm == 38){ //鸡
            $playId = 3625;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 1 || $tm == 13 || $tm == 25 || $tm == 37 || $tm == 49){ //狗
            $playId = 3626;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 12 || $tm == 24 || $tm == 36 || $tm == 48){ //猪
            $playId = 3627;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 11 || $tm == 23 || $tm == 35 || $tm == 47){ // 鼠
            $playId = 3616;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 10 || $tm == 22 || $tm == 34 || $tm == 46){ //牛
            $playId = 3617;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 9 || $tm == 21 || $tm == 33 || $tm == 45){ //虎
            $playId = 3618;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 8 || $tm == 20 || $tm == 32 || $tm == 44){ //兔
            $playId = 3619;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 7 || $tm == 19 || $tm == 31 || $tm == 43){ //龙
            $playId = 3620;
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
    }

    //特码头尾数
    public function TMTWS($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tmtws_playCate = 167; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        $tmBL = str_pad($tm,2,"0",STR_PAD_LEFT); //十位补零
        $chaiTM = str_split($tmBL); //拆分个位 十位
        $tou = (int)$chaiTM[0];
        $wei = (int)$chaiTM[1];
        if($tou == 0){
            $playId = 3638;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 1){
            $playId = 3639;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 2){
            $playId = 3640;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 3){
            $playId = 3641;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($tou == 4){
            $playId = 3642;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 0){
            $playId = 3652;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 1){
            $playId = 3643;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 2){
            $playId = 3644;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 3){
            $playId = 3645;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 4){
            $playId = 3646;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 5){
            $playId = 3647;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 6){
            $playId = 3648;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 7){
            $playId = 3649;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 8){
            $playId = 3650;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
        if($wei == 9){
            $playId = 3651;
            $winCode = $gameId.$tmtws_playCate.$playId;
            $win->push($winCode);
        }
    }

    //正码
    public function ZM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $zm_playCate = 168; //正码分类ID
        $ZM1 = $arrOpenCode[0];
        $ZM2 = $arrOpenCode[1];
        $ZM3 = $arrOpenCode[2];
        $ZM4 = $arrOpenCode[3];
        $ZM5 = $arrOpenCode[4];
        $ZM6 = $arrOpenCode[5];
        $nums = ['1'=>'3653','2'=>'3654','3'=>'3655','4'=>'3656','5'=>'3657','6'=>'3658','7'=>'3659','8'=>'3660','9'=>'3661','10'=>'3662','11'=>'3663','12'=>'3664','13'=>'3665','14'=>'3666','15'=>'3667','16'=>'3668','17'=>'3669','18'=>'3670','19'=>'3671','20'=>'3672','21'=>'3673','22'=>'3674','23'=>'3675','24'=>'3676','25'=>'3677','26'=>'3678','27'=>'3679','28'=>'3680','29'=>'3681','30'=>'3682','31'=>'3683','32'=>'3684','33'=>'3685','34'=>'3686','35'=>'3687','36'=>'3688','37'=>'3689','38'=>'3690','39'=>'3691','40'=>'3692','41'=>'3693','42'=>'3694','43'=>'3695','44'=>'3696','45'=>'3697','46'=>'3698','47'=>'3699','48'=>'3700','49'=>'3701'];
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
        $wx_playCate = 170; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        if($tm == 4 || $tm == 5 || $tm == 18 || $tm == 19 || $tm == 26 || $tm == 27 || $tm == 34 || $tm == 35 || $tm == 48 || $tm == 49){ //金
            $playId = 3702;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 1 || $tm == 8 || $tm == 9 || $tm == 16 || $tm == 17 || $tm == 30 || $tm == 31 || $tm == 38 || $tm == 39 || $tm == 46 || $tm == 47){ //木
            $playId = 3703;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 6 || $tm == 7 || $tm == 14 || $tm == 15 || $tm == 22 || $tm == 23 || $tm == 36 || $tm == 37 || $tm == 44 || $tm == 45){ //水
            $playId = 3704;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 2 || $tm == 3 || $tm == 10 || $tm == 11 || $tm == 24 || $tm == 25 || $tm == 32 || $tm == 33 || $tm == 40 || $tm == 41){ //火
            $playId = 3705;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 12 || $tm == 13 || $tm == 20 || $tm == 21 || $tm == 28 || $tm == 29 || $tm == 42 || $tm == 43){ //土
            $playId = 3706;
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
    }

    //七色波
    public function QSB($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $qsb_playCate = 173; //特码分类ID
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
        if($zmys_blue == 3 && $zmys_green == 3 && $tmsb == 'R'){ //和局
            $playId = 3744;
            $winCode = $gameId.$qsb_playCate.$playId;
            $win->push($winCode);
        } else if ($zmys_blue == 3 && $zmys_red == 3 && $tmsb == 'G'){//和局
            $playId = 3744;
            $winCode = $gameId.$qsb_playCate.$playId;
            $win->push($winCode);
        } else if ($zmys_green == 3 && $zmys_red == 3 && $tmsb == 'B'){//和局
            $playId = 3744;
            $winCode = $gameId.$qsb_playCate.$playId;
            $win->push($winCode);
        } else {
            if ($redTotal>$blueTotal&$redTotal>$greenTotal){ //红
                $playId = 3741;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            }else if ($blueTotal>$greenTotal) { //蓝
                $playId = 3742;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            } else { //绿
                $playId = 3743;
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            }
        }
    }

    //平特一肖位数
    public function PTYXWS($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $ptyxws_playCate = 171; //特码分类ID
        $m1 = $arrOpenCode[0];
        $m2 = $arrOpenCode[1];
        $m3 = $arrOpenCode[2];
        $m4 = $arrOpenCode[3];
        $m5 = $arrOpenCode[4];
        $m6 = $arrOpenCode[5];
        $m7 = $arrOpenCode[6];
        $shu = [11,23,35,47];
        $niu = [10,22,34,46];
        $hu = [9,21,33,45];
        $tu = [8,20,32,44];
        $long = [7,19,31,43];
        $she = [6,18,30,42];
        $ma = [5,17,29,41];
        $yang = [4,16,28,40];
        $hou = [3,15,27,39];
        $ji = [2,14,26,38];
        $gou = [1,13,25,37,49];
        $zhu = [12,24,36,48];
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
            $playId = 3707;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$niu) || in_array($m2,$niu) || in_array($m3,$niu) || in_array($m4,$niu) || in_array($m5,$niu) || in_array($m6,$niu) || in_array($m7,$niu)){
            $playId = 3708;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$hu) || in_array($m2,$hu) || in_array($m3,$hu) || in_array($m4,$hu) || in_array($m5,$hu) || in_array($m6,$hu) || in_array($m7,$hu)){
            $playId = 3709;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$tu) || in_array($m2,$tu) || in_array($m3,$tu) || in_array($m4,$tu) || in_array($m5,$tu) || in_array($m6,$tu) || in_array($m7,$tu)){
            $playId = 3710;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$long) || in_array($m2,$long) || in_array($m3,$long) || in_array($m4,$long) || in_array($m5,$long) || in_array($m6,$long) || in_array($m7,$long)){
            $playId = 3711;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$she) || in_array($m2,$she) || in_array($m3,$she) || in_array($m4,$she) || in_array($m5,$she) || in_array($m6,$she) || in_array($m7,$she)){
            $playId = 3712;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$ma) || in_array($m2,$ma) || in_array($m3,$ma) || in_array($m4,$ma) || in_array($m5,$ma) || in_array($m6,$ma) || in_array($m7,$ma)){
            $playId = 3713;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$yang) || in_array($m2,$yang) || in_array($m3,$yang) || in_array($m4,$yang) || in_array($m5,$yang) || in_array($m6,$yang) || in_array($m7,$yang)){
            $playId = 3714;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$hou) || in_array($m2,$hou) || in_array($m3,$hou) || in_array($m4,$hou) || in_array($m5,$hou) || in_array($m6,$hou) || in_array($m7,$hou)){
            $playId = 3715;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$ji) || in_array($m2,$ji) || in_array($m3,$ji) || in_array($m4,$ji) || in_array($m5,$ji) || in_array($m6,$ji) || in_array($m7,$ji)){
            $playId = 3716;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$gou) || in_array($m2,$gou) || in_array($m3,$gou) || in_array($m4,$gou) || in_array($m5,$gou) || in_array($m6,$gou) || in_array($m7,$gou)){
            $playId = 3717;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$zhu) || in_array($m2,$zhu) || in_array($m3,$zhu) || in_array($m4,$zhu) || in_array($m5,$zhu) || in_array($m6,$zhu) || in_array($m7,$zhu)){
            $playId = 3718;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        //尾数
        if(in_array($m1,$w0) || in_array($m2,$w0) || in_array($m3,$w0) || in_array($m4,$w0) || in_array($m5,$w0) || in_array($m6,$w0) || in_array($m7,$w0)){
            $playId = 3719;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w1) || in_array($m2,$w1) || in_array($m3,$w1) || in_array($m4,$w1) || in_array($m5,$w1) || in_array($m6,$w1) || in_array($m7,$w1)){
            $playId = 3720;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w2) || in_array($m2,$w2) || in_array($m3,$w2) || in_array($m4,$w2) || in_array($m5,$w2) || in_array($m6,$w2) || in_array($m7,$w2)){
            $playId = 3721;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w3) || in_array($m2,$w3) || in_array($m3,$w3) || in_array($m4,$w3) || in_array($m5,$w3) || in_array($m6,$w3) || in_array($m7,$w3)){
            $playId = 3722;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w4) || in_array($m2,$w4) || in_array($m3,$w4) || in_array($m4,$w4) || in_array($m5,$w4) || in_array($m6,$w4) || in_array($m7,$w4)){
            $playId = 3723;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w5) || in_array($m2,$w5) || in_array($m3,$w5) || in_array($m4,$w5) || in_array($m5,$w5) || in_array($m6,$w5) || in_array($m7,$w5)){
            $playId = 3724;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w6) || in_array($m2,$w6) || in_array($m3,$w6) || in_array($m4,$w6) || in_array($m5,$w6) || in_array($m6,$w6) || in_array($m7,$w6)){
            $playId = 3725;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w7) || in_array($m2,$w7) || in_array($m3,$w7) || in_array($m4,$w7) || in_array($m5,$w7) || in_array($m6,$w7) || in_array($m7,$w7)){
            $playId = 3726;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w8) || in_array($m2,$w8) || in_array($m3,$w8) || in_array($m4,$w8) || in_array($m5,$w8) || in_array($m6,$w8) || in_array($m7,$w8)){
            $playId = 3727;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w9) || in_array($m2,$w9) || in_array($m3,$w9) || in_array($m4,$w9) || in_array($m5,$w9) || in_array($m6,$w9) || in_array($m7,$w9)){
            $playId = 3728;
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
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
    function BUNKO($openCode,$win,$gameId,$issue)
    {
        $id = [];
        foreach ($win as $k=>$v){
            $id[] = $v;
        }
        $getUserBets = DB::table('bet')->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        if($getUserBets){
            $sql = "UPDATE bet SET bunko = CASE "; //中奖的SQL语句
            $sql_lose = "UPDATE bet SET bunko = CASE "; //未中奖的SQL语句

            $ids = implode(',', $id);
            foreach ($getUserBets as $item){
                $bunko = ($item->bet_money * $item->play_odds) + ($item->bet_money * $item->play_rebate);
                $bunko_lose = (0-$item->bet_money) + ($item->bet_money * $item->play_rebate);
                $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
            }
            $sql .= "END WHERE `play_id` IN ($ids) AND `issue` = $issue AND `game_id` = $gameId";
            $sql_lose .= "END WHERE `play_id` NOT IN ($ids) AND `issue` = $issue AND `game_id` = $gameId";
            $run = DB::statement($sql);

            $zxbz_playCate = 175; //特码分类ID
            $zxbz_ids = [];
            $zxbz_lose_ids = [];
            $get = DB::table('bet')->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$zxbz_playCate)->where('bunko','=',0.00)->get();
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
            $ids_zxbz_lose = implode(',', $zxbz_lose_ids);
//            \Log::info('自选不中--》中了：'.$ids_zxbz);
//            \Log::info('自选不中--》没中：'.$ids_zxbz_lose);
            if($ids_zxbz){
                $sql_zxb = "UPDATE bet SET bunko = bet_money * play_odds WHERE `bet_id` IN ($ids_zxbz)"; //中奖的SQL语句
            } else {
                $sql_zxb = 0;
            }

//            if ($ids_zxbz_lose) {
//                $sql_zxb = "UPDATE bet SET bunko = 0-bet_money WHERE `bet_id` IN ($ids_zxbz_lose)"; //未中奖的SQL语句
//                $run_xzbz_lose = DB::statement($sql_zxb);
//            } else {
//                $run_xzbz_lose = 0;
//            }

            if($run == 1){
                $run2 = DB::statement($sql_lose);
                if($run2 == 1){
                    if($sql_zxb !== 0){
                        $run3 = DB::statement($sql_zxb);
                        if($run3 == 1){
                            return 1;
                        }
                    } else {
                        return 1;
                    }
                }
            }
        }
    }

    function updateUserMoney($gameId,$issue){
        $get = DB::table('bet')->select(DB::raw("sum(bunko) as s"),'user_id')->where('game_id',$gameId)->where('issue',$issue)->where('bunko','>=',0.01)->groupBy('user_id')->get();
        \Log::info('lucky lhc'.$get);
        if($get){
            $sql = "UPDATE users SET money = money+ CASE id ";
            $users = [];
            foreach ($get as $i){
                $users[] = $i->user_id;
                $sql .= "WHEN $i->user_id THEN $i->s ";
            }
            $ids = implode(',',$users);
            if($ids && isset($ids)){
                $sql .= "END WHERE id IN (0,$ids)";
                $up = DB::statement($sql);
                if($up == 1){
                    return 1;
                }
            }
        } else {
            \Log::info('幸运六合彩已结算过，已阻止！');
        }
    }
}
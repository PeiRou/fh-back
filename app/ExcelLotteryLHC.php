<?php
/**
 * 六合彩玩法结算
 * User: jeremy
 * Date: 2019/3/14
 * Time: 下午20:01
 */

namespace App;

use App\Helpers\LHC_SX;
use Illuminate\Support\Facades\DB;

class ExcelLotteryLHC
{
    public $arrPlayCate;
    public $arrPlayId;
    public $sx1;
    public $sx2;
    public $sx3;
    public $sx4;
    public $sx5;
    public $sx6;
    public $sx7;
    public $wei1;
    public $wei2;
    public $wei3;
    public $wei4;
    public $wei5;
    public $wei6;
    public $wei7;

    public function setArrPlay($openCode,$arrPlayCate=array(),$arrPlayId=array()){
        $this->arrPlayCate = $arrPlayCate;
        $this->arrPlayId = $arrPlayId;
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $LHC_SX = new LHC_SX();
        $this->sx1 = $LHC_SX->shengxiao($arrOpenCode[0]);
        $this->sx2 = $LHC_SX->shengxiao($arrOpenCode[1]);
        $this->sx3 = $LHC_SX->shengxiao($arrOpenCode[2]);
        $this->sx4 = $LHC_SX->shengxiao($arrOpenCode[3]);
        $this->sx5 = $LHC_SX->shengxiao($arrOpenCode[4]);
        $this->sx6 = $LHC_SX->shengxiao($arrOpenCode[5]);
        $this->sx7 = $LHC_SX->shengxiao($arrOpenCode[6]);
        $this->wei1 = $LHC_SX->wei($arrOpenCode[0]);
        $this->wei2 = $LHC_SX->wei($arrOpenCode[1]);
        $this->wei3 = $LHC_SX->wei($arrOpenCode[2]);
        $this->wei4 = $LHC_SX->wei($arrOpenCode[3]);
        $this->wei5 = $LHC_SX->wei($arrOpenCode[4]);
        $this->wei6 = $LHC_SX->wei($arrOpenCode[5]);
        $this->wei7 = $LHC_SX->wei($arrOpenCode[6]);
    }

    //特码A-B
    public function LHC_TM($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tm_playCate = $this->arrPlayCate['TEMA']; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        if($tm >= 1 && $tm < 10){
            $playId_B = $this->arrPlayId['TMB_0'.$tm];
            $winCode_B = $gameId.$tm_playCate.$playId_B;
            $win->push($winCode_B);
            $playId_A = $this->arrPlayId['TMA_0'.$tm];
            $winCode_A = $gameId.$tm_playCate.$playId_A;
            $win->push($winCode_A);
        }else if ($tm <= 49){
            $playId_B = $this->arrPlayId['TMB_'.$tm];
            $winCode_B = $gameId.$tm_playCate.$playId_B;
            $win->push($winCode_B);
            $playId_A = $this->arrPlayId['TMA_'.$tm];
            $winCode_A = $gameId.$tm_playCate.$playId_A;
            $win->push($winCode_A);
        }
    }
    //两面
    public function LHC_LM($openCode,$gameId,$win,$ids_he){
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $lm_playCate = $this->arrPlayCate['LIANGMIAN']; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        $ZH = (int)$arrOpenCode[0]+(int)$arrOpenCode[1]+(int)$arrOpenCode[2]+(int)$arrOpenCode[3]+(int)$arrOpenCode[4]+(int)$arrOpenCode[5]+(int)$arrOpenCode[6];
        //和局退本金
        if($tm==49){
            //特码大小
            $playId = $this->arrPlayId['LMTD'];
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['LMTX'];
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            //特码单双
            $playId = $this->arrPlayId['LMTDAN'];
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['LMTS'];
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            //特码合数大小
            $playId = $this->arrPlayId['LMTHD'];
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['LMTHEX'];
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['LMTHDAN'];
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['LMTHSHUANG'];
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            //特尾大 特尾小
            $playId = $this->arrPlayId['LMTWD'];
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['LMTWX'];
            $winCode = $gameId.$lm_playCate.$playId;
            $ids_he->push($winCode);
        }else{
            if($tm >= 25 && $tm <= 48){ //大
                $playId = $this->arrPlayId['LMTD'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //特大双
                    $playId = $this->arrPlayId['LMTDSHUANG'];
                    $winCode = $gameId.$lm_playCate.$playId;
                    $win->push($winCode);
                } else { //特大单
                    $playId = $this->arrPlayId['LMTDDAN'];
                    $winCode = $gameId.$lm_playCate.$playId;
                    $win->push($winCode);
                }
            }else if($tm <= 24){
                $playId = $this->arrPlayId['LMTX'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //特小双
                    $playId = $this->arrPlayId['LMTXS'];
                    $winCode = $gameId.$lm_playCate.$playId;
                    $win->push($winCode);
                } else { //特小单
                    $playId = $this->arrPlayId['LMTXDAN'];
                    $winCode = $gameId.$lm_playCate.$playId;
                    $win->push($winCode);
                }
            }
            //特码单双
            if($tm%2 == 0){ // 双
                $playId = $this->arrPlayId['LMTS'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }else if($tm%2 != 0 && $tm != 49){
                $playId = $this->arrPlayId['LMTDAN'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
            //特码合数大小
            $tmBL = str_pad($tm,2,"0",STR_PAD_LEFT); //十位补零
            $chaiTM = str_split($tmBL); //拆分个位 十位
            $TMHS = (int)$chaiTM[0]+(int)$chaiTM[1];
            if($TMHS >= 7 && $tmBL != 49){ //特合大
                $playId = $this->arrPlayId['LMTHD'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }else if($TMHS <= 6 && $tmBL != 49){ //特合小
                $playId = $this->arrPlayId['LMTHEX'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
            if($TMHS%2 == 0){ // 双
                $playId = $this->arrPlayId['LMTHSHUANG'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }else if($TMHS%2 != 0 && $tmBL != 49){
                $playId = $this->arrPlayId['LMTHDAN'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
            //特天肖 地肖
            $TTX = $this->sx7;
            if($TTX == '兔' || $TTX == '马' || $TTX == '猴' || $TTX == '猪' || $TTX == '牛' || $TTX == '龙'){ //天肖
                $playId = $this->arrPlayId['LMTTX'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
            if($TTX == '蛇' || $TTX == '羊' || $TTX == '鸡' || $TTX == '狗' || $TTX == '鼠' || $TTX == '虎'){ //地肖
                $playId = $this->arrPlayId['LMTDX'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
            //特前肖 后肖
            $TQH = $this->sx7;
            if($TQH == '鼠' || $TQH == '牛' || $TQH == '虎' || $TQH == '兔' || $TQH == '龙' || $TQH == '蛇'){ //前肖
                $playId = $this->arrPlayId['LMTQX'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
            if($TQH == '马' || $TQH == '羊' || $TQH == '猴' || $TQH == '鸡' || $TQH == '狗' || $TQH == '猪'){ //后肖
                $playId = $this->arrPlayId['LMTHOUX'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
            //特家肖 野肖
            $TJX = $this->sx7;
            if($TJX == '牛' || $TJX == '马' || $TJX == '羊' || $TJX == '鸡' || $TJX == '狗' || $TJX == '猪'){ //家肖
                $playId = $this->arrPlayId['LMTJX'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
            if($TJX == '鼠' || $TJX == '虎' || $TJX == '兔' || $TJX == '龙' || $TJX == '蛇' || $TJX == '猴'){ //野肖
                $playId = $this->arrPlayId['LMTYX'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
            //特尾大 特尾小
            $TW = $chaiTM[1];
            if($TW >= 5 && $tmBL != 49){ //尾大
                $playId = $this->arrPlayId['LMTWD'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }else if($TW <= 4 && $tmBL != 49){
                $playId = $this->arrPlayId['LMTWX'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
            //总和大小
            if($ZH >= 175){ //大
                $playId = $this->arrPlayId['LMZHDA'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            } else { //小
                $playId = $this->arrPlayId['LMZHXIAO'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
            //总和单双
            if($ZH%2 == 0){ //双
                $playId = $this->arrPlayId['LMZHS'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['LMZHD'];
                $winCode = $gameId.$lm_playCate.$playId;
                $win->push($winCode);
            }
        }
    }
    //色波
    public function LHC_SB($openCode,$gameId,$win,$ids_he){
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $sb_playCate = $this->arrPlayCate['SEBO']; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        //色波
        if($tm == 1 || $tm == 2 || $tm == 7 || $tm == 8 || $tm == 12 || $tm == 13 || $tm == 18 || $tm == 19 || $tm == 23 || $tm == 24 || $tm == 29 || $tm == 30 || $tm == 34 || $tm == 35 || $tm == 40 || $tm == 45 || $tm == 46){ //红波
            $playId = $this->arrPlayId['HONGBO'];
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //红双
                $playId = $this->arrPlayId['HONGSHUANG'];
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //红单
                $playId = $this->arrPlayId['HONGDAN'];
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //红大
                $playId = $this->arrPlayId['HONGDA'];
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //红大双
                    $playId = $this->arrPlayId['HONGDASHUANG'];
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 红大单
                    $playId = $this->arrPlayId['HONGDADAN'];
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //红小
                $playId = $this->arrPlayId['HONGXIAO'];
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //红小双
                    $playId = $this->arrPlayId['HONGXIAOSHUANG'];
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 红小单
                    $playId = $this->arrPlayId['HONGXIAODAN'];
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if($tm == 3 || $tm == 4 || $tm == 9 || $tm == 10 || $tm == 14 || $tm == 15 || $tm == 20 || $tm == 25 || $tm == 26 || $tm == 31 || $tm == 36 || $tm == 37 || $tm == 41 || $tm == 42 || $tm == 47 || $tm == 48){ //蓝波
            $playId = $this->arrPlayId['LANBO'];
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm%2 == 0){ //蓝双
                $playId = $this->arrPlayId['LANSHUANG'];
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            } else { //蓝单
                $playId = $this->arrPlayId['LANDAN'];
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
            }
            if($tm >= 25 && $tm <= 48){ //蓝大
                $playId = $this->arrPlayId['LANDA'];
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //蓝大双
                    $playId = $this->arrPlayId['LANDASHUANG'];
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 蓝大单
                    $playId = $this->arrPlayId['LANDADAN'];
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
            if($tm <= 24){ //蓝小
                $playId = $this->arrPlayId['LANXIAO'];
                $winCode = $gameId.$sb_playCate.$playId;
                $win->push($winCode);
                if($tm%2 == 0){ //蓝小双
                    $playId = $this->arrPlayId['LANXIAOSHUANG'];
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { // 蓝小单
                    $playId = $this->arrPlayId['LANXIAODAN'];
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if($tm == 5 || $tm == 6 || $tm == 11 || $tm == 16 || $tm == 17 || $tm == 21 || $tm == 22 || $tm == 27 || $tm == 28 || $tm == 32 || $tm == 33 || $tm == 38 || $tm == 39 || $tm == 43 || $tm == 44 || $tm == 49){ //绿波
            $playId = $this->arrPlayId['LUBO'];
            $winCode = $gameId.$sb_playCate.$playId;
            $win->push($winCode);
            //半波
            if($tm==49){    //和局退本金
                $playId = $this->arrPlayId['LUSHUANG'];
                $winCode = $gameId.$sb_playCate.$playId;
                $ids_he->push($winCode);
                $playId = $this->arrPlayId['LUDAN'];
                $winCode = $gameId.$sb_playCate.$playId;
                $ids_he->push($winCode);
                $playId = $this->arrPlayId['LUDA'];
                $winCode = $gameId.$sb_playCate.$playId;
                $ids_he->push($winCode);
                $playId = $this->arrPlayId['LUDASHUANG'];
                $winCode = $gameId.$sb_playCate.$playId;
                $ids_he->push($winCode);
                $playId = $this->arrPlayId['LUDADAN'];
                $winCode = $gameId.$sb_playCate.$playId;
                $ids_he->push($winCode);
                $playId = $this->arrPlayId['LUAXIAO'];
                $winCode = $gameId.$sb_playCate.$playId;
                $ids_he->push($winCode);
                $playId = $this->arrPlayId['LUXIAOSHUANG'];
                $winCode = $gameId.$sb_playCate.$playId;
                $ids_he->push($winCode);
                $playId = $this->arrPlayId['LUXIAODAN'];
                $winCode = $gameId.$sb_playCate.$playId;
                $ids_he->push($winCode);
            }else{
                if($tm%2 == 0){ //绿双
                    $playId = $this->arrPlayId['LUSHUANG'];
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                } else { //绿单
                    $playId = $this->arrPlayId['LUDAN'];
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                }
                if($tm >= 25 && $tm <= 48){ //绿大
                    $playId = $this->arrPlayId['LUDA'];
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                    if($tm%2 == 0){ //绿大双
                        $playId = $this->arrPlayId['LUDASHUANG'];
                        $winCode = $gameId.$sb_playCate.$playId;
                        $win->push($winCode);
                    } else { // 绿大单
                        $playId = $this->arrPlayId['LUDADAN'];
                        $winCode = $gameId.$sb_playCate.$playId;
                        $win->push($winCode);
                    }
                }
                if($tm <= 24){ //绿小
                    $playId = $this->arrPlayId['LUAXIAO'];
                    $winCode = $gameId.$sb_playCate.$playId;
                    $win->push($winCode);
                    if($tm%2 == 0){ //绿小双
                        $playId = $this->arrPlayId['LUXIAOSHUANG'];
                        $winCode = $gameId.$sb_playCate.$playId;
                        $win->push($winCode);
                    } else { // 绿小单
                        $playId = $this->arrPlayId['LUXIAODAN'];
                        $winCode = $gameId.$sb_playCate.$playId;
                        $win->push($winCode);
                    }
                }
            }
        }
    }
    //特肖
    public function LHC_TX($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tx_playCate = $this->arrPlayCate['TEXIAO']; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        if($tm == 7 || $tm == 19 || $tm == 31 || $tm == 43){ //蛇
            $playId = $this->arrPlayId['TXSHE'];
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 6 || $tm == 18 || $tm == 30 || $tm == 42){ //马
            $playId = $this->arrPlayId['TXMA'];
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 5 || $tm == 17 || $tm == 29 || $tm == 41){ //羊
            $playId = $this->arrPlayId['TXYANG'];
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 4 || $tm == 16 || $tm == 28 || $tm == 40){ //猴
            $playId = $this->arrPlayId['TXHOU'];
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 3 || $tm == 15 || $tm == 27 || $tm == 39){ //鸡
            $playId = $this->arrPlayId['TXJI'];
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 2 || $tm == 14 || $tm == 26 || $tm == 38){ //狗
            $playId = $this->arrPlayId['TXGOU'];
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 1 || $tm == 13 || $tm == 25 || $tm == 37 || $tm == 49){ //猪
            $playId = $this->arrPlayId['TXZHU'];
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 12 || $tm == 24 || $tm == 36 || $tm == 48){ // 鼠
            $playId = $this->arrPlayId['TXSHU'];
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 11 || $tm == 23 || $tm == 35 || $tm == 47){ //牛
            $playId = $this->arrPlayId['TXNIU'];
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 10 || $tm == 22 || $tm == 34 || $tm == 46){ //虎
            $playId = $this->arrPlayId['TXHU'];
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 9 || $tm == 21 || $tm == 33 || $tm == 45){ //兔
            $playId = $this->arrPlayId['TXTU'];
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 8 || $tm == 20 || $tm == 32 || $tm == 44){ //龙
            $playId = $this->arrPlayId['TXLONG'];
            $winCode = $gameId.$tx_playCate.$playId;
            $win->push($winCode);
        }
    }
    //特码头尾数
    public function LHC_TMTWS($openCode,$gameId,$win,$ids_he){
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tmtws_playCate = $this->arrPlayCate['TOUWEISHU']; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        $tmBL = str_pad($tm,2,"0",STR_PAD_LEFT); //十位补零
        $chaiTM = str_split($tmBL); //拆分个位 十位
        $tou = (int)$chaiTM[0];
        $wei = (int)$chaiTM[1];
        if($tm==49){    //和局：特码为49时，和局退本金//特码尾数大小，特尾大：5尾~9尾为大，如05、18、19。特尾小：0尾~4尾为小，如01，32，44。
            $playId = $this->arrPlayId['TOUT'.$tou];
            $winCode = $gameId.$tmtws_playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['WEIW'.$wei];
            $winCode = $gameId.$tmtws_playCate.$playId;
            $ids_he->push($winCode);
        }else{
            if($tou>=0 && $tou<=4){
                $playId = $this->arrPlayId['TOUT'.$tou];
                $winCode = $gameId.$tmtws_playCate.$playId;
                $win->push($winCode);
            }
            if($wei>=0 && $wei<=9){
                $playId = $this->arrPlayId['WEIW'.$wei];
                $winCode = $gameId.$tmtws_playCate.$playId;
                $win->push($winCode);
            }
        }
    }
    //正码
    public function LHC_ZM($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $zm_playCate = $this->arrPlayCate['ZHENGMA']; //正码分类ID
        $ZM1 = $arrOpenCode[0];
        $ZM2 = $arrOpenCode[1];
        $ZM3 = $arrOpenCode[2];
        $ZM4 = $arrOpenCode[3];
        $ZM5 = $arrOpenCode[4];
        $ZM6 = $arrOpenCode[5];
        $nums = ['1'=>$this->arrPlayId['ZM01'],'2'=>$this->arrPlayId['ZM02'],'3'=>$this->arrPlayId['ZM03'],'4'=>$this->arrPlayId['ZM04'],'5'=>$this->arrPlayId['ZM05'],'6'=>$this->arrPlayId['ZM06'],'7'=>$this->arrPlayId['ZM07'],'8'=>$this->arrPlayId['ZM08'],'9'=>$this->arrPlayId['ZM09'],'10'=>$this->arrPlayId['ZM10'],'11'=>$this->arrPlayId['ZM11'],'12'=>$this->arrPlayId['ZM12'],'13'=>$this->arrPlayId['ZM13'],'14'=>$this->arrPlayId['ZM14'],'15'=>$this->arrPlayId['ZM15'],'16'=>$this->arrPlayId['ZM16'],'17'=>$this->arrPlayId['ZM17'],'18'=>$this->arrPlayId['ZM18'],'19'=>$this->arrPlayId['ZM19'],'20'=>$this->arrPlayId['ZM20'],'21'=>$this->arrPlayId['ZM21'],'22'=>$this->arrPlayId['ZM22'],'23'=>$this->arrPlayId['ZM23'],'24'=>$this->arrPlayId['ZM24'],'25'=>$this->arrPlayId['ZM25'],'26'=>$this->arrPlayId['ZM26'],'27'=>$this->arrPlayId['ZM27'],'28'=>$this->arrPlayId['ZM28'],'29'=>$this->arrPlayId['ZM29'],'30'=>$this->arrPlayId['ZM30'],'31'=>$this->arrPlayId['ZM31'],'32'=>$this->arrPlayId['ZM32'],'33'=>$this->arrPlayId['ZM33'],'34'=>$this->arrPlayId['ZM34'],'35'=>$this->arrPlayId['ZM35'],'36'=>$this->arrPlayId['ZM36'],'37'=>$this->arrPlayId['ZM37'],'38'=>$this->arrPlayId['ZM38'],'39'=>$this->arrPlayId['ZM39'],'40'=>$this->arrPlayId['ZM40'],'41'=>$this->arrPlayId['ZM41'],'42'=>$this->arrPlayId['ZM42'],'43'=>$this->arrPlayId['ZM43'],'44'=>$this->arrPlayId['ZM44'],'45'=>$this->arrPlayId['ZM45'],'46'=>$this->arrPlayId['ZM46'],'47'=>$this->arrPlayId['ZM47'],'48'=>$this->arrPlayId['ZM48'],'49'=>$this->arrPlayId['ZM49']];
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
    //正码特
    public function LHC_ZMT($openCode,$gameId,$win,$ids_he){
        $arrOpenCode = explode(',',$openCode);
        $playCate = $this->arrPlayCate['ZHENGMATE'];
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

        $zm1_nums = [1=>$this->arrPlayId['ZHENGYITE01'],2=>$this->arrPlayId['ZHENGYITE02'],3=>$this->arrPlayId['ZHENGYITE03'],4=>$this->arrPlayId['ZHENGYITE04'],5=>$this->arrPlayId['ZHENGYITE05'],6=>$this->arrPlayId['ZHENGYITE06'],7=>$this->arrPlayId['ZHENGYITE07'],8=>$this->arrPlayId['ZHENGYITE08'],9=>$this->arrPlayId['ZHENGYITE09'],10=>$this->arrPlayId['ZHENGYITE10'],11=>$this->arrPlayId['ZHENGYITE11'],12=>$this->arrPlayId['ZHENGYITE12'],13=>$this->arrPlayId['ZHENGYITE13'],14=>$this->arrPlayId['ZHENGYITE14'],15=>$this->arrPlayId['ZHENGYITE15'],16=>$this->arrPlayId['ZHENGYITE16'],17=>$this->arrPlayId['ZHENGYITE17'],18=>$this->arrPlayId['ZHENGYITE18'],19=>$this->arrPlayId['ZHENGYITE19'],20=>$this->arrPlayId['ZHENGYITE20'],21=>$this->arrPlayId['ZHENGYITE21'],22=>$this->arrPlayId['ZHENGYITE22'],23=>$this->arrPlayId['ZHENGYITE23'],24=>$this->arrPlayId['ZHENGYITE24'],25=>$this->arrPlayId['ZHENGYITE25'],26=>$this->arrPlayId['ZHENGYITE26'],27=>$this->arrPlayId['ZHENGYITE27'],28=>$this->arrPlayId['ZHENGYITE28'],29=>$this->arrPlayId['ZHENGYITE29'],30=>$this->arrPlayId['ZHENGYITE30'],31=>$this->arrPlayId['ZHENGYITE31'],32=>$this->arrPlayId['ZHENGYITE32'],33=>$this->arrPlayId['ZHENGYITE33'],34=>$this->arrPlayId['ZHENGYITE34'],35=>$this->arrPlayId['ZHENGYITE35'],36=>$this->arrPlayId['ZHENGYITE36'],37=>$this->arrPlayId['ZHENGYITE37'],38=>$this->arrPlayId['ZHENGYITE38'],39=>$this->arrPlayId['ZHENGYITE39'],40=>$this->arrPlayId['ZHENGYITE40'],41=>$this->arrPlayId['ZHENGYITE41'],42=>$this->arrPlayId['ZHENGYITE42'],43=>$this->arrPlayId['ZHENGYITE43'],44=>$this->arrPlayId['ZHENGYITE44'],45=>$this->arrPlayId['ZHENGYITE45'],46=>$this->arrPlayId['ZHENGYITE46'],47=>$this->arrPlayId['ZHENGYITE47'],48=>$this->arrPlayId['ZHENGYITE48'],49=>$this->arrPlayId['ZHENGYITE49']];
        $zm2_nums = [1=>$this->arrPlayId['ZHENGERTE01'],2=>$this->arrPlayId['ZHENGERTE02'],3=>$this->arrPlayId['ZHENGERTE03'],4=>$this->arrPlayId['ZHENGERTE04'],5=>$this->arrPlayId['ZHENGERTE05'],6=>$this->arrPlayId['ZHENGERTE06'],7=>$this->arrPlayId['ZHENGERTE07'],8=>$this->arrPlayId['ZHENGERTE08'],9=>$this->arrPlayId['ZHENGERTE09'],10=>$this->arrPlayId['ZHENGERTE10'],11=>$this->arrPlayId['ZHENGERTE11'],12=>$this->arrPlayId['ZHENGERTE12'],13=>$this->arrPlayId['ZHENGERTE13'],14=>$this->arrPlayId['ZHENGERTE14'],15=>$this->arrPlayId['ZHENGERTE15'],16=>$this->arrPlayId['ZHENGERTE16'],17=>$this->arrPlayId['ZHENGERTE17'],18=>$this->arrPlayId['ZHENGERTE18'],19=>$this->arrPlayId['ZHENGERTE19'],20=>$this->arrPlayId['ZHENGERTE20'],21=>$this->arrPlayId['ZHENGERTE21'],22=>$this->arrPlayId['ZHENGERTE22'],23=>$this->arrPlayId['ZHENGERTE23'],24=>$this->arrPlayId['ZHENGERTE24'],25=>$this->arrPlayId['ZHENGERTE25'],26=>$this->arrPlayId['ZHENGERTE26'],27=>$this->arrPlayId['ZHENGERTE27'],28=>$this->arrPlayId['ZHENGERTE28'],29=>$this->arrPlayId['ZHENGERTE29'],30=>$this->arrPlayId['ZHENGERTE30'],31=>$this->arrPlayId['ZHENGERTE31'],32=>$this->arrPlayId['ZHENGERTE32'],33=>$this->arrPlayId['ZHENGERTE33'],34=>$this->arrPlayId['ZHENGERTE34'],35=>$this->arrPlayId['ZHENGERTE35'],36=>$this->arrPlayId['ZHENGERTE36'],37=>$this->arrPlayId['ZHENGERTE37'],38=>$this->arrPlayId['ZHENGERTE38'],39=>$this->arrPlayId['ZHENGERTE39'],40=>$this->arrPlayId['ZHENGERTE40'],41=>$this->arrPlayId['ZHENGERTE41'],42=>$this->arrPlayId['ZHENGERTE42'],43=>$this->arrPlayId['ZHENGERTE43'],44=>$this->arrPlayId['ZHENGERTE44'],45=>$this->arrPlayId['ZHENGERTE45'],46=>$this->arrPlayId['ZHENGERTE46'],47=>$this->arrPlayId['ZHENGERTE47'],48=>$this->arrPlayId['ZHENGERTE48'],49=>$this->arrPlayId['ZHENGERTE49']];
        $zm3_nums = [1=>$this->arrPlayId['ZHENGSANTE01'],2=>$this->arrPlayId['ZHENGSANTE02'],3=>$this->arrPlayId['ZHENGSANTE03'],4=>$this->arrPlayId['ZHENGSANTE04'],5=>$this->arrPlayId['ZHENGSANTE05'],6=>$this->arrPlayId['ZHENGSANTE06'],7=>$this->arrPlayId['ZHENGSANTE07'],8=>$this->arrPlayId['ZHENGSANTE08'],9=>$this->arrPlayId['ZHENGSANTE09'],10=>$this->arrPlayId['ZHENGSANTE10'],11=>$this->arrPlayId['ZHENGSANTE11'],12=>$this->arrPlayId['ZHENGSANTE12'],13=>$this->arrPlayId['ZHENGSANTE13'],14=>$this->arrPlayId['ZHENGSANTE14'],15=>$this->arrPlayId['ZHENGSANTE15'],16=>$this->arrPlayId['ZHENGSANTE16'],17=>$this->arrPlayId['ZHENGSANTE17'],18=>$this->arrPlayId['ZHENGSANTE18'],19=>$this->arrPlayId['ZHENGSANTE19'],20=>$this->arrPlayId['ZHENGSANTE20'],21=>$this->arrPlayId['ZHENGSANTE21'],22=>$this->arrPlayId['ZHENGSANTE22'],23=>$this->arrPlayId['ZHENGSANTE23'],24=>$this->arrPlayId['ZHENGSANTE24'],25=>$this->arrPlayId['ZHENGSANTE25'],26=>$this->arrPlayId['ZHENGSANTE26'],27=>$this->arrPlayId['ZHENGSANTE27'],28=>$this->arrPlayId['ZHENGSANTE28'],29=>$this->arrPlayId['ZHENGSANTE29'],30=>$this->arrPlayId['ZHENGSANTE30'],31=>$this->arrPlayId['ZHENGSANTE31'],32=>$this->arrPlayId['ZHENGSANTE32'],33=>$this->arrPlayId['ZHENGSANTE33'],34=>$this->arrPlayId['ZHENGSANTE34'],35=>$this->arrPlayId['ZHENGSANTE35'],36=>$this->arrPlayId['ZHENGSANTE36'],37=>$this->arrPlayId['ZHENGSANTE37'],38=>$this->arrPlayId['ZHENGSANTE38'],39=>$this->arrPlayId['ZHENGSANTE39'],40=>$this->arrPlayId['ZHENGSANTE40'],41=>$this->arrPlayId['ZHENGSANTE41'],42=>$this->arrPlayId['ZHENGSANTE42'],43=>$this->arrPlayId['ZHENGSANTE43'],44=>$this->arrPlayId['ZHENGSANTE44'],45=>$this->arrPlayId['ZHENGSANTE45'],46=>$this->arrPlayId['ZHENGSANTE46'],47=>$this->arrPlayId['ZHENGSANTE47'],48=>$this->arrPlayId['ZHENGSANTE48'],49=>$this->arrPlayId['ZHENGSANTE49']];
        $zm4_nums = [1=>$this->arrPlayId['ZHENGSITE01'],2=>$this->arrPlayId['ZHENGSITE02'],3=>$this->arrPlayId['ZHENGSITE03'],4=>$this->arrPlayId['ZHENGSITE04'],5=>$this->arrPlayId['ZHENGSITE05'],6=>$this->arrPlayId['ZHENGSITE06'],7=>$this->arrPlayId['ZHENGSITE07'],8=>$this->arrPlayId['ZHENGSITE08'],9=>$this->arrPlayId['ZHENGSITE09'],10=>$this->arrPlayId['ZHENGSITE10'],11=>$this->arrPlayId['ZHENGSITE11'],12=>$this->arrPlayId['ZHENGSITE12'],13=>$this->arrPlayId['ZHENGSITE13'],14=>$this->arrPlayId['ZHENGSITE14'],15=>$this->arrPlayId['ZHENGSITE15'],16=>$this->arrPlayId['ZHENGSITE16'],17=>$this->arrPlayId['ZHENGSITE17'],18=>$this->arrPlayId['ZHENGSITE18'],19=>$this->arrPlayId['ZHENGSITE19'],20=>$this->arrPlayId['ZHENGSITE20'],21=>$this->arrPlayId['ZHENGSITE21'],22=>$this->arrPlayId['ZHENGSITE22'],23=>$this->arrPlayId['ZHENGSITE23'],24=>$this->arrPlayId['ZHENGSITE24'],25=>$this->arrPlayId['ZHENGSITE25'],26=>$this->arrPlayId['ZHENGSITE26'],27=>$this->arrPlayId['ZHENGSITE27'],28=>$this->arrPlayId['ZHENGSITE28'],29=>$this->arrPlayId['ZHENGSITE29'],30=>$this->arrPlayId['ZHENGSITE30'],31=>$this->arrPlayId['ZHENGSITE31'],32=>$this->arrPlayId['ZHENGSITE32'],33=>$this->arrPlayId['ZHENGSITE33'],34=>$this->arrPlayId['ZHENGSITE34'],35=>$this->arrPlayId['ZHENGSITE35'],36=>$this->arrPlayId['ZHENGSITE36'],37=>$this->arrPlayId['ZHENGSITE37'],38=>$this->arrPlayId['ZHENGSITE38'],39=>$this->arrPlayId['ZHENGSITE39'],40=>$this->arrPlayId['ZHENGSITE40'],41=>$this->arrPlayId['ZHENGSITE41'],42=>$this->arrPlayId['ZHENGSITE42'],43=>$this->arrPlayId['ZHENGSITE43'],44=>$this->arrPlayId['ZHENGSITE44'],45=>$this->arrPlayId['ZHENGSITE45'],46=>$this->arrPlayId['ZHENGSITE46'],47=>$this->arrPlayId['ZHENGSITE47'],48=>$this->arrPlayId['ZHENGSITE48'],49=>$this->arrPlayId['ZHENGSITE49']];
        $zm5_nums = [1=>$this->arrPlayId['ZHENGWUTE01'],2=>$this->arrPlayId['ZHENGWUTE02'],3=>$this->arrPlayId['ZHENGWUTE03'],4=>$this->arrPlayId['ZHENGWUTE04'],5=>$this->arrPlayId['ZHENGWUTE05'],6=>$this->arrPlayId['ZHENGWUTE06'],7=>$this->arrPlayId['ZHENGWUTE07'],8=>$this->arrPlayId['ZHENGWUTE08'],9=>$this->arrPlayId['ZHENGWUTE09'],10=>$this->arrPlayId['ZHENGWUTE10'],11=>$this->arrPlayId['ZHENGWUTE11'],12=>$this->arrPlayId['ZHENGWUTE12'],13=>$this->arrPlayId['ZHENGWUTE13'],14=>$this->arrPlayId['ZHENGWUTE14'],15=>$this->arrPlayId['ZHENGWUTE15'],16=>$this->arrPlayId['ZHENGWUTE16'],17=>$this->arrPlayId['ZHENGWUTE17'],18=>$this->arrPlayId['ZHENGWUTE18'],19=>$this->arrPlayId['ZHENGWUTE19'],20=>$this->arrPlayId['ZHENGWUTE20'],21=>$this->arrPlayId['ZHENGWUTE21'],22=>$this->arrPlayId['ZHENGWUTE22'],23=>$this->arrPlayId['ZHENGWUTE23'],24=>$this->arrPlayId['ZHENGWUTE24'],25=>$this->arrPlayId['ZHENGWUTE25'],26=>$this->arrPlayId['ZHENGWUTE26'],27=>$this->arrPlayId['ZHENGWUTE27'],28=>$this->arrPlayId['ZHENGWUTE28'],29=>$this->arrPlayId['ZHENGWUTE29'],30=>$this->arrPlayId['ZHENGWUTE30'],31=>$this->arrPlayId['ZHENGWUTE31'],32=>$this->arrPlayId['ZHENGWUTE32'],33=>$this->arrPlayId['ZHENGWUTE33'],34=>$this->arrPlayId['ZHENGWUTE34'],35=>$this->arrPlayId['ZHENGWUTE35'],36=>$this->arrPlayId['ZHENGWUTE36'],37=>$this->arrPlayId['ZHENGWUTE37'],38=>$this->arrPlayId['ZHENGWUTE38'],39=>$this->arrPlayId['ZHENGWUTE39'],40=>$this->arrPlayId['ZHENGWUTE40'],41=>$this->arrPlayId['ZHENGWUTE41'],42=>$this->arrPlayId['ZHENGWUTE42'],43=>$this->arrPlayId['ZHENGWUTE43'],44=>$this->arrPlayId['ZHENGWUTE44'],45=>$this->arrPlayId['ZHENGWUTE45'],46=>$this->arrPlayId['ZHENGWUTE46'],47=>$this->arrPlayId['ZHENGWUTE47'],48=>$this->arrPlayId['ZHENGWUTE48'],49=>$this->arrPlayId['ZHENGWUTE49']];
        $zm6_nums = [1=>$this->arrPlayId['ZHENGLIUTE01'],2=>$this->arrPlayId['ZHENGLIUTE02'],3=>$this->arrPlayId['ZHENGLIUTE03'],4=>$this->arrPlayId['ZHENGLIUTE04'],5=>$this->arrPlayId['ZHENGLIUTE05'],6=>$this->arrPlayId['ZHENGLIUTE06'],7=>$this->arrPlayId['ZHENGLIUTE07'],8=>$this->arrPlayId['ZHENGLIUTE08'],9=>$this->arrPlayId['ZHENGLIUTE09'],10=>$this->arrPlayId['ZHENGLIUTE10'],11=>$this->arrPlayId['ZHENGLIUTE11'],12=>$this->arrPlayId['ZHENGLIUTE12'],13=>$this->arrPlayId['ZHENGLIUTE13'],14=>$this->arrPlayId['ZHENGLIUTE14'],15=>$this->arrPlayId['ZHENGLIUTE15'],16=>$this->arrPlayId['ZHENGLIUTE16'],17=>$this->arrPlayId['ZHENGLIUTE17'],18=>$this->arrPlayId['ZHENGLIUTE18'],19=>$this->arrPlayId['ZHENGLIUTE19'],20=>$this->arrPlayId['ZHENGLIUTE20'],21=>$this->arrPlayId['ZHENGLIUTE21'],22=>$this->arrPlayId['ZHENGLIUTE22'],23=>$this->arrPlayId['ZHENGLIUTE23'],24=>$this->arrPlayId['ZHENGLIUTE24'],25=>$this->arrPlayId['ZHENGLIUTE25'],26=>$this->arrPlayId['ZHENGLIUTE26'],27=>$this->arrPlayId['ZHENGLIUTE27'],28=>$this->arrPlayId['ZHENGLIUTE28'],29=>$this->arrPlayId['ZHENGLIUTE29'],30=>$this->arrPlayId['ZHENGLIUTE30'],31=>$this->arrPlayId['ZHENGLIUTE31'],32=>$this->arrPlayId['ZHENGLIUTE32'],33=>$this->arrPlayId['ZHENGLIUTE33'],34=>$this->arrPlayId['ZHENGLIUTE34'],35=>$this->arrPlayId['ZHENGLIUTE35'],36=>$this->arrPlayId['ZHENGLIUTE36'],37=>$this->arrPlayId['ZHENGLIUTE37'],38=>$this->arrPlayId['ZHENGLIUTE38'],39=>$this->arrPlayId['ZHENGLIUTE39'],40=>$this->arrPlayId['ZHENGLIUTE40'],41=>$this->arrPlayId['ZHENGLIUTE41'],42=>$this->arrPlayId['ZHENGLIUTE42'],43=>$this->arrPlayId['ZHENGLIUTE43'],44=>$this->arrPlayId['ZHENGLIUTE44'],45=>$this->arrPlayId['ZHENGLIUTE45'],46=>$this->arrPlayId['ZHENGLIUTE46'],47=>$this->arrPlayId['ZHENGLIUTE47'],48=>$this->arrPlayId['ZHENGLIUTE48'],49=>$this->arrPlayId['ZHENGLIUTE49']];
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
        if($zm1==49){ //和局退本金
            $playId = $this->arrPlayId['ZHENGYITESM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGYITEDANM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGYITEXM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGYITEDAM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGYITEHS'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGYITEHDAN'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGYITEHDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGYITEHX'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            //尾大
            $playId = $this->arrPlayId['ZHENGYITEWEIDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            //尾小
            $playId = $this->arrPlayId['ZHENGYITEWEIXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
        }else{
            if($zm1%2 == 0){ //双
                $playId = $this->arrPlayId['ZHENGYITESM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else { //单
                $playId = $this->arrPlayId['ZHENGYITEDANM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm1 <= 24){ //小
                $playId = $this->arrPlayId['ZHENGYITEXM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else { //大
                $playId = $this->arrPlayId['ZHENGYITEDAM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm1_heshu%2 == 0){//合双
                $playId = $this->arrPlayId['ZHENGYITEHS'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else { //合单
                $playId = $this->arrPlayId['ZHENGYITEHDAN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm1_heshu >= 7){ //合大
                $playId = $this->arrPlayId['ZHENGYITEHDA'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }else if($zm1_heshu <= 6){ //合小
                $playId = $this->arrPlayId['ZHENGYITEHX'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm1_wei == 5 || $zm1_wei == 6 || $zm1_wei == 7 || $zm1_wei == 8 || $zm1_wei == 9){ //尾大
                $playId = $this->arrPlayId['ZHENGYITEWEIDA'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }else if($zm1_wei == 0 || $zm1_wei == 1 || $zm1_wei == 2 || $zm1_wei == 3 || $zm1_wei == 4){ //尾小
                $playId = $this->arrPlayId['ZHENGYITEWEIXIAO'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        if($this->SB_Color($zm1) == 'R'){
            $playId = $this->arrPlayId['ZHENGYITEHONGBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'B'){
            $playId = $this->arrPlayId['ZHENGYITELANBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm1) == 'G'){
            $playId = $this->arrPlayId['ZHENGYITELUBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正1====两面====结束
        //正2====两面====开始
        if($zm2==49){ //和局退本金
            $playId = $this->arrPlayId['ZHENGERTESM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGERTEDANM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGERTEXM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGERTEDAM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGERTEHS'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGERTEHDAN'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGERTEHDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGERTEHX'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            //尾大
            $playId = $this->arrPlayId['ZHENGERTEWEIDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            //尾小
            $playId = $this->arrPlayId['ZHENGERTEWEIXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
        }else{
            if($zm2%2 == 0){ //双
                $playId = $this->arrPlayId['ZHENGERTESM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGERTEDANM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm2 <= 24){ //小
                $playId = $this->arrPlayId['ZHENGERTEXM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGERTEDAM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm2_heshu%2 == 0){//合双
                $playId = $this->arrPlayId['ZHENGERTEHS'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGERTEHDAN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm2_heshu >= 7){ //合大
                $playId = $this->arrPlayId['ZHENGERTEHDA'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }else if($zm2_heshu <= 6){ //合小
                $playId = $this->arrPlayId['ZHENGERTEHX'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm2_wei == 5 || $zm2_wei == 6 || $zm2_wei == 7 || $zm2_wei == 8 || $zm2_wei == 9){ //尾大
                $playId = $this->arrPlayId['ZHENGERTEWEIDA'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }else if($zm2_wei == 0 || $zm2_wei == 1 || $zm2_wei == 2 || $zm2_wei == 3 || $zm2_wei == 4){ //尾小
                $playId = $this->arrPlayId['ZHENGERTEWEIXIAO'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        if($this->SB_Color($zm2) == 'R'){
            $playId = $this->arrPlayId['ZHENGERTEHONGBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'B'){
            $playId = $this->arrPlayId['ZHENGERTELANBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm2) == 'G'){
            $playId = $this->arrPlayId['ZHENGERTELUBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正2====两面====结束
        //正3====两面====开始
        if($zm3==49){ //和局退本金
            $playId = $this->arrPlayId['ZHENGSANTESM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSANTEDANM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSANTEXM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSANTEDAM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSANTEHS'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSANTEHDAN'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSANTEHDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSANTEHX'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            //尾大
            $playId = $this->arrPlayId['ZHENGSANTEWEIDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            //尾小
            $playId = $this->arrPlayId['ZHENGSANTEWEIXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
        }else{
            if($zm3%2 == 0){ //双
                $playId = $this->arrPlayId['ZHENGSANTESM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGSANTEDANM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm3 <= 24){ //小
                $playId = $this->arrPlayId['ZHENGSANTEXM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGSANTEDAM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm3_heshu%2 == 0){//合双
                $playId = $this->arrPlayId['ZHENGSANTEHS'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGSANTEHDAN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm3_heshu >= 7){ //合大
                $playId = $this->arrPlayId['ZHENGSANTEHDA'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }else if($zm3_heshu <= 6){ //合小
                $playId = $this->arrPlayId['ZHENGSANTEHX'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm3_wei == 5 || $zm3_wei == 6 || $zm3_wei == 7 || $zm3_wei == 8 || $zm3_wei == 9){ //尾大
                $playId = $this->arrPlayId['ZHENGSANTEWEIDA'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }else if($zm3_wei == 0 || $zm3_wei == 1 || $zm3_wei == 2 || $zm3_wei == 3 || $zm3_wei == 4){ //尾小
                $playId = $this->arrPlayId['ZHENGSANTEWEIXIAO'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        if($this->SB_Color($zm3) == 'R'){
            $playId = $this->arrPlayId['ZHENGSANTEHONGBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'B'){
            $playId = $this->arrPlayId['ZHENGSANTELANBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm3) == 'G'){
            $playId = $this->arrPlayId['ZHENGSANTELUBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正3====两面====结束
        //正4====两面====开始
        if($zm4==49) { //和局退本金
            $playId = $this->arrPlayId['ZHENGSITESM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSITEDANM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSITEXM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSITEDAM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSITEHS'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSITEHDAN'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSITEHDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGSITEHX'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            //尾大
            $playId = $this->arrPlayId['ZHENGSITEWEIDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            //尾小
            $playId = $this->arrPlayId['ZHENGSITEWEIXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
        }else{
            if($zm4%2 == 0){ //双
                $playId = $this->arrPlayId['ZHENGSITESM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGSITEDANM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm4 <= 24){ //小
                $playId = $this->arrPlayId['ZHENGSITEXM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGSITEDAM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm4_heshu%2 == 0){//合双
                $playId = $this->arrPlayId['ZHENGSITEHS'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGSITEHDAN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm4_heshu >= 7){ //合大
                $playId = $this->arrPlayId['ZHENGSITEHDA'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }else if($zm4_heshu <= 6){ //合小
                $playId = $this->arrPlayId['ZHENGSITEHX'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm4_wei == 5 || $zm4_wei == 6 || $zm4_wei == 7 || $zm4_wei == 8 || $zm4_wei == 9){ //尾大
                $playId = $this->arrPlayId['ZHENGSITEWEIDA'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }else if($zm4_wei == 0 || $zm4_wei == 1 || $zm4_wei == 2 || $zm4_wei == 3 || $zm4_wei == 4){ //尾小
                $playId = $this->arrPlayId['ZHENGSITEWEIXIAO'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        if($this->SB_Color($zm4) == 'R'){
            $playId = $this->arrPlayId['ZHENGSITEHONGBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'B'){
            $playId = $this->arrPlayId['ZHENGSITELANBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm4) == 'G'){
            $playId = $this->arrPlayId['ZHENGSITELUBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正4====两面====结束
        //正5====两面====开始
        if($zm5==49) { //和局退本金
            $playId = $this->arrPlayId['ZHENGWUTESM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGWUTEDANM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGWUTEXM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGWUTEDAM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGWUTEHS'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGWUTEHDAN'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGWUTEHDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGWUTEHX'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            //尾大
            $playId = $this->arrPlayId['ZHENGWUTEWEIDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            //尾小
            $playId = $this->arrPlayId['ZHENGWUTEWEIXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
        }else{
            if($zm5%2 == 0){ //双
                $playId = $this->arrPlayId['ZHENGWUTESM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGWUTEDANM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm5 <= 24){ //小
                $playId = $this->arrPlayId['ZHENGWUTEXM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGWUTEDAM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm5_heshu%2 == 0){//合双
                $playId = $this->arrPlayId['ZHENGWUTEHS'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGWUTEHDAN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm5_heshu >= 7){ //合大
                $playId = $this->arrPlayId['ZHENGWUTEHDA'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }else if($zm5_heshu <= 6){ //合小
                $playId = $this->arrPlayId['ZHENGWUTEHX'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm5_wei == 5 || $zm5_wei == 6 || $zm5_wei == 7 || $zm5_wei == 8 || $zm5_wei == 9){ //尾大
                $playId = $this->arrPlayId['ZHENGWUTEWEIDA'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }else if($zm5_wei == 0 || $zm5_wei == 1 || $zm5_wei == 2 || $zm5_wei == 3 || $zm5_wei == 4){ //尾小
                $playId = $this->arrPlayId['ZHENGWUTEWEIXIAO'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        if($this->SB_Color($zm5) == 'R'){
            $playId = $this->arrPlayId['ZHENGWUTEHONGBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'B'){
            $playId = $this->arrPlayId['ZHENGWUTELANBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm5) == 'G'){
            $playId = $this->arrPlayId['ZHENGWUTELUBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正5====两面====结束
        //正6====两面====开始
        if($zm6==49) { //和局退本金
            $playId = $this->arrPlayId['ZHENGLIUTESM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGLIUTEDANM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGLIUTEXM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGLIUTEDAM'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGLIUTEHS'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGLIUTEHDAN'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGLIUTEHDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZHENGLIUTEHX'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            //尾大
            $playId = $this->arrPlayId['ZHENGLIUTEWEIDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            //尾小
            $playId = $this->arrPlayId['ZHENGLIUTEWEIXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
        }else{
            if($zm6%2 == 0){ //双
                $playId = $this->arrPlayId['ZHENGLIUTESM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGLIUTEDANM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm6 <= 24){ //小
                $playId = $this->arrPlayId['ZHENGLIUTEXM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGLIUTEDAM'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm6_heshu%2 == 0){//合双
                $playId = $this->arrPlayId['ZHENGLIUTEHS'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            } else {
                $playId = $this->arrPlayId['ZHENGLIUTEHDAN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm6_heshu >= 7){ //合大
                $playId = $this->arrPlayId['ZHENGLIUTEHDA'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }else if($zm6_heshu <= 6){ //合小
                $playId = $this->arrPlayId['ZHENGLIUTEHX'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($zm6_wei == 5 || $zm6_wei == 6 || $zm6_wei == 7 || $zm6_wei == 8 || $zm6_wei == 9){ //尾大
                $playId = $this->arrPlayId['ZHENGLIUTEWEIDA'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }else if($zm6_wei == 0 || $zm6_wei == 1 || $zm6_wei == 2 || $zm6_wei == 3 || $zm6_wei == 4){ //尾小
                $playId = $this->arrPlayId['ZHENGLIUTEWEIXIAO'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        if($this->SB_Color($zm6) == 'R'){
            $playId = $this->arrPlayId['ZHENGLIUTEHONGBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'B'){
            $playId = $this->arrPlayId['ZHENGLIUTELANBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->SB_Color($zm6) == 'G'){
            $playId = $this->arrPlayId['ZHENGLIUTELUBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //正6====两面====结束
    }
    //五行
    public function LHC_WX($openCode,$gameId,$win){//WUHANG
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $wx_playCate = $this->arrPlayCate['WUHANG']; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        if($tm == 5 || $tm == 6 || $tm == 19 || $tm == 20 || $tm == 27 || $tm == 28 || $tm == 35 || $tm == 36 || $tm == 49){ //金
            $playId = $this->arrPlayId['WXJIN'];
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 1 || $tm == 2 || $tm == 9 || $tm == 10 || $tm == 17 || $tm == 18 || $tm == 31 || $tm == 32 || $tm == 39 || $tm == 40 || $tm == 47 || $tm == 48){ //木
            $playId = $this->arrPlayId['WXMU'];
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 7 || $tm == 8 || $tm == 15 || $tm == 16 || $tm == 23 || $tm == 24 || $tm == 37 || $tm == 38 || $tm == 45 || $tm == 46){ //水
            $playId = $this->arrPlayId['WXSHUI'];
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 3 || $tm == 4 || $tm == 11 || $tm == 12 || $tm == 25 || $tm == 26 || $tm == 33 || $tm == 34 || $tm == 41 || $tm == 42){ //火
            $playId = $this->arrPlayId['WXHUO'];
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
        if($tm == 13 || $tm == 14 || $tm == 21 || $tm == 22 || $tm == 29 || $tm == 30 || $tm == 43 || $tm == 44){ //土
            $playId = $this->arrPlayId['WXTU'];
            $winCode = $gameId.$wx_playCate.$playId;
            $win->push($winCode);
        }
    }
    //平特一肖尾数
    public function LHC_PTYXWS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $ptyxws_playCate = $this->arrPlayCate['PINGTEYIXIAOWEISHU']; //特码分类ID
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
            $playId = $this->arrPlayId['PTYXSHU'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$niu) || in_array($m2,$niu) || in_array($m3,$niu) || in_array($m4,$niu) || in_array($m5,$niu) || in_array($m6,$niu) || in_array($m7,$niu)){
            $playId = $this->arrPlayId['PTYXNIU'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$hu) || in_array($m2,$hu) || in_array($m3,$hu) || in_array($m4,$hu) || in_array($m5,$hu) || in_array($m6,$hu) || in_array($m7,$hu)){
            $playId = $this->arrPlayId['PTYXHU'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$tu) || in_array($m2,$tu) || in_array($m3,$tu) || in_array($m4,$tu) || in_array($m5,$tu) || in_array($m6,$tu) || in_array($m7,$tu)){
            $playId = $this->arrPlayId['PTYXTU'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$long) || in_array($m2,$long) || in_array($m3,$long) || in_array($m4,$long) || in_array($m5,$long) || in_array($m6,$long) || in_array($m7,$long)){
            $playId = $this->arrPlayId['PTYXLONG'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$she) || in_array($m2,$she) || in_array($m3,$she) || in_array($m4,$she) || in_array($m5,$she) || in_array($m6,$she) || in_array($m7,$she)){
            $playId = $this->arrPlayId['PTYXSHE'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$ma) || in_array($m2,$ma) || in_array($m3,$ma) || in_array($m4,$ma) || in_array($m5,$ma) || in_array($m6,$ma) || in_array($m7,$ma)){
            $playId = $this->arrPlayId['PTYXMA'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$yang) || in_array($m2,$yang) || in_array($m3,$yang) || in_array($m4,$yang) || in_array($m5,$yang) || in_array($m6,$yang) || in_array($m7,$yang)){
            $playId = $this->arrPlayId['PTYXYANG'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$hou) || in_array($m2,$hou) || in_array($m3,$hou) || in_array($m4,$hou) || in_array($m5,$hou) || in_array($m6,$hou) || in_array($m7,$hou)){
            $playId = $this->arrPlayId['PTYXHOU'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$ji) || in_array($m2,$ji) || in_array($m3,$ji) || in_array($m4,$ji) || in_array($m5,$ji) || in_array($m6,$ji) || in_array($m7,$ji)){
            $playId = $this->arrPlayId['PTYXJI'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$gou) || in_array($m2,$gou) || in_array($m3,$gou) || in_array($m4,$gou) || in_array($m5,$gou) || in_array($m6,$gou) || in_array($m7,$gou)){
            $playId = $this->arrPlayId['PTYXGOU'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$zhu) || in_array($m2,$zhu) || in_array($m3,$zhu) || in_array($m4,$zhu) || in_array($m5,$zhu) || in_array($m6,$zhu) || in_array($m7,$zhu)){
            $playId = $this->arrPlayId['PTYXZHU'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        //尾数
        if(in_array($m1,$w0) || in_array($m2,$w0) || in_array($m3,$w0) || in_array($m4,$w0) || in_array($m5,$w0) || in_array($m6,$w0) || in_array($m7,$w0)){
            $playId = $this->arrPlayId['PTYXW0'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w1) || in_array($m2,$w1) || in_array($m3,$w1) || in_array($m4,$w1) || in_array($m5,$w1) || in_array($m6,$w1) || in_array($m7,$w1)){
            $playId = $this->arrPlayId['PTYXW1'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w2) || in_array($m2,$w2) || in_array($m3,$w2) || in_array($m4,$w2) || in_array($m5,$w2) || in_array($m6,$w2) || in_array($m7,$w2)){
            $playId = $this->arrPlayId['PTYXW2'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w3) || in_array($m2,$w3) || in_array($m3,$w3) || in_array($m4,$w3) || in_array($m5,$w3) || in_array($m6,$w3) || in_array($m7,$w3)){
            $playId = $this->arrPlayId['PTYXW3'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w4) || in_array($m2,$w4) || in_array($m3,$w4) || in_array($m4,$w4) || in_array($m5,$w4) || in_array($m6,$w4) || in_array($m7,$w4)){
            $playId = $this->arrPlayId['PTYXW4'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w5) || in_array($m2,$w5) || in_array($m3,$w5) || in_array($m4,$w5) || in_array($m5,$w5) || in_array($m6,$w5) || in_array($m7,$w5)){
            $playId = $this->arrPlayId['PTYXW5'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w6) || in_array($m2,$w6) || in_array($m3,$w6) || in_array($m4,$w6) || in_array($m5,$w6) || in_array($m6,$w6) || in_array($m7,$w6)){
            $playId = $this->arrPlayId['PTYXW6'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w7) || in_array($m2,$w7) || in_array($m3,$w7) || in_array($m4,$w7) || in_array($m5,$w7) || in_array($m6,$w7) || in_array($m7,$w7)){
            $playId = $this->arrPlayId['PTYXW7'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w8) || in_array($m2,$w8) || in_array($m3,$w8) || in_array($m4,$w8) || in_array($m5,$w8) || in_array($m6,$w8) || in_array($m7,$w8)){
            $playId = $this->arrPlayId['PTYXW8'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
        if(in_array($m1,$w9) || in_array($m2,$w9) || in_array($m3,$w9) || in_array($m4,$w9) || in_array($m5,$w9) || in_array($m6,$w9) || in_array($m7,$w9)){
            $playId = $this->arrPlayId['PTYXW9'];
            $winCode = $gameId.$ptyxws_playCate.$playId;
            $win->push($winCode);
        }
    }
    //七色波
    public function LHC_QSB($openCode,$gameId,$win,$ids_he){
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $qsb_playCate = $this->arrPlayCate['QISEBO']; //特码分类ID
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
            $playId = $this->arrPlayId['QISBHJ'];
            $winCode = $gameId.$qsb_playCate.$playId;
            $win->push($winCode);
            //和局退本金
            $playId = $this->arrPlayId['QISBHONG'];
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['QISBLANBO'];
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['QISBLUBO'];
            $winCode = $gameId.$qsb_playCate.$playId;
            $ids_he->push($winCode);
        } else {
            if ($redTotal>$blueTotal&$redTotal>$greenTotal){ //红
                $playId = $this->arrPlayId['QISBHONG'];
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            }else if ($blueTotal>$greenTotal) { //蓝
                $playId = $this->arrPlayId['QISBLANBO'];
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            } else { //绿
                $playId = $this->arrPlayId['QISBLUBO'];
                $winCode = $gameId.$qsb_playCate.$playId;
                $win->push($winCode);
            }
        }
    }
    //总肖
    public function LHC_ZONGXIAO($gameId,$win){
        $playCate = $this->arrPlayCate['ZONGXIAO'];
        $openSX = [$this->sx1,$this->sx2,$this->sx3,$this->sx4,$this->sx5,$this->sx6,$this->sx7];
        $countOpen = array_count_values($openSX);
        $count = count($countOpen);
        if($count == 2){
            $playId = $this->arrPlayId['ZONGXIAO2X2'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 3){
            $playId = $this->arrPlayId['ZONGXIAO3X3'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 4){
            $playId = $this->arrPlayId['ZONGXIAO4X4'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 5){
            $playId = $this->arrPlayId['ZONGXIAO5X5'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 6){
            $playId = $this->arrPlayId['ZONGXIAO6X6'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count == 7){
            $playId = $this->arrPlayId['ZONGXIAO7X7'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($count%2 == 0){
            $playId = $this->arrPlayId['ZONGXIAOS'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = $this->arrPlayId['ZONGXIAODAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //自选不中-ZIXUANBUZHONG
    public function LHC_ZXBZH($openCode,$gameId,$table,$issue){
        $zxbz_playCate = $this->arrPlayCate['ZIXUANBUZHONG']; //特码分类ID
        $zxbz_ids = [];
        $get = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$zxbz_playCate)->where('bunko','=',0.00)->get();
        foreach ($get as $item) {
            $open = explode(',', $openCode);
            $user = explode(',', $item->bet_info);
            $bi = array_intersect($open, $user);
            if (empty($bi)) {
                $zxbz_ids[] = $item->bet_id;
            }
        }
        $ids_zxbz = implode(',', $zxbz_ids);
        if($ids_zxbz){
            $sql_zxb = "UPDATE ".$table." SET bunko = bet_money * play_odds, status = 3 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `bet_id` IN ($ids_zxbz)"; //中奖的SQL语句
        } else {
            $sql_zxb = "";
        }
        return $sql_zxb;
    }
    //合宵
    public function LHC_HX($gameId,$table,$issue){
        $tema_SX = $this->sx7; //特码生肖
        $hexiao_playCate = $this->arrPlayCate['HEXIAO']; //分类ID
        $hexiao_ids = [];
        $getHexiao = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$hexiao_playCate)->where('bunko','=',0.00)->get();
        foreach ($getHexiao as $item) {
            $hexiao_user = explode(',', $item->bet_info);
            $hexiao_bi = in_array($tema_SX, $hexiao_user);
            if ($hexiao_bi) {
                $hexiao_ids[] = $item->bet_id;
            }
        }
        $ids_hexiao = implode(',', $hexiao_ids);
        if($ids_hexiao){
            $sql_hexiao = "UPDATE ".$table." SET bunko = bet_money * play_odds, status = 3 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `bet_id` IN ($ids_hexiao)"; //中奖的SQL语句
        } else {
            $sql_hexiao = 0;
        }
        return $sql_hexiao;
    }
    //正宵
    public function LHC_ZX($gameId,$table,$issue){
        $zx_playCate = $this->arrPlayCate['ZHENGXIAO']; //分类ID
        $zx_id = [];
        $zx_plays = ['鼠'=>$this->arrPlayId['ZXIAOSHU'],'牛'=>$this->arrPlayId['ZXIAONIU'],'虎'=>$this->arrPlayId['ZXIAOHU'],'兔'=>$this->arrPlayId['ZXIAOTU'],'龙'=>$this->arrPlayId['ZXIAOLONG'],'蛇'=>$this->arrPlayId['ZXIAOSHE'],'马'=>$this->arrPlayId['ZXIAOMA'],'羊'=>$this->arrPlayId['ZXIAOYANG'],'猴'=>$this->arrPlayId['ZXIAOHOU'],'鸡'=>$this->arrPlayId['ZXIAOJI'],'狗'=>$this->arrPlayId['ZXIAOGOU'],'猪'=>$this->arrPlayId['ZXIAOZHU']];
        $openSX = [$this->sx1,$this->sx2,$this->sx3,$this->sx4,$this->sx5,$this->sx6];
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
            $zx_sql .= "END, status = 3 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `game_id` = $gameId AND `issue` = $issue AND play_id IN ($zx_ids)";
        } else {
            $zx_sql = "";
        }
        return $zx_sql;
    }
    //连肖连尾
    public function LHC_LXLW($gameId,$table,$issue){
        $lxlw_playCate = $this->arrPlayCate['LIANXIAOLIANWEI']; //分类ID
        $uniqueSX = array_unique([$this->sx1,$this->sx2,$this->sx3,$this->sx4,$this->sx5,$this->sx6,$this->sx7]);
        //二连肖
        $lx_ids = [];
        $get2LX = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lxlw_playCate)->where('issue',$issue)->where('play_name','like','%二连肖%')->where('bunko','=',0.00)->get();
        foreach ($get2LX as $item) {
            $userBetInfoSX = explode(',',$item->bet_info);
            $bi = array_intersect($uniqueSX, $userBetInfoSX);
            if(count($bi) == 2){
                $lx_ids[] = $item->bet_id;
            }
        }
        //三连肖
        $get3LX = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lxlw_playCate)->where('issue',$issue)->where('play_name','like','%三连肖%')->where('bunko','=',0.00)->get();
        foreach ($get3LX as $item) {
            $userBetInfoSX_3 = explode(',',$item->bet_info);
            $bi = array_intersect($uniqueSX, $userBetInfoSX_3);
            if(count($bi) == 3){
                $lx_ids[] = $item->bet_id;
            }
        }
        //四连肖
        $get4LX = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lxlw_playCate)->where('issue',$issue)->where('play_name','like','%四连肖%')->where('bunko','=',0.00)->get();
        foreach ($get4LX as $item) {
            $userBetInfoSX_4 = explode(',',$item->bet_info);
            $bi = array_intersect($uniqueSX, $userBetInfoSX_4);
            if(count($bi) == 4){
                $lx_ids[] = $item->bet_id;
            }
        }
        //五连肖
        $get5LX = DB::table($table)->select('bet_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lxlw_playCate)->where('issue',$issue)->where('play_name','like','%五连肖%')->where('bunko','=',0.00)->get();
        foreach ($get5LX as $item) {
            $userBetInfoSX_5 = explode(',',$item->bet_info);
            $bi = array_intersect($uniqueSX, $userBetInfoSX_5);
            if(count($bi) == 5){
                $lx_ids[] = $item->bet_id;
            }
        }
        $ids_lx = implode(',', $lx_ids);
        if($ids_lx){
            $sql_lx = "UPDATE ".$table." SET bunko = bet_money * play_odds, status = 3 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `bet_id` IN ($ids_lx)"; //中奖的SQL语句
        } else {
            $sql_lx = "";
        }
        //连尾
        $uniqueWei = array_unique([$this->wei1,$this->wei2,$this->wei3,$this->wei4,$this->wei5,$this->wei6,$this->wei7]);
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
            $sql_lw = "UPDATE ".$table." SET bunko = bet_money * play_odds, status = 3 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `bet_id` IN ($ids_lw)"; //中奖的SQL语句
        } else {
            $sql_lw = "";
        }
        return array('lx'=>$sql_lx,'lw'=>$sql_lw);
    }
    //连码
    public function LHC_LIANMA($openCode,$gameId,$table,$issue){
        $lm_playCate = $this->arrPlayCate['LIANMA']; //分类ID
        $arrLm = [];
        $sql_lm = "";
        $get = DB::table($table)->select('bet_id','bet_money','play_id','play_odds','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lm_playCate)->where('bunko','=',0.00)->get();
        $open = explode(',', $openCode);
        $openZM = [$open[0],$open[1],$open[2],$open[3],$open[4],$open[5]];
        $lm_play_2 = 'SANZHONGERZHONGER';         //三中二中二
        $lm_play_3 = 'SANZHONGERZHONGSAN';        //三中二中三
        $lm_play_ERQZ = 'ERQUANZHONG';               //二全中
        $lm_play_ERTEQZ = 'ERZHONGTEZHONGTE';        //二中特中特
        $lm_play_ERERQZ = 'ERZHONGTEZHONGER';        //二中特中二
        $lm_play_TEC = 'TECHUAN';                    //特串
        $lm_play_SANQZ = 'SANQUANZHONG';             //三全中
        $lm_play_SIQZ = 'SIQUANZHONG';               //四全中
        $ids_lm = array();
        if($get){
            $getPlayOdds = DB::table('play')->select('ucode','odds','name')->whereIn('id',[$this->arrPlayId[$lm_play_2],$this->arrPlayId[$lm_play_3],$this->arrPlayId[$lm_play_ERTEQZ],$this->arrPlayId[$lm_play_ERERQZ]])->get()->keyBy('ucode');
            $arrLm['bunko'] = " bunko = CASE ";
            $arrLm['odds'] = " play_odds = CASE ";
            $arrLm['play_id'] = " play_id = CASE ";
            $arrLm['play_name'] = " play_name = CASE ";
            $arrLm_bets['bunko'] = "";
            $arrLm_bets['odds'] = "";
            $arrLm_bets['play_id'] = "";
            $arrLm_bets['play_name'] = "";
            foreach ($get as $item) {
                $user = explode(',', $item->bet_info);
                $bi = array_intersect($openZM, $user);
                $te = in_array($open[6],$user)?'1':'0';
                switch ($item->play_id.'-c'.count($bi).'-t'.$te){
                        //特串
                    case $gameId.$lm_playCate.$this->arrPlayId[$lm_play_TEC].'-c1-t1':
                        //二全中
                    case $gameId.$lm_playCate.$this->arrPlayId[$lm_play_ERQZ].'-c2-t0':
                        //三全中
                    case $gameId.$lm_playCate.$this->arrPlayId[$lm_play_SANQZ].'-c3-t0':
                        //四全中
                    case $gameId.$lm_playCate.$this->arrPlayId[$lm_play_SIQZ].'-c4-t0':
                        $ids_lm[] = $item->bet_id;
                        $odds = $item->play_odds;
                        $bunko = $item->bet_money * $odds;
                        $arrLm_bets['bunko'] .= " WHEN `bet_id` = $item->bet_id THEN ".$bunko;
                        break;
                    //三中二中二
                    case $gameId.$lm_playCate.$this->arrPlayId[$lm_play_2].'-c2-t0':
                    case $gameId.$lm_playCate.$this->arrPlayId[$lm_play_3].'-c2-t0':
                        $ids_lm[] = $item->bet_id;
                        $arrLm_bets = $this->chgPlayOdds($this->arrPlayId[$lm_play_2],$item,$getPlayOdds[$lm_play_2],$arrLm_bets,$gameId,$lm_playCate);
                        break;
                    //三中二中三
                    case $gameId.$lm_playCate.$this->arrPlayId[$lm_play_2].'-c3-t0':
                    case $gameId.$lm_playCate.$this->arrPlayId[$lm_play_3].'-c3-t0':
                        $ids_lm[] = $item->bet_id;
                        $arrLm_bets = $this->chgPlayOdds($this->arrPlayId[$lm_play_3],$item,$getPlayOdds[$lm_play_3],$arrLm_bets,$gameId,$lm_playCate);
                        break;
                    //二中特中特
                    case $gameId.$lm_playCate.$this->arrPlayId[$lm_play_ERTEQZ].'-c1-t1':
                    case $gameId.$lm_playCate.$this->arrPlayId[$lm_play_ERERQZ].'-c1-t1':
                        $ids_lm[] = $item->bet_id;
                        $arrLm_bets = $this->chgPlayOdds($this->arrPlayId[$lm_play_ERTEQZ],$item,$getPlayOdds[$lm_play_ERTEQZ],$arrLm_bets,$gameId,$lm_playCate);
                    //二中特中二
                    case $gameId.$lm_playCate.$this->arrPlayId[$lm_play_ERTEQZ].'-c2-t0':
                    case $gameId.$lm_playCate.$this->arrPlayId[$lm_play_ERERQZ].'-c2-t0':
                        $ids_lm[] = $item->bet_id;
                        $arrLm_bets = $this->chgPlayOdds($this->arrPlayId[$lm_play_ERERQZ],$item,$getPlayOdds[$lm_play_ERERQZ],$arrLm_bets,$gameId,$lm_playCate);
                        break;
                }
            }
            if(count($ids_lm)>0){
                $ids_lm = implode(',',$ids_lm);
                $sql_lm = "UPDATE ".$table." SET ";
                if(!empty($arrLm_bets['bunko']))
                    $sql_lm .= $arrLm['bunko'].$arrLm_bets['bunko']." END, ";
                if(!empty($arrLm_bets['odds']))
                    $sql_lm .= $arrLm['odds'].$arrLm_bets['odds']." END, ";
                if(!empty($arrLm_bets['play_id']))
                    $sql_lm .= $arrLm['play_id'].$arrLm_bets['play_id']." END, ";
                if(!empty($arrLm_bets['play_name']))
                    $sql_lm .= $arrLm['play_name'].$arrLm_bets['play_name']." END, ";
                $sql_lm .= "status = 3 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `bet_id` IN ($ids_lm)"; //中奖的SQL语句
                \Log::info($sql_lm);
            }
        }
        return $sql_lm;
    }
    //特殊玩法需要根据已中奖的修改显示中奖的信息
    private function chgPlayOdds($lm_play,$item,$getPlayOdds,$arrLm_bets,$gameId,$lm_playCate){
        $ids_lm[] = $item->bet_id;
        $odds = $getPlayOdds->odds;
        $lm_play_name = $getPlayOdds->name;
        $bunko = $item->bet_money * $odds;
        $arrLm_bets['bunko'] .= " WHEN `bet_id` = $item->bet_id THEN ".$bunko;
        $arrLm_bets['odds'] .= " WHEN `bet_id` = $item->bet_id THEN ".$odds;               //特殊玩法需要根据已中奖的修改显示中奖的赔率
        $arrLm_bets['play_id'] .= " WHEN `bet_id` = $item->bet_id THEN ".$gameId.$lm_playCate.$lm_play;    //特殊玩法需要根据已中奖的修改显示中奖的玩法id
        $arrLm_bets['play_name'] .= " WHEN `bet_id` = $item->bet_id THEN ' - ".$lm_play_name."' ";         //特殊玩法需要根据已中奖的修改显示中奖的玩法名称
        return $arrLm_bets;
    }

    private function SB_Color($num){
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
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/28
 * Time: 15:40
 */

namespace App\Repository\GamesApi\Card\Content;


class KY extends Base
{
    function f620 ($array, $data, $k, $CardValue){      //德州扑克 
        return false;
    }
    function f720 ($array, $data, $k, $CardValue){      //二八杠 
        return false;
    }
    function f830 ($array, $data, $k, $CardValue){      //抢庄牛牛 
        return false;
    }
    function f220 ($array, $data, $k, $CardValue){      //炸金花 
        return false;
    }
    function f860 ($array, $data, $k, $CardValue){      //三公 
        return false;
    }
    function f900 ($array, $data, $k, $CardValue){      //押庄龙虎 
        return false;
    }
    function f600 ($array, $data, $k, $CardValue){      //21 点 
        return false;
    }
    function f870 ($array, $data, $k, $CardValue){      //通比牛牛 
        return false;
    }
    function f880 ($array, $data, $k, $CardValue){      //欢乐红包 
        return false;
    }
    function f230 ($array, $data, $k, $CardValue){      //极速炸金花 
        return false;
    }
    function f730 ($array, $data, $k, $CardValue){      //抢庄牌九 
        return false;
    }
    function f630 ($array, $data, $k, $CardValue){      //十三水 
        return false;
    }
    function f380 ($array, $data, $k, $CardValue){      //幸运五张 
        return false;
    }
    function f610 ($array, $data, $k, $CardValue){      //斗地主 
        return false;
    }
    function f390 ($array, $data, $k, $CardValue){      //射龙门 
        return false;
    }
    function f910 ($array, $data, $k, $CardValue){      //百家乐 
//        $str = '局号：'.$array['round_id'].'<br />';
//        $str .= '下注前余额：'.$data['CellScore'][$k];
//        return $str;
        return false;
    }
    function f920 ($array, $data, $k, $CardValue){      //森林舞会 
        return false;
    }
    function f930 ($array, $data, $k, $CardValue){      //百人牛牛 
        return false;
    }
    function f1950($array, $data, $k, $CardValue){      // 万人炸金花 
        return false;
    }

    function comm ($array, $data, $k, $CardValue)
    {
        $str = '局号：'.$array['round_id'].'<br />';
        $str .= '下注前余额：'.$data['CellScore'][$k];
        return $str;
    }
}
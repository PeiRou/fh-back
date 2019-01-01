<?php
/**
 * Created by PhpStorm.
 * User: ashen
 * Date: 18-11-8
 * Time: 下午5:13
 */

namespace App\Http\Controllers\Common;


use App\Games;

class AgentLevelOdds
{
    //获取代理赔率
    public function getAgentOdds($odds,$agentOdds){
////        $odds = (string)round((1 - ($platformOdds - $aArrayOdds[$i])/$platformOdds)*$originalOdds,$length);
//        $odds = (string)$this->interceptingDecimals((1 - ($platformOdds - $aArrayOdds[$i])/$platformOdds)*$originalOdds,$length);
////        (1 - (基础赔率 - 层级赔率) / 基础赔率) * 当前赔率
//        $i++;
//        if(!empty($aArrayOdds[$i])) {
//            $odds = $this->getAgentOdds($aArrayOdds[$i-1], $aArrayOdds, $odds, $length, $i);
//        }
        return round($odds*(1-$agentOdds/100),3);
    }

    //获取当前层级赔率
    public function getCurrentAgentOdds($platformOdds,$aArrayOdds,$originalOdds,$length,$k,$i = 1){
        $odds = (string)$this->interceptingDecimals((1 - ($platformOdds - $aArrayOdds[$i])/$platformOdds)*$originalOdds,$length);
        $i++;
        if($i <= $k)
            $odds = $this->getCurrentAgentOdds($aArrayOdds[$i-1],$aArrayOdds,$odds,$length,$k,$i);
        return $odds;
    }

    //根据游戏获取分类赔率
    public function getOddsCategoryId($aUserOdds,$gameId){
        $categoryId = Games::where('game_id',$gameId)->value('odds_category_id');
        return $aUserOdds[$categoryId];
    }

    //获取游戏分类
    public function getGameCategoryId($gameId){
        return Games::where('game_id',$gameId)->value('odds_category_id');
    }

    //根据游戏获取分类赔率
    public function getOddsByCategoryId($aUserOdds,$categoryId){
        return $aUserOdds[$categoryId];
    }

    //获取小数后位数
    public function getDecimalNumber($preOdds){
        $aNum = explode('.',$preOdds);
        if(empty($aNum[1]))
            return 3;
        else
            if(strlen($aNum[1]) <= 3)
                return 3;
        return strlen($aNum[1]);
    }

    //截取小数
    public function interceptingDecimals($number,$length){
        $num = 1;
        for ($k = 1;$k <= $length;$k++){
            $num = $num * 10;
        }
        return floor($number * $num)/$num;
    }

    //获取需要返水的代理赔率
    public function getBackwaterAgentOdds($agentOdds,$categoryId){
        $aAgentOddsArray = [];
        foreach ($agentOdds as $key => $value){
            $aAgentOddsArray[$key] = $value[$categoryId];
        }
        $aAgentOddsArray = $this->getBackwaterAgentOddsDiff($aAgentOddsArray);
        return $aAgentOddsArray;
    }

    //获取需要返水的代理赔率差
    public function getBackwaterAgentOddsDiff($aAgentOddsArray){
        $arr = [];
        $i = 0;
        foreach ($aAgentOddsArray as $kArray => $iArray){
            if($i !== 0){
                $arr[$preAgentId] = bcdiv($iArray-$preOdds,100,4);
            }
            $i++;
            $preOdds = (float)$iArray;
            $preAgentId = $kArray;
        }
        return serialize($arr);
    }
}
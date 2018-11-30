<?php
/**
 * Created by PhpStorm.
 * User: ashen
 * Date: 18-11-8
 * Time: 下午5:13
 */

namespace App\Http\Controllers\Common;


class AgentLevelOdds
{
    //获取代理赔率
    public function getAgentOdds($platformOdds,$aArrayOdds,$originalOdds,$length,$i = 1){
//        $odds = (string)round((1 - ($platformOdds - $aArrayOdds[$i])/$platformOdds)*$originalOdds,$length);
        $odds = (string)$this->interceptingDecimals((1 - ($platformOdds - $aArrayOdds[$i])/$platformOdds)*$originalOdds,$length);
//        (1 - (基础赔率 - 层级赔率) / 基础赔率) * 当前赔率
        $i++;
        if(!empty($aArrayOdds[$i])) {
            $odds = $this->getAgentOdds($aArrayOdds[$i-1], $aArrayOdds, $odds, $length, $i);
        }
        return $odds;
    }

    //获取当前层级赔率
    public function getCurrentAgentOdds($platformOdds,$aArrayOdds,$originalOdds,$length,$k,$i = 1){
        $odds = (string)$this->interceptingDecimals((1 - ($platformOdds - $aArrayOdds[$i])/$platformOdds)*$originalOdds,$length);
        $i++;
        if($i <= $k)
            $odds = $this->getCurrentAgentOdds($aArrayOdds[$i-1],$aArrayOdds,$odds,$length,$k,$i);
        return $odds;
    }

    //获取小数后位数
    public function getDecimalNumber($preOdds){
        $aNum = explode('.',$preOdds);
        if(empty($aNum[1]))
            return 2;
        else
            if(strlen($aNum[1]) <= 2)
                return 2;
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
    public function getBackwaterAgentOdds($user,$getPlayName,$platformOdds,$aArrayOdds,$oddsLength){
        if(!empty($user->agent_odds)){
            $aAgentOddsArray = [];
            foreach (unserialize($user->agent_odds) as $key => $value){
                if($value == 0)
                    $aAgentOddsArray[$key] = $getPlayName->odds;
                else
                    $aAgentOddsArray[$key] = $this->getCurrentAgentOdds($platformOdds,$aArrayOdds,$getPlayName->odds,$oddsLength,$value);
            }
            return $aAgentOddsArray;
        }
        return 0;
    }

    //获取需要返水的代理赔率差
    public function getBackwaterAgentOddsDiff($aAgentOddsArray,$odds){
        $aArray = $aAgentOddsArray;
        $aArray[] = $odds;
        $arr = [];
        $i = 0;
        foreach ($aArray as $kArray => $iArray){
            if($i !== 0){
                $arr[$preAgentId] = bcsub($preOdds,$iArray,4);
            }
            $i++;
            $preOdds = $iArray;
            $preAgentId = $kArray;
        }
        return serialize($arr);
    }
}
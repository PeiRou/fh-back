<?php
/**
 * 牛牛玩法结算
 * User: Zoe
 * Date: 2019/4/24
 * Time: 下午22:18
 */

namespace App;

class ExcelLotteryNN
{
    public $arrPlayCate;
    public $arrPlayId;

    public function setArrPlay($openCode,$arrPlayCate=array(),$arrPlayId=array()){
        $this->arrPlayCate = $arrPlayCate;
        $this->arrPlayId = $arrPlayId;
    }

    public function NN($openCode,$nn,$gameId,$win,$lose)
    {
        $niuniuArr = explode(',',$nn); //分割牛牛结果
        $explodeNum = explode(',',$openCode); //分割秒速赛车开奖结果

        $banker_nn = $niuniuArr[0];
        $player1_nn = $niuniuArr[1];
        $player2_nn = $niuniuArr[2];
        $player3_nn = $niuniuArr[3];
        $player4_nn = $niuniuArr[4];
        $player5_nn = $niuniuArr[5];
        $gamePlay = $gameId.$this->arrPlayCate['NN'];
        if((int)$banker_nn > (int)$player1_nn){
            $playId = $this->arrPlayId['XIANYI'];//$playId = 3462;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            // \Log::info('闲一输');
        } else if((int)$banker_nn == (int)$player1_nn && (int)$banker_nn <= 6){
            $playId = $this->arrPlayId['XIANYI'];//$playId = 3462;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲一输');
        } else if((int)$banker_nn == (int)$player1_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[1]){
            $playId = $this->arrPlayId['XIANYI'];//$playId = 3462;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲一输');
        } else {
            $playId = $this->arrPlayId['XIANYI'];//$playId = 3462;
            $numCode = $gamePlay.$playId;
            $win->push([$numCode,(int)$player1_nn]);
            //\Log::info('闲一赢');
        }

        if((int)$banker_nn > (int)$player2_nn){
            $playId = $this->arrPlayId['XIANER'];//$playId = 3463;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲二输');
        } else if((int)$banker_nn == (int)$player2_nn && (int)$banker_nn <= 6){

            $playId = $this->arrPlayId['XIANER'];//$playId = 3463;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲二输');
        } else if((int)$banker_nn == (int)$player2_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[2]){

            $playId = $this->arrPlayId['XIANER'];//$playId = 3463;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲二输');
        } else {
            $playId = $this->arrPlayId['XIANER'];//$playId = 3463;
            $numCode = $gamePlay.$playId;
            $win->push([$numCode,(int)$player2_nn]);
            //\Log::info('闲二赢');
        }

        if((int)$banker_nn > (int)$player3_nn){
            $playId = $this->arrPlayId['XIANSAN'];//$playId = 3464;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲三输');
        } else if((int)$banker_nn == (int)$player3_nn && (int)$banker_nn <= 6){
            $playId = $this->arrPlayId['XIANSAN'];//$playId = 3464;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲三输');
        } else if((int)$banker_nn == (int)$player3_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[3]){
            $playId = $this->arrPlayId['XIANSAN'];//$playId = 3464;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲三输');
        } else {
            $playId = $this->arrPlayId['XIANSAN'];//$playId = 3464;
            $numCode = $gamePlay.$playId;
            $win->push([$numCode,(int)$player3_nn]);
            //\Log::info('闲三赢');
        }

        if((int)$banker_nn > (int)$player4_nn){
            $playId = $this->arrPlayId['XIANSI'];//$playId = 3465;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲四输');
        } else if((int)$banker_nn == (int)$player4_nn && (int)$banker_nn <= 6){
            $playId = $this->arrPlayId['XIANSI'];//$playId = 3465;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲四输');
        } else if((int)$banker_nn == (int)$player4_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[4]){
            $playId = $this->arrPlayId['XIANSI'];//$playId = 3465;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲四输');
        } else {
            $playId = $this->arrPlayId['XIANSI'];//$playId = 3465;
            $numCode = $gamePlay.$playId;
            $win->push([$numCode,(int)$player4_nn]);
            //\Log::info('闲四赢');
        }

        if((int)$banker_nn > (int)$player5_nn){
            $playId = $this->arrPlayId['XIANWU'];//$playId = 3466;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲五输');
        } else if((int)$banker_nn == (int)$player5_nn && (int)$banker_nn <= 6){
            $playId = $this->arrPlayId['XIANWU'];//$playId = 3466;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲五输');
        } else if((int)$banker_nn == (int)$player5_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[5]){
            $playId = $this->arrPlayId['XIANWU'];//$playId = 3466;
            $numCode = $gamePlay.$playId;
            $lose->push([$numCode,(int)$banker_nn]);
            //\Log::info('闲五输');
        } else {
            $playId = $this->arrPlayId['XIANWU'];//$playId = 3466;
            $numCode = $gamePlay.$playId;
            $win->push([$numCode,(int)$player5_nn]);
            //\Log::info('闲五赢');
        }
    }
}

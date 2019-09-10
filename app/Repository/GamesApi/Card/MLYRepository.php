<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/7
 * Time: 14:47
 */

namespace App\Repository\GamesApi\Card;


class MLYRepository extends BaseRepository
{
    //格式化数据  插入数据库
    public function createData($aData){
        $GameIDs = $this->distinct($aData, 'id');
        $arr = [];
        foreach ($aData as $v){
            if(in_array($v['id'], $GameIDs))
                continue;
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $v['id'],
                'sessionId' => '',
                'username' => $v['muid'],
                'AllBet' => $v['betcoin'],
                'bunko' => $v['wlcoin'],
                'bet_money' => $v['codeamount'],
                'GameStartTime' => $v['endtime'],
                'GameEndTime' =>  $v['endtime'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => $v['endtime'],
                'gameCategory' => 'PVP',
                'bet_info' => $v['bp'],
                'game_type' => $this->getGameType($v['gid']),
                'service_money' => $v['choushui'] ?? 0,
                'flag' => 1,
                'game_id' => 41,
                'round_id' => $v['gameno'] ?? '',  //局号
            ];
            $array['content'] = $this->content($v) ?: $array['game_type'];
            $user = $this->getUser($array['username']);
            $array['agent'] = $user->agent ?? 0;
            $array['user_id'] = $user->id ?? 0;
            $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
            $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
            $arr[] = $array;
        }
        return $this->insertDB($arr);
    }

    public function content($v)
    {
        $str = '局号：'.$v['gameno'].'<br />';
        $str .= '房间id：'.$v['roomid'].'<br />';
        $str .= '下注前余额：'.($v['coinquit'] + $v['wlcoin'] + $v['choushui']).'<br />';
        $str .= '用户ID：'.$v['uid'].'<br />';

        return $str;
    }

    public function getGameType($value)
    {
        $arr = [
            0 => [
                'k' => 'hall',
                'v' => '大厅',
            ],
            1 => [
                'k' => 'Fish',
                'v' => '捕鱼',
            ],
            2 => [
                'k' => 'DoubleKilling',
                'v' => '龙虎斗',
            ],
            3 => [
                'k' => 'Bobbin',
                'v' => '推筒子',
            ],
            4 => [
                'k' => 'Baccara',
                'v' => '百家乐',
            ],
            5 => [
                'k' => 'niuniu',
                'v' => '抢庄牛牛',
            ],
            6 => [
                'k' => 'threecards',
                'v' => '炸金花',
            ],
            7 => [
                'k' => 'BRNiuniu',
                'v' => '百人牛牛',
            ],
            8 => [
                'k' => 'FruitMachine',
                'v' => '百人水果机',
            ],
            9 => [
                'k' => 'FruitMachineSingle',
                'v' => '单人水果机',
            ],
            10 => [
                'k' => 'RedBlack',
                'v' => '红黑大战',
            ],
            11 => [
                'k' => 'LandLord',
                'v' => '斗地主',
            ],
            12 => [
                'k' => 'thirteencards',
                'v' => '十三水',
            ],
            13 => [
                'k' => 'erbagang',
                'v' => '二八杠',
            ],
            14 => [
                'k' => 'SanGong',
                'v' => '三公',
            ],
            15 => [
                'k' => 'BoatNiuniu',
                'v' => '开船牛牛',
            ],
            16 => [
                'k' => 'BRTexas',
                'v' => '百人德州',
            ],
            17 => [
                'k' => 'SanGongSail',
                'v' => '开船三公',
            ],
            18 => [
                'k' => 'NiuNiuMP',
                'v' => '闷牌牛牛',
            ],
            19 => [
                'k' => 'SanGong',
                'v' => '闷牌三公',
            ],
            20 => [
                'k' => 'BlackJack',
                'v' => '21点',
            ],
        ];
        foreach ($arr as $k => $v){
            if(strtolower($v['k']) == strtolower($value)){
                return $v['v'];
            }
        }
        return '';
    }

}
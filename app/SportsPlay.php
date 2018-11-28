<?php

namespace App;

class SportsPlay extends Base
{
    protected $table = 'sports_play';
    protected $primaryKey = 'id';
    private $aArr = [
        'minMoney' => 1,
        'maxMoney' => 50000,
        'maxTurnMoney' => 50000,
        'rebate' => 1,
    ];
    //create胜平负
    public function create_spf($data, $game_id){
        $data = explode(',',$data);
        $arr = [];
        foreach ($data as $k=>$v) {
            $aArr = $this->aArr;
            $aArr['gameId'] = $game_id;
            $aArr['odds'] = $v;
            $aArr['name'] = $this->spfArr[$k]['name'];
            $aArr['odds_tag'] = $this->spfArr[$k]['odds_tag'];
            $arr[] = $aArr;
        }
        return $arr;
    }
    //create比分
    public function create_bf($data, $game_id){
        $data = explode(',',$data);
        $arr = [];
        foreach ($data as $k=>$v) {
            $aArr = $this->aArr;
            $aArr['gameId'] = $game_id;
            $aArr['odds'] = $v;
            $aArr['name'] = $this->bfArr[$k]['name'];
            $aArr['odds_tag'] = $this->bfArr[$k]['odds_tag'];
            $arr[] = $aArr;
        }
        return $arr;
    }
    //create让球
    public function create_jq($data, $game_id){
        $data = explode(',',$data);
        $arr = [];
        foreach ($data as $k=>$v) {
            $aArr = $this->aArr;
            $aArr['gameId'] = $game_id;
            $aArr['odds'] = $v;
            $aArr['name'] = $this->jqArr[$k]['name'];
            $aArr['odds_tag'] = $this->jqArr[$k]['odds_tag'];
            $arr[] = $aArr;
        }
        return $arr;
    }
    //勝平負
    private $spfArr = [
        0 => [
            'name' => '勝',
            'odds_tag' => 'sheng'
        ],
        1 => [
            'name' => '平',
            'odds_tag' => 'ping'
        ],
        2 => [
            'name' => '负',
            'odds_tag' => 'fu'
        ],
    ];
    //进球
    public $jqArr = [
        0 => [
            'name' => '0球',
            'odds_tag' => ''
        ],
        1 => [
            'name' => '1球',
            'odds_tag' => ''
        ],
        2 => [
            'name' => '2球',
            'odds_tag' => ''
        ],
        3 => [
            'name' => '3球',
            'odds_tag' => ''
        ],
        4 => [
            'name' => '4球',
            'odds_tag' => ''
        ],
        5 => [
            'name' => '5球',
            'odds_tag' => ''
        ],
        6 => [
            'name' => '6球',
            'odds_tag' => ''
        ],
        7 => [
            'name' => '其它',
            'odds_tag' => ''
        ],
    ];
    //比分
    public $bfArr = [
        0 => [
            'name' => '1:0',
            'odds_tag' => '1_0'
        ],
        1 => [
            'name' => '2:0',
            'odds_tag' => '2_0'
        ],
        2 => [
            'name' => '2:1',
            'odds_tag' => '2_1'
        ],
        3 => [
            'name' => '3:0',
            'odds_tag' => '3_0'
        ],
        4 => [
            'name' => '3:1',
            'odds_tag' => '3_1'
        ],
        5 => [
            'name' => '3:2',
            'odds_tag' => '3_2'
        ],
        6 => [
            'name' => '4:0',
            'odds_tag' => '4_0'
        ],
        7 => [
            'name' => '4:1',
            'odds_tag' => '4_1'
        ],
        8 => [
            'name' => '4:2',
            'odds_tag' => '4_2'
        ],
        9 => [
            'name' => '5:0',
            'odds_tag' => '5_0'
        ],
        10 => [
            'name' => '5:1',
            'odds_tag' => '5_1'
        ],
        11 => [
            'name' => '5:2',
            'odds_tag' => '5_2'
        ],
        12 => [
            'name' => '赢其它',
            'odds_tag' => 'yingqita'
        ],
        13 => [
            'name' => '0:0',
            'odds_tag' => '0_0'
        ],
        14 => [
            'name' => '1:1',
            'odds_tag' => '1_1'
        ],
        15 => [
            'name' => '2:2',
            'odds_tag' => '2_2'
        ],
        16 => [
            'name' => '3:3',
            'odds_tag' => '3_3'
        ],
        17 => [
            'name' => '平其它',
            'odds_tag' => 'pingqita'
        ],
        18 => [
            'name' => '0:1',
            'odds_tag' => '0_1'
        ],
        19 => [
            'name' => '0:2',
            'odds_tag' => '0_2'
        ],
        20 => [
            'name' => '1:2',
            'odds_tag' => '1_2'
        ],
        21 => [
            'name' => '0:3',
            'odds_tag' => '0_3'
        ],
        22 => [
            'name' => '1:3',
            'odds_tag' => '1_3'
        ],
        23 => [
            'name' => '2:3',
            'odds_tag' => '2_3'
        ],
        24 => [
            'name' => '0:4',
            'odds_tag' => '0_4'
        ],
        25 => [
            'name' => '1:4',
            'odds_tag' => '1_4'
        ],
        26 => [
            'name' => '2:4',
            'odds_tag' => '2_4'
        ],
        27 => [
            'name' => '0:5',
            'odds_tag' => '0_5'
        ],
        28 => [
            'name' => '1:5',
            'odds_tag' => '1_5'
        ],
        29 => [
            'name' => '2:5',
            'odds_tag' => '2_5'
        ],
        30 => [
            'name' => '输其它',
            'odds_tag' => 'shuqita'
        ]
    ];
}

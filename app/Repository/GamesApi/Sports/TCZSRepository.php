<?php
/* 体彩指数数据处理 */

namespace App\Repository\GamesApi\Sports;

use Illuminate\Support\Facades\DB;

class TCZSRepository extends TCRepository
{
    //获取体彩指数api数据
    public function getTCZS(){
        $data = $data = json_decode('{
              "jczq": [
                {
                  "id": 1805056001,
                  "event": "日本职业联赛",
                  "home": "札幌冈萨多",
                  "away": "大阪钢巴",
                  "issue": "180505",
                  "issue_num": "6001",
                  "sell_status": "1,1,2,2,2",
                  "matchtime": 1525539600,
                  "spf": "1.81,3.60,3.35",
                  "rq": "-1,3.42,3.55,1.80",
                  "bf":"6.00,8.50,7.50,18.00,18.00,29.00,50.00,39.00,80.00,150.0,150.0,250.0,80.00,8.00,5.60,15.00,70.00,500.0,7.25,13.00,9.00,39.00,28.00,39.00,100.0,80.00,120.0,400.0,300.0,400.0,150.0",
                  "jq": "12.00,4.70,3.25,3.60,5.00,8.50,14.00,23.00",
                  "bqc": "2.80,13.00,34.00,4.20,5.50,7.80,24.00,13.00,5.50"
                }
              ],
              "jclq": [
                {
                  "id": 1805045301,
                  "event": "美国职业篮球联盟",
                  "home": "金州勇士",
                  "away": "新奥尔良鹈鹕",
                  "issue": "180504",
                  "issue_num": "5301",
                  "sell_status": "1,1,1,2",
                  "matchtime": 1525539600,
                  "sf": "1.32,2.55",
                  "rf": "5.50,1.75,1.75",
                  "sfc": "4.15,3.65,5.55,9.70,18.50,20.00,5.00,5.70,11.00,22.00,39.00,50.00",
                  "dxf": "231.50,1.75,1.75"
                }
              ]
            }',true);
        return $this->show(0,'',$data);
    }
//    public function getRes(){
//        $res = $this->service->send_TCZS();
//        if(empty($res))
//            return $this->show(500, '请求超时');
//        $data = @json_decode($res, 1);
//        if(empty($data))
//            return $this->show(1, $res);
//        return $data;
//    }
    //格式化储存
    public function createDataTCZS($data){
        if(isset($data['jczq']))
            $this->createData_jczq($data['jczq']);
//        if(isset($data['jclq']))
//            $this->createData_jczq($data['jclq']);
    }
    //处理体彩指数竞猜足球数据
    public function createData_jczq($data){
        $SportsGames = $this->getOtherModel('SportsGames');
        $jczq = DB::table('sports_jczq');
        $jczqArr = [];
//        echo microtime();
        foreach ($data as $k=>$v){
            //插入game表 得到game_id
            $game_id = $SportsGames->checkInsertId($this->createInsertGame($v));
            //组合Jczq表数据
            if($game_id && !$jczq->where('issue', $v['id'])->count())
                $jczqArr[] = $this->createInsertJczq($v, $game_id);
            //插入play
            $this->createInsertPlay($v, $game_id);
        }
        //插入Jczq
        $jczq->insert($jczqArr);
//        echo '插入'.count($jczqArr).'条数据';
    }
    private function createInsertPlay($v,$game_id){
        $SportsPlay = $this->getOtherModel('SportsPlay');
        $spf = $SportsPlay->create_spf($v['spf'], $game_id);//胜平负
        $bf = $SportsPlay->create_bf($v['bf'], $game_id); //比分
        $jq = $SportsPlay->create_jq($v['jq'], $game_id); //总进球
        $arr = array_merge($spf, $bf, $jq);
        $SportsPlay->insert($arr);
    }
    private function createInsertJczq($v,$game_id){
        return [
            'issue' => $v['id'],
            'is_open' => 1,
            'year' => date('Y', $v['matchtime']),
            'month' => date('m', $v['matchtime']),
            'day' => date('d', $v['matchtime']),
            'opentime' => date('Y-m-d H:i:s', $v['matchtime']),
            'apiopentime' => $v['matchtime'],
            'opennum' => 0,
            'bunko' => 0,
            'backwater' => 0,
            'game_id' => $game_id,
            'spf' => $v['spf'],
            'rq' => $v['rq'],
            'bf' => $v['bf'],
            'jq' => $v['jq'],
            'bqc' => $v['bqc'],
        ];
    }
    private function createInsertGame($v){
        $SportsEvent = $this->getOtherModel('SportsEvent');
        $SportsTeamname = $this->getOtherModel('SportsTeamname');
        return [
            'type' => 1,
            'event' => $SportsEvent->checkInsertId($v['event']),
            'home' => $SportsTeamname->checkInsertId($v['home']),
            'away' => $SportsTeamname->checkInsertId($v['away']),
            'issue' => $v['issue'],
            'issue_num' => $v['issue_num'],
            'sell_status' => $v['sell_status'],
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    }
    //处理竞猜篮球数据
    public function createData_jclq($data){

    }
    public function deleteTCZS(){
//        $this->getOtherModel('SportsEvent')->truncate();
//        $this->getOtherModel('SportsTeamname')->truncate();
        $this->getOtherModel('SportsPlay')->truncate();
    }


    
}
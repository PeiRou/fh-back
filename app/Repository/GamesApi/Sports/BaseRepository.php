<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 12:14
 */

namespace App\Repository\GamesApi\Sports;
use App\Http\Services\FactoryService;
use Illuminate\Support\Facades\DB;

class BaseRepository
{
    protected $model;

    protected $otherModel;

    protected $otherRepository;
    public function __construct()
    {
        if(is_null($this->otherModel))
            $this->otherModel = new \stdClass;
    }

    //处理返回数据
    public function createData($data){
//        $arr = [];
//        for ($i = 0; $i < 200; $i++){
//            $arr[] = $data['jczq'][0];
//        }
//        $data['jczq'] = $arr;
        if(isset($data['jczq']))
            $this->createData_jczq($data['jczq']);
    }
    //处理竞猜足球数据
    public function createData_jczq($data){
        $SportsEvent = $this->getOtherModel('SportsEvent');
        $SportsTeamname = $this->getOtherModel('SportsTeamname');
        $SportsGames = $this->getOtherModel('SportsGames');
        $jczq = DB::table('sports_jczq');
        $jczqArr = [];
//        echo microtime();
        foreach ($data as $k=>$v){
            //插入game表
            $arr = [
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
            //插入jczq表
            if($game_id = $SportsGames->checkInsertId($arr)){
                if(!$jczq->where('issue', $v['id'])->count()){
                    $jczqArr[] = [
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
                        'spf' => $v['bqc'],
                    ];
                }
            }
        }
        $jczq->insert($jczqArr);
        echo '插入'.count($jczqArr).'条数据';
//        echo microtime();
    }
    //处理竞猜篮球数据



    public function getOtherModel($model){
        if(empty($this->otherModel->$model))
            $this->otherModel->$model = FactoryService::generateModel($model);
        return $this->otherModel->$model;
    }
    public function getOtherRepository($repository){
        if(empty($this->otherRepository->$repository))
            $this->otherRepository->$repository = FactoryService::generateRepository($repository);
        return $this->otherRepository->$repository;
    }

}
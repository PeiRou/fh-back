<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 12:14
 */

namespace App\Repository;


use App\GamesApi;
use App\GamesList;
use App\Http\Controllers\Obtain\SendController;
use App\JqBetHis;
use App\JqReportBet;
use App\JqReportBetGame;
use App\Offer;
use App\SystemSetting;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;

class PlatformOfferRepository extends BaseRepository
{

    public function __construct($param = [])
    {
        $this->param = $param;
        $this->param['time'] = $param['date'] ?? time();
        $this->param['startTime'] = date('Y-m-01 00:00:00', $this->time);
        $this->param['endTime'] = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($this->startTime)) - 1);
    }

    public function __get($key)
    {
        isset($this->param[$key]) &&
            $this->$key = $this->param[$key];
        return $this->$key;
    }

    public $type = [
        1 => '平台费用',
        2 => '证书费用(https)',
        3 => '其它',
        4 => '第三方游戏费用',
    ];

    //第三方游戏费用
    public function jq($param = [])
    {
        $type = 4;
        $res = JqReportBetGame::reportQuerySum([
            'startTime' => $this->startTime,
            'endTime' => $this->endTime,
        ]);
        $arr = [];
        foreach ($res as $v){
            $data = [
                'order_id' => $this->orderNumber(),
                'order_no' => '',
                'money' => GamesApi::getRatioMoney($v->bet_bunko,[
                    'g_id' => $v->game_id,
                    'productType' => $v->productType,
                ]),
                'status' => 0,
                'type' => $type,
                'paystatus' => 0,
                'typestr' => $this->type[$type],
                'content' => $v->game_name . '-' . (GamesList::$productType[$v->productType] ?? '') . date('-Y年m月', $this->time) . '费用',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'overstayed' => date('Y-m-d H:i:s', time() + 3600 * 24 * 7),
                'date' => date('Y-m-d', $this->time),
            ];
            $arr[] = $data;
        }
        $this->save($arr, $type);
    }

    private function save($data, $type)
    {
//        if(count($data) < 1)
//            return false;
//        $model = Offer::class;
//        DB::beginTransaction();
//        try{
//            if(isset($this->param['clear']))
//                $model::where('date', date('Y-m-d', $this->time))
//                    ->where('type', $type)
//                    ->delete();
//            $model::insert($data);
//            DB::commit();
//            # 平台更新成功
//        }catch (\Throwable $e){
//            DB::rollback();
//            echo $e->getMessage();
//            writeLog('error', $this->type[$type].$e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
//            return false;
//        }
//        //通知总后台 为了通知总后台的IO时间不影响事物时间 分开写
        $this->send($data, $type);
    }

    private function send($data, $type)
    {
        static $platform_id;
        if(empty($platform_id))
            $platform_id = SystemSetting::getValueByRemark1('payment_platform_id');

        $baseController = new SendController([
            'platform_id' => $platform_id,
            'data' => json_encode($data),
            'type' => $type
        ]);
        $res = $baseController->sendParameter('Children/PlatformOffer/save');
        p($res, 1);
    }


    //默认生成订单号
    protected function orderNumber($alias = ''){
        $date = date('YmdHis');
        $randnum = rand(10000000,99999999);
        return $alias.$date.$randnum;
    }

}
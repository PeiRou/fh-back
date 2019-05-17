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
use App\ReportBet;
use App\SystemSetting;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\PHP;

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
        $res = JqReportBetGame::reportQuerySum([
            'startTime' => $this->startTime,
            'endTime' => $this->endTime,
        ]);
        return $res;
    }


    //第三方游戏费用
//    public function jq($param = [])
//    {
//        $type = 4;
//        $res = JqReportBetGame::reportQuerySum([
//            'startTime' => $this->startTime,
//            'endTime' => $this->endTime,
//        ]);
//        $arr = [];
//        foreach ($res as $v){
//            $data = $this->createData([
//                'money' => GamesApi::getRatioMoney($v->bet_bunko,[
//                    'g_id' => $v->game_id,
//                    'productType' => $v->productType,
//                ]),
//                'type' => $type,
//                'content' => $v->game_name . '-' . (GamesList::$productType[$v->productType] ?? '') . date('-Y年m月', $this->time) . '费用',
//            ]);
//            $arr[] = $data;
//        }
//        $this->save($arr, $type);
//    }

    //彩票费用
    public function lottery($param = [])
    {
        $res = ReportBet::reportQuerySum([
            'startTime' => $this->startTime,
            'endTime' => $this->endTime,
        ], ['bet_money', 'bunko'])->toArray();
        return $res;
    }

    private function createData($data = [])
    {
        return array_merge([
            'order_id' => $this->orderNumber(),
            'order_no' => '',
            'money' => 0,
            'status' => 0,
            'type' => '',
            'paystatus' => 0,
            'typestr' => $this->type[$data['type'] ?? 0] ?? '',
            'content' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'overstayed' => date('Y-m-d H:i:s', time() + 3600 * 24 * 7),
            'date' => date('Y-m-d', $this->time),
        ], $data);
    }

    /**
     * 更新平台后台
     * @param $data
     * @param $type 默认命令行clear = true 会清除掉type，date对应的数据
     * @return bool
     */
    private function save($data, $type)
    {
        if(count($data) < 1)
            return false;
        $model = Offer::class;
        DB::beginTransaction();
        try{
            if(isset($this->param['clear']))
                $model::where('date', 'like', date('Y-m', $this->time).'%')
                    ->where('type', $type)
                    ->delete();
            $model::insert($data);
            DB::commit();
            # 平台更新成功
        }catch (\Throwable $e){
            DB::rollback();
            echo $e->getMessage();
            writeLog('error', $this->type[$type].$e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
            return false;
        }
//        //通知总后台 为了通知总后台的IO时间不影响事物时间 分开写
        $this->send($data, $type);
    }

    /**
     * 通知总后台更新
     * @param $data
     * @param $type 费用类型
     */
    private function send($data, $type)
    {
        static $platform_id;
        if(empty($platform_id))
            $platform_id = SystemSetting::getValueByRemark1('payment_platform_id');

        $baseController = new SendController([
            'platform_id' => $platform_id,
            'data' => json_encode([
                'data' => $data,
                'type' => $type,
                'param' => $this->param
            ]),
        ]);
        $res = $baseController->sendParameter('Children/PlatformOffer/save');
        if(isset($res['code']) && $res['code'] === 0) {
            echo '-OK';
        }else {
            echo ''.($res['msg'] ?? 'error');
        }
        echo PHP_EOL;
    }

    public function generate($data)
    {
        $platform_id = SystemSetting::getValueByRemark1('payment_platform_id');

        $baseController = new SendController([
            'platform_id' => $platform_id,
            'data' => json_encode([
                'data' => $data,
                'param' => $this->param
            ]),
        ]);
        return  $baseController->sendPlatformOffer('Children/PlatformOffer/generate');
    }

    public function saveDB($array)
    {
        if (!is_array($array))
            throw new \Exception('返回数据异常！');

        extract($array);
        if(!isset($data, $typeIn))
            throw new \Exception('返回数据异常2！');
        foreach ($data as &$v){
            unset($v['platform_id']);
            unset($v['send_status']);
        }
        $model = Offer::class;
        DB::beginTransaction();
        try{
            if(isset($this->param['clear']) && $this->param['clear'] == 1)
                $model::where('date', date('Y-m-01', $this->time))
                    ->whereIn('type', $typeIn)
                    ->update([
                        'is_delete' => 1
                    ]);
            $model::insert($data);
            DB::commit();
            return true;
            # 平台更新成功
        }catch (\Throwable $e){
            DB::rollback();
            writeLog('error', $e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
            throw $e;
        }
    }

    //默认生成订单号
    protected function orderNumber($alias = ''){
        $date = date('YmdHis');
        $randnum = rand(10000000,99999999);
        return $alias.$date.$randnum;
    }

}
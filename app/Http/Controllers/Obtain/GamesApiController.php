<?php

namespace App\Http\Controllers\Obtain;

use App\Feedback;
use App\FeedbackMessage;
use App\GamesApi;
use App\GamesList;
use Illuminate\Support\Facades\DB;

class GamesApiController extends BaseController
{
    //执行方法
    public function doAction ($aParam)
    {
        $action = $aParam['action'] ?? '';
        if(method_exists($this, $action)){
            return call_user_func([$this, $action], $aParam);
        }
        return $this->returnAction([
            'code' => 1,
            'msg' => $this->code[1],
        ]);
    }

    /**
     * 开关游戏 - 修改维护字段
     * @param $aParam
     */
    private function GamesListSave($aParam)
    {
        if(!isset($aParam['list']))
            $aParam['list'] = [];
        GamesList::where(function($sql){})->update(['weihu' => 0]);
        if(count($aParam['list']) > 0 && !GamesList::whereRaw('game_id in ('.$aParam['list'].')')->update(['weihu' => 1]))
            return $this->returnAction([
                'code' => 6,
                'msg' => '修改失败',
            ]);
        return $this->returnAction([
            'code' => 0,
            'msg' => $this->code[0],
        ]);
    }

    //更新接口的信息  配置、其它附加参数
    private function GamesApiSave($aParam)
    {
        $data = json_decode($aParam['data'], 1);
        $info = $data['info'];
        $config = $data['config'];
        $other_param = $data['other_param'];
        $g_id = $info['g_id'];

        unset($info['g_id'], $info['sort'], $info['open'], $info['platform_id']);

        $configArr = [];
        foreach ($config as $k=>$v){
            $configArr[] = [
                'g_id' => $v['g_id'],
                'key' => $v['key'],
                'value' => $v['value'],
                'description' => $v['description'],
            ];
        }

        $other_paramArr = [];
        foreach ($other_param as $k=>$v){
            $other_paramArr[] = [
                'g_id' => $v['g_id'],
                'key' => $v['key'],
                'value' => $v['value'],
                'name' => $v['name'],
                'param' => $v['param'],
            ];
        }

        try{
            DB::beginTransaction();
            $games_api = DB::table('games_api')->where('g_id', $g_id);
            $games_api_config = DB::table('games_api_config')->where('g_id', $g_id);
            $games_api_other_param = DB::table('games_api_other_param')->where('g_id', $g_id);

            $games_api_config->delete();
            $games_api_other_param->delete();

            if(!$games_api_config->insert($configArr)
                || !$games_api_other_param->insert($other_paramArr))
                throw new \Exception('error');
            if($games_api->count() > 0){
                $games_api->update($info);
            }else{
                $games_api->insert(array_merge($info, ['g_id'=>$g_id]));
            }

            DB::commit();
            return $this->returnAction([
                'code' => 0,
                'msg' => $this->code[0],
            ]);
        }catch (\Throwable $e){
            DB::rollback();
            writeLog('error', $e->getMessage());
            return $this->returnAction([
                'code' => 6,
                'msg' => '修改失败',
            ]);
        }
    }

    private function GamesApiGet($aParam)
    {
        $data['games_api'] = DB::table('games_api')->get();
        $data['games_api_config'] = DB::table('games_api_config')->get();
        $data['games_api_other_param'] = DB::table('games_api_other_param')->get();

        $this->show(0, $data);
    }

    private function GamesApiDel($aParam)
    {
        if(!isset($aParam['g_id']) || !($g_id = (int)$aParam['g_id']))
            return $this->show(1);

        GamesApi::delGamesApi($g_id);
        $this->show(0, [], 'ok');
    }

    //修改第三方余额
    private function GamesPlatQuota($aParam)
    {
        try{
            $data = json_decode($aParam['data'], 1);
            $orderNum = $data['orderNum'];
            if($orderInfo = DB::table('platform_capital')->where('orderNum', $orderNum)->first()){
                $this->show(0, ['money' => $orderInfo->plat_amount], 'ok');
            }
            if((float)$data['amount'] === 0){
                $this->show(10, [], '金额不能为0');
            }
            $nowMoney = DB::table('system_setting')->value('gamesapi_amount');
            $upMoney = $nowMoney + $data['amount'];
            DB::beginTransaction();
            $arr = [
                'orderNum' => $data['orderNum'],
                'type_id' => $data['type_id'],
                'type' => $data['type'],
                'type_updown' => (int)$data['type_updown'],
                'amount' => (float)$data['amount'],
                'plat_amount' => $upMoney, //帐变后的金额
                'admin_id' => $data['admin_id'],
                'admin_account' => $data['admin_account'],
                'content' => $data['content'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            if(!DB::table('platform_capital')->insert($arr) ){
                throw new \Exception('增加资金明细失败', 1);
            }
            if(!(DB::table('system_setting')->where('id', 1)->update(['gamesapi_amount' => DB::raw(' `gamesapi_amount` + ' . $data['amount'])]))){
                throw new \Exception('修改金额失败', 1);
            }
            DB::commit();
            $this->show(0, ['money' => $upMoney], 'ok');
        }catch (\Throwable $e){
            DB::rollback();
            if(!$e->getCode()){
                writeLog('error', $e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
            }
            $this->show(15, [],  'error'.$e->getMessage());
        }
    }

    //获取第三方配置的余额
    private function getGamesPlatQuotaMoney($aParam)
    {
        $money = DB::table('system_setting')->value('gamesapi_amount');
        return  $this->show(0, ['money' => $money], 'ok');
    }

    //设置平台收支
    private function setPlatjqpoint($aParam)
    {
        try{
            $data = json_decode($aParam['data'], 1);
            $arr = [];
            foreach ($data as $v){
                $arr[] = [
                    'jq_game_id' => $v['jq_game_id'],
                    'jq_game_name' => $v['jq_game_name'],
                    'jq_point' => $v['jq_point'],
                    'admin_id' => $v['admin_id'],
                    'admin_account' => $v['admin_account'],
                    'created_at' => $v['created_at'],
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            DB::transaction(function () use($arr){
                DB::table('platform_jqpoint')->truncate();
                if(!DB::table('platform_jqpoint')->insert($arr))
                    throw new \Exception('platform_jqpoint插入失败');
            });
            $this->show(0, [], 'ok');
        }catch (\Throwable $e){
            if(!$e->getCode()){
                writeLog('error', $e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
            }
            $this->show(15, [],  'error'.$e->getMessage());
        }
        return  $this->show(0, [], 'ok');
    }

    private function getPlatformCapital($aParam)
    {
        if(!isset($aParam['endTime'], $aParam['startTime']))
            return  $this->show(1);
//        $aParam['endTime'] = date('Y-m-d H:i:s', strtotime($aParam['endTime']));
//        $aParam['startTime'] = date('Y-m-d H:i:s', strtotime($aParam['startTime']));
        if(strtotime($aParam['endTime']) - strtotime($aParam['startTime']) > 60 * 15)
            return  $this->show(15, '时间间隔过大');
        $res = DB::table('platform_capital')->whereBetween('updated_at', [$aParam['startTime'], $aParam['endTime']])->get();
        return  $this->show(0, $res, 'ok');
    }

}

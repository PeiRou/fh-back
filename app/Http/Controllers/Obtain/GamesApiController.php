<?php

namespace App\Http\Controllers\Obtain;

use App\Feedback;
use App\FeedbackMessage;
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
            $this->returnAction([
                'code' => 1,
                'msg' => $this->code[1],
            ]);
        GamesList::where(function($sql){})->update(['weihu' => 0]);
        if(!GamesList::whereRaw('game_id in ('.$aParam['list'].')')->update(['weihu' => 1]))
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

}

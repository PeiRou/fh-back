<?php
/* 龍城娱乐 */
namespace App\Http\Controllers\GamesApi\Sports;

use App\GamesApi;
use App\GamesApiConfig;

class PrivodeController extends BaseController {
    public function getRes(){
        $list = GamesApi::getTcList();
//        foreach ($list as $k=>$v){
//            $res = $this->action($v->g_id, 'getRes');
//        }
        return $this->action(18, 'getRes');
    }
    public function action($g_id, $method){
        $getGamesApiInfo = GamesApi::getGamesApiInfo($g_id);
        $config = GamesApiConfig::getConfig($g_id);
        if($getGamesApiInfo && $getGamesApiInfo['class_name']){
            $instanceName = $this->getInstanceName($getGamesApiInfo['class_name']);
            $repoName= $this->getRepositoryName($getGamesApiInfo['class_name']);
            $repo = new $repoName($config);
            $instance = new $instanceName($repo);
            $repo->gameInfo = $getGamesApiInfo;
            return $instance->action($method);
        }
        return [
            'code' => 1,
            'msg' => '没有这个游戏',
            'data' => []
        ];
    }
    //获取实例类名
    protected function getInstanceName($name = 'Base'){
        $class = sprintf("App\Http\Controllers\GamesApi\Sports\%sController",$name);
        return $class;
    }
    //获取服务类名
    protected function getRepositoryName($name = 'Base'){
        $class = sprintf("\App\Repository\GamesApi\Sports\%sRepository",$name);
        return $class;
    }
}

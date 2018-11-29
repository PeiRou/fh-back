<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 12:14
 */

namespace App\Repository\GamesApi\Sports;
use App\Http\Services\FactoryService;

class BaseRepository
{
    protected $model;
    protected $otherModel;
    protected $otherRepository;
    public $instance;
    public $service;
    public $gameInfo = []; //游戏信息
    public $Config = []; //配置
    public $param = []; //参数

    public function __construct($config)
    {
        $className = 'App\Repository\GamesApi\Sports\Service\TC';
        $this->Config = $config;
        $this->otherModel = (object)[];
        $this->otherRepository = (object)[];
        $this->instance = (object)[];
        $this->service = new $className($config);
    }
    protected function show($code = '', $msg = '', $data = []){
        $data = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return $data;
    }
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
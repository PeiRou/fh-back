<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 12:14
 */

namespace App\Repository\HandleLog;
use App\Http\Services\FactoryService;
use App\LogHandle;

class BaseRepository
{
    protected $response;
    protected $request;
    private $param = null;
    public function __construct($response,$request,$id, $data)
    {
        $this->response = $response;
        $this->request = $request;
        $this->id = $id;
        $this->data = $data;
//        if(class_exists($response)){
//            $class = new \ReflectionClass($response);
//            if($class->getName() == 'Illuminate\Http\JsonResponse')
//                $this->response = $response->getContent();
//        }
        $this->action();
    }
    public function action(){
        $funcName = preg_replace_callback('/([\.]+([a-z]{1}))/i',function($matches){
            return strtoupper($matches[2]);
        },$this->request->route()->getName());
        if(method_exists($this, $funcName))
            $this->$funcName();
        $this->update();
    }
    private function update(){
        if(!empty($this->param) && is_array($this->param)){
            LogHandle::where('id', $this->id)->update($this->param);
        }
    }
    //改变用户金额
    private function acAdChangeUserMoney(){
        $this->param['action'] = '管理员'.$this->data['username'].'修改用户('.$this->data['user_id'].')金额：'.$this->request->money;
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
<?php

namespace App\Http\Controllers\GamesApi\Sports;

use App\Http\Controllers\Controller;
use App\Http\Services\FactoryService;
class BaseController extends Controller
{
    protected $repository;
    protected $otherRepository;

    public function __construct()
    {
        if(is_null($this->otherRepository))
            $this->otherRepository = new \stdClass;
    }

    /**
     * @param $repoName
     * @return mixed
     */
    public function getOtherRepository($repository){
        if(empty($this->otherRepository->$repository))
            $this->otherRepository->$repository = FactoryService::generateRepository($repository);
        return $this->otherRepository->$repository;
    }
    public function getOtherApiRepository($repository){
        if(empty($this->otherRepository->$repository))
            $this->otherRepository->$repository = FactoryService::generateRepository('GamesApi\\Sports\\'.$repository);
        return $this->otherRepository->$repository;
    }
    /**
     * 获得控制器名
     * @return string
     */
    private function getController(){
        return lcfirst(str_replace('Controller','',$this->currentController));
    }

}

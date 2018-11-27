<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 19:18
 */

namespace App\Service;


class FactoryService
{
    /**
     * @param $className
     * @param string $param
     * @return mixed
     */
    public static function generateClass($className,$param=""){
        if(!empty($param)){
            return  new $className($param);
        }
        return new $className();
    }

    /**
     * @param $service
     * @param string $param
     * @return mixed
     */
    public static function generateService($service,$param=""){
        return self::generateClass('\App\\Service\\'.ucfirst($service).'Service',$param);
    }

    /**
     * @param $repository
     * @return mixed
     */
    public static function generateRepository($repository){
        return self::generateClass('\App\\Repository\\'.ucfirst($repository).'Repository',$repository);
    }

    /**
     * @param $model
     * @param string $tableName
     * @return mixed
     */
    public static function generateModel($model){
        return self::generateClass('\App\\Model\\'.ucfirst($model).'Model');
    }

    /**
     * @param $requestsName
     * @return mixed
     */
    public static function generateRequests($requestsName){
        return self::generateClass('\App\\Http\\Requests\\'.ucfirst($requestsName).'Validate');
    }

    /**
     * @param $channelName
     * @return mixed
     */
    public static function generateChannel($channelName){
        return self::generateClass('\App\\Channel\\'.ucfirst($channelName).'Channel');
    }
}